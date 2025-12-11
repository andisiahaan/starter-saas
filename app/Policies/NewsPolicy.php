<?php

namespace App\Policies;

use App\Models\News;
use App\Models\User;

class NewsPolicy
{
    /**
     * Determine whether the user can view any news.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-news');
    }

    /**
     * Determine whether the user can view the news.
     */
    public function view(User $user, News $news): bool
    {
        return $user->can('view-news');
    }

    /**
     * Determine whether the user can create news.
     */
    public function create(User $user): bool
    {
        return $user->can('create-news');
    }

    /**
     * Determine whether the user can update the news.
     */
    public function update(User $user, News $news): bool
    {
        return $user->can('edit-news');
    }

    /**
     * Determine whether the user can delete the news.
     */
    public function delete(User $user, News $news): bool
    {
        return $user->can('delete-news');
    }
}
