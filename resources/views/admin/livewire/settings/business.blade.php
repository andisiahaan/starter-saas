<div>
    <form wire:submit="save">
        <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('settings.business.title') }}</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('settings.business.description') }}</p>
            </div>

            <div class="p-6 space-y-6">
                <!-- Brand & Identity -->
                <div>
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">{{ __('settings.business.sections.brand') }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="brand_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.brand_name') }}</label>
                            <input type="text" wire:model="state.brand_name" id="brand_name" placeholder="Your Brand" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="legal_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.legal_name') }}</label>
                            <input type="text" wire:model="state.legal_name" id="legal_name" placeholder="PT. Your Company" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label for="tagline" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.tagline') }}</label>
                            <input type="text" wire:model="state.tagline" id="tagline" placeholder="Your company tagline" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Invoice Settings -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">{{ __('settings.business.sections.invoice') }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="invoice_prefix" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.invoice_prefix') }}</label>
                            <input type="text" wire:model="state.invoice_prefix" id="invoice_prefix" placeholder="INV-" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="invoice_starting_number" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.invoice_starting_number') }}</label>
                            <input type="number" wire:model="state.invoice_starting_number" id="invoice_starting_number" min="1" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">{{ __('settings.business.sections.contact') }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.email') }}</label>
                            <input type="email" wire:model="state.email" id="email" placeholder="contact@company.com" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.phone') }}</label>
                            <input type="text" wire:model="state.phone" id="phone" placeholder="+62 812 3456 7890" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="whatsapp" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.whatsapp') }}</label>
                            <input type="text" wire:model="state.whatsapp" id="whatsapp" placeholder="+62 812 3456 7890" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="website" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.website') }}</label>
                            <input type="url" wire:model="state.website" id="website" placeholder="https://yourcompany.com" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">{{ __('settings.business.sections.address') }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="address_line_1" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.address_line_1') }}</label>
                            <input type="text" wire:model="state.address_line_1" id="address_line_1" placeholder="Street address" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label for="address_line_2" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.address_line_2') }}</label>
                            <input type="text" wire:model="state.address_line_2" id="address_line_2" placeholder="Building, Suite, etc." class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.city') }}</label>
                            <input type="text" wire:model="state.city" id="city" placeholder="Jakarta" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="state" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.state') }}</label>
                            <input type="text" wire:model="state.state" id="state" placeholder="DKI Jakarta" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.postal_code') }}</label>
                            <input type="text" wire:model="state.postal_code" id="postal_code" placeholder="12345" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="country" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.country') }}</label>
                            <input type="text" wire:model="state.country" id="country" placeholder="Indonesia" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Tax & Legal -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">{{ __('settings.business.sections.tax') }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="tax_type" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.tax_type') }}</label>
                            <select wire:model="state.tax_type" id="tax_type" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                <option value="VAT">VAT</option>
                                <option value="GST">GST</option>
                                <option value="PPN">PPN (Indonesia)</option>
                                <option value="SST">SST (Malaysia)</option>
                                <option value="None">No Tax</option>
                            </select>
                        </div>
                        <div>
                            <label for="tax_rate" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.tax_rate') }}</label>
                            <input type="number" wire:model="state.tax_rate" id="tax_rate" min="0" max="100" step="0.1" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="tax_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.tax_id') }}</label>
                            <input type="text" wire:model="state.tax_id" id="tax_id" placeholder="XX.XXX.XXX.X-XXX.XXX" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="registration_number" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.registration_number') }}</label>
                            <input type="text" wire:model="state.registration_number" id="registration_number" placeholder="NIB / SIUP" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Banking -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">{{ __('settings.business.sections.banking') }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="bank_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.bank_name') }}</label>
                            <input type="text" wire:model="state.bank_name" id="bank_name" placeholder="Bank Central Asia" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="bank_account_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.bank_account_name') }}</label>
                            <input type="text" wire:model="state.bank_account_name" id="bank_account_name" placeholder="PT. Your Company" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="bank_account_number" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.bank_account_number') }}</label>
                            <input type="text" wire:model="state.bank_account_number" id="bank_account_number" placeholder="1234567890" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="bank_swift_code" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.business.fields.bank_swift_code') }}</label>
                            <input type="text" wire:model="state.bank_swift_code" id="bank_swift_code" placeholder="CENAIDJA" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Custom Fields -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">{{ __('settings.business.sections.custom') }}</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">{{ __('settings.business.custom_fields.description') }}</p>
                    
                    @if(count($customFields) > 0)
                    <div class="space-y-2 mb-4">
                        @foreach($customFields as $key => $field)
                        <div class="flex items-center gap-2 p-3 bg-slate-50 dark:bg-dark-soft rounded-lg">
                            <div class="flex-1">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $field['label'] }}</span>
                                <span class="text-slate-500 dark:text-slate-400">:</span>
                                <span class="text-sm text-slate-600 dark:text-slate-400">{{ $field['value'] }}</span>
                            </div>
                            <button type="button" wire:click="removeCustomField('{{ $key }}')" class="p-1 text-red-500 hover:text-red-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="flex gap-2">
                        <input type="text" wire:model="newFieldKey" placeholder="{{ __('settings.business.custom_fields.key') }}" class="flex-1 rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        <input type="text" wire:model="newFieldValue" placeholder="{{ __('settings.business.custom_fields.value') }}" class="flex-1 rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        <button type="button" wire:click="addCustomField" class="px-4 py-2 bg-slate-200 dark:bg-dark-border text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-300 dark:hover:bg-dark-soft text-sm font-medium">
                            {{ __('settings.business.custom_fields.add') }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border flex justify-end">
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition">
                    {{ __('common.actions.save_changes') }}
                </button>
            </div>
        </div>
    </form>
</div>
