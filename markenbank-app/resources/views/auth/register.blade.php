@extends('layouts.app')

@section('title', 'Créer un compte - Marken Bank')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="glass-card p-5">
                <div class="text-center mb-5">
                    <div class="mb-3">
                        <i class="fas fa-user-plus fa-3x text-gradient"></i>
                    </div>
                    <h2 class="mb-2">Ouvrir un compte</h2>
                    <p class="text-muted">Rejoignez Marken Bank en quelques minutes</p>
                </div>

                <!-- Progress Steps -->
                <div class="row mb-5">
                    <div class="col-4 text-center">
                        <div class="bg-gradient-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-2" 
                             style="width: 50px; height: 50px;">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <p class="small mb-0 text-primary fw-bold">Informations</p>
                    </div>
                    <div class="col-4 text-center">
                        <div class="bg-dark bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" 
                             style="width: 50px; height: 50px; border: 2px dashed var(--border-color);">
                            <i class="fas fa-money-bill-wave text-muted"></i>
                        </div>
                        <p class="small mb-0 text-muted">Devise</p>
                    </div>
                    <div class="col-4 text-center">
                        <div class="bg-dark bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" 
                             style="width: 50px; height: 50px; border: 2px dashed var(--border-color);">
                            <i class="fas fa-check text-muted"></i>
                        </div>
                        <p class="small mb-0 text-muted">Confirmation</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                    @csrf

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Erreur!</strong> Veuillez corriger les erreurs ci-dessous.
                        <button type="button" class="btn-close" data-bs-toggle="alert"></button>
                    </div>
                    @endif

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label">
                                <i class="fas fa-user me-1"></i>Nom complet *
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="Jean Dupont"
                                   required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-1"></i>Email *
                            </label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="jean@example.com"
                                   required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">
                                <i class="fas fa-phone me-1"></i>Téléphone
                            </label>
                            <input type="tel" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}" 
                                   placeholder="+33 6 12 34 56 78">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-1"></i>Mot de passe *
                            </label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   placeholder="••••••••"
                                   required>
                            <small class="text-muted">Minimum 8 caractères</small>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-lock me-1"></i>Confirmer le mot de passe *
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   placeholder="••••••••"
                                   required>
                        </div>

                        <div class="col-md-12">
                            <label for="currency" class="form-label">
                                <i class="fas fa-coins me-1"></i>Devise principale *
                            </label>
                            <select class="form-select @error('currency') is-invalid @enderror" 
                                    id="currency" 
                                    name="currency" 
                                    required>
                                <option value="">Sélectionnez une devise</option>
                                @foreach($currencies as $curr)
                                <option value="{{ $curr }}" {{ old('currency') == $curr ? 'selected' : '' }}>
                                    {{ $curr }} - {{ getCurrencySymbol($curr) }}
                                </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Vous pourrez ajouter d'autres devises plus tard</small>
                            @error('currency')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    J'accepte les <a href="#" class="text-primary">conditions d'utilisation</a> 
                                    et la <a href="#" class="text-primary">politique de confidentialité</a>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-gradient w-100 btn-lg">
                                <i class="fas fa-rocket me-2"></i>Créer mon compte
                            </button>
                        </div>

                        <div class="col-md-12 text-center">
                            <p class="text-muted mb-0">
                                Vous avez déjà un compte? 
                                <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">
                                    Se connecter
                                </a>
                            </p>
                        </div>
                    </div>
                </form>

                <!-- Security Info -->
                <div class="row mt-5 text-center g-4">
                    <div class="col-md-4">
                        <i class="fas fa-shield-alt fa-2x text-success mb-2"></i>
                        <p class="small text-muted mb-0">Données sécurisées SSL 256-bit</p>
                    </div>
                    <div class="col-md-4">
                        <i class="fas fa-lock fa-2x text-success mb-2"></i>
                        <p class="small text-muted mb-0">Protection 2FA disponible</p>
                    </div>
                    <div class="col-md-4">
                        <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                        <p class="small text-muted mb-0">100% gratuit, aucun frais cachés</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
