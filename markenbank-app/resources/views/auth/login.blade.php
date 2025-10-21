@extends('layouts.app')

@section('title', __('auth.login') . ' - ' . __('app_name'))

@push('styles')
<style>
.auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.auth-split {
    display: flex;
    min-height: 100vh;
}

.auth-image-section {
    flex: 1;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.auth-image-section::before {
    content: '';
    position: absolute;
    width: 500px;
    height: 500px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    top: -100px;
    left: -100px;
}

.auth-image-section::after {
    content: '';
    position: absolute;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    bottom: -50px;
    right: -50px;
}

.auth-illustration {
    position: relative;
    z-index: 1;
    max-width: 500px;
    padding: 3rem;
}

.auth-form-section {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background: var(--bg-dark-1);
}

.auth-form-container {
    width: 100%;
    max-width: 450px;
}

.auth-logo {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 2rem;
}

.social-login-btn {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid var(--border-color);
    background: var(--glass-bg);
    color: var(--text-primary);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.social-login-btn:hover {
    border-color: var(--primary);
    background: var(--glass-bg);
    transform: translateY(-2px);
}

.divider {
    display: flex;
    align-items: center;
    text-align: center;
    margin: 1.5rem 0;
}

.divider::before,
.divider::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid var(--border-color);
}

.divider span {
    padding: 0 1rem;
    color: var(--text-secondary);
    font-size: 0.875rem;
}

@media (max-width: 768px) {
    .auth-image-section {
        display: none;
    }
    
    .auth-form-section {
        flex: none;
        width: 100%;
    }
}
</style>
@endpush

@section('content')
<div class="auth-split">
    <!-- Left Side - Illustration -->
    <div class="auth-image-section" data-aos="fade-right">
        <div class="auth-illustration text-center text-white">
            <div class="mb-4">
                <i class="fas fa-landmark" style="font-size: 5rem;"></i>
            </div>
            <h2 class="fw-bold mb-3">Bienvenue sur Marken Bank</h2>
            <p class="lead mb-4">
                Connectez-vous pour accéder à votre espace bancaire sécurisé
            </p>
            <div class="glass p-4 rounded-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span>Sécurité SSL</span>
                    <i class="fas fa-shield-alt fa-2x"></i>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span>Authentification 2FA</span>
                    <i class="fas fa-lock fa-2x"></i>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span>Données cryptées</span>
                    <i class="fas fa-key fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Form -->
    <div class="auth-form-section" data-aos="fade-left">
        <div class="auth-form-container">
            <div class="auth-logo text-gradient text-center">
                <i class="fas fa-landmark me-2"></i>{{ __('app_name') }}
            </div>
            
            <div class="text-center mb-4">
                <h3 class="fw-bold mb-2">{{ __('auth.login') }}</h3>
                <p class="text-muted">Accédez à votre compte bancaire</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Erreur!</strong> {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('auth.email') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="fas fa-envelope text-muted"></i>
                        </span>
                        <input type="email" 
                               class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               placeholder="exemple@email.com"
                               required 
                               autofocus>
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('auth.password') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="fas fa-lock text-muted"></i>
                        </span>
                        <input type="password" 
                               class="form-control border-start-0 border-end-0 ps-0 @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               placeholder="••••••••"
                               required>
                        <span class="input-group-text bg-transparent border-start-0 cursor-pointer" onclick="togglePassword()">
                            <i class="fas fa-eye text-muted" id="toggleIcon"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label text-muted" for="remember">
                            {{ __('auth.remember_me') }}
                        </label>
                    </div>
                    <a href="#" class="text-primary text-decoration-none">
                        {{ __('auth.forgot_password') }}
                    </a>
                </div>

                <button type="submit" class="btn btn-gradient w-100 mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i>{{ __('auth.sign_in') }}
                </button>

                <div class="text-center">
                    <p class="text-muted mb-0">
                        {{ __('auth.dont_have_account') }}
                        <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold">
                            {{ __('auth.sign_up') }}
                        </a>
                    </p>
                </div>
            </form>

            <div class="divider">
                <span>OU</span>
            </div>

            <div class="row g-2">
                <div class="col-6">
                    <button type="button" class="social-login-btn">
                        <i class="fab fa-google me-2"></i>Google
                    </button>
                </div>
                <div class="col-6">
                    <button type="button" class="social-login-btn">
                        <i class="fab fa-apple me-2"></i>Apple
                    </button>
                </div>
            </div>

            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="fas fa-shield-alt me-1"></i>
                    Connexion sécurisée SSL 256-bit
                </small>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>
@endpush
