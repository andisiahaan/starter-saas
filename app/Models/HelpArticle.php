<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HelpArticle extends Model
{
    protected $fillable = [
        'help_category_id',
        'title',
        'slug',
        'content',
        'is_active',
        'views_count',
        'helpful_yes_count',
        'helpful_no_count',
        'published_at',
        'order_column',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Category this article belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(HelpCategory::class, 'help_category_id');
    }

    /**
     * Scope: only active articles.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: only published articles (published_at <= now).
     */
    public function scopePublished($query)
    {
        return $query->active()
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope: popular articles ordered by views.
     */
    public function scopePopular($query)
    {
        return $query->orderByDesc('views_count');
    }

    /**
     * Scope: order by order_column.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_column');
    }

    /**
     * Increment view count.
     */
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    /**
     * Increment helpful count (yes or no).
     */
    public function incrementHelpful(string $type): void
    {
        if ($type === 'yes') {
            $this->increment('helpful_yes_count');
        } elseif ($type === 'no') {
            $this->increment('helpful_no_count');
        }
    }

    /**
     * Check if article is published.
     */
    public function getIsPublishedAttribute(): bool
    {
        return $this->is_active 
            && $this->published_at 
            && $this->published_at->lte(now());
    }

    /**
     * Get reading time (approx 200 words per minute).
     */
    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->content));
        return max(1, ceil($wordCount / 200));
    }
}

