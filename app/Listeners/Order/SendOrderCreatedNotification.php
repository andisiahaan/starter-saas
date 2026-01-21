<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderCreated;
use App\Notifications\Orders\OrderCreatedNotification;
use App\Support\NotificationHelper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

/**
 * Send order created notification to user.
 * Queued for async processing.
 */
class SendOrderCreatedNotification implements ShouldQueue
{
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        $user = $order->user;

        if (!$user) {
            Log::warning('[SendOrderCreatedNotification] Order has no user', [
                'order_id' => $order->id,
            ]);
            return;
        }

        if (!NotificationHelper::isTypeEnabled('order.created')) {
            Log::info('[SendOrderCreatedNotification] Notification type disabled');
            return;
        }

        try {
            $user->notify(new OrderCreatedNotification($order));
            
            Log::info('[SendOrderCreatedNotification] Notification sent', [
                'order_id' => $order->id,
                'user_id' => $user->id,
            ]);
        } catch (\Throwable $e) {
            Log::error('[SendOrderCreatedNotification] Failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
