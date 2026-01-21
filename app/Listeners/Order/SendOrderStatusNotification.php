<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderStatusChanged;
use App\Notifications\Orders\OrderStatusChangedNotification;
use App\Support\NotificationHelper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

/**
 * Send order status changed notification to user.
 * Queued for async processing.
 */
class SendOrderStatusNotification implements ShouldQueue
{
    public function handle(OrderStatusChanged $event): void
    {
        $order = $event->order;
        $user = $order->user;
        $oldStatus = $event->oldStatus;
        $newStatus = $event->newStatus;

        if (!$user) {
            Log::warning('[SendOrderStatusNotification] Order has no user', [
                'order_id' => $order->id,
            ]);
            return;
        }

        $notificationType = $newStatus->getNotificationType();

        if (!$notificationType || !NotificationHelper::isTypeEnabled($notificationType)) {
            Log::info('[SendOrderStatusNotification] Notification type disabled', [
                'order_id' => $order->id,
                'notification_type' => $notificationType,
            ]);
            return;
        }

        try {
            $user->notify(new OrderStatusChangedNotification($order, $oldStatus?->value, $newStatus->value));

            Log::info('[SendOrderStatusNotification] Notification sent', [
                'order_id' => $order->id,
                'old_status' => $oldStatus?->value,
                'new_status' => $newStatus->value,
            ]);
        } catch (\Throwable $e) {
            Log::error('[SendOrderStatusNotification] Failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
