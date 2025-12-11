<div>
    <form wire:submit="save">
        <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('settings.cookie_consent.title') }}</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('settings.cookie_consent.description') }}</p>
            </div>

            <div class="p-6 space-y-6">
                <!-- Enable Toggle -->
                <label class="flex items-center justify-between p-4 bg-slate-50 dark:bg-dark-soft rounded-lg border border-slate-200 dark:border-dark-border hover:border-primary-500/30 transition cursor-pointer">
                    <div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.cookie_consent.enabled') }}</span>
                        <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('settings.cookie_consent.enabled_description') }}</p>
                    </div>
                    <div class="relative">
                        <input type="checkbox" wire:model.live="state.is_enabled" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-300 dark:bg-dark-border rounded-full peer peer-checked:bg-primary-600 transition-colors"></div>
                        <div class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                    </div>
                </label>

                @if($state['is_enabled'])
                <!-- Display Settings -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">{{ __('settings.cookie_consent.display.title') }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="position" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.cookie_consent.display.position') }}</label>
                            <select wire:model="state.position" id="position" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                <option value="bottom">{{ __('settings.cookie_consent.display.positions.bottom') }}</option>
                                <option value="top">{{ __('settings.cookie_consent.display.positions.top') }}</option>
                                <option value="bottom-left">{{ __('settings.cookie_consent.display.positions.bottom-left') }}</option>
                                <option value="bottom-right">{{ __('settings.cookie_consent.display.positions.bottom-right') }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="theme" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.cookie_consent.display.theme') }}</label>
                            <select wire:model="state.theme" id="theme" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                <option value="light">{{ __('settings.cookie_consent.display.themes.light') }}</option>
                                <option value="dark">{{ __('settings.cookie_consent.display.themes.dark') }}</option>
                                <option value="auto">{{ __('settings.cookie_consent.display.themes.auto') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">{{ __('settings.cookie_consent.content.title') }}</h4>
                    <div class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.cookie_consent.content.banner_title') }}</label>
                            <input type="text" wire:model="state.title" id="title" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.cookie_consent.content.message') }}</label>
                            <textarea wire:model="state.message" id="message" rows="3" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm"></textarea>
                        </div>
                        <div>
                            <label for="privacy_policy_url" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.cookie_consent.content.privacy_url') }}</label>
                            <input type="text" wire:model="state.privacy_policy_url" id="privacy_policy_url" placeholder="/page/privacy-policy" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">{{ __('settings.cookie_consent.buttons.title') }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="accept_button_text" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.cookie_consent.buttons.accept') }}</label>
                            <input type="text" wire:model="state.accept_button_text" id="accept_button_text" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="reject_button_text" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.cookie_consent.buttons.reject') }}</label>
                            <input type="text" wire:model="state.reject_button_text" id="reject_button_text" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="settings_button_text" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.cookie_consent.buttons.settings') }}</label>
                            <input type="text" wire:model="state.settings_button_text" id="settings_button_text" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="mt-4 flex flex-wrap gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" wire:model="state.show_reject_button" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                            <span class="text-sm text-slate-700 dark:text-slate-300">{{ __('settings.cookie_consent.buttons.show_reject') }}</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" wire:model="state.show_settings_button" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                            <span class="text-sm text-slate-700 dark:text-slate-300">{{ __('settings.cookie_consent.buttons.show_settings') }}</span>
                        </label>
                    </div>
                </div>

                <!-- Cookie Settings -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">{{ __('settings.cookie_consent.cookie_settings.title') }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="cookie_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.cookie_consent.cookie_settings.name') }}</label>
                            <input type="text" wire:model="state.cookie_name" id="cookie_name" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm font-mono text-xs">
                        </div>
                        <div>
                            <label for="cookie_expiry_days" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.cookie_consent.cookie_settings.expiry') }}</label>
                            <input type="number" wire:model="state.cookie_expiry_days" id="cookie_expiry_days" min="1" max="365" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="px-6 py-4 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border flex justify-end">
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition">
                    {{ __('common.actions.save_changes') }}
                </button>
            </div>
        </div>
    </form>
</div>
