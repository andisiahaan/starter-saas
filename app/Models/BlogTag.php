<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlogTag extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    // Many-to-many with posts
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(BlogPost::class, 'blog_post_tag', 'blog_tag_id', 'blog_post_id')
            ->withTimestamps();
    }

    // Get published posts count
    public function getPublishedPostsCountAttribute(): int
    {
        return $this->posts()->where('status', 'published')->count();
    }
}
