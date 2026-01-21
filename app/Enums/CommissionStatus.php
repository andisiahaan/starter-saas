<?php

namespace App\Enums;

enum CommissionStatus: string
{
    case Pending = 'pending';   // Menunggu masa hold selesai
    case Approved = 'approved'; // Disetujui, sudah masuk referral_balance
    case Declined = 'declined'; // Ditolak (misal: order refund)

    /**
     * Get human-readable label.
     */
    public function label(): string
    {
        return match ($this) {
            self::Pending => __('referral.commission_status.pending'),
            self::Approved => __('referral.commission_status.approved'),
            self::Declined => __('referral.commission_status.declined'),
        };
    }

    /**
     * Get CSS color classes.
     */
    public function color(): string
    {
        return match ($this) {
            self::Pending => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
            self::Approved => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
            self::Declined => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
        };
    }

    /**
     * Check if commission affects balance positively.
     */
    public function addsToBalance(): bool
    {
        return $this === self::Approved;
    }
}

