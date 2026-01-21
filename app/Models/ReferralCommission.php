<?php

namespace App\Models;

use App\Enums\CommissionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ReferralCommission extends Model
{
    protected $fillable = [
        'user_id',
        'referred_user_id',
        'amount',
        'type',
        'commissionable_type',
        'commissionable_id',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'status' => CommissionStatus::class,
        ];
    }

    /**
     * Get the referrer (user who gets the commission).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the referred user.
     */
    public function referredUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }

    /**
     * Get the commissionable model (Order, etc).
     */
    public function commissionable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope for pending commissions.
     */
    public function scopePending($query)
    {
        return $query->where('status', CommissionStatus::Pending);
    }

    /**
     * Scope for approved commissions.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', CommissionStatus::Approved);
    }

    /**
     * Scope for declined commissions.
     */
    public function scopeDeclined($query)
    {
        return $query->where('status', CommissionStatus::Declined);
    }

    /**
     * Scope for user's commissions.
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Check if commission is pending.
     */
    public function isPending(): bool
    {
        return $this->status === CommissionStatus::Pending;
    }

    /**
     * Check if commission is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === CommissionStatus::Approved;
    }

    /**
     * Check if commission is declined.
     */
    public function isDeclined(): bool
    {
        return $this->status === CommissionStatus::Declined;
    }

    /**
     * Approve commission.
     */
    public function approve(): bool
    {
        return $this->update(['status' => CommissionStatus::Approved]);
    }

    /**
     * Decline commission.
     */
    public function decline(): bool
    {
        return $this->update(['status' => CommissionStatus::Declined]);
    }
}
