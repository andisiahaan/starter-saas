<?php

namespace App\Observers;

use App\Events\News\NewsPublished;
use App\Models\News;
use Illuminate\Support\Facades\Log;

/**
 * Observer for News model events.
 * 
 * THIN OBSERVER - only dispatches events.
 * Broadcasting to users handled by listener.
 */
class NewsObserver
{
    /**
     * Handle the News "created" event.
     */
    public function created(News $news): void
    {
        // If news is published immediately on create, dispatch event
        if ($news->is_published && $news->isActive()) {
            Log::info('[NewsObserver] News published on create, dispatching event', [
                'news_id' => $news->id,
            ]);

            NewsPublished::dispatch($news);
        }
    }

    /**
     * Handle the News "updated" event.
     */
    public function updated(News $news): void
    {
        // Dispatch event if news just became published
        if ($news->isDirty('is_published') && $news->is_published && $news->isActive()) {
            Log::info('[NewsObserver] News published, dispatching event', [
                'news_id' => $news->id,
            ]);

            NewsPublished::dispatch($news);
        }
    }
}
