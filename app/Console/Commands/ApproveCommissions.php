<?php

namespace App\Console\Commands;

use App\Services\ReferralService;
use Illuminate\Console\Command;

class ApproveCommissions extends Command
{
    protected $signature = 'referral:approve';

    protected $description = 'Approve eligible commissions after hold period and add to referral balance';

    public function handle(ReferralService $referralService): int
    {
        $this->info('Processing eligible commissions...');

        $count = $referralService->approveEligibleCommissions();

        if ($count > 0) {
            $this->info("✓ {$count} commission(s) approved and added to balance.");
        } else {
            $this->info('No eligible commissions to approve.');
        }

        return self::SUCCESS;
    }
}
