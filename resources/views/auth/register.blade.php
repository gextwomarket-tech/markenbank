@extends('layouts.app')

@section('title', __('auth.register') . ' - ' . __('app_name'))

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
    background: linear-gradient(135deg, var(--accent) 0%, var(--primary) 50%, var(--secondary) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.auth-image-section::before {
    content: '';
    position: absolute;
    width: 600px;
    height: 600px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    top: -200px;
    left: -200px;
    animation: float 6s ease-in-out infinite;
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
    max-width: 550px;
}

/* Step Progress */
.step-progress {
    display: flex;
    justify-content: space-between;
    margin-bottom: 3rem;
    position: relative;
}

.step-progress::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--border-color);
    z-index: 0;
}

.step-progress-line {
    position: absolute;
    top: 20px;
    left: 0;
    height: 2px;
    background: linear-gradient(to right, var(--primary), var(--secondary));
    z-index: 0;
    transition: width 0.3s ease;
}

.step-item {
    position: relative;
    z-index: 1;
    text-align: center;
    flex: 1;
}

.step-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--bg-dark-2);
    border: 2px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.5rem;
    transition: all 0.3s ease;
    font-weight: 600;
}

.step-item.active .step-circle {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    border-color: var(--primary);
    color: white;
    transform: scale(1.1);
}

.step-item.completed .step-circle {
    background: var(--success);
    border-color: var(--success);
    color: white;
}

.step-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

.step-item.active .step-label {
    color: var(--primary);
    font-weight: 600;
}

/* Form Steps */
.form-step {
    display: none;
    animation: fadeIn 0.5s ease;
}

.form-step.active {
    display: block;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.form-step h4 {
    margin-bottom: 1.5rem;
    color: var(--text-primary);
}

.file-upload-area {
    border: 2px dashed var(--border-color);
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: var(--glass-bg);
}

.file-upload-area:hover {
    border-color: var(--primary);
    background: var(--glass-bg);
}

.file-upload-area.dragover {
    border-color: var(--primary);
    background: rgba(0, 102, 255, 0.1);
}

.currency-option {
    padding: 1rem;
    border: 2px solid var(--border-color);
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.currency-option:hover {
    border-color: var(--primary);
    transform: translateY(-2px);
}

.currency-option.selected {
    border-color: var(--primary);
    background: var(--glass-bg);
}

.currency-option .currency-flag {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

@media (max-width: 768px) {
    .auth-image-section {
        display: none;
    }
    
    .auth-form-section {
        flex: none;
        width: 100%;
    }
    
    .step-label {
        display: none;
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
                <i class="fas fa-rocket" style="font-size: 5rem;"></i>
            </div>
            <h2 class="fw-bold mb-3">Rejoignez Marken Bank</h2>
            <p class="lead mb-4">
                Ouvrez votre compte bancaire en quelques minutes seulement
            </p>
            
            <div class="row g-3 text-start">
                <div class="col-12">
                    <div class="glass p-3 rounded-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-white bg-opacity-25 rounded p-2 me-3">
                                <i class="fas fa-check fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Ouverture gratuite</h6>
                                <small>Aucun frais d'inscription</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="glass p-3 rounded-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-white bg-opacity-25 rounded p-2 me-3">
                                <i class="fas fa-bolt fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Activation instantanée</h6>
                                <small>Compte actif en 2 minutes</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="glass p-3 rounded-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-white bg-opacity-25 rounded p-2 me-3">
                                <i class="fas fa-gift fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Carte virtuelle offerte</h6>
                                <small>Dès l'ouverture de compte</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Form -->
    <div class="auth-form-section" data-aos="fade-left">
        <div class="auth-form-container">
            <div class="auth-logo text-gradient text-center mb-4">
                <i class="fas fa-landmark me-2"></i>{{ __('app_name') }}
            </div>

            <!-- Step Progress -->
            <div class="step-progress">
                <div class="step-progress-line" id="progressLine"></div>
                <div class="step-item active" data-step="1">
                    <div class="step-circle">1</div>
                    <div class="step-label">{{ __('auth.step_personal') }}</div>
                </div>
                <div class="step-item" data-step="2">
                    <div class="step-circle">2</div>
                    <div class="step-label">{{ __('auth.step_address') }}</div>
                </div>
                <div class="step-item" data-step="3">
                    <div class="step-circle">3</div>
                    <div class="step-label">{{ __('auth.step_documents') }}</div>
                </div>
                <div class="step-item" data-step="4">
                    <div class="step-circle">4</div>
                    <div class="step-label">{{ __('auth.step_complete') }}</div>
                </div>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" id="registerForm">
                @csrf

                <!-- Step 1: Personal Information -->
                <div class="form-step active" data-step="1">
                    <h4><i class="fas fa-user me-2"></i>{{ __('auth.step_personal') }}</h4>
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('auth.name') }}</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('auth.email') }}</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('auth.phone') }}</label>
                        <input type="tel" 
                               class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">{{ __('auth.date_of_birth') }}</label>
                        <input type="date" 
                               class="form-control @error('date_of_birth') is-invalid @enderror" 
                               id="date_of_birth" 
                               name="date_of_birth" 
                               value="{{ old('date_of_birth') }}">
                        @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">{{ __('auth.password') }}</label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">{{ __('auth.password_confirmation') }}</label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Address -->
                <div class="form-step" data-step="2">
                    <h4><i class="fas fa-map-marker-alt me-2"></i>{{ __('auth.step_address') }}</h4>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">{{ __('auth.address') }}</label>
                        <input type="text" 
                               class="form-control @error('address') is-invalid @enderror" 
                               id="address" 
                               name="address" 
                               value="{{ old('address') }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="city" class="form-label">{{ __('auth.city') }}</label>
                            <input type="text" 
                                   class="form-control @error('city') is-invalid @enderror" 
                                   id="city" 
                                   name="city" 
                                   value="{{ old('city') }}">
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="postal_code" class="form-label">{{ __('auth.postal_code') }}</label>
                            <input type="text" 
                                   class="form-control @error('postal_code') is-invalid @enderror" 
                                   id="postal_code" 
                                   name="postal_code" 
                                   value="{{ old('postal_code') }}">
                            @error('postal_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="country" class="form-label">{{ __('auth.country') }}</label>
                        <select class="form-select @error('country') is-invalid @enderror" 
                                id="country" 
                                name="country">
                            <option value="">Sélectionner un pays</option>
                            <option value="FR" {{ old('country') == 'FR' ? 'selected' : '' }}>France</option>
                            <option value="BE" {{ old('country') == 'BE' ? 'selected' : '' }}>Belgique</option>
                            <option value="CH" {{ old('country') == 'CH' ? 'selected' : '' }}>Suisse</option>
                            <option value="CA" {{ old('country') == 'CA' ? 'selected' : '' }}>Canada</option>
                            <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>États-Unis</option>
                            <option value="CI" {{ old('country') == 'CI' ? 'selected' : '' }}>Côte d'Ivoire</option>
                            <option value="SN" {{ old('country') == 'SN' ? 'selected' : '' }}>Sénégal</option>
                        </select>
                        @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Step 3: Documents & Currency -->
                <div class="form-step" data-step="3">
                    <h4><i class="fas fa-file-alt me-2"></i>{{ __('auth.step_documents') }}</h4>
                    
                    <div class="mb-4">
                        <label class="form-label">{{ __('auth.currency') }}</label>
                        <div class="row g-3">
                            <div class="col-4">
                                <div class="currency-option" data-currency="EUR">
                                    <div class="currency-flag">🇪🇺</div>
                                    <strong>EUR</strong>
                                    <small class="d-block text-muted">Euro</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="currency-option" data-currency="USD">
                                    <div class="currency-flag">🇺🇸</div>
                                    <strong>USD</strong>
                                    <small class="d-block text-muted">Dollar</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="currency-option" data-currency="GBP">
                                    <div class="currency-flag">🇬🇧</div>
                                    <strong>GBP</strong>
                                    <small class="d-block text-muted">Livre</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="currency-option" data-currency="CAD">
                                    <div class="currency-flag">🇨🇦</div>
                                    <strong>CAD</strong>
                                    <small class="d-block text-muted">Dollar CA</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="currency-option" data-currency="XOF">
                                    <div class="currency-flag">🌍</div>
                                    <strong>XOF</strong>
                                    <small class="d-block text-muted">CFA</small>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="currency" name="currency" value="{{ old('currency', 'EUR') }}">
                    </div>

                    <div class="mb-3">
                        <label for="identity_document" class="form-label">{{ __('auth.identity_document') }}</label>
                        <div class="file-upload-area" id="fileUploadArea">
                            <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-2"></i>
                            <p class="mb-2">Glissez votre document ici ou cliquez pour sélectionner</p>
                            <small class="text-muted">PNG, JPG, PDF (Max. 5MB)</small>
                            <input type="file" 
                                   class="d-none" 
                                   id="identity_document" 
                                   name="identity_document" 
                                   accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div id="fileName" class="mt-2 text-muted small"></div>
                    </div>
                </div>

                <!-- Step 4: Complete -->
                <div class="form-step" data-step="4">
                    <div class="text-center py-4">
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                        </div>
                        <h4 class="mb-3">Presque terminé !</h4>
                        <p class="text-muted mb-4">
                            Vérifiez vos informations et confirmez pour créer votre compte
                        </p>
                        
                        <div class="glass-card text-start p-4 mb-4">
                            <h6 class="mb-3">Récapitulatif</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Nom:</span>
                                <strong id="summary-name"></strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Email:</span>
                                <strong id="summary-email"></strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Téléphone:</span>
                                <strong id="summary-phone"></strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Devise:</span>
                                <strong id="summary-currency"></strong>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                            <label class="form-check-label text-start" for="terms">
                                J'accepte les <a href="#" class="text-primary">conditions d'utilisation</a> et la 
                                <a href="#" class="text-primary">politique de confidentialité</a>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-secondary" id="prevBtn" style="display: none;">
                        <i class="fas fa-arrow-left me-2"></i>{{ __('auth.previous') }}
                    </button>
                    <button type="button" class="btn btn-gradient ms-auto" id="nextBtn">
                        {{ __('auth.next') }}<i class="fas fa-arrow-right ms-2"></i>
                    </button>
                    <button type="submit" class="btn btn-gradient ms-auto" id="submitBtn" style="display: none;">
                        <i class="fas fa-check me-2"></i>{{ __('auth.submit') }}
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <p class="text-muted mb-0">
                    {{ __('auth.already_have_account') }}
                    <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">
                        {{ __('auth.sign_in') }}
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let currentStep = 1;
const totalSteps = 4;

// Step Navigation
document.getElementById('nextBtn').addEventListener('click', () => {
    if (validateStep(currentStep)) {
        if (currentStep < totalSteps) {
            currentStep++;
            updateStep();
        }
    }
});

document.getElementById('prevBtn').addEventListener('click', () => {
    if (currentStep > 1) {
        currentStep--;
        updateStep();
    }
});

function updateStep() {
    // Hide all steps
    document.querySelectorAll('.form-step').forEach(step => {
        step.classList.remove('active');
    });
    
    // Show current step
    document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('active');
    
    // Update step indicators
    document.querySelectorAll('.step-item').forEach((item, index) => {
        item.classList.remove('active', 'completed');
        if (index + 1 < currentStep) {
            item.classList.add('completed');
            item.querySelector('.step-circle').innerHTML = '<i class="fas fa-check"></i>';
        } else if (index + 1 === currentStep) {
            item.classList.add('active');
            item.querySelector('.step-circle').textContent = index + 1;
        } else {
            item.querySelector('.step-circle').textContent = index + 1;
        }
    });
    
    // Update progress line
    const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
    document.getElementById('progressLine').style.width = progress + '%';
    
    // Update buttons
    document.getElementById('prevBtn').style.display = currentStep === 1 ? 'none' : 'block';
    document.getElementById('nextBtn').style.display = currentStep === totalSteps ? 'none' : 'block';
    document.getElementById('submitBtn').style.display = currentStep === totalSteps ? 'block' : 'none';
    
    // Update summary
    if (currentStep === 4) {
        document.getElementById('summary-name').textContent = document.getElementById('name').value;
        document.getElementById('summary-email').textContent = document.getElementById('email').value;
        document.getElementById('summary-phone').textContent = document.getElementById('phone').value || 'Non renseigné';
        document.getElementById('summary-currency').textContent = document.getElementById('currency').value;
    }
}

function validateStep(step) {
    const currentStepElement = document.querySelector(`.form-step[data-step="${step}"]`);
    const inputs = currentStepElement.querySelectorAll('input[required], select[required]');
    let valid = true;
    
    inputs.forEach(input => {
        if (!input.value) {
            input.classList.add('is-invalid');
            valid = false;
        } else {
            input.classList.remove('is-invalid');
        }
    });
    
    return valid;
}

// Currency Selection
document.querySelectorAll('.currency-option').forEach(option => {
    option.addEventListener('click', function() {
        document.querySelectorAll('.currency-option').forEach(opt => opt.classList.remove('selected'));
        this.classList.add('selected');
        document.getElementById('currency').value = this.dataset.currency;
    });
});

// Set default currency
document.querySelector('.currency-option[data-currency="EUR"]').classList.add('selected');

// File Upload
const fileUploadArea = document.getElementById('fileUploadArea');
const fileInput = document.getElementById('identity_document');
const fileName = document.getElementById('fileName');

fileUploadArea.addEventListener('click', () => fileInput.click());

fileInput.addEventListener('change', function() {
    if (this.files[0]) {
        fileName.textContent = `Fichier sélectionné: ${this.files[0].name}`;
        fileName.classList.add('text-success');
    }
});

// Drag & Drop
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    fileUploadArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    fileUploadArea.addEventListener(eventName, () => {
        fileUploadArea.classList.add('dragover');
    }, false);
});

['dragleave', 'drop'].forEach(eventName => {
    fileUploadArea.addEventListener(eventName, () => {
        fileUploadArea.classList.remove('dragover');
    }, false);
});

fileUploadArea.addEventListener('drop', function(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    fileInput.files = files;
    
    if (files[0]) {
        fileName.textContent = `Fichier sélectionné: ${files[0].name}`;
        fileName.classList.add('text-success');
    }
});
</script>
@endpush
