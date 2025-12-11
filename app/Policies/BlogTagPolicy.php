<?php

namespace App\Policies;

use App\Models\BlogTag;
use App\Models\User;

class BlogTagPolicy
{
    /**
     * Determine whether the user can view any blog tags.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-blog');
    }

    /**
     * Determine whether the user can view the blog tag.
     */
    public function view(User $user, BlogTag $blogTag): bool
    {
        return $user->can('view-blog');
    }

    /**
     * Determine whether the user can create blog tags.
     */
    public function create(User $user): bool
    {
        return $user->can('manage-blog-categories');
    }

    /**
     * Determine whether the user can update the blog tag.
     */
    public function update(User $user, BlogTag $blogTag): bool
    {
        return $user->can('manage-blog-categories');
    }

    /**
     * Determine whether the user can delete the blog tag.
     */
    public function delete(User $user, BlogTag $blogTag): bool
    {
        return $user->can('manage-blog-categories');
    }
}
