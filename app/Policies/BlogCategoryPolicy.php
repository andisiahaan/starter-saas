<?php

namespace App\Policies;

use App\Models\BlogCategory;
use App\Models\User;

class BlogCategoryPolicy
{
    /**
     * Determine whether the user can view any blog categories.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-blog');
    }

    /**
     * Determine whether the user can view the blog category.
     */
    public function view(User $user, BlogCategory $blogCategory): bool
    {
        return $user->can('view-blog');
    }

    /**
     * Determine whether the user can create blog categories.
     */
    public function create(User $user): bool
    {
        return $user->can('manage-blog-categories');
    }

    /**
     * Determine whether the user can update the blog category.
     */
    public function update(User $user, BlogCategory $blogCategory): bool
    {
        return $user->can('manage-blog-categories');
    }

    /**
     * Determine whether the user can delete the blog category.
     */
    public function delete(User $user, BlogCategory $blogCategory): bool
    {
        return $user->can('manage-blog-categories');
    }
}
