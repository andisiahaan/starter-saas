<?php

namespace App\Listeners\News;

use App\Events\News\NewsPublished;
use App\Models\User;
use App\Notifications\News\NewsPublishedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

/**
 * Broadcast news to all users.
 * Queued for async processing - handles large user base efficiently.
 */
class BroadcastNewsToUsers implements ShouldQueue
{
    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 3;

    /**
     * The number of seconds to wait before retrying.
     */
    public int $backoff = 60;

    public function handle(NewsPublished $event): void
    {
        $news = $event->news;

        Log::info('[BroadcastNewsToUsers] Starting broadcast', [
            'news_id' => $news->id,
            'title' => $news->title,
        ]);

        $notification = new NewsPublishedNotification($news);
        $count = 0;

        try {
            // Use cursor for memory efficiency with large user bases
            User::whereNotNull('email_verified_at')
                ->orWhereNull('email_verified_at')
                ->cursor()
                ->each(function (User $user) use ($notification, &$count) {
                    try {
                        $user->notify($notification);
                        $count++;
                    } catch (\Throwable $e) {
                        Log::warning('[BroadcastNewsToUsers] Failed for user', [
                            'user_id' => $user->id,
                            'error' => $e->getMessage(),
                        ]);
                    }
                });

            Log::info('[BroadcastNewsToUsers] Broadcast completed', [
                'news_id' => $news->id,
                'users_notified' => $count,
            ]);
        } catch (\Throwable $e) {
            Log::error('[BroadcastNewsToUsers] Broadcast failed', [
                'news_id' => $news->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
