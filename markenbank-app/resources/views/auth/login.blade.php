@extends('layouts.app')

@section('title', 'Connexion - Marken Bank')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-lg-10">
            <div class="row g-0 glass-card overflow-hidden">
                <!-- Left Side - Illustration -->
                <div class="col-lg-6 d-none d-lg-block position-relative" style="background: var(--gradient-primary);">
                    <div class="h-100 d-flex flex-column justify-content-center align-items-center p-5 text-white">
                        <div class="mb-4" data-aos="fade-down">
                            <i class="fas fa-university fa-5x opacity-75"></i>
                        </div>
                        <h2 class="mb-3" data-aos="fade-up">Bon retour parmi nous!</h2>
                        <p class="text-center opacity-75" data-aos="fade-up" data-aos-delay="100">
                            Accédez à votre dashboard et gérez vos finances en toute simplicité.
                        </p>
                        
                        <!-- Stats -->
                        <div class="row text-center mt-5 w-100" data-aos="fade-up" data-aos-delay="200">
                            <div class="col-4">
                                <h4 class="mb-0">50K+</h4>
                                <small class="opacity-75">Utilisateurs</small>
                            </div>
                            <div class="col-4">
                                <h4 class="mb-0">99.9%</h4>
                                <small class="opacity-75">Uptime</small>
                            </div>
                            <div class="col-4">
                                <h4 class="mb-0">24/7</h4>
                                <small class="opacity-75">Support</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Login Form -->
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Connexion</h3>
                            <p class="text-muted">Entrez vos identifiants pour accéder à votre compte</p>
                        </div>

                        <!-- Demo Accounts -->
                        <div class="alert alert-info border-0 glass mb-4" role="alert">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Comptes de démonstration</strong>
                            </div>
                            <small class="text-muted">Cliquez sur un compte pour vous connecter automatiquement</small>
                        </div>

                        <div class="row g-2 mb-4">
                            @foreach($demoAccounts as $demo)
                            <div class="col-12">
                                <button type="button" 
                                        class="btn btn-sm w-100 text-start demo-login-btn glass-card"
                                        data-email="{{ $demo['email'] }}"
                                        data-password="{{ $demo['password'] }}"
                                        style="border: 1px solid var(--border-color);">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-{{ $demo['color'] }} bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="fas {{ $demo['icon'] }} text-{{ $demo['color'] }}"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">{{ $demo['name'] }}</div>
                                            <small class="text-muted">{{ $demo['email'] }}</small>
                                        </div>
                                        @if(isset($demo['balance']))
                                        <span class="badge bg-{{ $demo['color'] }}">{{ $demo['balance'] }}</span>
                                        @endif
                                    </div>
                                </button>
                            </div>
                            @endforeach
                        </div>

                        <div class="position-relative my-4">
                            <hr>
                            <span class="position-absolute top-50 start-50 translate-middle px-3" 
                                  style="background: var(--bg-dark-2);">
                                <small class="text-muted">OU</small>
                            </span>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                            @csrf

                            @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ $errors->first() }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            @endif

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-1"></i>Email
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="votre@email.com"
                                       required 
                                       autofocus>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label for="password" class="form-label mb-0">
                                        <i class="fas fa-lock me-1"></i>Mot de passe
                                    </label>
                                    <a href="#" class="text-primary text-decoration-none small">
                                        Mot de passe oublié?
                                    </a>
                                </div>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="••••••••"
                                       required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Se souvenir de moi
                                </label>
                            </div>

                            <button type="submit" class="btn btn-gradient w-100 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                            </button>

                            <div class="text-center">
                                <p class="text-muted mb-0">
                                    Pas encore de compte? 
                                    <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold">
                                        Créer un compte
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
