# 🚀 Marken Bank - Guide de Démarrage Rapide

## Installation en 5 Minutes ⚡

### 1. Cloner & Installer
```bash
cd markenbank-app
composer install
cp .env.example .env
php artisan key:generate
```

### 2. Base de Données
```bash
# Créer la DB
mysql -u root -p -e "CREATE DATABASE markenbank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Configurer .env
nano .env
# Modifier: DB_DATABASE=markenbank, DB_USERNAME, DB_PASSWORD

# Migrer & Seed
php artisan migrate --seed
php artisan storage:link
```

### 3. Lancer
```bash
php artisan serve
```

**C'est prêt!** → http://localhost:8000

## 🔑 Comptes de Test

### Admin
```
Email: admin@markenbank.com
Pass: password123
URL: /admin
```

### Client
```
Email: jean.dupont@example.com
Pass: password123
```

## 📱 Pages Principales

| Page | URL | Statut |
|------|-----|--------|
| **Accueil** | `/` | ✅ Complet |
| **Login** | `/login` | ✅ Complet |
| **Register** | `/register` | ✅ Complet |
| **Dashboard** | `/dashboard` | ✅ Complet |
| **Admin** | `/admin` | ⚠️ À finaliser |

## 🎨 Fonctionnalités Démo

### Ce qui fonctionne:
- ✅ Navigation complète
- ✅ Dark/Light mode
- ✅ Animations & effets
- ✅ Formulaire multi-étapes
- ✅ Dashboard avec stats
- ✅ Multi-langues (FR/EN)

### À compléter:
- ⚠️ Controllers backend
- ⚠️ Filament admin
- ⚠️ Logique métier
- ⚠️ Upload fichiers

## 🛠️ Commandes Utiles

```bash
# Reset DB
php artisan migrate:fresh --seed

# Cache clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Queue (si besoin)
php artisan queue:work

# Créer controller
php artisan make:controller MonController

# Créer model
php artisan make:model MonModel -m
```

## 🐛 Problèmes Courants

### Erreur "key not found"
```bash
php artisan key:generate
```

### Erreur permissions
```bash
chmod -R 775 storage bootstrap/cache
```

### Page blanche
```bash
composer dump-autoload
php artisan config:clear
```

## 📚 Documentation Complète

- **README.md** → Installation détaillée
- **PROJECT_SUMMARY.md** → État du projet
- **FEATURES.md** → Liste des fonctionnalités

## 🎯 Prochaines Étapes

1. Tester l'application
2. Créer les controllers manquants
3. Finaliser admin Filament
4. Implémenter logique métier
5. Tester & déployer

## 💡 Astuces

### Changer le thème
Cliquer sur le bouton 🌙/☀️ en haut à droite

### Ajouter une langue
1. Créer `resources/lang/xx.json`
2. Copier `fr.json` et traduire
3. Ajouter dans la table `languages`

### Modifier les couleurs
Éditer les variables CSS dans:
- `resources/views/layouts/app.blade.php`
- `resources/views/layouts/dashboard.blade.php`

```css
:root[data-theme="dark"] {
    --primary: #0066FF;     /* Bleu principal */
    --secondary: #6C2BD9;   /* Violet */
    --accent: #00D9FF;      /* Cyan */
}
```

## 🤝 Besoin d'Aide?

1. Consulter README.md
2. Vérifier PROJECT_SUMMARY.md
3. Regarder les exemples de code
4. Contacter support

---

**Happy Coding!** 🚀💙
