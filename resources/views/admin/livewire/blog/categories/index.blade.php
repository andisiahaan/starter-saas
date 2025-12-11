<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('blog.categories.title') }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('blog.categories.description') }}</p>
        </div>
        <button 
            wire:click="$dispatch('openModal', { component: 'admin.blog.modals.category-form' })" 
            class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            {{ __('blog.categories.add') }}
        </button>
    </div>

    <!-- Search -->
    <div class="mb-6">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ __('common.form.search_placeholder') }}" class="w-full max-w-md rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
            <thead class="bg-slate-50 dark:bg-dark-soft">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('blog.categories.table.name') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('blog.categories.table.slug') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('blog.categories.table.posts') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('blog.categories.table.status') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('common.table.actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-dark-border">
                @forelse($categories as $category)
                <tr class="hover:bg-slate-50 dark:hover:bg-dark-soft transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-slate-900 dark:text-white">{{ $category->name }}</div>
                        @if($category->parent)
                        <div class="text-xs text-slate-500 dark:text-slate-400">{{ __('blog.categories.form.parent') }}: {{ $category->parent->name }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">{{ $category->slug }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">{{ $category->posts_count }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $category->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-300' }}">
                            {{ $category->is_active ? __('common.status.active') : __('common.status.inactive') }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button 
                            wire:click="$dispatch('openModal', { component: 'admin.blog.modals.category-form', arguments: { categoryId: {{ $category->id }} }})" 
                            class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300 mr-3">{{ __('common.actions.edit') }}</button>
                        <button wire:click="delete({{ $category->id }})" wire:confirm="{{ __('common.confirm.delete') }}" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">{{ __('common.actions.delete') }}</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">{{ __('blog.categories.empty') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
