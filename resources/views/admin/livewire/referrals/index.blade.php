<div>
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border p-5">
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('admin.referrals_index.stats.total_referrals') }}</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white mt-1">{{ number_format($stats['total_referrals']) }}</p>
        </div>
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border p-5">
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('admin.referrals_index.stats.total_referrers') }}</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white mt-1">{{ number_format($stats['total_referrers']) }}</p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-200 dark:border-dark-border flex items-center justify-between">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('admin.referrals_index.title') }}</h3>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ __('admin.referrals_index.search') }}" 
                   class="w-64 bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-3 py-2 text-sm">
        </div>

        @if($referrals->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
                <thead class="bg-slate-50 dark:bg-dark-soft">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">{{ __('admin.referrals_index.table.user') }}</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">{{ __('admin.referrals_index.table.referred_by') }}</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">{{ __('admin.referrals_index.table.joined') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-dark-border">
                    @foreach($referrals as $user)
                    <tr>
                        <td class="px-5 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                                    <span class="text-primary-600 dark:text-primary-400 text-sm font-semibold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <p class="text-sm text-slate-900 dark:text-white">{{ $user->referrer?->name ?? '-' }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $user->referrer?->email }}</p>
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-slate-200 dark:border-dark-border">
            {{ $referrals->links() }}
        </div>
        @else
        <div class="p-8 text-center">
            <p class="text-slate-500 dark:text-slate-400">{{ __('admin.referrals_index.empty') }}</p>
        </div>
        @endif
    </div>
</div>
