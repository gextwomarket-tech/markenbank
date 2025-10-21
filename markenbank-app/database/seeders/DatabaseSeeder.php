<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BankAccount;
use App\Models\Transaction;
use App\Models\Topup;
use App\Models\VirtualCard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin MarkenBank',
            'email' => 'admin@markenbank.com',
            'phone' => '+33123456789',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_verified' => true,
        ]);

        // Create sample users
        $user1 = User::create([
            'name' => 'Jean Dupont',
            'email' => 'user1@example.com',
            'phone' => '+33612345678',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'is_verified' => true,
        ]);

        $user2 = User::create([
            'name' => 'Marie Martin',
            'email' => 'user2@example.com',
            'phone' => '+33687654321',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'is_verified' => true,
        ]);

        // Create bank accounts for user1 (USD)
        $account1 = BankAccount::create([
            'user_id' => $user1->id,
            'account_number' => generateAccountNumber($user1->id),
            'iban' => generateIban(),
            'currency' => 'USD',
            'balance' => 1000.00,
            'status' => 'active',
        ]);

        // Create bank accounts for user1 (EUR)
        $account2 = BankAccount::create([
            'user_id' => $user1->id,
            'account_number' => generateAccountNumber($user1->id + 100),
            'iban' => generateIban(),
            'currency' => 'EUR',
            'balance' => 500.00,
            'status' => 'active',
        ]);

        // Create bank account for user2 (XOF)
        $account3 = BankAccount::create([
            'user_id' => $user2->id,
            'account_number' => generateAccountNumber($user2->id),
            'iban' => generateIban(),
            'currency' => 'XOF',
            'balance' => 250000.00,
            'status' => 'active',
        ]);

        // Create transactions for account1
        Transaction::create([
            'bank_account_id' => $account1->id,
            'type' => 'credit',
            'amount' => 500.00,
            'currency' => 'USD',
            'status' => 'completed',
            'reference' => generateTransactionRef(),
            'meta' => ['description' => 'Initial deposit'],
        ]);

        Transaction::create([
            'bank_account_id' => $account1->id,
            'type' => 'debit',
            'amount' => 100.00,
            'currency' => 'USD',
            'status' => 'completed',
            'reference' => generateTransactionRef(),
            'meta' => ['description' => 'Transfer to savings'],
        ]);

        // Create topups
        Topup::create([
            'user_id' => $user1->id,
            'bank_account_id' => $account1->id,
            'method' => 'iban',
            'amount' => 200.00,
            'currency' => 'USD',
            'status' => 'pending',
            'proof_path' => null,
        ]);

        Topup::create([
            'user_id' => $user2->id,
            'bank_account_id' => $account3->id,
            'method' => 'crypto',
            'amount' => 0.005,
            'currency' => 'BTC',
            'crypto_currency' => 'BTC',
            'wallet_address' => '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
            'status' => 'approved',
            'admin_note' => 'Verified on blockchain',
        ]);

        // Create virtual cards
        VirtualCard::create([
            'user_id' => $user1->id,
            'bank_account_id' => $account1->id,
            'card_number_masked' => maskCardNumber(generateCardNumber()),
            'card_expiry' => '12/26',
            'card_cvv_masked' => '***',
            'status' => 'active',
        ]);

        VirtualCard::create([
            'user_id' => $user2->id,
            'bank_account_id' => $account3->id,
            'card_number_masked' => maskCardNumber(generateCardNumber()),
            'card_expiry' => '06/27',
            'card_cvv_masked' => '***',
            'status' => 'pending',
        ]);

        // Call all seeders
        $this->call([
            LanguageSeeder::class,
            PaymentMethodSeeder::class,
            CryptoAddressSeeder::class,
            SettingsSeeder::class,
        ]);
    }
}
