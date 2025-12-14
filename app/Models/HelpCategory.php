<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HelpCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'is_active',
        'order_column',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Articles in this category.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(HelpArticle::class)->orderBy('order_column');
    }

    /**
     * Scope: only active categories.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: order by order_column.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_column');
    }

    /**
     * Get count of published articles.
     */
    public function getPublishedArticlesCountAttribute(): int
    {
        return $this->articles()->published()->count();
    }
}
