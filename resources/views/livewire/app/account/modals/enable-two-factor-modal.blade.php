<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
            @if($showRecoveryCodes)
            {{ __('account.modals.enable_2fa.save_codes_title') }}
            @else
            {{ __('account.modals.enable_2fa.title') }}
            @endif
        </h3>
        @unless($showRecoveryCodes)
        <button wire:click="$dispatch('closeModal')" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:text-white dark:hover:bg-white/10 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        @endunless
    </div>

    {{-- Body --}}
    <div class="p-5">
        @if($showRecoveryCodes)
        {{-- Recovery Codes --}}
        <div class="text-center mb-4">
            <div class="w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-sm text-slate-600 dark:text-slate-300">
                {{ __('account.modals.enable_2fa.enabled_message') }}
            </p>
        </div>

        <div class="bg-slate-100 dark:bg-dark-soft rounded-lg p-4 mb-4">
            <div class="grid grid-cols-2 gap-2 font-mono text-sm">
                @foreach($recoveryCodes as $code)
                <div class="p-2 bg-white dark:bg-dark-muted rounded text-center text-slate-800 dark:text-slate-200">
                    {{ $code }}
                </div>
                @endforeach
            </div>
        </div>

        <p class="text-xs text-red-600 dark:text-red-400 text-center">
            {{ __('account.modals.enable_2fa.code_warning') }}
        </p>
        @else
        {{-- QR Code Setup --}}
        <div class="text-center mb-6">
            <p class="text-sm text-slate-600 dark:text-slate-300 mb-4">
                {{ __('account.modals.enable_2fa.scan_qr') }}
            </p>

            <div class="inline-block p-4 bg-white rounded-lg shadow-sm">
                {!! $qrCodeSvg !!}
            </div>

            <p class="mt-4 text-xs text-slate-500 dark:text-slate-400">
                {{ __('account.modals.enable_2fa.enter_manually') }}
                <code class="block mt-1 p-2 bg-slate-100 dark:bg-dark-soft rounded text-sm font-mono text-slate-900 dark:text-white break-all">{{ $secret }}</code>
            </p>
        </div>

        <form wire:submit="enable">
            <div>
                <label for="code" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                    {{ __('account.modals.enable_2fa.verification_code') }}
                </label>
                <input
                    type="text"
                    id="code"
                    wire:model="code"
                    maxlength="6"
                    placeholder="000000"
                    class="mt-1 block w-full px-3 py-2 border border-slate-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-muted text-slate-900 dark:text-white text-center text-xl tracking-widest font-mono focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    autofocus>
                @error('code')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </form>
        @endif
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        @if($showRecoveryCodes)
        <button wire:click="finish" class="btn btn-primary">
            {{ __('account.modals.enable_2fa.saved_codes') }}
        </button>
        @else
        <button wire:click="$dispatch('closeModal')" class="btn btn-ghost">
            {{ __('account.modals.enable_2fa.cancel') }}
        </button>
        <button wire:click="enable" class="btn btn-primary" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="enable">{{ __('account.modals.enable_2fa.verify_enable') }}</span>
            <span wire:loading wire:target="enable">{{ __('account.modals.enable_2fa.verifying') }}</span>
        </button>
        @endif
    </div>
</div>
