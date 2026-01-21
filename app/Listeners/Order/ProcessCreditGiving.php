<?php

namespace App\Listeners\Order;

use App\Enums\CreditLogType;
use App\Events\Order\OrderStatusChanged;
use App\Notifications\Orders\CreditAddedNotification;
use App\Support\NotificationHelper;
use Illuminate\Support\Facades\Log;

/**
 * Process credit giving when order becomes paid.
 * 
 * SYNC listener - NOT queued for immediate balance update.
 * Idempotent - checks credit_given_at before processing.
 * Failure does NOT break order lifecycle.
 */
class ProcessCreditGiving
{
    public function handle(OrderStatusChanged $event): void
    {
        $order = $event->order;
        $newStatus = $event->newStatus;

        // Only process when status becomes paid
        if (!$newStatus->isPaid()) {
            return;
        }

        // Idempotency check - prevent double credit giving
        if ($order->credit_given_at !== null) {
            Log::info('[ProcessCreditGiving] Credit already given', [
                'order_id' => $order->id,
                'credit_given_at' => $order->credit_given_at,
            ]);
            return;
        }

        // Check if order has credit amount
        if ($order->credit_amount <= 0) {
            Log::info('[ProcessCreditGiving] Order has no credit amount', [
                'order_id' => $order->id,
            ]);
            return;
        }

        $user = $order->user;

        if (!$user) {
            Log::error('[ProcessCreditGiving] User not found', [
                'order_id' => $order->id,
                'user_id' => $order->user_id,
            ]);
            return;
        }

        try {
            // Add credit to user
            $user->addCredit(
                amount: $order->credit_amount,
                type: CreditLogType::PURCHASE,
                description: "Credit from order #{$order->order_number}",
                reference: $order
            );

            // Mark credit as given (updateQuietly to prevent recursive observer)
            $order->updateQuietly([
                'credit_given_at' => now(),
            ]);

            Log::info('[ProcessCreditGiving] Credit given successfully', [
                'order_id' => $order->id,
                'user_id' => $user->id,
                'credit_amount' => $order->credit_amount,
            ]);

            // Send credit added notification (async via queue)
            if (NotificationHelper::isTypeEnabled('credit.added')) {
                NotificationHelper::sendAsync(
                    $user,
                    new CreditAddedNotification($order, (float) $order->credit_amount)
                );
            }
        } catch (\Throwable $e) {
            // Log error but DO NOT re-throw - don't break order lifecycle
            Log::error('[ProcessCreditGiving] Failed', [
                'order_id' => $order->id,
                'user_id' => $user->id,
                'credit_amount' => $order->credit_amount,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
