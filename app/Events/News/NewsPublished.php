<?php

namespace App\Events\News;

use App\Models\News;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Event dispatched when news is published.
 */
class NewsPublished
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly News $news
    ) {}
}
