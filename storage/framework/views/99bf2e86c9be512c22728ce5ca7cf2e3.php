<div>
    <form wire:submit="save">
        <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Business Settings</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Configure your business details for invoices and documents.</p>
            </div>

            <div class="p-6 space-y-6">
                <!-- Brand & Identity -->
                <div>
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">Brand & Identity</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="brand_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Brand Name</label>
                            <input type="text" wire:model="state.brand_name" id="brand_name" placeholder="Your Brand" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="legal_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Legal Name</label>
                            <input type="text" wire:model="state.legal_name" id="legal_name" placeholder="PT. Your Company" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label for="tagline" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tagline</label>
                            <input type="text" wire:model="state.tagline" id="tagline" placeholder="Your company tagline" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Invoice Settings -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">Invoice Settings</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="invoice_prefix" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Invoice Prefix</label>
                            <input type="text" wire:model="state.invoice_prefix" id="invoice_prefix" placeholder="INV-" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="invoice_starting_number" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Starting Number</label>
                            <input type="number" wire:model="state.invoice_starting_number" id="invoice_starting_number" min="1" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">Contact Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email</label>
                            <input type="email" wire:model="state.email" id="email" placeholder="contact@company.com" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Phone</label>
                            <input type="text" wire:model="state.phone" id="phone" placeholder="+62 812 3456 7890" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="whatsapp" class="block text-sm font-medium text-slate-700 dark:text-slate-300">WhatsApp</label>
                            <input type="text" wire:model="state.whatsapp" id="whatsapp" placeholder="+62 812 3456 7890" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="website" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Website</label>
                            <input type="url" wire:model="state.website" id="website" placeholder="https://yourcompany.com" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">Address</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="address_line_1" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Address Line 1</label>
                            <input type="text" wire:model="state.address_line_1" id="address_line_1" placeholder="Street address" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label for="address_line_2" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Address Line 2</label>
                            <input type="text" wire:model="state.address_line_2" id="address_line_2" placeholder="Building, Suite, etc." class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-medium text-slate-700 dark:text-slate-300">City</label>
                            <input type="text" wire:model="state.city" id="city" placeholder="Jakarta" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="state" class="block text-sm font-medium text-slate-700 dark:text-slate-300">State/Province</label>
                            <input type="text" wire:model="state.state" id="state" placeholder="DKI Jakarta" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Postal Code</label>
                            <input type="text" wire:model="state.postal_code" id="postal_code" placeholder="12345" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="country" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Country</label>
                            <input type="text" wire:model="state.country" id="country" placeholder="Indonesia" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Tax & Legal -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">Tax & Legal</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="tax_type" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tax Type</label>
                            <select wire:model="state.tax_type" id="tax_type" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                <option value="VAT">VAT</option>
                                <option value="GST">GST</option>
                                <option value="PPN">PPN (Indonesia)</option>
                                <option value="SST">SST (Malaysia)</option>
                                <option value="None">No Tax</option>
                            </select>
                        </div>
                        <div>
                            <label for="tax_rate" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tax Rate (%)</label>
                            <input type="number" wire:model="state.tax_rate" id="tax_rate" min="0" max="100" step="0.1" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="tax_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tax ID / NPWP</label>
                            <input type="text" wire:model="state.tax_id" id="tax_id" placeholder="XX.XXX.XXX.X-XXX.XXX" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="registration_number" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Business Registration No.</label>
                            <input type="text" wire:model="state.registration_number" id="registration_number" placeholder="NIB / SIUP" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Banking -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">Banking Details</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="bank_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Bank Name</label>
                            <input type="text" wire:model="state.bank_name" id="bank_name" placeholder="Bank Central Asia" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="bank_account_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Account Name</label>
                            <input type="text" wire:model="state.bank_account_name" id="bank_account_name" placeholder="PT. Your Company" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="bank_account_number" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Account Number</label>
                            <input type="text" wire:model="state.bank_account_number" id="bank_account_number" placeholder="1234567890" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="bank_swift_code" class="block text-sm font-medium text-slate-700 dark:text-slate-300">SWIFT Code</label>
                            <input type="text" wire:model="state.bank_swift_code" id="bank_swift_code" placeholder="CENAIDJA" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Custom Fields -->
                <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">Custom Fields</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">Add any additional business information that will appear on invoices.</p>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($customFields) > 0): ?>
                    <div class="space-y-2 mb-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div class="flex items-center gap-2 p-3 bg-slate-50 dark:bg-dark-soft rounded-lg">
                            <div class="flex-1">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e($field['label']); ?></span>
                                <span class="text-slate-500 dark:text-slate-400">:</span>
                                <span class="text-sm text-slate-600 dark:text-slate-400"><?php echo e($field['value']); ?></span>
                            </div>
                            <button type="button" wire:click="removeCustomField('<?php echo e($key); ?>')" class="p-1 text-red-500 hover:text-red-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="flex gap-2">
                        <input type="text" wire:model="newFieldKey" placeholder="Field Name" class="flex-1 rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        <input type="text" wire:model="newFieldValue" placeholder="Value" class="flex-1 rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        <button type="button" wire:click="addCustomField" class="px-4 py-2 bg-slate-200 dark:bg-dark-border text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-300 dark:hover:bg-dark-soft text-sm font-medium">
                            Add
                        </button>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border flex justify-end">
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition">
                    Save Changes
                </button>
            </div>
        </div>
    </form>
</div>
<?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/admin/livewire/settings/business.blade.php ENDPATH**/ ?>