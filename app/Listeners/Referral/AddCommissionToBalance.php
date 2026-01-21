<?php

namespace App\Listeners\Referral;

use App\Enums\ReferralBalanceLogType;
use App\Events\Referral\CommissionApproved;
use Illuminate\Support\Facades\Log;

/**
 * Add commission amount to user's referral balance.
 * 
 * SYNC listener - balance update is core business logic.
 * Failure does NOT break commission lifecycle.
 */
class AddCommissionToBalance
{
    public function handle(CommissionApproved $event): void
    {
        $commission = $event->commission;
        $user = $commission->user;

        if (!$user) {
            Log::warning('[AddCommissionToBalance] Commission has no user', [
                'commission_id' => $commission->id,
            ]);
            return;
        }

        try {
            $user->addReferralBalance(
                amount: (float) $commission->amount,
                type: ReferralBalanceLogType::CommissionApproved,
                description: __('referral.balance_log.commission_approved', [
                    'order' => $commission->commissionable?->order_number ?? $commission->commissionable_id,
                ]),
                reference: $commission
            );

            Log::info('[AddCommissionToBalance] Commission added to balance', [
                'commission_id' => $commission->id,
                'user_id' => $user->id,
                'amount' => $commission->amount,
                'new_balance' => $user->referral_balance,
            ]);
        } catch (\Throwable $e) {
            // Log error but DO NOT re-throw - don't break commission lifecycle
            Log::error('[AddCommissionToBalance] Failed', [
                'commission_id' => $commission->id,
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
