<?php

namespace App\Policies;

use App\Models\BlogPost;
use App\Models\User;

class BlogPostPolicy
{
    /**
     * Determine whether the user can view any blog posts.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-blog');
    }

    /**
     * Determine whether the user can view the blog post.
     */
    public function view(User $user, BlogPost $blogPost): bool
    {
        // Published posts can be viewed by anyone
        if ($blogPost->status === 'published') {
            return true;
        }

        // Draft/scheduled posts can be viewed by author or those with view-blog permission
        return $user->id === $blogPost->author_id || $user->can('view-blog');
    }

    /**
     * Determine whether the user can create blog posts.
     */
    public function create(User $user): bool
    {
        return $user->can('create-blog');
    }

    /**
     * Determine whether the user can update the blog post.
     */
    public function update(User $user, BlogPost $blogPost): bool
    {
        // Author can always edit their own posts
        if ($user->id === $blogPost->author_id) {
            return true;
        }

        return $user->can('edit-blog');
    }

    /**
     * Determine whether the user can delete the blog post.
     */
    public function delete(User $user, BlogPost $blogPost): bool
    {
        // Author can delete their own posts
        if ($user->id === $blogPost->author_id) {
            return true;
        }

        return $user->can('delete-blog');
    }

    /**
     * Determine whether the user can publish the blog post.
     */
    public function publish(User $user, BlogPost $blogPost): bool
    {
        // Author can publish their own posts
        if ($user->id === $blogPost->author_id) {
            return true;
        }

        return $user->can('edit-blog');
    }

    /**
     * Determine whether the user can feature the blog post.
     */
    public function feature(User $user, BlogPost $blogPost): bool
    {
        return $user->can('edit-blog');
    }
}
