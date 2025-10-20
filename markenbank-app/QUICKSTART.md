# 🚀 Guide de Démarrage Rapide - Marken Bank

## Installation Rapide (5 minutes)

### 1. Cloner et Installer

```bash
# Cloner le projet
git clone https://github.com/gextwomarket-tech/markenbank.git
cd markenbank/markenbank-app

# Installer les dépendances
composer install
npm install

# Configuration
cp .env.example .env
php artisan key:generate
```

### 2. Configurer la Base de Données

Éditez `.env` :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=markenbank
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

Créez la base de données :
```sql
CREATE DATABASE markenbank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 3. Migrer et Peupler

```bash
php artisan migrate --seed
php artisan storage:link
```

### 4. Compiler les Assets

```bash
npm run build
# ou en mode dev :
npm run dev
```

### 5. Démarrer le Serveur

```bash
php artisan serve
```

Ouvrez http://localhost:8000

## 🔑 Comptes de Test

### Administrateur
- **Email** : admin@markenbank.com
- **Mot de passe** : password123
- **Panel Admin** : http://localhost:8000/admin

### Utilisateurs
- **User 1** : user1@example.com / password123 (1000 USD, 500 EUR)
- **User 2** : user2@example.com / password123 (250000 XOF)

## 📊 Ce qui est Disponible Maintenant

### ✅ Backend Complet
- 8 migrations de base de données
- 8 modèles Eloquent avec relations
- Seeders avec données de démo
- Panel admin Filament (5 ressources)

### ✅ Données de Démo
- 1 admin + 2 utilisateurs
- 3 comptes bancaires (multi-devises)
- 2 transactions exemple
- 2 demandes de recharge
- 2 cartes virtuelles

### ✅ Panel Admin Filament
Accessible à `/admin` :
- Gestion utilisateurs
- Gestion comptes bancaires
- Validation recharges
- Gestion cartes virtuelles
- Historique transactions

## 🎯 Prochaines Étapes

### Pour Tester l'Existant
1. Connectez-vous au panel admin (`/admin`)
2. Explorez les ressources (Users, Bank Accounts, Topups, etc.)
3. Testez l'approbation d'une recharge en attente
4. Créez un nouveau compte bancaire pour un utilisateur

### Pour Continuer le Développement

#### Frontend (Priorité 1)
```bash
# Installer Bootstrap & dépendances
npm install bootstrap @popperjs/core
npm install @fortawesome/fontawesome-free
npm install gsap aos chart.js swiper particles.js

# Créer les vues
php artisan make:view layouts.app
php artisan make:view landing
php artisan make:view auth.login
php artisan make:view auth.register
php artisan make:view dashboard.index
```

#### Routes Web (Priorité 1)
Éditez `routes/web.php` pour ajouter :
- Route landing page (/)
- Routes auth (login, register, logout)
- Routes dashboard (protégées par auth)
- Routes topup, cards, transactions, profile

#### API REST (Priorité 2)
```bash
# Publier Sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate

# Éditez routes/api.php pour ajouter les endpoints
```

#### Intégrations (Priorité 3)
- Configurer PayPal SDK
- Ajouter logique crypto
- Implémenter webhooks

## 🛠️ Commandes Utiles

```bash
# Nettoyer le cache
php artisan optimize:clear

# Recréer la base de données
php artisan migrate:fresh --seed

# Créer un utilisateur admin Filament
php artisan make:filament-user

# Lancer les queues (pour emails)
php artisan queue:work

# Générer une resource Filament
php artisan make:filament-resource NomDuModel

# Créer un contrôleur
php artisan make:controller NomController

# Créer un modèle avec migration
php artisan make:model NomModel -m
```

## 📁 Structure du Projet

```
markenbank-app/
├── app/
│   ├── Filament/          ✅ Ressources admin
│   ├── Http/Controllers/  ✅ Contrôleurs (à compléter)
│   └── Models/            ✅ Modèles Eloquent
├── database/
│   ├── migrations/        ✅ 8 migrations
│   └── seeders/           ✅ Seeders complets
├── resources/
│   ├── views/             ⏳ À créer
│   ├── css/               ⏳ À compléter
│   └── js/                ⏳ À compléter
├── routes/
│   ├── web.php            ⏳ À compléter
│   └── api.php            ⏳ À créer
├── .env.example           ✅ Configuré
├── README.md              ✅ Documentation complète
├── PROGRESS.md            ✅ Suivi progression
└── QUICKSTART.md          ✅ Ce fichier
```

## 🐛 Dépannage

### Erreur de connexion à la base de données
```bash
# Vérifiez MySQL/MariaDB
sudo systemctl status mysql

# Vérifiez les credentials dans .env
```

### Erreur de permission storage
```bash
chmod -R 775 storage bootstrap/cache
```

### Erreur npm
```bash
rm -rf node_modules package-lock.json
npm install
```

### Erreur composer
```bash
composer clear-cache
composer install
```

## 📚 Ressources

- [Documentation Laravel](https://laravel.com/docs/11.x)
- [Documentation Filament](https://filamentphp.com/docs/3.x)
- [Bootstrap 5 Docs](https://getbootstrap.com/docs/5.3/)
- [GSAP Docs](https://greensock.com/docs/)
- [Chart.js Docs](https://www.chartjs.org/docs/)

## 💬 Support

Pour toute question :
- GitHub Issues : https://github.com/gextwomarket-tech/markenbank/issues
- Email : support@markenbank.com (à configurer)

---

**Bonne chance avec votre développement ! 🚀**
