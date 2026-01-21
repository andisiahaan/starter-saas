<?php

namespace App\Services;

use App\Enums\CommissionStatus;
use App\Models\Order;
use App\Models\ReferralCommission;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ReferralService
{
    /**
     * Check if referral system is enabled.
     */
    public function isEnabled(): bool
    {
        return (bool) setting('referral.is_enabled', false);
    }

    /**
     * Get referral settings with caching.
     */
    public function getSettings(): array
    {
        return [
            'is_enabled' => (bool) setting('referral.is_enabled', false),
            'referral_cookie_days' => (int) setting('referral.referral_cookie_days', 60),
            'referral_expiry_days' => (int) setting('referral.referral_expiry_days', 30),
            'commission_hold_days' => (int) setting('referral.commission_hold_days', 7),
            'commission_fixed' => (float) setting('referral.commission_fixed', 1000),
            'commission_percent' => (float) setting('referral.commission_percent', 20),
        ];
    }

    /**
     * Calculate commission for an order.
     */
    public function calculateCommission(Order $order): array
    {
        $settings = $this->getSettings();
        
        $fixedAmount = $settings['commission_fixed'];
        $percentAmount = ($settings['commission_percent'] / 100) * (float) $order->total_amount;
        
        $totalAmount = $fixedAmount + $percentAmount;

        return [
            'fixed' => $fixedAmount,
            'percent' => $percentAmount,
            'total' => $totalAmount,
            'type' => 'both',
        ];
    }

    /**
     * Create referral commission for an order.
     * Called when order status changes to paid.
     */
    public function createCommissionForOrder(Order $order): ?ReferralCommission
    {
        if (!$this->isEnabled()) {
            Log::info('[ReferralService] Referral system is disabled');
            return null;
        }

        $user = $order->user;
        if (!$user) {
            Log::warning('[ReferralService] Order has no user', ['order_id' => $order->id]);
            return null;
        }

        // Check if user has a referrer
        if (!$user->referrer_id) {
            Log::info('[ReferralService] User has no referrer', ['user_id' => $user->id]);
            return null;
        }

        $referrer = $user->referrer;
        if (!$referrer) {
            Log::warning('[ReferralService] Referrer not found', ['referrer_id' => $user->referrer_id]);
            return null;
        }

        // Check if user is still within referral expiry period
        $settings = $this->getSettings();
        $expiryDays = $settings['referral_expiry_days'];
        if ($expiryDays > 0 && $user->created_at->addDays($expiryDays)->isPast()) {
            Log::info('[ReferralService] User outside referral expiry period', [
                'user_id' => $user->id,
                'created_at' => $user->created_at,
                'expiry_days' => $expiryDays,
            ]);
            return null;
        }

        // Check if commission already exists for this order (idempotency)
        $existingCommission = ReferralCommission::where('commissionable_type', Order::class)
            ->where('commissionable_id', $order->id)
            ->first();

        if ($existingCommission) {
            Log::info('[ReferralService] Commission already exists for order', [
                'order_id' => $order->id,
                'commission_id' => $existingCommission->id,
            ]);
            return $existingCommission;
        }

        // Calculate commission
        $commission = $this->calculateCommission($order);

        try {
            $referralCommission = ReferralCommission::create([
                'user_id' => $referrer->id,
                'referred_user_id' => $user->id,
                'amount' => $commission['total'],
                'type' => $commission['type'],
                'commissionable_type' => Order::class,
                'commissionable_id' => $order->id,
                'status' => CommissionStatus::Pending,
            ]);

            Log::info('[ReferralService] Commission created', [
                'commission_id' => $referralCommission->id,
                'referrer_id' => $referrer->id,
                'referred_user_id' => $user->id,
                'order_id' => $order->id,
                'amount' => $commission['total'],
            ]);

            return $referralCommission;
        } catch (\Exception $e) {
            Log::error('[ReferralService] Failed to create commission', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Approve eligible commissions after hold period.
     * Should be run via scheduled command.
     */
    public function approveEligibleCommissions(): int
    {
        $settings = $this->getSettings();
        $holdDays = $settings['commission_hold_days'];

        $count = 0;
        
        // Get pending commissions that have passed hold period
        ReferralCommission::pending()
            ->where('created_at', '<=', now()->subDays($holdDays))
            ->cursor()
            ->each(function (ReferralCommission $commission) use (&$count) {
                $commission->approve(); // Triggers observer & event
                $count++;
            });

        if ($count > 0) {
            Log::info('[ReferralService] Approved commissions', ['count' => $count]);
        }

        return $count;
    }

    /**
     * Decline a commission.
     */
    public function declineCommission(ReferralCommission $commission, string $reason = null): bool
    {
        if (!$commission->isPending()) {
            Log::warning('[ReferralService] Cannot decline non-pending commission', [
                'commission_id' => $commission->id,
                'status' => $commission->status->value,
            ]);
            return false;
        }

        $result = $commission->decline();

        if ($result) {
            Log::info('[ReferralService] Commission declined', [
                'commission_id' => $commission->id,
                'reason' => $reason,
            ]);
        }

        return $result;
    }

    /**
     * Get user by referral code.
     */
    public function getUserByReferralCode(string $code): ?User
    {
        return User::where('referral_code', $code)->first();
    }
}
