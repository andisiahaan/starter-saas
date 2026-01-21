<?php

namespace App\Listeners\User;

use App\Enums\NotificationType;
use App\Events\User\UserRegistered;
use App\Notifications\Admin\AdminUserRegisteredNotification;
use App\Support\NotificationHelper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

/**
 * Notify admins about new user registration.
 * Queued for async processing.
 */
class NotifyAdminsUserRegistered implements ShouldQueue
{
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;

        try {
            NotificationHelper::sendToAdmins(
                new AdminUserRegisteredNotification($user),
                NotificationType::ADMIN_USER_REGISTERED->value
            );

            Log::info('[NotifyAdminsUserRegistered] Admin notification sent', [
                'user_id' => $user->id,
                'email' => $user->email,
            ]);
        } catch (\Throwable $e) {
            Log::error('[NotifyAdminsUserRegistered] Failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
