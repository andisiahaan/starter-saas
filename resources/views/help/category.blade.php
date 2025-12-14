<x-layouts.main :title="$category->name . ' - ' . __('help.title')">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 mb-8">
            <a href="{{ route('help.index') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition">{{ __('help.title') }}</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-slate-900 dark:text-white font-medium">{{ $category->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Category Header -->
                <div class="mb-8">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                            @if($category->icon)
                            <span class="text-3xl">{!! $category->icon !!}</span>
                            @else
                            <svg class="w-7 h-7 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                            @endif
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $category->name }}</h1>
                            @if($category->description)
                            <p class="text-slate-600 dark:text-slate-400 mt-1">{{ $category->description }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Articles List -->
                <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border divide-y divide-slate-200 dark:divide-dark-border">
                    @forelse($articles as $article)
                    <a href="{{ route('help.article', [$category->slug, $article->slug]) }}" class="group flex items-center gap-4 p-5 hover:bg-slate-50 dark:hover:bg-dark-soft transition">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-slate-100 dark:bg-dark-soft flex items-center justify-center">
                            <svg class="w-5 h-5 text-slate-500 dark:text-slate-400 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="font-medium text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition">{{ $article->title }}</h2>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ __('help.reading_time', ['count' => $article->reading_time]) }}</p>
                        </div>
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    @empty
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-slate-500 dark:text-slate-400">{{ __('help.no_articles_in_category') }}</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Other Categories -->
                <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border p-5">
                    <h3 class="font-semibold text-slate-900 dark:text-white mb-4">{{ __('help.other_categories') }}</h3>
                    <ul class="space-y-2">
                        @foreach($otherCategories as $otherCategory)
                        <li>
                            <a href="{{ route('help.category', $otherCategory->slug) }}" class="flex items-center justify-between text-sm text-slate-600 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition py-1">
                                <span>{{ $otherCategory->name }}</span>
                                <span class="px-2 py-0.5 bg-slate-100 dark:bg-dark-soft rounded text-xs">{{ $otherCategory->articles_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contact Support -->
                <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl p-5 text-white">
                    <h3 class="font-semibold mb-2">{{ __('help.need_more_help') }}</h3>
                    <p class="text-primary-100 text-sm mb-4">{{ __('help.contact_support_text') }}</p>
                    <a href="{{ route('app.tickets.create') }}" class="inline-flex items-center px-4 py-2 bg-white text-primary-600 text-sm font-medium rounded-lg hover:bg-primary-50 transition">
                        {{ __('help.contact_support') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>
