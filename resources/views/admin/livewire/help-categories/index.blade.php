<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('help.admin.categories.title') }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('help.admin.categories.description') }}</p>
        </div>
        <button 
            wire:click="$dispatch('openModal', { component: 'admin.help-categories.modals.form' })" 
            class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            {{ __('help.admin.categories.add') }}
        </button>
    </div>

    <!-- Filters -->
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ __('help.admin.categories.filters.search') }}" class="flex-1 max-w-md rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
        <select wire:model.live="status" class="rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            <option value="">{{ __('help.admin.categories.filters.all_status') }}</option>
            <option value="active">{{ __('common.status.active') }}</option>
            <option value="inactive">{{ __('common.status.inactive') }}</option>
        </select>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
            <thead class="bg-slate-50 dark:bg-dark-soft">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('help.admin.categories.table.order') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('help.admin.categories.table.name') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('help.admin.categories.table.slug') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('help.admin.categories.table.articles') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('help.admin.categories.table.status') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('common.table.actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-dark-border">
                @forelse($categories as $category)
                <tr class="hover:bg-slate-50 dark:hover:bg-dark-soft transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">{{ $category->order_column }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            @if($category->icon)
                            <span class="text-xl">{!! $category->icon !!}</span>
                            @else
                            <div class="w-8 h-8 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                                <svg class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                </svg>
                            </div>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-slate-900 dark:text-white">{{ $category->name }}</div>
                                @if($category->description)
                                <div class="text-xs text-slate-500 dark:text-slate-400 truncate max-w-xs">{{ Str::limit($category->description, 50) }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">{{ $category->slug }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">{{ $category->articles_count }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button 
                            wire:click="toggleActive({{ $category->id }})"
                            class="px-2 py-1 text-xs font-medium rounded-full {{ $category->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-300' }}">
                            {{ $category->is_active ? __('common.status.active') : __('common.status.inactive') }}
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button 
                            wire:click="$dispatch('openModal', { component: 'admin.help-categories.modals.form', arguments: { categoryId: {{ $category->id }} }})" 
                            class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300 mr-3">{{ __('common.actions.edit') }}</button>
                        <button wire:click="delete({{ $category->id }})" wire:confirm="{{ __('help.admin.categories.confirm_delete') }}" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">{{ __('common.actions.delete') }}</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">{{ __('help.admin.categories.empty') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
