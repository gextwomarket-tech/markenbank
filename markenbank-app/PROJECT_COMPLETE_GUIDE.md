# 🏦 MARKEN BANK - Guide Complet du Projet

## 📋 Vue d'ensemble

Marken Bank est une application bancaire web complète développée avec Laravel, Bootstrap 5, et JavaScript (CDN uniquement, sans NPM). L'application offre une expérience bancaire digitale moderne avec support multi-devises, recharges crypto/PayPal/IBAN, cartes virtuelles, et un système d'administration complet.

## ✅ Fonctionnalités Implémentées

### 🎨 Design & UX
- ✅ Mode Dark/Light avec toggle persistant
- ✅ Design moderne avec glassmorphism et effets frozen
- ✅ Animations fluides avec AOS.js et GSAP
- ✅ Images cartoon et design flat
- ✅ Responsive design complet
- ✅ Logo SVG personnalisé généré

### 🔐 Authentification
- ✅ Login client et admin séparés
- ✅ Register multi-step (5 étapes)
- ✅ Comptes démo intégrés
- ✅ KYC document upload

### 💼 Dashboard Client
- ✅ Vue d'ensemble avec statistiques
- ✅ Gestion multi-comptes et multi-devises
- ✅ IBAN généré par pays
- ✅ Historique des transactions
- ✅ Système de recharge (IBAN, PayPal, Crypto)
- ✅ Cartes virtuelles 3D
- ✅ Gestion du profil avec avatar upload
- ✅ Export CSV des transactions

### 👨‍💼 Dashboard Admin
- ✅ Statistiques avancées
- ✅ Gestion des utilisateurs
- ✅ Validation des recharges
- ✅ Validation des documents KYC
- ✅ Gestion des cartes virtuelles
- ✅ Configuration des méthodes de paiement
- ✅ Gestion des langues et traductions
- ✅ Logs d'activité utilisateur
- ✅ Audit complet

### 🌐 Internationalisation
- ✅ Système de traduction dynamique
- ✅ Français et Anglais par défaut
- ✅ Gestion des langues côté admin
- ✅ Traductions stockées en BDD

### 💳 Paiements
- ✅ Méthodes: IBAN, PayPal, Crypto (BTC, ETH, USDT)
- ✅ Frais configurables par méthode
- ✅ Limites min/max personnalisables
- ✅ Validation admin obligatoire

### 🔒 Sécurité
- ✅ Cryptage des données sensibles (numéros de carte)
- ✅ Rôles et permissions (admin, user, support, auditor)
- ✅ Audit logs complet
- ✅ Logs d'activité par utilisateur
- ✅ Validation côté serveur et client

## 📁 Structure du Projet

```
markenbank-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   └── RegisterController.php
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── UserController.php
│   │   │   │   ├── TopupController.php
│   │   │   │   ├── KycDocumentController.php
│   │   │   │   ├── LanguageController.php
│   │   │   │   └── SettingController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── TopupController.php
│   │   │   ├── TransactionController.php
│   │   │   ├── VirtualCardController.php
│   │   │   └── ProfileController.php
│   │   └── Middleware/
│   │       ├── LocaleMiddleware.php
│   │       ├── RoleMiddleware.php
│   │       └── LogUserActivity.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── BankAccount.php
│   │   ├── Transaction.php
│   │   ├── Topup.php
│   │   ├── VirtualCard.php
│   │   ├── KycDocument.php
│   │   ├── Setting.php
│   │   ├── AuditLog.php
│   │   ├── Language.php
│   │   ├── UserActivityLog.php
│   │   ├── PaymentMethod.php
│   │   └── CryptoAddress.php
│   ├── Services/
│   │   ├── TransactionService.php
│   │   ├── TopupService.php
│   │   ├── CardService.php
│   │   └── KycService.php
│   └── Helpers/
│       └── helpers.php (fonctions globales)
├── database/
│   ├── migrations/ (toutes les tables créées)
│   └── seeders/ (données de test complètes)
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── landing.blade.php
│   │   │   ├── auth.blade.php
│   │   │   ├── dashboard.blade.php
│   │   │   └── admin.blade.php
│   │   ├── landing/ (pages publiques)
│   │   ├── auth/ (authentification)
│   │   ├── dashboard/ (client)
│   │   └── admin/ (administration)
│   └── lang/ (fichiers de traduction JSON)
└── public/
    └── assets/
        ├── css/
        │   └── style.css (styling complet)
        ├── js/
        │   └── main.js (JavaScript principal)
        └── images/
            ├── logo.svg
            ├── logo-white.svg
            └── favicon.svg

## 🗄️ Schéma de Base de Données

### Tables Principales

1. **users** - Utilisateurs
   - Champs KYC complets
   - Rôles et vérification
   
2. **bank_accounts** - Comptes bancaires
   - Multi-devises
   - IBAN par pays
   - SWIFT/BIC

3. **transactions** - Transactions
   - Types: credit, debit, transfer, topup, fee
   - Référence unique
   - Metadata JSON

4. **topups** - Recharges
   - Méthodes: IBAN, PayPal, Crypto
   - Validation admin
   - Preuves uploadées

5. **virtual_cards** - Cartes virtuelles
   - Données cryptées
   - Versions masquées
   - Statuts multiples

6. **kyc_documents** - Documents KYC
   - Types multiples
   - Workflow de validation
   - Notes de révision

7. **languages** - Langues
   - Traductions JSON
   - Gestion active/défaut

8. **payment_methods** - Méthodes de paiement
   - Configuration par méthode
   - Frais et limites

9. **crypto_addresses** - Adresses crypto
   - Multi-devises
   - Réseaux différents

10. **user_activity_logs** - Logs d'activité
    - Tracking des pages visitées
    - IP et timestamps

11. **audit_logs** - Logs d'audit
    - Actions sensibles
    - Traçabilité complète

12. **settings** - Paramètres
    - Configuration globale
    - Groupes de settings

## 🚀 Installation et Configuration

### Prérequis
- PHP 8.2+
- MySQL 5.7+
- Composer
- Serveur web (Apache/Nginx)

### Étapes d'Installation

1. **Cloner et installer dépendances**
```bash
cd /workspace/markenbank-app
composer install
```

2. **Configuration environnement**
```bash
cp .env.example .env
php artisan key:generate
```

3. **Configurer .env**
```env
APP_NAME="Marken Bank"
APP_URL=http://localhost:8000
APP_LOCALE=fr

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=markenbank
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525

PAYPAL_CLIENT_ID=your_client_id
PAYPAL_SECRET=your_secret
PAYPAL_MODE=sandbox

QUEUE_CONNECTION=database
```

4. **Base de données**
```bash
php artisan migrate --seed
php artisan storage:link
```

5. **Créer les tables de queue**
```bash
php artisan queue:table
php artisan migrate
```

6. **Démarrer l'application**
```bash
php artisan serve
php artisan queue:work  # Dans un autre terminal
```

## 👥 Comptes de Démonstration

### Admin
- **Email**: admin@demo.com
- **Password**: password

### Clients
- **Email**: user@demo.com / **Password**: password (Compte USD - 1000$)
- **Email**: client@demo.com / **Password**: password (Compte XOF - 250,000 CFA)

## 🎨 Palette de Couleurs

### Premium Dark Mode (Défaut)
- Primary: #0066FF (Bleu électrique)
- Secondary: #6C2BD9 (Violet profond)
- Accent: #00D9FF (Cyan lumineux)
- Success: #00D1A0 (Vert émeraude)
- Warning: #FF8F3D (Orange ambre)
- Dark 1: #1A1D29 (Fond principal dark)
- Dark 2: #252A3A (Fond secondaire dark)

### Light Mode
- Backgrounds: Blanc (#FFFFFF) et gris clair (#F8F9FD)
- Texte: Gris foncé (#2D3748)

## 📝 Routes Principales

### Public
- `/` - Landing page
- `/login` - Connexion
- `/register` - Inscription (5 étapes)

### Client Dashboard
- `/dashboard` - Vue d'ensemble
- `/dashboard/accounts` - Mes comptes
- `/dashboard/transactions` - Transactions
- `/dashboard/topup` - Recharger
- `/dashboard/cards` - Mes cartes
- `/dashboard/profile` - Profil

### Admin Dashboard
- `/admin` - Dashboard admin
- `/admin/users` - Gestion utilisateurs
- `/admin/topups` - Validation recharges
- `/admin/kyc-documents` - Validation KYC
- `/admin/settings` - Configuration
- `/admin/languages` - Gestion langues

## 🔧 Personnalisation

### Ajouter une Langue

1. Créer dans l'interface admin (`/admin/languages`)
2. Ou via seeder:
```php
Language::create([
    'code' => 'es',
    'name' => 'Español',
    'flag' => '🇪🇸',
    'is_active' => true,
    'translations' => [
        'home' => 'Inicio',
        // ... autres traductions
    ]
]);
```

### Ajouter une Crypto

```php
CryptoAddress::create([
    'currency' => 'BNB',
    'address' => 'votre_adresse',
    'network' => 'BSC',
    'is_active' => true
]);
```

### Modifier les Frais

Via interface admin ou directement:
```php
$method = PaymentMethod::where('type', 'paypal')->first();
$method->update([
    'fees_percentage' => 3.0,
    'fees_fixed' => 0.5
]);
```

## 📦 Technologies Utilisées

### Backend
- Laravel 12
- MySQL
- Queue system (Database)

### Frontend (CDN uniquement)
- Bootstrap 5.3.2
- FontAwesome 6.5.1
- AOS.js 2.3.1 (Animations scroll)
- GSAP 3.12.5 (Animations complexes)
- Chart.js 4.4.1 (Graphiques)
- Swiper.js 11 (Carousels)
- Particles.js 2.0.0 (Effets particules)
- SweetAlert2 11 (Modals élégantes)
- Toastify.js (Notifications)
- CountUp.js 2.8.0 (Compteurs animés)

### Fonts
- Inter (Google Fonts)

## 🔐 Sécurité

- ✅ Cryptage des données sensibles (Crypt::encrypt)
- ✅ CSRF protection
- ✅ SQL injection protection (Eloquent ORM)
- ✅ XSS protection (Blade escaping)
- ✅ Password hashing (bcrypt)
- ✅ Rate limiting
- ✅ Audit logging
- ✅ Role-based access control

## 🐛 Debugging

```bash
# Logs Laravel
tail -f storage/logs/laravel.log

# Vider le cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Recréer la BDD
php artisan migrate:fresh --seed
```

## 📧 Support

Pour toute question ou problème:
- Email: support@markenbank.com (fictif)
- Documentation: Ce fichier

## 🚧 Développements Futurs

- [ ] API REST complète
- [ ] Application mobile (React Native/Flutter)
- [ ] Notifications push
- [ ] Authentification 2FA
- [ ] Intégration Stripe
- [ ] Exportgénération PDF des relevés
- [ ] Chat support en temps réel
- [ ] Blog dynamique
- [ ] Programme de parrainage
- [ ] Cashback et récompenses

## 📄 Licence

Projet éducatif - Tous droits réservés © 2025 Marken Bank

---

**Note**: Ce projet est une démonstration complète d'une application bancaire. Ne pas utiliser en production sans audit de sécurité complet et conformité réglementaire bancaire.
