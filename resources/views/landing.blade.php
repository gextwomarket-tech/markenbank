@extends('layouts.app')

@section('title', __('app_name') . ' - ' . __('tagline'))

@push('styles')
<style>
.hero {
    background: linear-gradient(135deg, #1A1D29 0%, #252A3A 100%);
    position: relative;
    overflow: hidden;
}

#particles-js {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
}

.floating-card {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.mobile-app-mockup {
    position: relative;
    max-width: 300px;
    margin: 0 auto;
}

.mockup-phone {
    position: relative;
    width: 100%;
    border-radius: 40px;
    overflow: hidden;
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5);
}

.gradient-blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.3;
    animation: blob 7s ease-in-out infinite;
}

@keyframes blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
}

.feature-icon-large {
    width: 100px;
    height: 100px;
    margin: 0 auto;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    border-radius: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: white;
    transition: all 0.4s ease;
}

.glass-card:hover .feature-icon-large {
    transform: scale(1.1) rotate(10deg);
}

.pricing-card {
    transition: all 0.3s ease;
}

.pricing-card:hover {
    transform: translateY(-10px);
}

.security-badge {
    background: var(--glass-bg);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    padding: 0.5rem 1.5rem;
    border: 1px solid var(--glass-border);
    display: inline-block;
    margin: 0.5rem;
}
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div id="particles-js"></div>
    <div class="container position-relative">
        <div class="row align-items-center min-vh-100 py-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="mb-4">
                    <span class="security-badge">
                        <i class="fas fa-shield-alt text-success me-2"></i>100% Sécurisé & Régulé
                    </span>
                </div>
                
                <h1 class="hero-title display-3 fw-bold mb-4">
                    {!! __('hero.title') !!}
                </h1>
                <p class="lead text-muted mb-4">
                    {{ __('hero.subtitle') }}
                </p>
                <div class="d-flex flex-wrap gap-3 mb-5">
                    <a href="{{ route('register') }}" class="btn btn-gradient btn-lg glow">
                        <i class="fas fa-rocket me-2"></i>{{ __('hero.cta_primary') }}
                    </a>
                    <a href="#features" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-play-circle me-2"></i>{{ __('hero.cta_secondary') }}
                    </a>
                </div>
                
                <div class="row g-4">
                    <div class="col-4">
                        <div class="text-center">
                            <h3 class="text-gradient mb-0 stat-number" data-target="50000">0</h3>
                            <small class="text-muted">{{ __('hero.stats.users') }}</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="text-center">
                            <h3 class="text-gradient mb-0 stat-number" data-target="150">0</h3>
                            <small class="text-muted">{{ __('hero.stats.countries') }}</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="text-center">
                            <h3 class="text-gradient mb-0 stat-number" data-target="99">0</h3>
                            <small class="text-muted">{{ __('hero.stats.satisfaction') }}</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative">
                    <!-- Gradient Blobs -->
                    <div class="gradient-blob" style="width: 300px; height: 300px; background: var(--primary); top: -50px; right: -50px;"></div>
                    <div class="gradient-blob" style="width: 200px; height: 200px; background: var(--secondary); bottom: -30px; left: -30px; animation-delay: 2s;"></div>
                    
                    <div class="glass-card p-4 position-relative">
                        <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?w=600&h=400&fit=crop" 
                             alt="Banking Dashboard" 
                             class="img-fluid rounded-3">
                    </div>
                    
                    <!-- Floating Card Elements -->
                    <div class="position-absolute top-0 end-0 glass p-3 m-3 floating-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="d-flex align-items-center">
                            <div class="bg-gradient-primary rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Transaction réussie</small>
                                <strong class="text-success">+1,250.00 €</strong>
                            </div>
                        </div>
                    </div>
                    
                    <div class="position-absolute bottom-0 start-0 glass p-3 m-3 floating-card" data-aos="fade-up" data-aos-delay="400" style="animation-delay: 1.5s;">
                        <div class="d-flex align-items-center">
                            <div class="bg-gradient-accent rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-shield-alt text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Sécurité</small>
                                <strong class="text-primary">100% Sécurisé</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5 my-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-4 fw-bold mb-3">{!! __('features.title') !!}</h2>
            <p class="lead text-muted">{{ __('features.subtitle') }}</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="glass-card text-center h-100">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                    <h4 class="mb-3">{{ __('features.multi_currency.title') }}</h4>
                    <p class="text-muted">
                        {{ __('features.multi_currency.description') }}
                    </p>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="glass-card text-center h-100">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h4 class="mb-3">{{ __('features.virtual_cards.title') }}</h4>
                    <p class="text-muted">
                        {{ __('features.virtual_cards.description') }}
                    </p>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="glass-card text-center h-100">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h4 class="mb-3">{{ __('features.instant_transfers.title') }}</h4>
                    <p class="text-muted">
                        {{ __('features.instant_transfers.description') }}
                    </p>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="glass-card text-center h-100">
                    <div class="stat-icon mb-3">
                        <i class="fab fa-bitcoin"></i>
                    </div>
                    <h4 class="mb-3">{{ __('features.crypto_friendly.title') }}</h4>
                    <p class="text-muted">
                        {{ __('features.crypto_friendly.description') }}
                    </p>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                <div class="glass-card text-center h-100">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="mb-3">{{ __('features.security.title') }}</h4>
                    <p class="text-muted">
                        {{ __('features.security.description') }}
                    </p>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                <div class="glass-card text-center h-100">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4 class="mb-3">{{ __('features.analytics.title') }}</h4>
                    <p class="text-muted">
                        {{ __('features.analytics.description') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mobile App Section -->
<section class="py-5 my-5" style="background: var(--bg-dark-2);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <div class="mobile-app-mockup">
                    <div class="mockup-phone">
                        <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=300&h=600&fit=crop" 
                             alt="Marken Bank Mobile App" 
                             class="w-100">
                    </div>
                    
                    <!-- Floating App Features -->
                    <div class="position-absolute top-0 end-0 glass p-2" style="width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center; animation: float 2s ease-in-out infinite;">
                        <i class="fas fa-fingerprint fa-2x text-gradient"></i>
                    </div>
                    
                    <div class="position-absolute bottom-0 start-0 glass p-2" style="width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center; animation: float 2.5s ease-in-out infinite;">
                        <i class="fas fa-bell fa-2x" style="color: var(--warning);"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="display-4 fw-bold mb-4">
                    Gérez vos finances <span class="text-gradient">partout</span>, tout le temps
                </h2>
                <p class="lead text-muted mb-4">
                    L'application mobile Marken Bank vous offre un contrôle total sur vos finances, directement depuis votre smartphone.
                </p>
                
                <div class="row g-4 mb-4">
                    <div class="col-6">
                        <div class="d-flex align-items-start">
                            <div class="bg-gradient-primary rounded p-2 me-3">
                                <i class="fas fa-mobile-alt text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Interface intuitive</h6>
                                <small class="text-muted">Design moderne et facile à utiliser</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="d-flex align-items-start">
                            <div class="bg-gradient-primary rounded p-2 me-3">
                                <i class="fas fa-fingerprint text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Biométrie</h6>
                                <small class="text-muted">Touch ID & Face ID</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="d-flex align-items-start">
                            <div class="bg-gradient-primary rounded p-2 me-3">
                                <i class="fas fa-bell text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Notifications</h6>
                                <small class="text-muted">Alertes en temps réel</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="d-flex align-items-start">
                            <div class="bg-gradient-primary rounded p-2 me-3">
                                <i class="fas fa-qrcode text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Paiement QR</h6>
                                <small class="text-muted">Payez en scannant</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex flex-wrap gap-3">
                    <a href="#" class="btn btn-dark btn-lg">
                        <i class="fab fa-apple me-2"></i>App Store
                    </a>
                    <a href="#" class="btn btn-dark btn-lg">
                        <i class="fab fa-google-play me-2"></i>Google Play
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="py-5 my-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-4 fw-bold mb-3">Comment ça marche ?</h2>
            <p class="lead text-muted">Ouvrez votre compte en 3 étapes simples</p>
        </div>
        
        <div class="row g-5">
            <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="mb-4">
                    <div class="bg-gradient-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                         style="width: 80px; height: 80px;">
                        <h2 class="text-white mb-0">1</h2>
                    </div>
                </div>
                <h4 class="mb-3">Inscription</h4>
                <p class="text-muted">Créez votre compte en 2 minutes avec juste votre email et quelques informations basiques.</p>
            </div>
            
            <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="mb-4">
                    <div class="bg-gradient-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                         style="width: 80px; height: 80px;">
                        <h2 class="text-white mb-0">2</h2>
                    </div>
                </div>
                <h4 class="mb-3">Vérification</h4>
                <p class="text-muted">Vérifiez votre identité rapidement et sécurisez votre compte avec la 2FA.</p>
            </div>
            
            <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="mb-4">
                    <div class="bg-gradient-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                         style="width: 80px; height: 80px;">
                        <h2 class="text-white mb-0">3</h2>
                    </div>
                </div>
                <h4 class="mb-3">C'est parti !</h4>
                <p class="text-muted">Rechargez votre compte et commencez à profiter de tous nos services.</p>
            </div>
        </div>
    </div>
</section>

<!-- Security Section -->
<section id="security" class="py-5 my-5" style="background: var(--bg-dark-2);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <h2 class="display-4 fw-bold mb-4">
                    Votre <span class="text-gradient">sécurité</span> est notre priorité
                </h2>
                <p class="lead text-muted mb-4">
                    Nous utilisons les technologies de sécurité les plus avancées pour protéger vos fonds et vos données personnelles.
                </p>
                
                <div class="mb-4">
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-success rounded p-2 me-3">
                            <i class="fas fa-lock text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Encryption SSL 256-bit</h5>
                            <p class="text-muted mb-0">Toutes vos données sont cryptées de bout en bout</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-success rounded p-2 me-3">
                            <i class="fas fa-user-shield text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Authentification 2FA</h5>
                            <p class="text-muted mb-0">Double protection pour votre compte</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start">
                        <div class="bg-success rounded p-2 me-3">
                            <i class="fas fa-eye text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Surveillance 24/7</h5>
                            <p class="text-muted mb-0">Détection automatique des activités suspectes</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="glass-card text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-shield-alt text-gradient" style="font-size: 5rem;"></i>
                    </div>
                    <h3 class="mb-3">Certifications</h3>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <span class="security-badge">
                            <i class="fas fa-check-circle text-success me-2"></i>PCI DSS Compliant
                        </span>
                        <span class="security-badge">
                            <i class="fas fa-check-circle text-success me-2"></i>ISO 27001
                        </span>
                        <span class="security-badge">
                            <i class="fas fa-check-circle text-success me-2"></i>GDPR Compliant
                        </span>
                        <span class="security-badge">
                            <i class="fas fa-check-circle text-success me-2"></i>SOC 2 Type II
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5 my-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-4 fw-bold mb-3">Ils nous font <span class="text-gradient">confiance</span></h2>
            <p class="lead text-muted">Des milliers de clients satisfaits</p>
        </div>
        
        <div class="swiper testimonials-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="glass-card text-center">
                        <div class="mb-3">
                            <img src="https://i.pravatar.cc/100?img=1" alt="User" class="rounded-circle" width="80" height="80">
                        </div>
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="text-muted mb-3">"Interface intuitive, service client réactif. Marken Bank a révolutionné ma gestion financière!"</p>
                        <h6 class="mb-0">Jean Dupont</h6>
                        <small class="text-muted">Entrepreneur</small>
                    </div>
                </div>
                
                <div class="swiper-slide">
                    <div class="glass-card text-center">
                        <div class="mb-3">
                            <img src="https://i.pravatar.cc/100?img=5" alt="User" class="rounded-circle" width="80" height="80">
                        </div>
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="text-muted mb-3">"Les virements instantanés et le support crypto font toute la différence. Je recommande!"</p>
                        <h6 class="mb-0">Marie Martin</h6>
                        <small class="text-muted">Freelance</small>
                    </div>
                </div>
                
                <div class="swiper-slide">
                    <div class="glass-card text-center">
                        <div class="mb-3">
                            <img src="https://i.pravatar.cc/100?img=8" alt="User" class="rounded-circle" width="80" height="80">
                        </div>
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="text-muted mb-3">"Sécurité au top et frais transparents. Enfin une banque qui respecte ses clients!"</p>
                        <h6 class="mb-0">Pierre Dubois</h6>
                        <small class="text-muted">Consultant</small>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination mt-4"></div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-5 my-5" style="background: var(--bg-dark-2);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-4 fw-bold mb-3">Questions fréquentes</h2>
            <p class="lead text-muted">Tout ce que vous devez savoir sur Marken Bank</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item glass-card mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Comment ouvrir un compte ?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Inscrivez-vous en ligne en quelques minutes, vérifiez votre identité et votre compte sera activé immédiatement.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item glass-card mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Quels sont les frais ?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Pas de frais cachés ! Ouverture de compte gratuite, virements gratuits entre comptes Marken Bank.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item glass-card mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Comment recharger mon compte ?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Virement bancaire, PayPal ou cryptomonnaies - choisissez la méthode qui vous convient.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item glass-card">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Est-ce sécurisé ?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Absolument ! Nous utilisons le chiffrement SSL, l'authentification 2FA et surveillons votre compte 24/7.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 my-5">
    <div class="container">
        <div class="glass-card text-center p-5" data-aos="zoom-in">
            <h2 class="display-5 fw-bold mb-4">
                Prêt à révolutionner vos <span class="text-gradient">finances</span> ?
            </h2>
            <p class="lead text-muted mb-4">
                Rejoignez des milliers d'utilisateurs qui ont déjà fait le choix de Marken Bank
            </p>
            <a href="{{ route('register') }}" class="btn btn-gradient btn-lg glow">
                <i class="fas fa-rocket me-2"></i>Ouvrir un compte gratuitement
            </a>
            <p class="text-muted mt-4 mb-0">
                <i class="fas fa-check-circle text-success me-2"></i>
                Aucun frais cachés • Pas de dépôt minimum • Carte virtuelle gratuite
            </p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
    // Particles.js Configuration
    if (document.getElementById('particles-js')) {
        particlesJS('particles-js', {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: '#0066FF' },
                shape: { type: 'circle' },
                opacity: { value: 0.5, random: false },
                size: { value: 3, random: true },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#0066FF',
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 2,
                    direction: 'none',
                    random: false,
                    straight: false,
                    out_mode: 'out',
                    bounce: false
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: { enable: true, mode: 'repulse' },
                    onclick: { enable: true, mode: 'push' },
                    resize: true
                }
            },
            retina_detect: true
        });
    }
    
    // Accordion custom styling
    document.querySelectorAll('.accordion-button').forEach(button => {
        button.addEventListener('click', function() {
            this.style.background = 'var(--glass-bg)';
            this.style.color = 'var(--text-primary)';
        });
    });
</script>
@endpush
