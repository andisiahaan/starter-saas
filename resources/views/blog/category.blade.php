<x-layouts.main :title="$category->name . ' - Blog'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('blog.index') }}" class="text-sm text-slate-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400">← Back to Blog</a>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white mt-4">{{ $category->name }}</h1>
            @if($category->description)
            <p class="text-slate-600 dark:text-slate-400 mt-2">{{ $category->description }}</p>
            @endif
        </div>

        <!-- Posts -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($posts as $post)
            <a href="{{ route('blog.show', $post->slug) }}" class="group block bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border overflow-hidden hover:shadow-lg transition">
                @if($post->featured_image)
                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-40 object-cover">
                @endif
                <div class="p-5">
                    <span class="text-xs text-slate-500 dark:text-slate-400">{{ $post->reading_time }} min read</span>
                    <h3 class="mt-2 font-semibold text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition line-clamp-2">{{ $post->title }}</h3>
                    @if($post->excerpt)
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-400 line-clamp-2">{{ $post->excerpt }}</p>
                    @endif
                    <p class="mt-4 text-xs text-slate-500 dark:text-slate-400">{{ $post->published_at->format('M d, Y') }}</p>
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-12 text-slate-500 dark:text-slate-400">
                No posts in this category yet.
            </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
</x-layouts.main>
