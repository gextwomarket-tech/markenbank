<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Payment methods
            [
                'key' => 'payment_methods_enabled',
                'value' => json_encode(['iban', 'paypal', 'crypto']),
                'group' => 'payment',
            ],
            
            // Crypto addresses
            [
                'key' => 'crypto_addresses',
                'value' => json_encode([
                    'BTC' => '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
                    'ETH' => '0x742d35Cc6634C0532925a3b844Bc9e7595f0bEb1',
                    'USDT' => '0x742d35Cc6634C0532925a3b844Bc9e7595f0bEb1',
                ]),
                'group' => 'crypto',
            ],
            
            // PayPal settings
            [
                'key' => 'paypal_client_id',
                'value' => json_encode('sandbox_client_id'),
                'group' => 'paypal',
            ],
            [
                'key' => 'paypal_secret',
                'value' => json_encode('sandbox_secret'),
                'group' => 'paypal',
            ],
            [
                'key' => 'paypal_mode',
                'value' => json_encode('sandbox'),
                'group' => 'paypal',
            ],
            
            // IBAN deposit details
            [
                'key' => 'iban_deposit_account',
                'value' => json_encode('FR7630001007941234567890185'),
                'group' => 'iban',
            ],
            [
                'key' => 'iban_bic',
                'value' => json_encode('BNPAFRPP'),
                'group' => 'iban',
            ],
            [
                'key' => 'iban_account_holder',
                'value' => json_encode('MarkenBank SA'),
                'group' => 'iban',
            ],
            
            // Fees and limits
            [
                'key' => 'fees_iban',
                'value' => json_encode(['fixed' => 0, 'percent' => 0]),
                'group' => 'fees',
            ],
            [
                'key' => 'fees_paypal',
                'value' => json_encode(['fixed' => 0, 'percent' => 2.9]),
                'group' => 'fees',
            ],
            [
                'key' => 'fees_crypto',
                'value' => json_encode(['fixed' => 0, 'percent' => 1]),
                'group' => 'fees',
            ],
            [
                'key' => 'limits_topup_min',
                'value' => json_encode(10),
                'group' => 'limits',
            ],
            [
                'key' => 'limits_topup_max',
                'value' => json_encode(10000),
                'group' => 'limits',
            ],
            
            // Supported currencies
            [
                'key' => 'supported_currencies',
                'value' => json_encode(['USD', 'EUR', 'XOF', 'GBP', 'CAD']),
                'group' => 'general',
            ],
            
            // App settings
            [
                'key' => 'app_name',
                'value' => json_encode('Marken Bank'),
                'group' => 'general',
            ],
            [
                'key' => 'app_tagline',
                'value' => json_encode('Votre banque digitale de confiance'),
                'group' => 'general',
            ],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::create($setting);
        }
    }
}
