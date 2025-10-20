# 🏦 Marken Bank - Application Bancaire en Ligne

**Marken Bank** est une application web bancaire moderne développée avec Laravel, Filament Admin, Bootstrap 5 et des animations JavaScript avancées. Elle offre une expérience utilisateur fluide et professionnelle pour la gestion de comptes bancaires multi-devises, recharges (IBAN, PayPal, Crypto), cartes virtuelles, et bien plus.

## 🎯 Fonctionnalités Principales

### Pour les Utilisateurs
- ✅ **Inscription & KYC** - Ouverture de compte avec vérification d'identité
- 💳 **Comptes Multi-Devises** - Support USD, EUR, XOF, GBP, CAD, etc.
- 💰 **Recharges Multiples** :
  - Virement IBAN
  - PayPal (Sandbox & Live)
  - Cryptomonnaies (BTC, ETH, USDT)
- 🎴 **Cartes Virtuelles** - Demande et gestion de cartes virtuelles
- 📊 **Dashboard Interactif** - Vue d'ensemble avec graphiques et statistiques
- 📜 **Historique des Transactions** - Filtrage et export CSV
- 👤 **Profil Utilisateur** - Modification des informations et avatar

### Pour les Administrateurs (Filament)
- 👥 **Gestion Utilisateurs** - CRUD complet avec filtres avancés
- 💵 **Validation des Recharges** - Approbation/rejet avec notes
- 🏦 **Gestion des Comptes** - Crédit/débit manuel, gel/dégel
- 🎴 **Gestion des Cartes** - Activation, gel, annulation
- ⚙️ **Configuration Système** :
  - Méthodes de paiement (activer/désactiver)
  - Frais et commissions
  - Limites de transaction
  - Adresses crypto
  - Clés API PayPal
- 📊 **Analytics & Rapports** - Statistiques et exports
- 🔍 **Audit Logs** - Traçabilité complète des actions

## 🎨 Design & UX

### Ligne Artistique
- **Palette Premium Dark Mode** :
  - Primaire : Bleu électrique (#0066FF)
  - Secondaire : Violet profond (#6C2BD9)
  - Accent : Cyan lumineux (#00D9FF)
  - Background : Gris ardoise (#1A1D29, #252A3A)
  - Success : Vert émeraude (#00D1A0)

- **Effets Visuels** :
  - Glassmorphism sur les cards
  - Gradients animés
  - Animations de particules (hero section)
  - Micro-interactions fluides
  - Mode sombre/clair avec toggle animé

## 🛠️ Stack Technique

### Backend
- **Laravel 11** - Framework PHP moderne
- **MySQL/MariaDB** - Base de données relationnelle
- **Filament 3** - Panel d'administration élégant
- **Laravel Sanctum** - Authentification API
- **Spatie Media Library** - Gestion des fichiers

### Frontend
- **Blade Templates** - Moteur de templates Laravel
- **Bootstrap 5** - Framework CSS responsive
- **Alpine.js** - JavaScript réactif léger
- **FontAwesome 6** - Icônes
- **GSAP** - Animations complexes
- **AOS** - Scroll animations
- **Chart.js** - Graphiques interactifs
- **Swiper.js** - Carousels
- **Particles.js** - Effets de particules

## 📦 Installation

### Prérequis
- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL/MariaDB
- Extensions PHP : intl, gd, curl, mbstring, xml, zip, sqlite3

### Étapes d'Installation

1. **Cloner le projet**
```bash
git clone <repository-url>
cd markenbank-app
```

2. **Installer les dépendances PHP**
```bash
composer install
```

3. **Installer les dépendances JavaScript**
```bash
npm install
```

4. **Configurer l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurer la base de données**
Éditez `.env` et configurez vos paramètres de base de données :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=markenbank
DB_USERNAME=root
DB_PASSWORD=
```

6. **Exécuter les migrations et seeders**
```bash
php artisan migrate --seed
```

7. **Créer le lien symbolique pour le storage**
```bash
php artisan storage:link
```

8. **Compiler les assets**
```bash
npm run build
# ou pour le développement :
npm run dev
```

9. **Démarrer le serveur**
```bash
php artisan serve
```

L'application sera accessible à `http://localhost:8000`

## 🔑 Comptes de Démonstration

Après avoir exécuté les seeders, vous aurez accès à :

### Administrateur
- **Email** : admin@markenbank.com
- **Mot de passe** : password123

### Utilisateurs de Test
- **User 1** : user1@example.com / password123
- **User 2** : user2@example.com / password123

## 🌐 Routes Principales

### Public
- `/` - Landing page
- `/login` - Connexion
- `/register` - Inscription

### Utilisateur (Auth requise)
- `/dashboard` - Dashboard principal
- `/dashboard/accounts` - Gestion des comptes
- `/dashboard/cards` - Cartes virtuelles
- `/dashboard/topup` - Recharges
- `/dashboard/transactions` - Historique
- `/dashboard/profile` - Profil

### Admin
- `/admin` - Panel Filament

## 📡 API Endpoints

### Authentification
```
POST /api/auth/register
POST /api/auth/login
GET /api/user (protected)
```

### Comptes
```
GET /api/accounts (protected)
POST /api/accounts (protected)
GET /api/accounts/{id}/transactions (protected)
```

### Recharges
```
POST /api/topups (protected)
POST /api/topups/{id}/confirm (admin)
```

### Cartes Virtuelles
```
POST /api/cards (protected)
GET /api/cards (protected)
```

## ⚙️ Configuration

### Variables d'Environnement Importantes

```env
# Application
APP_NAME="Marken Bank"
APP_ENV=local
APP_URL=http://localhost:8000

# Base de données
DB_CONNECTION=mysql
DB_DATABASE=markenbank

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525

# PayPal
PAYPAL_CLIENT_ID=your_client_id
PAYPAL_SECRET=your_secret
PAYPAL_MODE=sandbox

# Queues (recommandé : Redis)
QUEUE_CONNECTION=database
```

## 🔧 Commandes Artisan Utiles

```bash
# Créer un utilisateur admin Filament
php artisan make:filament-user

# Nettoyer le cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Lancer les queues (pour emails et notifications)
php artisan queue:work

# Optimiser l'application (production)
php artisan optimize
```

## 🚀 Déploiement en Production

1. **Configurer l'environnement**
```bash
APP_ENV=production
APP_DEBUG=false
```

2. **Optimiser l'application**
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

3. **Configurer les permissions**
```bash
chmod -R 755 storage bootstrap/cache
```

4. **Configurer les queues**
Utilisez Supervisor pour maintenir `php artisan queue:work` en exécution.

5. **SSL/HTTPS**
Assurez-vous d'avoir un certificat SSL configuré.

## 📚 Structure du Projet

```
markenbank-app/
├── app/
│   ├── Filament/          # Ressources Filament Admin
│   ├── Http/
│   │   ├── Controllers/   # Contrôleurs
│   │   └── Middleware/    # Middleware
│   └── Models/            # Modèles Eloquent
├── database/
│   ├── migrations/        # Migrations de base de données
│   └── seeders/           # Seeders (données de test)
├── public/                # Assets publics
├── resources/
│   ├── views/             # Templates Blade
│   ├── css/               # Styles CSS
│   └── js/                # JavaScript
└── routes/
    ├── web.php            # Routes web
    └── api.php            # Routes API
```

## 🔒 Sécurité

- ✅ Authentification Laravel Sanctum
- ✅ Validation côté serveur pour toutes les entrées
- ✅ Protection CSRF
- ✅ Rate limiting sur les API
- ✅ Hashage bcrypt des mots de passe
- ✅ Encryption des données sensibles
- ✅ Audit logs pour traçabilité
- ✅ 2FA optionnel (à implémenter)

## 📝 Base de Données

### Tables Principales
- `users` - Utilisateurs
- `bank_accounts` - Comptes bancaires
- `transactions` - Transactions
- `topups` - Recharges
- `virtual_cards` - Cartes virtuelles
- `kyc_documents` - Documents KYC
- `settings` - Configuration système
- `audit_logs` - Logs d'audit

## 🎯 Fonctionnalités à Venir

- [ ] Intégration 2FA (TOTP)
- [ ] Chat support en direct
- [ ] Application mobile (React Native)
- [ ] Virements SEPA réels
- [ ] Intégration PSD2
- [ ] Système de parrainage
- [ ] Programme de fidélité
- [ ] Notifications push

## 🐛 Bugs Connus & Limitations

- Les IBAN générés sont au format démo (non réels)
- Les cartes virtuelles sont simulées
- Les paiements crypto nécessitent confirmation manuelle admin
- Mode sandbox PayPal uniquement (par défaut)

## 📄 Licence

Ce projet est sous licence MIT.

## 👥 Contributeurs

- Développeur principal : [Votre Nom]
- Design : Génération Z, moderne et professionnel

## 📞 Support

Pour toute question ou support :
- Email : support@markenbank.com
- Documentation : [À venir]
- Issues : Utilisez GitHub Issues

---

**Marken Bank** - Votre banque digitale de confiance 🚀
