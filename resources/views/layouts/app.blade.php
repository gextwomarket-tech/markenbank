<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('app_name') . ' - ' . __('tagline'))</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <style>
        :root[data-theme="dark"] {
            /* Premium Dark Mode Colors */
            --primary: #0066FF;
            --secondary: #6C2BD9;
            --accent: #00D9FF;
            --success: #00D1A0;
            --warning: #FF8F3D;
            --danger: #FF4757;
            --bg-dark-1: #1A1D29;
            --bg-dark-2: #252A3A;
            --bg-dark-3: #2D3349;
            --text-primary: #FFFFFF;
            --text-secondary: #A0AEC0;
            --border-color: rgba(255, 255, 255, 0.1);
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }
        
        :root[data-theme="light"] {
            --primary: #0047AB;
            --secondary: #6C2BD9;
            --accent: #00B8D4;
            --success: #00A87E;
            --warning: #FF7720;
            --danger: #E63946;
            --bg-dark-1: #F8F9FD;
            --bg-dark-2: #FFFFFF;
            --bg-dark-3: #F0F2F7;
            --text-primary: #2D3748;
            --text-secondary: #718096;
            --border-color: rgba(0, 0, 0, 0.1);
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(0, 0, 0, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark-1);
            color: var(--text-primary);
            transition: background 0.3s ease, color 0.3s ease;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }
        
        .text-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Navbar Styles */
        .navbar {
            background: rgba(26, 29, 41, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }
        
        [data-theme="light"] .navbar {
            background: rgba(255, 255, 255, 0.8);
        }
        
        .navbar.scrolled {
            background: rgba(26, 29, 41, 0.95);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        
        [data-theme="light"] .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
        }
        
        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            transition: color 0.3s ease;
            padding: 0.5rem 1rem !important;
        }
        
        .nav-link:hover {
            color: var(--primary) !important;
        }
        
        /* Glass Morphism */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            padding: 2rem;
            transition: all 0.3s ease;
        }
        
        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0, 102, 255, 0.2);
            border-color: rgba(0, 102, 255, 0.3);
        }
        
        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            border: 1px solid var(--glass-border);
        }
        
        /* Buttons */
        .btn-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 40px rgba(0, 102, 255, 0.4);
            color: white;
        }
        
        .btn-gradient.glow {
            animation: glow 2s ease-in-out infinite;
        }
        
        @keyframes glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(0, 102, 255, 0.3);
            }
            50% {
                box-shadow: 0 0 40px rgba(0, 102, 255, 0.6);
            }
        }
        
        .btn-outline-primary {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }
        
        /* Theme Toggle */
        .theme-toggle {
            width: 60px;
            height: 30px;
            background: var(--bg-dark-3);
            border-radius: 50px;
            position: relative;
            cursor: pointer;
            border: 2px solid var(--border-color);
            transition: all 0.3s ease;
        }
        
        .theme-toggle::before {
            content: '🌙';
            position: absolute;
            width: 24px;
            height: 24px;
            background: var(--primary);
            border-radius: 50%;
            top: 1px;
            left: 2px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }
        
        [data-theme="light"] .theme-toggle::before {
            content: '☀️';
            left: 32px;
        }
        
        /* Hero Section */
        .hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, var(--bg-dark-1) 0%, var(--bg-dark-2) 100%);
        }
        
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
        }
        
        .hero .container {
            position: relative;
            z-index: 1;
        }
        
        /* Statistics */
        .stat-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            transition: all 0.3s ease;
        }
        
        .glass-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        /* Dropdown */
        .dropdown-menu {
            background: var(--bg-dark-2);
            border: 1px solid var(--border-color);
            border-radius: 15px;
            padding: 0.5rem;
            margin-top: 0.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }
        
        .dropdown-item {
            color: var(--text-primary);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover {
            background: var(--glass-bg);
            color: var(--primary);
        }
        
        /* Forms */
        .form-control, .form-select {
            background: var(--bg-dark-2);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            background: var(--bg-dark-2);
            border-color: var(--primary);
            color: var(--text-primary);
            box-shadow: 0 0 0 0.25rem rgba(0, 102, 255, 0.15);
        }
        
        .form-label {
            color: var(--text-secondary);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        /* Cards & Backgrounds */
        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        }
        
        .bg-gradient-accent {
            background: linear-gradient(135deg, var(--accent) 0%, var(--primary) 100%);
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--bg-dark-1);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary);
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .glass-card {
                padding: 1.5rem;
            }
            
            .btn-gradient, .btn-outline-primary {
                padding: 0.6rem 1.5rem;
                font-size: 0.9rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-landmark me-2"></i>
                <span class="text-gradient">{{ __('app_name') }}</span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('nav.home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}#features">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}#about">{{ __('nav.about') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('nav.login') }}</a>
                        </li>
                        <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                            <a class="btn btn-gradient btn-sm" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-2"></i>{{ __('nav.register') }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.index') }}">
                                <i class="fas fa-chart-line me-1"></i>{{ __('nav.dashboard') }}
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                @if(auth()->user()->avatar_path)
                                    <img src="{{ Storage::url(auth()->user()->avatar_path) }}" alt="Avatar" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                                @else
                                    <i class="fas fa-user-circle fa-lg me-2"></i>
                                @endif
                                <span>{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('dashboard.profile.edit') }}"><i class="fas fa-user me-2"></i>{{ __('profile.title') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('dashboard.accounts') }}"><i class="fas fa-wallet me-2"></i>{{ __('dashboard.accounts') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('dashboard.cards.index') }}"><i class="fas fa-credit-card me-2"></i>{{ __('dashboard.cards') }}</a></li>
                                <li><hr class="dropdown-divider" style="border-color: var(--border-color);"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>{{ __('auth.logout') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                    
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <div class="theme-toggle" onclick="toggleTheme()"></div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="container mt-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="container mt-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-5 mt-5" style="background: var(--bg-dark-2); border-top: 1px solid var(--border-color);">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="text-gradient mb-3">
                        <i class="fas fa-landmark me-2"></i>{{ __('app_name') }}
                    </h5>
                    <p class="text-muted">{{ __('tagline') }}. Sécurité, transparence et innovation au service de vos finances.</p>
                    <div class="mt-3">
                        <a href="#" class="text-muted me-3 fs-5"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-muted me-3 fs-5"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-muted me-3 fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-muted fs-5"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-4">
                    <h6 class="text-white mb-3">{{ __('footer.about') }}</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">{{ __('dashboard.accounts') }}</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">{{ __('dashboard.cards') }}</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">{{ __('dashboard.transactions') }}</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Épargne</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-4">
                    <h6 class="text-white mb-3">Entreprise</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">{{ __('nav.about') }}</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Carrières</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Presse</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">{{ __('nav.blog') }}</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-4">
                    <h6 class="text-white mb-3">{{ __('footer.support') }}</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Centre d'aide</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">{{ __('footer.faq') }}</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">{{ __('footer.contact_us') }}</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">{{ __('nav.security') }}</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-12">
                    <h6 class="text-white mb-3">{{ __('footer.legal') }}</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">{{ __('footer.terms') }}</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">{{ __('footer.privacy') }}</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">{{ __('footer.cookies') }}</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Mentions légales</a></li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-4" style="border-color: var(--border-color);">
            
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="text-muted mb-0">{{ __('footer.copyright') }}</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <button class="btn btn-sm btn-outline-primary" onclick="toggleTheme()">
                        <i class="fas fa-adjust me-2"></i>{{ __('footer.theme_toggle') }}
                    </button>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <!-- CountUp JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.6.2/countUp.umd.min.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
        
        // Theme Toggle
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        }
        
        // Load saved theme
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', savedTheme);
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Initialize Swiper
        if (document.querySelector('.swiper')) {
            new Swiper('.testimonials-swiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        }
        
        // CountUp Animation for Stats
        document.querySelectorAll('.stat-number').forEach(element => {
            const target = parseInt(element.getAttribute('data-target'));
            const countUp = new countUp.CountUp(element, target, {
                duration: 2.5,
                useEasing: true,
                useGrouping: true,
            });
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        countUp.start();
                        observer.unobserve(entry.target);
                    }
                });
            });
            
            observer.observe(element);
        });
    </script>
    
    @stack('scripts')
</body>
</html>
