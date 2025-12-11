<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-slate-900 dark:text-white">{{ __('admin.users.title') }}</h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ __('admin.users.description') }}</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none flex gap-2">
            <button wire:click="exportCsv" class="inline-flex items-center justify-center rounded-md border border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-200 shadow-sm hover:bg-slate-50 dark:hover:bg-dark-soft focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                {{ __('common.actions.export_csv') }}
            </button>
            @can('create-users')
            <button wire:click="$dispatch('openModal', { component: 'admin.users.modals.create-edit-user-modal' })" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 sm:w-auto">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('admin.users.add') }}
            </button>
            @endcan
        </div>
    </div>

    <!-- Filters -->
    <div class="mt-4 flex flex-col sm:flex-row gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="{{ __('admin.users.filters.search') }}"
            class="block w-full sm:w-64 rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
        <select wire:model.live="roleFilter" class="block w-full sm:w-48 rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
            <option value="">{{ __('admin.users.filters.all_roles') }}</option>
            @foreach($roles as $role)
            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
            @endforeach
        </select>
        <select wire:model.live="statusFilter" class="block w-full sm:w-40 rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
            <option value="">{{ __('admin.users.filters.all_status') }}</option>
            <option value="active">{{ __('admin.users.status.active') }}</option>
            <option value="banned">{{ __('admin.users.status.banned') }}</option>
        </select>
        
        {{-- Trashed Filter (Superadmin Only) --}}
        @if($isSuperAdmin)
        <select wire:model.live="trashedFilter" class="block w-full sm:w-48 rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
            <option value="">{{ __('admin.users.filters.active_only') }}</option>
            <option value="with">{{ __('admin.users.filters.with_deleted') }}</option>
            <option value="only">{{ __('admin.users.filters.deleted_only') }}</option>
        </select>
        @endif
    </div>

    <!-- Bulk Actions Bar -->
    @if(count($selected) > 0)
    <div class="mt-4 bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 rounded-lg p-3 flex items-center justify-between flex-wrap gap-2">
        <span class="text-sm font-medium text-primary-700 dark:text-primary-300">
            {{ __('admin.users.bulk.selected', ['count' => count($selected)]) }}
        </span>
        <div class="flex flex-wrap gap-2">
            @if($trashedFilter !== 'only')
            <button wire:click="bulkBan" wire:confirm="{{ __('admin.users.confirm.ban_bulk') }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-orange-700 dark:text-orange-400 bg-orange-100 dark:bg-orange-900/30 rounded-md hover:bg-orange-200 dark:hover:bg-orange-900/50">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
                {{ __('admin.users.bulk.ban') }}
            </button>
            <button wire:click="bulkUnban" wire:confirm="{{ __('admin.users.confirm.unban_bulk') }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-900/30 rounded-md hover:bg-green-200 dark:hover:bg-green-900/50">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ __('admin.users.bulk.unban') }}
            </button>
            @endif
            
            {{-- Superadmin Only Actions --}}
            @if($isSuperAdmin)
                @if($trashedFilter === 'only' || $trashedFilter === 'with')
                <button wire:click="bulkRestore" wire:confirm="{{ __('admin.users.confirm.restore_bulk') }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-700 dark:text-blue-400 bg-blue-100 dark:bg-blue-900/30 rounded-md hover:bg-blue-200 dark:hover:bg-blue-900/50">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    {{ __('admin.users.bulk.restore') }}
                </button>
                <button wire:click="bulkForceDelete" wire:confirm="{{ __('admin.users.confirm.force_delete_bulk') }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-red-700 dark:text-red-400 bg-red-100 dark:bg-red-900/30 rounded-md hover:bg-red-200 dark:hover:bg-red-900/50">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    {{ __('admin.users.bulk.force_delete') }}
                </button>
                @endif
            @endif
        </div>
    </div>
    @endif

    <!-- Table -->
    <div class="mt-6 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-slate-200 dark:ring-dark-border md:rounded-lg">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
                        <thead class="bg-slate-50 dark:bg-dark-soft">
                            <tr>
                                <th scope="col" class="relative w-12 px-4 sm:px-6">
                                    <input type="checkbox" wire:model.live="selectAll" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500 dark:bg-dark-elevated">
                                </th>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 dark:text-white sm:pl-6">{{ __('admin.users.table.user') }}</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">{{ __('admin.users.table.roles') }}</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">{{ __('admin.users.table.credits') }}</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">{{ __('admin.users.table.joined') }}</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">{{ __('common.table.actions') }}</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-dark-border bg-white dark:bg-dark-base">
                            @forelse($users as $user)
                            @php
                                $isDeleted = $user->deleted_at !== null;
                                $canManage = $this->canManageUser($user);
                            @endphp
                            <tr class="hover:bg-slate-50 dark:hover:bg-dark-elevated transition-colors {{ in_array($user->id, $selected) ? 'bg-primary-50 dark:bg-primary-900/10' : '' }} {{ $isDeleted ? 'opacity-60' : '' }}">
                                <td class="relative w-12 px-4 sm:px-6">
                                    <input type="checkbox" wire:model.live="selected" value="{{ $user->id }}" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500 dark:bg-dark-elevated">
                                </td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 sm:pl-6">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 rounded-full 
                                            @if($isDeleted) bg-slate-200 dark:bg-slate-700
                                            @elseif($user->isBanned()) bg-red-100 dark:bg-red-900/30
                                            @else bg-primary-100 dark:bg-primary-900/30
                                            @endif flex items-center justify-center">
                                            <span class="@if($isDeleted) text-slate-500 dark:text-slate-400 @elseif($user->isBanned()) text-red-600 dark:text-red-400 @else text-primary-600 dark:text-primary-400 @endif font-medium">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-slate-900 dark:text-white flex items-center gap-2">
                                                {{ $user->name }}
                                                @if($isDeleted)
                                                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-400">{{ __('admin.users.status.deleted') }}</span>
                                                @elseif($user->isBanned())
                                                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400">{{ __('admin.users.status.banned') }}</span>
                                                @endif
                                            </div>
                                            <div class="text-sm text-slate-500 dark:text-slate-400">{{ $user->email }}</div>
                                            @if($user->username)
                                            <div class="text-xs text-slate-400 dark:text-slate-500">@{{ $user->username }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <div class="flex flex-wrap gap-1">
                                        @forelse($user->roles as $role)
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium 
                                            @if($role->name === 'superadmin') bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400
                                            @elseif($role->name === 'admin') bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400
                                            @else bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400
                                            @endif">
                                            {{ $role->name }}
                                        </span>
                                        @empty
                                        <span class="text-slate-400 dark:text-slate-500 text-xs">{{ __('admin.users.no_roles') }}</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-primary-600 dark:text-primary-400">
                                    {{ number_format($user->credit ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    @if($isDeleted)
                                        {{-- Deleted User Actions (Superadmin Only) --}}
                                        @if($isSuperAdmin)
                                        <button wire:click="restoreUser({{ $user->id }})" class="text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 mr-2">{{ __('admin.users.actions.restore') }}</button>
                                        @if(!$user->hasRole('superadmin'))
                                        <button wire:click="forceDeleteUser({{ $user->id }})" wire:confirm="{{ __('admin.users.confirm.force_delete') }}" class="text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300">{{ __('admin.users.actions.force_delete') }}</button>
                                        @endif
                                        @endif
                                    @else
                                        {{-- Normal User Actions --}}
                                        @if($canManage)
                                        <button wire:click="$dispatch('openModal', { component: 'admin.users.modals.create-edit-user-modal', arguments: { userId: {{ $user->id }} } })" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 mr-2">{{ __('common.actions.edit') }}</button>
                                        @if($user->id !== auth()->id())
                                            @if($user->isBanned())
                                            <button wire:click="unbanUser({{ $user->id }})" class="text-green-600 dark:text-green-400 hover:text-green-500 dark:hover:text-green-300 mr-2">{{ __('admin.users.actions.unban') }}</button>
                                            @else
                                            <button wire:click="$dispatch('openModal', { component: 'admin.users.modals.ban-user-modal', arguments: { userId: {{ $user->id }} } })" class="text-orange-600 dark:text-orange-400 hover:text-orange-500 dark:hover:text-orange-300 mr-2">{{ __('admin.users.actions.ban') }}</button>
                                            @endif
                                            <button wire:click="$dispatch('openModal', { component: 'admin.users.modals.delete-user-modal', arguments: { userId: {{ $user->id }} } })" class="text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300">{{ __('common.actions.delete') }}</button>
                                        @endif
                                        @else
                                        <span class="text-slate-400 dark:text-slate-500 text-xs">{{ __('admin.users.no_permission') }}</span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400">
                                    @if($trashedFilter === 'only')
                                    {{ __('admin.users.empty_deleted') }}
                                    @else
                                    {{ __('admin.users.empty') }}
                                    @endif
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
        {{ $users->links() }}
    </div>
</div>