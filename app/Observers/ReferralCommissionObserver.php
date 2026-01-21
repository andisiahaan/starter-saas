<?php

namespace App\Observers;

use App\Enums\CommissionStatus;
use App\Events\Referral\CommissionApproved;
use App\Models\ReferralCommission;
use Illuminate\Support\Facades\Log;

/**
 * Observer for ReferralCommission model events.
 * 
 * THIN OBSERVER - only dispatches events.
 * Balance updates handled by listener.
 */
class ReferralCommissionObserver
{
    /**
     * Handle the ReferralCommission "updated" event.
     */
    public function updated(ReferralCommission $commission): void
    {
        // Dispatch event if status changed to 'Approved'
        // Note: Using wasChanged() not isDirty() because model is already saved
        if ($commission->wasChanged('status') && $commission->status === CommissionStatus::Approved) {
            Log::info('[ReferralCommissionObserver] Commission approved, dispatching event', [
                'commission_id' => $commission->id,
            ]);

            CommissionApproved::dispatch($commission);
        }
    }
}
