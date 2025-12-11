<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Self-referencing relationship for parent category
    public function parent(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }

    // Children categories
    public function children(): HasMany
    {
        return $this->hasMany(BlogCategory::class, 'parent_id')->orderBy('order');
    }

    // Many-to-many with posts
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(BlogPost::class, 'blog_post_category', 'blog_category_id', 'blog_post_id')
            ->withTimestamps();
    }

    // Scope: only active
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope: only root (no parent)
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    // Get published posts count
    public function getPublishedPostsCountAttribute(): int
    {
        return $this->posts()->where('status', 'published')->count();
    }
}
