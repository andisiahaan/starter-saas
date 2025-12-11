<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display the blog index page
     */
    public function index(Request $request)
    {
        $posts = BlogPost::query()
            ->published()
            ->with(['author', 'categories', 'tags'])
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->orderByDesc('published_at')
            ->paginate(12);

        $featuredPosts = BlogPost::published()
            ->featured()
            ->with(['author', 'categories'])
            ->take(3)
            ->get();

        $categories = BlogCategory::active()
            ->withCount(['posts' => fn($q) => $q->published()])
            ->having('posts_count', '>', 0)
            ->orderBy('name')
            ->get();

        $tags = BlogTag::withCount(['posts' => fn($q) => $q->published()])
            ->having('posts_count', '>', 0)
            ->orderBy('name')
            ->get();

        return view('blog.index', compact('posts', 'featuredPosts', 'categories', 'tags'));
    }

    /**
     * Display a single blog post
     */
    public function show(BlogPost $post)
    {
        // Only show published posts (or allow preview for authors/admins)
        if (!$post->is_published && (!auth()->check() || auth()->id() !== $post->author_id)) {
            abort(404);
        }

        // Increment view count
        $post->incrementViews();

        // Load relationships
        $post->load(['author', 'categories', 'tags']);

        // Related posts (same categories, excluding current)
        $relatedPosts = BlogPost::published()
            ->whereHas('categories', function ($q) use ($post) {
                $q->whereIn('blog_categories.id', $post->categories->pluck('id'));
            })
            ->where('id', '!=', $post->id)
            ->with(['author', 'categories'])
            ->take(4)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    /**
     * Display posts by category
     */
    public function category(BlogCategory $category)
    {
        $posts = BlogPost::published()
            ->inCategory($category->slug)
            ->with(['author', 'categories', 'tags'])
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('blog.category', compact('category', 'posts'));
    }

    /**
     * Display posts by tag
     */
    public function tag(BlogTag $tag)
    {
        $posts = BlogPost::published()
            ->withTag($tag->slug)
            ->with(['author', 'categories', 'tags'])
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('blog.tag', compact('tag', 'posts'));
    }
}
