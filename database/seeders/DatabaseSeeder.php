<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BankAccount;
use App\Models\Transaction;
use App\Models\Topup;
use App\Models\VirtualCard;
use App\Models\Setting;
use App\Models\Language;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Languages
        $this->createLanguages();
        
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin Marken',
            'email' => 'admin@markenbank.com',
            'phone' => '+33612345678',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_verified' => true,
        ]);
        
        // Create Sample Users
        $user1 = User::create([
            'name' => 'Jean Dupont',
            'email' => 'jean.dupont@example.com',
            'phone' => '+33698765432',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'is_verified' => true,
        ]);
        
        $user2 = User::create([
            'name' => 'Marie Martin',
            'email' => 'marie.martin@example.com',
            'phone' => '+33687654321',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'is_verified' => true,
        ]);
        
        $user3 = User::create([
            'name' => 'Pierre Dubois',
            'email' => 'pierre.dubois@example.com',
            'phone' => '+33676543210',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'is_verified' => false,
        ]);
        
        // Create Bank Accounts
        $accounts = [
            // User 1 Accounts
            [
                'user_id' => $user1->id,
                'account_number' => generateAccountNumber($user1->id, 'ACC'),
                'iban' => generateIban('FR76'),
                'currency' => 'EUR',
                'balance' => 15000.00,
                'status' => 'active',
            ],
            [
                'user_id' => $user1->id,
                'account_number' => generateAccountNumber($user1->id, 'ACC') . '_USD',
                'iban' => generateIban('US12'),
                'currency' => 'USD',
                'balance' => 5000.00,
                'status' => 'active',
            ],
            // User 2 Accounts
            [
                'user_id' => $user2->id,
                'account_number' => generateAccountNumber($user2->id, 'ACC'),
                'iban' => generateIban('FR76'),
                'currency' => 'EUR',
                'balance' => 25000.00,
                'status' => 'active',
            ],
            [
                'user_id' => $user2->id,
                'account_number' => generateAccountNumber($user2->id, 'ACC') . '_GBP',
                'iban' => generateIban('GB82'),
                'currency' => 'GBP',
                'balance' => 8000.00,
                'status' => 'active',
            ],
            [
                'user_id' => $user2->id,
                'account_number' => generateAccountNumber($user2->id, 'ACC') . '_XOF',
                'iban' => generateIban('CI93'),
                'currency' => 'XOF',
                'balance' => 500000.00,
                'status' => 'active',
            ],
            // User 3 Accounts
            [
                'user_id' => $user3->id,
                'account_number' => generateAccountNumber($user3->id, 'ACC'),
                'iban' => generateIban('FR76'),
                'currency' => 'EUR',
                'balance' => 1000.00,
                'status' => 'active',
            ],
        ];
        
        foreach ($accounts as $accountData) {
            $account = BankAccount::create($accountData);
            
            // Create Transactions for each account
            $this->createTransactions($account);
        }
        
        // Create Virtual Cards
        $this->createVirtualCards($user1, $user2);
        
        // Create Topups
        $this->createTopups($user1, $user2, $user3);
        
        // Create Settings
        $this->createSettings();
        
        echo "\n✅ Database seeded successfully!\n";
        echo "Admin: admin@markenbank.com / password123\n";
        echo "User1: jean.dupont@example.com / password123\n";
        echo "User2: marie.martin@example.com / password123\n";
        echo "User3: pierre.dubois@example.com / password123\n\n";
    }
    
    private function createLanguages()
    {
        Language::create([
            'code' => 'fr',
            'name' => 'Français',
            'flag' => '🇫🇷',
            'is_active' => true,
            'is_default' => true,
        ]);
        
        Language::create([
            'code' => 'en',
            'name' => 'English',
            'flag' => '🇬🇧',
            'is_active' => true,
            'is_default' => false,
        ]);
    }
    
    private function createTransactions($account)
    {
        $types = ['credit', 'debit', 'transfer', 'topup', 'fee'];
        $statuses = ['completed', 'completed', 'completed', 'pending', 'failed'];
        
        for ($i = 0; $i < rand(5, 15); $i++) {
            $type = $types[array_rand($types)];
            $status = $statuses[array_rand($statuses)];
            $amount = rand(10, 1000) + (rand(0, 99) / 100);
            
            Transaction::create([
                'bank_account_id' => $account->id,
                'type' => $type,
                'amount' => $amount,
                'currency' => $account->currency,
                'status' => $status,
                'reference' => generateTransactionRef('TXN'),
                'meta' => [
                    'description' => 'Sample transaction',
                    'created_by' => 'system'
                ],
                'created_at' => now()->subDays(rand(0, 30)),
            ]);
        }
    }
    
    private function createVirtualCards($user1, $user2)
    {
        $account1 = $user1->bankAccounts()->where('currency', 'EUR')->first();
        $account2 = $user2->bankAccounts()->where('currency', 'EUR')->first();
        
        if ($account1) {
            VirtualCard::create([
                'user_id' => $user1->id,
                'bank_account_id' => $account1->id,
                'card_number_masked' => maskCardNumber(generateCardNumber()),
                'card_expiry' => '12/28',
                'card_cvv_masked' => '***',
                'status' => 'active',
                'metadata' => [
                    'card_type' => 'visa',
                    'spending_limit' => 5000
                ],
            ]);
        }
        
        if ($account2) {
            VirtualCard::create([
                'user_id' => $user2->id,
                'bank_account_id' => $account2->id,
                'card_number_masked' => maskCardNumber(generateCardNumber()),
                'card_expiry' => '06/27',
                'card_cvv_masked' => '***',
                'status' => 'active',
                'metadata' => [
                    'card_type' => 'mastercard',
                    'spending_limit' => 10000
                ],
            ]);
            
            VirtualCard::create([
                'user_id' => $user2->id,
                'bank_account_id' => $account2->id,
                'card_number_masked' => maskCardNumber(generateCardNumber()),
                'card_expiry' => '03/26',
                'card_cvv_masked' => '***',
                'status' => 'frozen',
                'metadata' => [
                    'card_type' => 'visa',
                    'spending_limit' => 3000
                ],
            ]);
        }
    }
    
    private function createTopups($user1, $user2, $user3)
    {
        $account1 = $user1->bankAccounts()->first();
        $account2 = $user2->bankAccounts()->first();
        $account3 = $user3->bankAccounts()->first();
        
        Topup::create([
            'user_id' => $user1->id,
            'bank_account_id' => $account1->id,
            'method' => 'iban',
            'amount' => 1000.00,
            'currency' => 'EUR',
            'status' => 'approved',
            'admin_note' => 'Verified and approved',
            'created_at' => now()->subDays(5),
        ]);
        
        Topup::create([
            'user_id' => $user2->id,
            'bank_account_id' => $account2->id,
            'method' => 'crypto',
            'amount' => 500.00,
            'currency' => 'USD',
            'crypto_currency' => 'BTC',
            'wallet_address' => '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
            'status' => 'pending',
            'created_at' => now()->subDays(1),
        ]);
        
        Topup::create([
            'user_id' => $user3->id,
            'bank_account_id' => $account3->id,
            'method' => 'paypal',
            'amount' => 200.00,
            'currency' => 'EUR',
            'status' => 'pending',
            'created_at' => now(),
        ]);
        
        Topup::create([
            'user_id' => $user1->id,
            'bank_account_id' => $account1->id,
            'method' => 'iban',
            'amount' => 750.00,
            'currency' => 'EUR',
            'status' => 'rejected',
            'admin_note' => 'Invalid proof of payment',
            'created_at' => now()->subDays(10),
        ]);
    }
    
    private function createSettings()
    {
        Setting::create([
            'key' => 'paypal_client_id',
            'value' => json_encode(''),
            'group' => 'payment',
        ]);
        
        Setting::create([
            'key' => 'paypal_secret',
            'value' => json_encode(''),
            'group' => 'payment',
        ]);
        
        Setting::create([
            'key' => 'crypto_addresses',
            'value' => json_encode([
                'BTC' => '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
                'ETH' => '0x742d35Cc6634C0532925a3b844Bc9e7595f0bEb',
                'USDT' => 'TYDzvRXgfUNJEDdP2wT3NXXKgqSVK5Kqwz',
            ]),
            'group' => 'crypto',
        ]);
        
        Setting::create([
            'key' => 'supported_currencies',
            'value' => json_encode(['EUR', 'USD', 'GBP', 'CAD', 'XOF']),
            'group' => 'general',
        ]);
        
        Setting::create([
            'key' => 'transaction_fees',
            'value' => json_encode([
                'iban' => ['fixed' => 0, 'percent' => 0],
                'crypto' => ['fixed' => 2, 'percent' => 1],
                'paypal' => ['fixed' => 0.5, 'percent' => 2.9],
            ]),
            'group' => 'fees',
        ]);
        
        Setting::create([
            'key' => 'topup_limits',
            'value' => json_encode([
                'iban' => ['min' => 10, 'max' => 50000],
                'crypto' => ['min' => 50, 'max' => 100000],
                'paypal' => ['min' => 10, 'max' => 10000],
            ]),
            'group' => 'limits',
        ]);
        
        Setting::create([
            'key' => 'deposit_iban',
            'value' => json_encode([
                'iban' => 'FR7630006000011234567890189',
                'bic' => 'BNPAFRPP',
                'holder' => 'Marken Bank SARL',
            ]),
            'group' => 'payment',
        ]);
    }
}
