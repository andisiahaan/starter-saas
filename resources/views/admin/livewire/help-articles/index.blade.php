<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('help.admin.articles.title') }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('help.admin.articles.description') }}</p>
        </div>
        <a href="{{ route('admin.help-articles.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            {{ __('help.admin.articles.new') }}
        </a>
    </div>

    <!-- Filters -->
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ __('help.admin.articles.filters.search') }}" class="flex-1 max-w-md rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
        <select wire:model.live="category" class="rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            <option value="">{{ __('help.admin.articles.filters.all_categories') }}</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
        <select wire:model.live="status" class="rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            <option value="">{{ __('help.admin.articles.filters.all_status') }}</option>
            <option value="published">{{ __('help.admin.articles.status.published') }}</option>
            <option value="draft">{{ __('help.admin.articles.status.draft') }}</option>
        </select>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
            <thead class="bg-slate-50 dark:bg-dark-soft">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('help.admin.articles.table.article') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('help.admin.articles.table.category') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('help.admin.articles.table.views') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('help.admin.articles.table.status') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('common.table.actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-dark-border">
                @forelse($articles as $article)
                <tr class="hover:bg-slate-50 dark:hover:bg-dark-soft transition">
                    <td class="px-6 py-4">
                        <div>
                            <div class="text-sm font-medium text-slate-900 dark:text-white">{{ Str::limit($article->title, 50) }}</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">{{ $article->created_at->format('M d, Y') }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($article->category)
                        <span class="px-2 py-0.5 text-xs bg-slate-100 dark:bg-dark-soft text-slate-600 dark:text-slate-400 rounded">{{ $article->category->name }}</span>
                        @else
                        <span class="text-xs text-slate-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                        {{ number_format($article->views_count) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $isPublished = $article->is_active && $article->published_at && $article->published_at->lte(now());
                            $isScheduled = $article->is_active && $article->published_at && $article->published_at->gt(now());
                        @endphp
                        <button 
                            wire:click="toggleActive({{ $article->id }})"
                            class="px-2 py-1 text-xs font-medium rounded-full {{ $isPublished ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : ($isScheduled ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : 'bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-300') }}">
                            {{ $isPublished ? __('help.admin.articles.status.published') : ($isScheduled ? __('help.admin.articles.status.scheduled') : __('help.admin.articles.status.draft')) }}
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.help-articles.edit', $article) }}" class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300 mr-3">{{ __('common.actions.edit') }}</a>
                        <button wire:click="delete({{ $article->id }})" wire:confirm="{{ __('help.admin.articles.confirm_delete') }}" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">{{ __('common.actions.delete') }}</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                        <svg class="w-12 h-12 mx-auto mb-4 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p>{{ __('help.admin.articles.empty') }} <a href="{{ route('admin.help-articles.create') }}" class="text-primary-600 hover:underline">{{ __('help.admin.articles.create_first') }}</a></p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $articles->links() }}
    </div>
</div>
