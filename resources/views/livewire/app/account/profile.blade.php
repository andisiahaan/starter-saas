<div class="p-6">
    <div class="max-w-xl">
        <h3 class="text-lg font-medium text-slate-900 dark:text-white">{{ __('account.profile.title') }}</h3>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('account.profile.description') }}</p>

        <form wire:submit="updateProfile" class="mt-6 space-y-4">
            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                    {{ __('account.profile.name') }}
                </label>
                <input
                    type="text"
                    id="name"
                    wire:model="name"
                    class="mt-1 block w-full px-3 py-2 border border-slate-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-muted text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                @error('name')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email (read-only, change via security tab) --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                    {{ __('account.profile.email') }}
                </label>
                <input
                    type="email"
                    value="{{ auth()->user()->email }}"
                    disabled
                    class="mt-1 block w-full px-3 py-2 border border-slate-200 dark:border-dark-border rounded-lg bg-slate-100 dark:bg-dark-soft text-slate-500 dark:text-slate-400 cursor-not-allowed">
                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ __('account.profile.email_hint') }}</p>
            </div>

            {{-- Submit --}}
            <div class="flex items-center gap-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('account.profile.save') }}
                </button>

                <div wire:loading wire:target="updateProfile" class="text-sm text-slate-500">
                    {{ __('account.profile.saving') }}
                </div>

                @if (session('success'))
                <span class="text-sm text-emerald-600 dark:text-emerald-400">{{ session('success') }}</span>
                @endif
            </div>
        </form>
    </div>
</div>