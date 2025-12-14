<div class="bg-white dark:bg-dark-elevated rounded-lg p-2 md:p-6 w-full">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $categoryId ? __('help.admin.categories.edit') : __('help.admin.categories.add') }}</h3>
        <button wire:click="$dispatch('closeModal')" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <form wire:submit="save" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('help.admin.categories.form.name') }}</label>
                <input type="text" wire:model="name" wire:blur="generateSlug" placeholder="{{ __('help.admin.categories.form.name_placeholder') }}" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('help.admin.categories.form.slug') }}</label>
                <input type="text" wire:model="slug" placeholder="{{ __('help.admin.categories.form.slug_placeholder') }}" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('help.admin.categories.form.icon') }}</label>
            <input type="text" wire:model="icon" placeholder="{{ __('help.admin.categories.form.icon_placeholder') }}" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ __('common.optional') }} - Use emoji or HTML/SVG</p>
            @error('icon') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('help.admin.categories.form.description') }}</label>
            <textarea wire:model="description" rows="3" placeholder="{{ __('help.admin.categories.form.description_placeholder') }}" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm"></textarea>
            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('help.admin.categories.form.order') }}</label>
                <input type="number" wire:model="order_column" min="0" class="mt-1 block w-24 rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            </div>
            <label class="flex items-center gap-2 mt-6">
                <input type="checkbox" wire:model="is_active" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                <span class="text-sm text-slate-700 dark:text-slate-300">{{ __('help.admin.categories.form.active') }}</span>
            </label>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-dark-border">
            <button type="button" wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-dark-border rounded-lg transition">{{ __('common.actions.cancel') }}</button>
            <button type="submit" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">{{ $categoryId ? __('common.actions.update') : __('common.actions.create') }}</button>
        </div>
    </form>
</div>
