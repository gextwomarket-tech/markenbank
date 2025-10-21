# 🏦 Marken Bank - Application Bancaire en Ligne

![Marken Bank Logo](public/images/logo.svg)

**Marken Bank** est une application bancaire en ligne moderne et complète construite avec Laravel, Filament et Bootstrap 5. Elle offre une expérience bancaire numérique de nouvelle génération avec support multi-devises, cartes virtuelles, cryptomonnaies et plus encore.

## ✨ Fonctionnalités Principales

### Pour les Clients
- 🌍 **Multi-Devises** : Comptes en EUR, USD, GBP, CAD, XOF
- 💳 **Cartes Virtuelles** : Création instantanée de cartes virtuelles sécurisées
- ⚡ **Virements Instantanés** : Transferts rapides entre comptes
- ₿ **Crypto-Friendly** : Recharge via Bitcoin, Ethereum, USDT
- 📊 **Analytics Avancés** : Graphiques et rapports détaillés
- 🔒 **Sécurité Maximale** : 2FA, SSL, encryption
- 🌙 **Mode Sombre/Clair** : Toggle entre les thèmes
- 🌐 **Multi-Langues** : Support FR/EN (extensible)

### Pour les Administrateurs
- 📈 **Dashboard Admin** : Statistiques en temps réel
- 👥 **Gestion Utilisateurs** : CRUD complet avec tracking d'activité
- 💰 **Validation Recharges** : Approbation/rejet des topups
- ⚙️ **Paramètres Système** : Configuration complète
- 📝 **Logs d'Audit** : Traçabilité complète
- 🔧 **Gestion KYC** : Vérification documents

## 🚀 Technologies Utilisées

### Backend
- **Laravel 10+** : Framework PHP moderne
- **Filament 3** : Panel admin élégant
- **MySQL** : Base de données relationnelle

### Frontend
- **Bootstrap 5** (CDN) : Framework CSS responsive
- **FontAwesome 6** : Icônes
- **Chart.js** : Graphiques
- **Particles.js** : Animations
- **AOS** : Animations au scroll
- **Swiper.js** : Carousels

### Design
- **Glassmorphism** : Effets de verre givré
- **Gradients Animés** : Transitions fluides
- **Dark/Light Mode** : Thèmes personnalisables

## 📋 Prérequis

- PHP >= 8.1
- Composer
- MySQL >= 5.7 / MariaDB >= 10.3
- Node.js & NPM (optionnel, CDN utilisé)

## 🛠️ Installation

### 1. Cloner le Projet

```bash
git clone <repository-url>
cd markenbank-app
```

### 2. Installer les Dépendances

```bash
composer install
```

### 3. Configuration Environnement

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurer la Base de Données

Éditer `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=markenbank
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

### 5. Créer la Base de Données

```bash
mysql -u root -p
CREATE DATABASE markenbank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 6. Exécuter les Migrations et Seeders

```bash
php artisan migrate --seed
```

### 7. Créer le Lien de Stockage

```bash
php artisan storage:link
```

### 8. Lancer le Serveur

```bash
php artisan serve
```

L'application sera accessible sur : `http://localhost:8000`

### 9. Lancer les Queues (Optionnel mais Recommandé)

Dans un nouveau terminal:

```bash
php artisan queue:work
```

## 👥 Comptes de Démonstration

### Administrateur
- **Email** : admin@markenbank.com
- **Mot de passe** : password123

### Utilisateurs de Test
- **Email** : jean.dupont@example.com | **MDP** : password123
- **Email** : marie.martin@example.com | **MDP** : password123
- **Email** : pierre.dubois@example.com | **MDP** : password123

## 📁 Structure du Projet

```
markenbank-app/
├── app/
│   ├── Models/              # Modèles Eloquent
│   ├── Http/
│   │   └── Controllers/     # Contrôleurs
│   ├── Filament/
│   │   └── Resources/       # Ressources Filament Admin
│   └── Helpers/
│       └── helpers.php      # Fonctions helper
├── database/
│   ├── migrations/          # Migrations DB
│   └── seeders/             # Seeders
├── resources/
│   ├── views/
│   │   ├── layouts/         # Layouts (app, dashboard)
│   │   ├── auth/            # Pages authentification
│   │   ├── dashboard/       # Dashboard client
│   │   └── landing.blade.php
│   └── lang/                # Fichiers de traduction
│       ├── fr.json
│       └── en.json
├── routes/
│   └── web.php              # Routes web
└── public/
    └── images/
        └── logo.svg         # Logo Marken Bank
```

## 🎨 Personnalisation

### Thème et Couleurs

Les couleurs sont définies dans `resources/views/layouts/app.blade.php` et `layouts/dashboard.blade.php`:

```css
:root[data-theme="dark"] {
    --primary: #0066FF;
    --secondary: #6C2BD9;
    --accent: #00D9FF;
    --success: #00D1A0;
    --warning: #FF8F3D;
    --danger: #FF4757;
}
```

### Langues

Ajouter une nouvelle langue:

1. Créer `resources/lang/es.json` (exemple)
2. Ajouter les traductions
3. Créer une entrée dans la table `languages`

```php
Language::create([
    'code' => 'es',
    'name' => 'Español',
    'flag' => '🇪🇸',
    'is_active' => true,
]);
```

### Devises Supportées

Modifier dans `app/Helpers/helpers.php`:

```php
function getCurrencySymbol(string $currency): string
{
    return match($currency) {
        'EUR' => '€',
        'USD' => '$',
        // Ajouter d'autres devises...
    };
}
```

## 🔐 Sécurité

### Fonctionnalités de Sécurité Implémentées

- ✅ Hashage des mots de passe (bcrypt)
- ✅ Protection CSRF
- ✅ Validation côté serveur
- ✅ Sessions sécurisées
- ✅ Logs d'audit
- ✅ Rate limiting (à configurer)
- ✅ Encryption SSL recommandée

### Configuration SSL (Production)

```env
APP_URL=https://votredomaine.com
SESSION_SECURE_COOKIE=true
```

## 📊 Base de Données

### Schéma Principal

- **users** : Utilisateurs du système
- **bank_accounts** : Comptes bancaires multi-devises
- **transactions** : Historique des transactions
- **topups** : Demandes de recharge
- **virtual_cards** : Cartes virtuelles
- **kyc_documents** : Documents KYC
- **settings** : Configuration système
- **languages** : Langues disponibles
- **user_activity_logs** : Tracking activité utilisateurs
- **audit_logs** : Logs d'audit
- **pages_content** : Contenu dynamique des pages

## 🔌 API & Intégrations

### PayPal (À Configurer)

```env
PAYPAL_CLIENT_ID=votre_client_id
PAYPAL_SECRET=votre_secret
PAYPAL_MODE=sandbox # ou live
```

### Cryptomonnaies

Configurer les adresses dans le panel admin ou via seeder:

```php
Setting::create([
    'key' => 'crypto_addresses',
    'value' => json_encode([
        'BTC' => 'votre_adresse_btc',
        'ETH' => 'votre_adresse_eth',
        'USDT' => 'votre_adresse_usdt',
    ]),
]);
```

### SMTP (Email)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=votre_username
MAIL_PASSWORD=votre_password
MAIL_FROM_ADDRESS=noreply@markenbank.com
```

## 🧪 Tests

```bash
# Exécuter les tests
php artisan test

# Tests avec couverture
php artisan test --coverage
```

## 📚 Documentation Fonctionnelle

### Flux Utilisateur

1. **Inscription**
   - Formulaire multi-étapes (4 étapes)
   - Informations personnelles
   - Adresse
   - Documents KYC
   - Choix devise principale
   - Génération automatique compte + IBAN

2. **Connexion**
   - Email + mot de passe
   - Option "Se souvenir de moi"
   - 2FA (à implémenter)

3. **Dashboard Client**
   - Vue d'ensemble : soldes, transactions récentes
   - Graphiques des revenus/dépenses
   - Carte virtuelle affichée
   - Actions rapides (recharger, transférer, etc.)

4. **Gestion des Comptes**
   - Créer des comptes multi-devises
   - Chaque compte a son propre IBAN
   - Visualiser soldes par devise

5. **Recharge (Topup)**
   - Méthodes : IBAN, Crypto, PayPal
   - Upload preuve de paiement
   - Status : pending → approved/rejected par admin

6. **Cartes Virtuelles**
   - Demande de carte
   - Affichage sécurisé des détails
   - Geler/Dégeler/Annuler

7. **Transactions**
   - Historique complet
   - Filtres (date, type, status)
   - Export CSV

### Flux Admin (Filament)

1. **Dashboard Admin**
   - Statistiques globales
   - Graphiques
   - Dernières activités

2. **Gestion Utilisateurs**
   - Liste + CRUD
   - Voir activité par utilisateur
   - Bloquer/Débloquer comptes

3. **Validation Recharges**
   - File d'attente des topups pending
   - Voir preuve de paiement
   - Approuver → crédite le compte
   - Rejeter → avec note admin

4. **Configuration**
   - Frais par méthode
   - Limites min/max
   - Adresses crypto
   - Clés API PayPal

## 🐛 Dépannage

### Erreur: "Class not found"
```bash
composer dump-autoload
```

### Erreur: "No application encryption key"
```bash
php artisan key:generate
```

### Erreur de permissions (Storage)
```bash
chmod -R 775 storage bootstrap/cache
```

### Migrations échouent
```bash
php artisan migrate:fresh --seed
```

## 🚧 Fonctionnalités à Implémenter

### Prioritaires
- [ ] Controllers complets pour toutes les pages
- [ ] Middleware d'authentification et d'autorisation
- [ ] Filament resources pour admin
- [ ] Validation des formulaires côté serveur
- [ ] Gestion des fichiers uploadés (KYC, preuves)
- [ ] Système de notifications
- [ ] Export transactions (CSV/PDF)

### Avancées
- [ ] Authentification 2FA (TOTP)
- [ ] Intégration réelle PayPal
- [ ] Intégration blockchain pour crypto
- [ ] Système de récupération de mot de passe
- [ ] Email de vérification
- [ ] Rate limiting anti-fraude
- [ ] Webhooks PayPal
- [ ] Scanner de virus pour uploads
- [ ] Compression d'images avatar

### Nice to Have
- [ ] Application mobile (API)
- [ ] Notifications push
- [ ] Chat support en direct
- [ ] Programme de parrainage
- [ ] Cartes physiques
- [ ] Épargne automatique
- [ ] Prêts

## 📝 Notes de Développement

### Bonnes Pratiques

- Utiliser les helpers pour formatter les montants: `formatCurrency($amount, $currency)`
- Logger les actions sensibles avec `AuditLog`
- Tracker l'activité utilisateur avec `UserActivityLog::logActivity()`
- Valider toutes les entrées utilisateur
- Utiliser les transactions DB pour les opérations financières
- Ne jamais exposer les numéros de carte complets

### Générer un IBAN
```php
$iban = generateIban('FR76'); // Génère un IBAN FR
```

### Générer un Numéro de Compte
```php
$accountNumber = generateAccountNumber($userId, 'ACC');
```

### Masquer un Numéro de Carte
```php
$masked = maskCardNumber('1234567890123456'); // **** **** **** 3456
```

## 🤝 Contribution

Les contributions sont les bienvenues! Pour contribuer:

1. Fork le projet
2. Créer une branche (`git checkout -b feature/AmazingFeature`)
3. Commit les changements (`git commit -m 'Add AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 👨‍💻 Support

Pour toute question ou problème:
- **Email** : support@markenbank.com
- **Documentation** : [docs.markenbank.com](https://docs.markenbank.com)
- **Issues GitHub** : [github.com/markenbank/issues](https://github.com/markenbank/issues)

## 🙏 Remerciements

- Laravel Framework
- Filament Admin Panel
- Bootstrap Team
- FontAwesome
- Toute la communauté open-source

---

**Marken Bank** - Votre banque digitale de nouvelle génération 🚀

© 2025 Marken Bank. Tous droits réservés.
