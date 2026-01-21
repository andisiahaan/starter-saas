<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ==========================================
// Scheduled Commands
// ==========================================

// Cancel expired pending orders every 5 minutes
Schedule::command('orders:cancel-expired')->everyFiveMinutes();

// Approve eligible referral commissions after hold period (hourly)
Schedule::command('referral:approve')->hourly();


