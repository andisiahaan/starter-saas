<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('blog.tags.title') }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('blog.tags.description') }}</p>
        </div>
        <button 
            wire:click="$dispatch('openModal', { component: 'admin.blog.modals.tag-form' })" 
            class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            {{ __('blog.tags.add') }}
        </button>
    </div>

    <!-- Search -->
    <div class="mb-6">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ __('common.form.search_placeholder') }}" class="w-full max-w-md rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
    </div>

    <!-- Tags Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($tags as $tag)
        <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border p-4">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">{{ $tag->name }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ $tag->slug }}</p>
                    @if($tag->description)
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">{{ Str::limit($tag->description, 50) }}</p>
                    @endif
                </div>
                <span class="px-2 py-1 text-xs font-medium bg-slate-100 dark:bg-dark-soft text-slate-600 dark:text-slate-400 rounded-full">
                    {{ __('blog.tags.posts_count', ['count' => $tag->posts_count]) }}
                </span>
            </div>
            <div class="flex gap-2 mt-4 pt-4 border-t border-slate-200 dark:border-dark-border">
                <button 
                    wire:click="$dispatch('openModal', { component: 'admin.blog.modals.tag-form', arguments: { tagId: {{ $tag->id }} }})" 
                    class="text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400">{{ __('common.actions.edit') }}</button>
                <button wire:click="delete({{ $tag->id }})" wire:confirm="{{ __('common.confirm.delete') }}" class="text-sm text-red-600 hover:text-red-700 dark:text-red-400">{{ __('common.actions.delete') }}</button>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-slate-500 dark:text-slate-400">{{ __('blog.tags.empty') }}</div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $tags->links() }}
    </div>
</div>
