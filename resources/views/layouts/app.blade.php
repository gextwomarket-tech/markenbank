<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Marken Bank - Votre banque digitale de confiance')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-university me-2"></i>
                <span class="text-gradient">Marken Bank</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Fonctionnalités</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">À propos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-gradient btn-sm" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-2"></i>Ouvrir un compte
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.index') }}">
                                <i class="fas fa-chart-line me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                @if(auth()->user()->avatar_path)
                                    <img src="{{ Storage::url(auth()->user()->avatar_path) }}" alt="Avatar" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                                @else
                                    <i class="fas fa-user-circle fa-lg"></i>
                                @endif
                                <span class="ms-2">{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('dashboard.profile.edit') }}"><i class="fas fa-user me-2"></i>Profil</a></li>
                                <li><a class="dropdown-item" href="{{ route('dashboard.accounts') }}"><i class="fas fa-wallet me-2"></i>Comptes</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                    
                    <li class="nav-item ms-3">
                        <div class="theme-toggle"></div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-5 mt-5" style="background: var(--bg-dark-2); border-top: 1px solid var(--border-color);">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="text-gradient mb-3">
                        <i class="fas fa-university me-2"></i>Marken Bank
                    </h5>
                    <p class="text-muted">Votre banque digitale de nouvelle génération. Sécurité, transparence et innovation au service de vos finances.</p>
                    <div class="mt-3">
                        <a href="#" class="text-muted me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-muted me-3"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-muted me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-linkedin fa-lg"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-4">
                    <h6 class="text-white mb-3">Produits</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Comptes</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Cartes</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Virements</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Épargne</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-4">
                    <h6 class="text-white mb-3">Entreprise</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">À propos</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Carrières</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Presse</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Blog</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-4">
                    <h6 class="text-white mb-3">Support</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Centre d'aide</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">FAQ</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Contact</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Sécurité</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-12">
                    <h6 class="text-white mb-3">Légal</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">CGU</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Confidentialité</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Cookies</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Mentions légales</a></li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-4" style="border-color: var(--border-color);">
            
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="text-muted mb-0">&copy; {{ date('Y') }} Marken Bank. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="text-muted mb-0">
                        <i class="fas fa-shield-alt me-2"></i>
                        Sécurisé par SSL & 2FA
                    </p>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
