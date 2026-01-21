<?php

namespace App\Observers;

use App\Events\Order\OrderCreated;
use App\Events\Order\OrderStatusChanged;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

/**
 * Observer for Order model events.
 * 
 * THIN OBSERVER - only dispatches events.
 * All heavy logic (notifications, credit, referral) is in listeners.
 */
class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        Log::info('[OrderObserver] Order created, dispatching event', [
            'order_id' => $order->id,
        ]);

        OrderCreated::dispatch($order);
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        // Dispatch status change event if status changed
        if ($order->isDirty('status')) {
            $oldStatus = $order->getOriginal('status');
            $newStatus = $order->status;

            Log::info('[OrderObserver] Order status changed, dispatching event', [
                'order_id' => $order->id,
                'old_status' => $oldStatus?->value ?? $oldStatus,
                'new_status' => $newStatus->value,
            ]);

            OrderStatusChanged::dispatch($order, $oldStatus, $newStatus);
        }
    }
}
