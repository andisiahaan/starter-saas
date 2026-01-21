<?php

namespace App\Observers;

use App\Events\User\UserRegistered;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Observer for User model events.
 * 
 * THIN OBSERVER:
 * - Lightweight sync operations (username/referral code generation, cache clearing)
 * - Dispatches events for heavy operations (admin notifications)
 */
class UserObserver
{
    /**
     * Handle the User "creating" event.
     * Auto-generate username and referral_code from name.
     */
    public function creating(User $user): void
    {
        // Generate username from name if not provided
        if (empty($user->username)) {
            $user->username = $this->generateUniqueUsername($user->name);
        }

        // Generate referral code if not provided
        if (empty($user->referral_code)) {
            $user->referral_code = $this->generateUniqueReferralCode($user->name);
        }
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Don't notify for admin-created users or seeded users
        if (app()->runningInConsole() && !app()->runningUnitTests()) {
            return;
        }

        Log::info('[UserObserver] User created, dispatching event', [
            'user_id' => $user->id,
        ]);

        // Dispatch event - admin notification handled by listener
        UserRegistered::dispatch($user);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // Clear user caches (lightweight, sync operation)
        Cache::forget('user_snippets_' . $user->id);
        Cache::forget('user_' . $user->id);
    }

    /**
     * Generate a unique username from name.
     */
    private function generateUniqueUsername(string $name): string
    {
        $baseUsername = Str::slug($name, '_');
        
        if (strlen($baseUsername) > 20) {
            $baseUsername = substr($baseUsername, 0, 20);
        }

        $username = $baseUsername;
        $counter = 1;
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }

    /**
     * Generate a unique referral code from name.
     */
    private function generateUniqueReferralCode(string $name): string
    {
        $prefix = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $name), 0, 3));
        
        while (strlen($prefix) < 3) {
            $prefix .= strtoupper(Str::random(1));
        }

        do {
            $code = $prefix . strtoupper(Str::random(5));
        } while (User::where('referral_code', $code)->exists());

        return $code;
    }
}
