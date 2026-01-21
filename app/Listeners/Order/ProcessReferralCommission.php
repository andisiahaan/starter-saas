<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderStatusChanged;
use App\Services\ReferralService;
use Illuminate\Support\Facades\Log;

/**
 * Process referral commission when order becomes paid.
 * 
 * SYNC listener - commission creation is core business logic.
 * Failure does NOT break order lifecycle.
 */
class ProcessReferralCommission
{
    public function __construct(
        protected ReferralService $referralService
    ) {}

    public function handle(OrderStatusChanged $event): void
    {
        $order = $event->order;
        $newStatus = $event->newStatus;

        // Only process when status becomes paid
        if (!$newStatus->isPaid()) {
            return;
        }

        try {
            $this->referralService->createCommissionForOrder($order);

            Log::info('[ProcessReferralCommission] Commission processed', [
                'order_id' => $order->id,
            ]);
        } catch (\Throwable $e) {
            // Log error but DO NOT re-throw - don't break order lifecycle
            Log::error('[ProcessReferralCommission] Failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
