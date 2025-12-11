<?php

namespace App\Livewire\Admin\Settings;

use App\Helpers\Toast;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class CookieConsent extends Component
{
    public array $state = [];

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $setting = Setting::firstOrCreate(
            ['section' => 'cookie_consent'],
            ['config' => $this->getDefaults()]
        );

        $this->state = array_merge($this->getDefaults(), $setting->config ?? []);
    }

    public function getDefaults(): array
    {
        return [
            'is_enabled' => false,
            
            // Display Settings
            'position' => 'bottom', // bottom, top, bottom-left, bottom-right
            'layout' => 'bar', // bar, box, cloud
            
            // Content
            'title' => 'We use cookies',
            'message' => 'This website uses cookies to ensure you get the best experience on our website.',
            'privacy_policy_url' => '/page/privacy-policy',
            
            // Buttons
            'accept_button_text' => 'Accept All',
            'reject_button_text' => 'Reject All',
            'settings_button_text' => 'Cookie Settings',
            'show_reject_button' => true,
            'show_settings_button' => false,
            
            // Cookie Categories (for granular consent)
            'categories' => [
                'necessary' => [
                    'name' => 'Necessary',
                    'description' => 'These cookies are essential for the website to function properly.',
                    'required' => true,
                ],
                'analytics' => [
                    'name' => 'Analytics',
                    'description' => 'These cookies help us understand how visitors interact with the website.',
                    'required' => false,
                ],
                'marketing' => [
                    'name' => 'Marketing',
                    'description' => 'These cookies are used to deliver personalized advertisements.',
                    'required' => false,
                ],
            ],
            
            // Appearance
            'theme' => 'light', // light, dark, auto
            'accent_color' => '#3B82F6',
            
            // Cookie Settings
            'cookie_name' => 'cookie_consent',
            'cookie_expiry_days' => 365,
        ];
    }

    public function save()
    {
        $this->validate([
            'state.title' => 'nullable|string|max:100',
            'state.message' => 'nullable|string|max:500',
            'state.accept_button_text' => 'nullable|string|max:50',
            'state.reject_button_text' => 'nullable|string|max:50',
            'state.cookie_expiry_days' => 'nullable|integer|min:1|max:365',
        ]);

        Setting::updateOrCreate(
            ['section' => 'cookie_consent'],
            ['config' => $this->state]
        );

        Cache::forget('settings.cookie_consent');
        Toast::success('Cookie consent settings saved successfully.');
    }

    public function render()
    {
        return view('admin.livewire.settings.cookie-consent');
    }
}
