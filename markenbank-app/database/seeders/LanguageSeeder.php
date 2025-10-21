<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $translations_fr = [
            // Navigation
            'home' => 'Accueil',
            'services' => 'Services',
            'pricing' => 'Tarifs',
            'security' => 'Sécurité',
            'about' => 'À propos',
            'contact' => 'Contact',
            'blog' => 'Blog',
            'login' => 'Connexion',
            'register' => 'Créer un compte',
            'logout' => 'Déconnexion',
            
            // Hero
            'hero_title' => 'Votre banque digitale de nouvelle génération',
            'hero_subtitle' => 'Gérez vos finances en toute simplicité avec Marken Bank',
            'open_account' => 'Ouvrir un compte',
            'learn_more' => 'En savoir plus',
            
            // Dashboard
            'dashboard' => 'Tableau de bord',
            'my_accounts' => 'Mes comptes',
            'transactions' => 'Transactions',
            'topup' => 'Recharger',
            'cards' => 'Cartes',
            'profile' => 'Profil',
            'settings' => 'Paramètres',
            
            // Account
            'account_number' => 'Numéro de compte',
            'iban' => 'IBAN',
            'balance' => 'Solde',
            'currency' => 'Devise',
            'status' => 'Statut',
            
            // Transactions
            'amount' => 'Montant',
            'date' => 'Date',
            'type' => 'Type',
            'description' => 'Description',
            'reference' => 'Référence',
            
            // Buttons
            'submit' => 'Envoyer',
            'cancel' => 'Annuler',
            'save' => 'Enregistrer',
            'delete' => 'Supprimer',
            'edit' => 'Modifier',
            'view' => 'Voir',
            'close' => 'Fermer',
            
            // Status
            'pending' => 'En attente',
            'approved' => 'Approuvé',
            'rejected' => 'Rejeté',
            'active' => 'Actif',
            'blocked' => 'Bloqué',
            'completed' => 'Terminé',
            
            // Footer
            'all_rights_reserved' => 'Tous droits réservés',
            'terms' => 'Conditions d\'utilisation',
            'privacy' => 'Politique de confidentialité',
            'legal' => 'Mentions légales',
        ];

        Language::create([
            'code' => 'fr',
            'name' => 'Français',
            'flag' => '🇫🇷',
            'is_active' => true,
            'is_default' => true,
            'translations' => $translations_fr,
        ]);

        $translations_en = [
            'home' => 'Home',
            'services' => 'Services',
            'pricing' => 'Pricing',
            'security' => 'Security',
            'about' => 'About',
            'contact' => 'Contact',
            'blog' => 'Blog',
            'login' => 'Login',
            'register' => 'Sign up',
            'logout' => 'Logout',
            'hero_title' => 'Your next-generation digital bank',
            'hero_subtitle' => 'Manage your finances with ease using Marken Bank',
            'open_account' => 'Open an account',
            'learn_more' => 'Learn more',
            'dashboard' => 'Dashboard',
            'my_accounts' => 'My accounts',
            'transactions' => 'Transactions',
            'topup' => 'Top up',
            'cards' => 'Cards',
            'profile' => 'Profile',
            'settings' => 'Settings',
            'account_number' => 'Account number',
            'iban' => 'IBAN',
            'balance' => 'Balance',
            'currency' => 'Currency',
            'status' => 'Status',
            'amount' => 'Amount',
            'date' => 'Date',
            'type' => 'Type',
            'description' => 'Description',
            'reference' => 'Reference',
            'submit' => 'Submit',
            'cancel' => 'Cancel',
            'save' => 'Save',
            'delete' => 'Delete',
            'edit' => 'Edit',
            'view' => 'View',
            'close' => 'Close',
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'active' => 'Active',
            'blocked' => 'Blocked',
            'completed' => 'Completed',
            'all_rights_reserved' => 'All rights reserved',
            'terms' => 'Terms of Service',
            'privacy' => 'Privacy Policy',
            'legal' => 'Legal Notice',
        ];

        Language::create([
            'code' => 'en',
            'name' => 'English',
            'flag' => '🇬🇧',
            'is_active' => true,
            'is_default' => false,
            'translations' => $translations_en,
        ]);
    }
}
