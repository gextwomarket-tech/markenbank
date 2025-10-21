<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BankAccount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin Marken',
            'email' => 'admin@demo.com',
            'phone' => '+33 6 12 34 56 78',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_verified' => true,
            'date_of_birth' => '1990-01-01',
            'address' => '123 Avenue des Champs-Élysées',
            'city' => 'Paris',
            'postal_code' => '75008',
            'country' => 'FR',
        ]);

        // Create demo client 1 (USD)
        $user1 = User::create([
            'name' => 'Jean Dupont',
            'email' => 'user@demo.com',
            'phone' => '+33 6 98 76 54 32',
            'password' => Hash::make('password'),
            'role' => 'user',
            'is_verified' => true,
            'date_of_birth' => '1995-05-15',
            'address' => '45 Rue de la République',
            'city' => 'Lyon',
            'postal_code' => '69002',
            'country' => 'FR',
        ]);

        $account1 = BankAccount::create([
            'user_id' => $user1->id,
            'account_number' => generateAccountNumber($user1->id),
            'iban' => generateIban('FR'),
            'currency' => 'USD',
            'country_code' => 'US',
            'swift_bic' => generateSwift(),
            'balance' => 1000.00,
            'status' => 'active',
        ]);

        // Create demo client 2 (XOF)
        $user2 = User::create([
            'name' => 'Aminata Diallo',
            'email' => 'client@demo.com',
            'phone' => '+221 77 123 45 67',
            'password' => Hash::make('password'),
            'role' => 'user',
            'is_verified' => true,
            'date_of_birth' => '1992-08-20',
            'address' => 'Avenue Cheikh Anta Diop',
            'city' => 'Dakar',
            'postal_code' => '12500',
            'country' => 'SN',
        ]);

        $account2 = BankAccount::create([
            'user_id' => $user2->id,
            'account_number' => generateAccountNumber($user2->id),
            'iban' => generateIban('SN'),
            'currency' => 'XOF',
            'country_code' => 'SN',
            'swift_bic' => generateSwift(),
            'balance' => 250000.00,
            'status' => 'active',
        ]);

        // Add EUR account for user2
        BankAccount::create([
            'user_id' => $user2->id,
            'account_number' => generateAccountNumber($user2->id) . '-EUR',
            'iban' => generateIban('FR'),
            'currency' => 'EUR',
            'country_code' => 'FR',
            'swift_bic' => generateSwift(),
            'balance' => 500.00,
            'status' => 'active',
        ]);
    }
}
