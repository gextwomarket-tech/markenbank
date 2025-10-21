<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::create([
            'name' => 'Virement bancaire (IBAN)',
            'type' => 'iban',
            'is_active' => true,
            'fees_percentage' => 0,
            'fees_fixed' => 0,
            'min_amount' => 10,
            'max_amount' => 100000,
            'config' => [
                'iban' => 'FR76 1234 5678 9012 3456 7890 123',
                'bic' => 'MARKENFRXXX',
                'account_holder' => 'MARKEN BANK SA',
                'bank_name' => 'Marken Bank',
            ],
        ]);

        PaymentMethod::create([
            'name' => 'PayPal',
            'type' => 'paypal',
            'is_active' => true,
            'fees_percentage' => 2.5,
            'fees_fixed' => 0.25,
            'min_amount' => 5,
            'max_amount' => 10000,
            'config' => [
                'client_id' => env('PAYPAL_CLIENT_ID'),
                'secret' => env('PAYPAL_SECRET'),
                'mode' => env('PAYPAL_MODE', 'sandbox'),
            ],
        ]);

        PaymentMethod::create([
            'name' => 'Cryptomonnaies',
            'type' => 'crypto',
            'is_active' => true,
            'fees_percentage' => 1,
            'fees_fixed' => 0,
            'min_amount' => 10,
            'max_amount' => 50000,
            'config' => [
                'supported_currencies' => ['BTC', 'ETH', 'USDT'],
                'confirmations_required' => 3,
            ],
        ]);
    }
}
