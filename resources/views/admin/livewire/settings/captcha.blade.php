<div>
    <form wire:submit="save">
        <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('settings.captcha.title') }}</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('settings.captcha.description') }}</p>
            </div>

            <div class="p-6 space-y-6">
                <!-- Provider Selection -->
                <div>
                    <label for="provider" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('settings.captcha.provider') }}</label>
                    <select wire:model.live="state.provider" id="provider" class="block w-full max-w-xs rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        <option value="none">{{ __('settings.captcha.providers.none') }}</option>
                        <option value="recaptcha_v2">{{ __('settings.captcha.providers.recaptcha_v2') }}</option>
                    </select>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ __('settings.captcha.provider_description') }}</p>
                </div>

                @if($state['provider'] !== 'none')
                <!-- API Keys -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">{{ __('settings.captcha.api_keys') }}</h4>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="site_key" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.captcha.site_key') }}</label>
                            <input type="text" wire:model="state.site_key" id="site_key" placeholder="6Lc..." class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm font-mono text-xs">
                        </div>
                        <div>
                            <label for="secret_key" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.captcha.secret_key') }}</label>
                            <input type="password" wire:model="state.secret_key" id="secret_key" placeholder="6Lc..." class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm font-mono text-xs">
                        </div>
                    </div>
                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                        {{ __('settings.captcha.get_keys_help') }} <a href="https://www.google.com/recaptcha/admin" target="_blank" class="text-primary-600 hover:underline">{{ __('settings.captcha.recaptcha_admin') }}</a>. {{ __('settings.captcha.recaptcha_select_help') }}
                    </p>
                </div>

                <!-- Form Protection -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">{{ __('settings.captcha.forms.title') }}</h4>
                    
                    <div class="space-y-3">
                        <label class="flex items-center justify-between p-4 bg-slate-50 dark:bg-dark-soft rounded-lg border border-slate-200 dark:border-dark-border hover:border-primary-500/30 transition cursor-pointer">
                            <div>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.captcha.forms.login') }}</span>
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('settings.captcha.forms.login_description') }}</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" wire:model.live="state.is_login_enabled" class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-dark-border rounded-full peer peer-checked:bg-primary-600 transition-colors"></div>
                                <div class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                            </div>
                        </label>

                        <label class="flex items-center justify-between p-4 bg-slate-50 dark:bg-dark-soft rounded-lg border border-slate-200 dark:border-dark-border hover:border-primary-500/30 transition cursor-pointer">
                            <div>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.captcha.forms.registration') }}</span>
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('settings.captcha.forms.registration_description') }}</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" wire:model.live="state.is_registration_enabled" class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-dark-border rounded-full peer peer-checked:bg-primary-600 transition-colors"></div>
                                <div class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                            </div>
                        </label>

                        <label class="flex items-center justify-between p-4 bg-slate-50 dark:bg-dark-soft rounded-lg border border-slate-200 dark:border-dark-border hover:border-primary-500/30 transition cursor-pointer">
                            <div>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.captcha.forms.forgot_password') }}</span>
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('settings.captcha.forms.forgot_password_description') }}</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" wire:model.live="state.is_forgot_password_enabled" class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-dark-border rounded-full peer peer-checked:bg-primary-600 transition-colors"></div>
                                <div class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                            </div>
                        </label>
                    </div>
                </div>
                @endif
            </div>

            <div class="px-6 py-4 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border flex justify-end">
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-base transition">
                    {{ __('common.actions.save_changes') }}
                </button>
            </div>
        </div>
    </form>
</div>
