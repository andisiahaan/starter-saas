<?php

namespace App\Events\Referral;

use App\Models\ReferralCommission;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Event dispatched when a referral commission is approved.
 */
class CommissionApproved
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly ReferralCommission $commission
    ) {}
}
