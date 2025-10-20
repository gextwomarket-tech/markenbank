@extends('layouts.app')

@section('title', 'Marken Bank - Votre banque digitale de confiance')

@push('styles')
<style>
.hero {
    background: linear-gradient(135deg, #1A1D29 0%, #252A3A 100%);
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
                <h1 class="hero-title display-3 fw-bold mb-4">
                    La banque <span class="text-gradient">digitale</span> de nouvelle génération
                </h1>
                <p class="lead text-muted mb-4">
                    Gérez vos finances en toute simplicité avec Marken Bank. Comptes multi-devises, cartes virtuelles, virements instantanés et bien plus.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="btn btn-gradient btn-lg">
                        <i class="fas fa-rocket me-2"></i>Ouvrir un compte
                    </a>
                    <a href="#features" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-play-circle me-2"></i>Découvrir
                    </a>
                </div>
                
                <div class="row mt-5 g-4">
                    <div class="col-4">
                        <div class="text-center">
                            <h3 class="text-gradient mb-0 stat-number" data-target="50000">0</h3>
                            <small class="text-muted">Utilisateurs</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="text-center">
                            <h3 class="text-gradient mb-0 stat-number" data-target="150">0</h3>
                            <small class="text-muted">Pays</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="text-center">
                            <h3 class="text-gradient mb-0 stat-number" data-target="99">0</h3>
                            <small class="text-muted">% Satisfaction</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative">
                    <div class="glass-card p-4">
                        <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?w=600&h=400&fit=crop" 
                             alt="Banking Dashboard" 
                             class="img-fluid rounded-3">
                    </div>
                    
                    <!-- Floating Card Elements -->
                    <div class="position-absolute top-0 end-0 glass p-3 m-3" data-aos="fade-up" data-aos-delay="200">
                        <div class="d-flex align-items-center">
                            <div class="bg-gradient-primary rounded-circle p-2 me-3">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Transaction réussie</small>
                                <strong class="text-success">+$1,250.00</strong>
                            </div>
                        </div>
                    </div>
                    
                    <div class="position-absolute bottom-0 start-0 glass p-3 m-3" data-aos="fade-up" data-aos-delay="400">
                        <div class="d-flex align-items-center">
                            <div class="bg-gradient-accent rounded-circle p-2 me-3">
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
            <h2 class="display-4 fw-bold mb-3">Pourquoi choisir <span class="text-gradient">Marken Bank</span> ?</h2>
            <p class="lead text-muted">Des fonctionnalités conçues pour simplifier votre vie financière</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="glass-card text-center h-100">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                    <h4 class="mb-3">Multi-devises</h4>
                    <p class="text-muted">
                        Gérez vos comptes en USD, EUR, GBP, CAD et XOF. Convertissez instantanément avec les meilleurs taux.
                    </p>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="glass-card text-center h-100">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h4 class="mb-3">Cartes Virtuelles</h4>
                    <p class="text-muted">
                        Créez des cartes virtuelles instantanément pour vos achats en ligne en toute sécurité.
                    </p>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="glass-card text-center h-100">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h4 class="mb-3">Virements Instantanés</h4>
                    <p class="text-muted">
                        Transférez de l'argent en quelques secondes vers n'importe quel compte Marken Bank.
                    </p>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="glass-card text-center h-100">
                    <div class="stat-icon mb-3">
                        <i class="fab fa-bitcoin"></i>
                    </div>
                    <h4 class="mb-3">Crypto-friendly</h4>
                    <p class="text-muted">
                        Rechargez vos comptes avec Bitcoin, Ethereum et autres cryptomonnaies.
                    </p>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                <div class="glass-card text-center h-100">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="mb-3">Sécurité Maximale</h4>
                    <p class="text-muted">
                        Authentification 2FA, encryption SSL et surveillance 24/7 pour protéger vos fonds.
                    </p>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                <div class="glass-card text-center h-100">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4 class="mb-3">Analytics Avancés</h4>
                    <p class="text-muted">
                        Suivez vos dépenses avec des graphiques détaillés et des rapports personnalisés.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="py-5 my-5" style="background: var(--bg-dark-2);">
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
            <p class="text-muted mt-3 mb-0">
                <i class="fas fa-check-circle text-success me-2"></i>
                Aucun frais cachés • Pas de dépôt minimum • Carte virtuelle gratuite
            </p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
@endpush
