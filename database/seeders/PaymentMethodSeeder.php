<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $paymentMethods = [
            // Bank Transfer
            [
                'code' => 'MANUAL_BCA',
                'provider' => 'MANUAL',
                'name' => 'Bank BCA',
                'type' => 'bank_transfer',
                'flow' => 'deposit',
                'description' => 'Transfer via Bank BCA',
                'min_amount' => 10000,
                'max_amount' => 100000000,
                'fee_flat' => 0,
                'fee_percent' => 0,
                'is_active' => true,
                'meta' => [
                    'bank_name' => 'Bank Central Asia (BCA)',
                    'account_number' => '1234567890',
                    'account_name' => 'PT Example Indonesia',
                    'instructions' => 'Transfer to the account number above and upload proof of payment.',
                ],
            ],
            [
                'code' => 'MANUAL_MANDIRI',
                'provider' => 'MANUAL',
                'name' => 'Bank Mandiri',
                'type' => 'bank_transfer',
                'flow' => 'deposit',
                'description' => 'Transfer via Bank Mandiri',
                'min_amount' => 10000,
                'max_amount' => 100000000,
                'fee_flat' => 0,
                'fee_percent' => 0,
                'is_active' => true,
                'meta' => [
                    'bank_name' => 'Bank Mandiri',
                    'account_number' => '0987654321',
                    'account_name' => 'PT Example Indonesia',
                    'instructions' => 'Transfer to the account number above and upload proof of payment.',
                ],
            ],

            // E-Wallet
            [
                'code' => 'MANUAL_DANA',
                'provider' => 'MANUAL',
                'name' => 'DANA',
                'type' => 'ewallet',
                'flow' => 'both',
                'description' => 'Payment via DANA e-wallet',
                'min_amount' => 10000,
                'max_amount' => 10000000,
                'fee_flat' => 0,
                'fee_percent' => 0,
                'is_active' => true,
                'meta' => [
                    'phone_number' => '081234567890',
                    'account_name' => 'Example Store',
                    'instructions' => 'Send to the phone number above via DANA app.',
                ],
            ],
            [
                'code' => 'MANUAL_GOPAY',
                'provider' => 'MANUAL',
                'name' => 'GoPay',
                'type' => 'ewallet',
                'flow' => 'both',
                'description' => 'Payment via GoPay e-wallet',
                'min_amount' => 10000,
                'max_amount' => 10000000,
                'fee_flat' => 0,
                'fee_percent' => 0,
                'is_active' => true,
                'meta' => [
                    'phone_number' => '081234567890',
                    'account_name' => 'Example Store',
                    'instructions' => 'Send to the phone number above via GoPay.',
                ],
            ],
            [
                'code' => 'MANUAL_OVO',
                'provider' => 'MANUAL',
                'name' => 'OVO',
                'type' => 'ewallet',
                'flow' => 'both',
                'description' => 'Payment via OVO e-wallet',
                'min_amount' => 10000,
                'max_amount' => 10000000,
                'fee_flat' => 0,
                'fee_percent' => 0,
                'is_active' => true,
                'meta' => [
                    'phone_number' => '081234567890',
                    'account_name' => 'Example Store',
                    'instructions' => 'Send to the phone number above via OVO app.',
                ],
            ],
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::firstOrCreate(
                ['code' => $method['code']],
                $method
            );
        }
    }
}
