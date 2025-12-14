<x-layouts.main :title="__('help.title')">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-4">{{ __('help.title') }}</h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">{{ __('help.subtitle') }}</p>
        </div>

        <!-- Search -->
        <div class="max-w-2xl mx-auto mb-12">
            <form action="{{ route('help.index') }}" method="GET" class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search ?? '' }}" 
                    placeholder="{{ __('help.search_placeholder') }}"
                    class="w-full pl-12 pr-4 py-4 rounded-xl border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 text-lg shadow-sm"
                >
                <svg class="w-6 h-6 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </form>
        </div>

        <!-- Search Results -->
        @if($searchResults)
        <div class="mb-12">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white mb-6">
                {{ __('help.search_results', ['query' => $search]) }}
                <span class="text-slate-500 dark:text-slate-400 text-base font-normal">({{ $searchResults->count() }} {{ __('help.results') }})</span>
            </h2>
            @if($searchResults->isEmpty())
            <div class="text-center py-12 bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border">
                <svg class="w-16 h-16 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-slate-500 dark:text-slate-400">{{ __('help.no_results') }}</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($searchResults as $article)
                <a href="{{ route('help.article', [$article->category->slug, $article->slug]) }}" class="group block p-5 bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border hover:border-primary-500/50 hover:shadow-md transition">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition truncate">{{ $article->title }}</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ $article->category->name }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @endif
        </div>
        @else
        <!-- Categories -->
        <div class="mb-12">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white mb-6">{{ __('help.browse_categories') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                <a href="{{ route('help.category', $category->slug) }}" class="group block p-6 bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border hover:border-primary-500/50 hover:shadow-lg transition">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                            @if($category->icon)
                            <span class="text-2xl">{!! $category->icon !!}</span>
                            @else
                            <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition">{{ $category->name }}</h3>
                            @if($category->description)
                            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">{{ $category->description }}</p>
                            @endif
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">{{ $category->articles_count }} {{ __('help.articles') }}</p>
                        </div>
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Popular Articles -->
        @if($popularArticles->isNotEmpty())
        <div>
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white mb-6">{{ __('help.popular_articles') }}</h2>
            <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border divide-y divide-slate-200 dark:divide-dark-border">
                @foreach($popularArticles as $article)
                <a href="{{ route('help.article', [$article->category->slug, $article->slug]) }}" class="group flex items-center gap-4 p-5 hover:bg-slate-50 dark:hover:bg-dark-soft transition">
                    <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-slate-100 dark:bg-dark-soft flex items-center justify-center">
                        <svg class="w-5 h-5 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-medium text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition truncate">{{ $article->title }}</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $article->category->name }}</p>
                    </div>
                    <div class="flex items-center gap-1 text-sm text-slate-400 dark:text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>{{ number_format($article->views_count) }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
        @endif

        <!-- Contact Support CTA -->
        <div class="mt-12 text-center py-12 bg-gradient-to-r from-primary-500 to-primary-600 rounded-2xl">
            <h3 class="text-2xl font-bold text-white mb-2">{{ __('help.still_need_help') }}</h3>
            <p class="text-primary-100 mb-6">{{ __('help.contact_support_text') }}</p>
            <a href="{{ route('app.tickets.create') }}" class="inline-flex items-center px-6 py-3 bg-white text-primary-600 font-semibold rounded-lg hover:bg-primary-50 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                {{ __('help.contact_support') }}
            </a>
        </div>
    </div>
</x-layouts.main>
