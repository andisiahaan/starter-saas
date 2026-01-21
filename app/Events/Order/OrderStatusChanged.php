<?php

namespace App\Events\Order;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Event dispatched when an order status changes.
 */
class OrderStatusChanged
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly Order $order,
        public readonly ?OrderStatus $oldStatus,
        public readonly OrderStatus $newStatus
    ) {}
}
