<?php

namespace App\Listeners\Order;

use App\Enums\NotificationType;
use App\Events\Order\OrderCreated;
use App\Notifications\Admin\AdminOrderCreatedNotification;
use App\Support\NotificationHelper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

/**
 * Notify admins about new order creation.
 * Queued for async processing.
 */
class NotifyAdminsOrderCreated implements ShouldQueue
{
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;

        try {
            NotificationHelper::sendToAdmins(
                new AdminOrderCreatedNotification($order),
                NotificationType::ADMIN_ORDER_CREATED->value
            );

            Log::info('[NotifyAdminsOrderCreated] Admin notification sent', [
                'order_id' => $order->id,
            ]);
        } catch (\Throwable $e) {
            Log::error('[NotifyAdminsOrderCreated] Failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
