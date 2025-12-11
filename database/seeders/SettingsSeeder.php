<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Main Settings
            [
                'section' => 'main',
                'config' => [
                    'name' => config('app.name', 'Laravel Starter'),
                    'description' => 'A powerful SaaS starter kit built with Laravel and Livewire',
                    'logo' => null,
                    'favicon' => null,
                    'timezone' => 'Asia/Jakarta',
                    'currency' => 'IDR',
                    'default_language' => 'en',
                    'theme' => 'light',
                ],
            ],

            // Auth Settings
            [
                'section' => 'auth',
                'config' => [
                    'is_registration_enabled' => true,
                    'is_email_verification_required' => true,
                    'is_phone_required' => false,
                    'is_registration_with_google_enabled' => false,
                    'is_login_with_google_enabled' => false,
                    'google_client_id' => null,
                    'google_client_secret' => null,
                    'default_role' => 'user',
                ],
            ],

            // Captcha Settings
            [
                'section' => 'captcha',
                'config' => [
                    'provider' => 'none', // none, recaptcha_v2, recaptcha_v3, hcaptcha, turnstile
                    'site_key' => null,
                    'secret_key' => null,
                    'is_login_enabled' => false,
                    'is_registration_enabled' => false,
                    'is_forgot_password_enabled' => false,
                ],
            ],

            // Social Login Settings
            [
                'section' => 'social',
                'config' => [
                    'google_enabled' => false,
                    'google_client_id' => null,
                    'google_client_secret' => null,
                ],
            ],

            // Referral Settings
            [
                'section' => 'referral',
                'config' => [
                    'is_enabled' => false,
                    'commission_type' => 'percentage', // fixed, percentage
                    'commission_value' => 10,
                    'min_withdrawal' => 50000,
                    'max_withdrawal' => 10000000,
                ],
            ],

            // Business Settings
            [
                'section' => 'business',
                'config' => [
                    'brand_name' => null,
                    'legal_name' => null,
                    'email' => null,
                    'phone' => null,
                    'address' => null,
                    'city' => null,
                    'country' => 'Indonesia',
                    'tax_id' => null,
                    'bank_name' => null,
                    'bank_account_number' => null,
                    'bank_account_name' => null,
                ],
            ],

            // Cookie Consent Settings
            [
                'section' => 'cookie-consent',
                'config' => [
                    'enabled' => false,
                    'position' => 'bottom',
                    'theme' => 'dark',
                    'title' => 'We use cookies',
                    'message' => 'This website uses cookies to ensure you get the best experience on our website.',
                    'accept_button' => 'Accept All',
                    'decline_button' => 'Decline',
                    'policy_link' => '/page/privacy-policy',
                ],
            ],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['section' => $setting['section']],
                ['config' => $setting['config']]
            );
        }
    }
}
