<?php

namespace App\Http\Controllers;

use App\Models\HelpCategory;
use App\Models\HelpArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HelpCenterController extends Controller
{
    /**
     * Display the help center index page.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        // Get active categories with published article counts
        $categories = Cache::remember('help_categories_with_counts', config('cache.ttl'), function () {
            return HelpCategory::active()
                ->ordered()
                ->withCount(['articles' => fn($q) => $q->published()])
                ->get();
        });

        // Popular articles
        $popularArticles = HelpArticle::published()
            ->with('category')
            ->popular()
            ->take(6)
            ->get();

        // Search results
        $searchResults = null;
        if ($search) {
            $searchResults = HelpArticle::published()
                ->with('category')
                ->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                })
                ->take(20)
                ->get();
        }

        return view('help.index', compact('categories', 'popularArticles', 'searchResults', 'search'));
    }

    /**
     * Display articles in a category.
     */
    public function category(HelpCategory $category)
    {
        // Ensure category is active
        if (!$category->is_active) {
            abort(404);
        }

        $articles = $category->articles()
            ->published()
            ->ordered()
            ->get();

        // Get other categories for sidebar
        $otherCategories = HelpCategory::active()
            ->ordered()
            ->where('id', '!=', $category->id)
            ->withCount(['articles' => fn($q) => $q->published()])
            ->get();

        return view('help.category', compact('category', 'articles', 'otherCategories'));
    }

    /**
     * Display a single article.
     */
    public function article(HelpCategory $category, HelpArticle $article)
    {
        // Ensure category and article are active/published
        if (!$category->is_active) {
            abort(404);
        }

        if (!$article->is_published || $article->help_category_id !== $category->id) {
            abort(404);
        }

        // Increment view count
        $article->incrementViews();

        // Related articles from same category
        $relatedArticles = HelpArticle::published()
            ->where('help_category_id', $category->id)
            ->where('id', '!=', $article->id)
            ->ordered()
            ->take(5)
            ->get();

        // Breadcrumb categories
        $categories = HelpCategory::active()->ordered()->get();

        return view('help.article', compact('category', 'article', 'relatedArticles', 'categories'));
    }

    /**
     * Handle article feedback (helpful yes/no).
     */
    public function feedback(HelpArticle $article, Request $request)
    {
        $type = $request->get('type');

        if (!in_array($type, ['yes', 'no'])) {
            return response()->json(['success' => false, 'message' => 'Invalid type'], 400);
        }

        $article->incrementHelpful($type);

        return response()->json([
            'success' => true,
            'message' => __('help.feedback_thanks'),
            'helpful_yes_count' => $article->helpful_yes_count,
            'helpful_no_count' => $article->helpful_no_count,
        ]);
    }
}

