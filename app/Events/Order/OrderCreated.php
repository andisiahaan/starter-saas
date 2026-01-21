<?php

namespace App\Events\Order;

use App\Models\Order;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Event dispatched when a new order is created.
 */
class OrderCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly Order $order
    ) {}
}
