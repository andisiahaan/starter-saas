<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $isEditing ? __('help.admin.articles.edit') : __('help.admin.articles.add') }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $isEditing ? __('help.admin.articles.description') : __('help.admin.articles.description') }}</p>
        </div>
        <a href="{{ route('admin.help-articles.index') }}" class="text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">
            ← {{ __('common.actions.back') }}
        </a>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title & Slug -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('help.admin.articles.form.title') }}</label>
                            <input type="text" wire:model="title" wire:blur="generateSlug" placeholder="{{ __('help.admin.articles.form.title_placeholder') }}" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 text-lg">
                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('help.admin.articles.form.slug') }}</label>
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-slate-500 dark:text-slate-400">/help/.../</span>
                                <input type="text" wire:model="slug" placeholder="{{ __('help.admin.articles.form.slug_placeholder') }}" class="flex-1 rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            </div>
                            @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Content with Trix Rich Editor -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border p-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ __('help.admin.articles.form.content') }}</label>
                    
                    <!-- Trix Editor -->
                    <div wire:ignore>
                        <input id="content" type="hidden" value="{{ $content }}">
                        <trix-editor 
                            input="content"
                            class="trix-content prose dark:prose-invert max-w-none min-h-[400px] rounded-lg border border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500"
                            x-data
                            x-on:trix-change="$wire.set('content', $event.target.value)"
                        ></trix-editor>
                    </div>
                    @error('content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- SEO Settings -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-dark-border">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('help.admin.articles.form.seo') }}</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('help.admin.articles.form.meta_title') }}</label>
                            <input type="text" wire:model="meta_title" placeholder="{{ __('help.admin.articles.form.meta_title_placeholder') }}" maxlength="70" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('help.admin.articles.form.meta_description') }}</label>
                            <textarea wire:model="meta_description" rows="2" placeholder="{{ __('help.admin.articles.form.meta_description_placeholder') }}" maxlength="160" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Publish Settings -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-dark-border">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('common.status.status') }}</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('help.admin.articles.form.category') }}</label>
                            <select wire:model="help_category_id" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                <option value="">{{ __('help.admin.articles.form.select_category') }}</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('help_category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('help.admin.articles.form.published_at') }}</label>
                            <input type="datetime-local" wire:model="published_at" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('help.admin.articles.form.order') }}</label>
                            <input type="number" wire:model="order_column" min="0" class="block w-24 rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" wire:model="is_active" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                                <span class="text-sm text-slate-700 dark:text-slate-300">{{ __('help.admin.articles.form.active') }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border">
                        <button type="submit" class="w-full px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">
                            {{ $isEditing ? __('common.actions.update') : __('common.actions.create') }}
                        </button>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800 p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-500 dark:text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-sm text-blue-700 dark:text-blue-300">
                            <p class="font-medium mb-1">{{ __('common.tips') }}</p>
                            <ul class="list-disc list-inside space-y-1 text-xs">
                                <li>Use clear, descriptive titles</li>
                                <li>Add meta title for SEO</li>
                                <li>Set publish date to schedule</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
