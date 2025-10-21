<?php

namespace Database\Seeders;

use App\Models\CryptoAddress;
use Illuminate\Database\Seeder;

class CryptoAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CryptoAddress::create([
            'currency' => 'BTC',
            'address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh',
            'network' => 'Bitcoin',
            'is_active' => true,
        ]);

        CryptoAddress::create([
            'currency' => 'ETH',
            'address' => '0x71C7656EC7ab88b098defB751B7401B5f6d8976F',
            'network' => 'Ethereum',
            'is_active' => true,
        ]);

        CryptoAddress::create([
            'currency' => 'USDT',
            'address' => '0x71C7656EC7ab88b098defB751B7401B5f6d8976F',
            'network' => 'ERC20',
            'is_active' => true,
        ]);

        CryptoAddress::create([
            'currency' => 'USDT',
            'address' => 'TYASr5UV6HEcXatwdFQfmLVUqQQQMUxHLS',
            'network' => 'TRC20',
            'is_active' => true,
        ]);
    }
}
