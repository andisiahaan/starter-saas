<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('blog.posts.title') }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('blog.posts.description') }}</p>
        </div>
        <a href="{{ route('admin.blog.posts.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            {{ __('blog.posts.new') }}
        </a>
    </div>

    <!-- Filters -->
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ __('blog.posts.filters.search') }}" class="flex-1 max-w-md rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
        <select wire:model.live="status" class="rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            <option value="">{{ __('blog.posts.filters.all_status') }}</option>
            <option value="draft">{{ __('blog.posts.status.draft') }}</option>
            <option value="published">{{ __('blog.posts.status.published') }}</option>
            <option value="scheduled">{{ __('blog.posts.status.scheduled') }}</option>
            <option value="archived">{{ __('blog.posts.status.archived') }}</option>
        </select>
    </div>

    <!-- Posts Table -->
    <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
            <thead class="bg-slate-50 dark:bg-dark-soft">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('blog.posts.table.post') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('blog.posts.table.author') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('blog.posts.table.categories') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('blog.posts.table.status') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('blog.posts.table.views') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('common.table.actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-dark-border">
                @forelse($posts as $post)
                <tr class="hover:bg-slate-50 dark:hover:bg-dark-soft transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if($post->featured_image)
                            <img src="{{ Storage::url($post->featured_image) }}" alt="" class="w-10 h-10 rounded object-cover">
                            @else
                            <div class="w-10 h-10 rounded bg-slate-200 dark:bg-dark-border flex items-center justify-center">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-slate-900 dark:text-white">{{ Str::limit($post->title, 40) }}</div>
                                <div class="text-xs text-slate-500 dark:text-slate-400">{{ $post->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                        {{ $post->author->name ?? __('common.unknown') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach($post->categories->take(2) as $category)
                            <span class="px-2 py-0.5 text-xs bg-slate-100 dark:bg-dark-soft text-slate-600 dark:text-slate-400 rounded">{{ $category->name }}</span>
                            @endforeach
                            @if($post->categories->count() > 2)
                            <span class="px-2 py-0.5 text-xs bg-slate-100 dark:bg-dark-soft text-slate-600 dark:text-slate-400 rounded">+{{ $post->categories->count() - 2 }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $statusColors = [
                                'draft' => 'bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-300',
                                'published' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                'scheduled' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                'archived' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400',
                            ];
                        @endphp
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$post->status] ?? '' }}">
                            {{ __('blog.posts.status.' . $post->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                        {{ number_format($post->views_count) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.blog.posts.edit', $post) }}" class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300 mr-3">{{ __('common.actions.edit') }}</a>
                        <button wire:click="delete({{ $post->id }})" wire:confirm="{{ __('common.confirm.delete') }}" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">{{ __('common.actions.delete') }}</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                        <svg class="w-12 h-12 mx-auto mb-4 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <p>{{ __('blog.posts.empty') }} <a href="{{ route('admin.blog.posts.create') }}" class="text-primary-600 hover:underline">{{ __('blog.posts.create_first') }}</a></p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
