<?php

namespace App\Livewire\Admin\Settings;

use App\Helpers\Toast;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Business extends Component
{
    public array $state = [];
    public array $customFields = [];
    public string $newFieldKey = '';
    public string $newFieldValue = '';

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $setting = Setting::firstOrCreate(
            ['section' => 'business'],
            ['config' => $this->getDefaults()]
        );

        $config = array_merge($this->getDefaults(), $setting->config ?? []);
        $this->customFields = $config['custom_fields'] ?? [];
        unset($config['custom_fields']);
        $this->state = $config;
    }

    public function getDefaults(): array
    {
        return [
            // Brand & Identity
            'brand_name' => '',
            'legal_name' => '',
            'tagline' => '',
            
            // Invoice Settings
            'invoice_prefix' => 'INV-',
            'invoice_starting_number' => 1,
            
            // Contact Information
            'email' => '',
            'phone' => '',
            'whatsapp' => '',
            'website' => '',
            
            // Address
            'address_line_1' => '',
            'address_line_2' => '',
            'city' => '',
            'state' => '',
            'postal_code' => '',
            'country' => 'Indonesia',
            
            // Tax & Legal
            'tax_type' => 'VAT', // VAT, GST, PPN, etc.
            'tax_id' => '',
            'tax_rate' => 0,
            'registration_number' => '',
            
            // Banking
            'bank_name' => '',
            'bank_account_name' => '',
            'bank_account_number' => '',
            'bank_swift_code' => '',
            
            // Additional
            'custom_fields' => [],
        ];
    }

    public function addCustomField()
    {
        $this->validate([
            'newFieldKey' => 'required|string|max:50',
            'newFieldValue' => 'required|string|max:255',
        ]);

        $key = strtolower(str_replace(' ', '_', $this->newFieldKey));
        $this->customFields[$key] = [
            'label' => $this->newFieldKey,
            'value' => $this->newFieldValue,
        ];

        $this->newFieldKey = '';
        $this->newFieldValue = '';
    }

    public function removeCustomField($key)
    {
        unset($this->customFields[$key]);
    }

    public function save()
    {
        $this->validate([
            'state.brand_name' => 'nullable|string|max:100',
            'state.legal_name' => 'nullable|string|max:150',
            'state.email' => 'nullable|email|max:100',
            'state.phone' => 'nullable|string|max:30',
            'state.invoice_prefix' => 'nullable|string|max:20',
            'state.tax_rate' => 'nullable|numeric|min:0|max:100',
        ]);

        $config = $this->state;
        $config['custom_fields'] = $this->customFields;

        Setting::updateOrCreate(
            ['section' => 'business'],
            ['config' => $config]
        );

        Cache::forget('settings.business');
        Toast::success('Business settings saved successfully.');
    }

    public function render()
    {
        return view('admin.livewire.settings.business');
    }
}
