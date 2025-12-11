<?php

namespace App\Livewire\Admin\Settings;

use App\Helpers\Toast;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Captcha extends Component
{
    public array $state = [];

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $setting = Setting::firstOrCreate(
            ['section' => 'captcha'],
            ['config' => $this->getDefaults()]
        );

        $this->state = array_merge($this->getDefaults(), $setting->config ?? []);
    }

    public function getDefaults(): array
    {
        return [
            'provider' => 'recaptcha_v2',
            'site_key' => '',
            'secret_key' => '',
            'is_login_enabled' => false,
            'is_registration_enabled' => false,
            'is_forgot_password_enabled' => false,
        ];
    }

    public function save()
    {
        $this->validate([
            'state.provider' => 'required|in:recaptcha_v2,none',
            'state.site_key' => 'nullable|string|max:100',
            'state.secret_key' => 'nullable|string|max:100',
        ]);

        Setting::updateOrCreate(
            ['section' => 'captcha'],
            ['config' => $this->state]
        );

        Cache::forget('settings.captcha');
        Toast::success('Captcha settings saved successfully.');
    }

    public function render()
    {
        return view('admin.livewire.settings.captcha');
    }
}
