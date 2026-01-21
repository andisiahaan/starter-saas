<?php

namespace App\Enums;

enum ReferralBalanceLogType: string
{
    case CommissionApproved = 'commission_approved';
    case CommissionDeclined = 'commission_declined';
    case WithdrawalRequest = 'withdrawal_request';
    case WithdrawalRefunded = 'withdrawal_refunded';
    case Adjustment = 'adjustment';

    /**
     * Get human-readable label.
     */
    public function label(): string
    {
        return match ($this) {
            self::CommissionApproved => __('referral.balance_log_types.commission_approved'),
            self::CommissionDeclined => __('referral.balance_log_types.commission_declined'),
            self::WithdrawalRequest => __('referral.balance_log_types.withdrawal_request'),
            self::WithdrawalRefunded => __('referral.balance_log_types.withdrawal_refunded'),
            self::Adjustment => __('referral.balance_log_types.adjustment'),
        };
    }

    /**
     * Get CSS color classes.
     */
    public function color(): string
    {
        return match ($this) {
            self::CommissionApproved => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
            self::CommissionDeclined => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
            self::WithdrawalRequest => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200',
            self::WithdrawalRefunded => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
            self::Adjustment => 'bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-200',
        };
    }

    /**
     * Check if this is an addition (positive amount).
     */
    public function isAddition(): bool
    {
        return in_array($this, [
            self::CommissionApproved,
            self::WithdrawalRefunded,
        ]);
    }

    /**
     * Check if this is a deduction (negative amount).
     */
    public function isDeduction(): bool
    {
        return in_array($this, [
            self::CommissionDeclined,
            self::WithdrawalRequest,
        ]);
    }

    /**
     * Get all values.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
