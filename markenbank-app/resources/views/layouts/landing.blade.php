<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Marken Bank - Votre banque digitale de nouvelle génération')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/favicon.svg') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https="fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    
    <!-- Toastify -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="Marken Bank" height="40">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ __t('home', 'Accueil') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">{{ __t('services', 'Services') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">{{ __t('pricing', 'Tarifs') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#security">{{ __t('security', 'Sécurité') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">{{ __t('contact', 'Contact') }}</a>
                    </li>
                    
                    <li class="nav-item ms-3">
                        <button class="theme-toggle" title="Changer le thème">
                            <i class="fas fa-sun theme-icon-light"></i>
                            <i class="fas fa-moon theme-icon-dark" style="display: none;"></i>
                        </button>
                    </li>
                    
                    @auth
                        <li class="nav-item ms-2">
                            <a href="{{ route('dashboard.index') }}" class="btn btn-outline">
                                <i class="fas fa-th-large"></i> {{ __t('dashboard', 'Dashboard') }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item ms-2">
                            <a href="{{ route('login') }}" class="btn btn-outline me-2">{{ __t('login', 'Connexion') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-primary">{{ __t('open_account', 'Ouvrir un compte') }}</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="padding-top: 80px;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-5" style="position: relative; overflow: hidden;">
        <!-- Wave SVG -->
        <svg style="position: absolute; top: 0; left: 0; width: 100%;" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 0L60 10C120 20 240 40 360 46.7C480 53 600 47 720 43.3C840 40 960 40 1080 46.7C1200 53 1320 67 1380 73.3L1440 80V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V0Z" fill="currentColor"/>
        </svg>
        
        <div class="container" style="position: relative; z-index: 1; margin-top: 60px;">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <img src="{{ asset('assets/images/logo-white.svg') }}" alt="Marken Bank" height="40" class="mb-3">
                    <p class="text-light">Votre banque digitale de confiance. Sécurité, simplicité et innovation au service de vos finances.</p>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-md-2 mb-4">
                    <h5 class="mb-3">Services</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Comptes multi-devises</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Cartes virtuelles</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Crypto trading</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Transferts rapides</a></li>
                    </ul>
                </div>
                
                <div class="col-md-2 mb-4">
                    <h5 class="mb-3">Support</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">FAQ</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Contact</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Blog</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Centre d'aide</a></li>
                    </ul>
                </div>
                
                <div class="col-md-2 mb-4">
                    <h5 class="mb-3">Légal</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">CGU</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Confidentialité</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Mentions légales</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Cookies</a></li>
                    </ul>
                </div>
                
                <div class="col-md-2 mb-4">
                    <h5 class="mb-3">Thème</h5>
                    <button class="theme-toggle btn btn-outline-light w-100">
                        <i class="fas fa-sun theme-icon-light"></i>
                        <i class="fas fa-moon theme-icon-dark" style="display: none;"></i>
                        <span class="ms-2">Changer</span>
                    </button>
                </div>
            </div>
            
            <hr class="my-4 bg-light">
            
            <div class="text-center text-light">
                <p class="mb-0">&copy; {{ date('Y') }} Marken Bank. {{ __t('all_rights_reserved', 'Tous droits réservés') }}.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    
    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    
    <!-- Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <!-- CountUp.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.8.0/countUp.umd.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Toastify -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
