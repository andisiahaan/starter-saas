<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-slate-900 dark:text-white">{{ __('admin.payment_methods_index.title') }}</h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ __('admin.payment_methods_index.description') }}</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <button wire:click="$dispatch('openModal', { component: 'admin.payment-methods.modals.create-edit-payment-method-modal' })" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                {{ __('admin.payment_methods_index.add') }}
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="mt-4 flex flex-col sm:flex-row gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="{{ __('admin.payment_methods_index.filters.search') }}"
            class="block w-full sm:w-64 rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
        <select wire:model.live="providerFilter" class="block w-full sm:w-40 rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
            <option value="">{{ __('admin.payment_methods_index.filters.all_providers') }}</option>
            @foreach($providers as $key => $label)
            <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>
        <select wire:model.live="typeFilter" class="block w-full sm:w-48 rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
            <option value="">{{ __('admin.payment_methods_index.filters.all_types') }}</option>
            @foreach($types as $key => $label)
            <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <!-- Table -->
    <div class="mt-6 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-slate-200 dark:ring-dark-border md:rounded-lg">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
                        <thead class="bg-slate-50 dark:bg-dark-soft">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 dark:text-white sm:pl-6">{{ __('admin.payment_methods_index.table.payment_method') }}</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">{{ __('admin.payment_methods_index.table.provider') }}</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">{{ __('admin.payment_methods_index.table.type') }}</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">{{ __('admin.payment_methods_index.table.limits') }}</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">{{ __('admin.payment_methods_index.table.fees') }}</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">{{ __('admin.payment_methods_index.table.status') }}</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">{{ __('common.table.actions') }}</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-dark-border bg-white dark:bg-dark-base">
                            @forelse($methods as $method)
                            <tr class="hover:bg-slate-50 dark:hover:bg-dark-elevated transition-colors">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 sm:pl-6">
                                    <div class="text-sm font-medium text-slate-900 dark:text-white">{{ $method->name }}</div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400">
                                        <code class="bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 px-1 rounded">{{ $method->code }}</code>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $method->provider === 'TRIPAY' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400' : 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400' }}">
                                        {{ $providers[$method->provider] ?? $method->provider }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400">
                                        {{ $types[$method->type] ?? $method->type }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300">
                                    @if($method->min_amount || $method->max_amount)
                                    <div class="text-xs">
                                        @if($method->min_amount)
                                        {{ __('admin.payment_methods_index.limits.min') }}: Rp {{ number_format($method->min_amount, 0, ',', '.') }}
                                        @endif
                                        @if($method->max_amount)
                                        <br>{{ __('admin.payment_methods_index.limits.max') }}: Rp {{ number_format($method->max_amount, 0, ',', '.') }}
                                        @endif
                                    </div>
                                    @else
                                    <span class="text-slate-400 dark:text-slate-500">-</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300">
                                    <div class="text-xs">
                                        @if($method->fee_flat > 0)
                                        {{ __('admin.payment_methods_index.fees.flat') }}: Rp {{ number_format($method->fee_flat, 0, ',', '.') }}
                                        @endif
                                        @if($method->fee_percent > 0)
                                        <br>{{ $method->fee_percent }}%
                                        @endif
                                        @if(!$method->fee_flat && !$method->fee_percent)
                                        <span class="text-slate-400 dark:text-slate-500">-</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <button wire:click="toggleActive({{ $method->id }})" class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $method->is_active ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300' }}">
                                        {{ $method->is_active ? __('admin.payment_methods_index.status.active') : __('admin.payment_methods_index.status.inactive') }}
                                    </button>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <button wire:click="$dispatch('openModal', { component: 'admin.payment-methods.modals.create-edit-payment-method-modal', arguments: { paymentMethodId: {{ $method->id }} } })" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 mr-3">{{ __('common.actions.edit') }}</button>
                                    <button wire:click="delete({{ $method->id }})" wire:confirm="{{ __('admin.payment_methods_index.confirm_delete') }}" class="text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300">{{ __('common.actions.delete') }}</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('admin.payment_methods_index.empty') }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $methods->links() }}
    </div>
</div>