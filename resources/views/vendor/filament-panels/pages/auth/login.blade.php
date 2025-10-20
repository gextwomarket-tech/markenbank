@php /** @var \Livewire\Livewire $this */ @endphp
<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-lg-10">
            <div class="row g-0 glass-card overflow-hidden">
                <!-- Left Side - Illustration/Stats/Logo -->
                <div class="col-lg-6 d-none d-lg-block position-relative" style="background: var(--gradient-primary);">
                    <div class="h-100 d-flex flex-column justify-content-center align-items-center p-5 text-white">
                        <div class="mb-4" data-aos="fade-down">
                            <i class="fas fa-university fa-5x opacity-75"></i>
                        </div>
                        <h2 class="mb-3" data-aos="fade-up">Espace Admin</h2>
                        <p class="text-center opacity-75" data-aos="fade-up" data-aos-delay="100">
                            Connexion sécurisée à l'administration Marken Bank.
                        </p>
                        <!-- Stats -->
                        <div class="row text-center mt-5 w-100" data-aos="fade-up" data-aos-delay="200">
                            <div class="col-4">
                                <h4 class="mb-0">100%</h4>
                                <small class="opacity-75">Uptime</small>
                            </div>
                            <div class="col-4">
                                <h4 class="mb-0">2FA</h4>
                                <small class="opacity-75">Protection</small>
                            </div>
                            <div class="col-4">
                                <h4 class="mb-0">Live</h4>
                                <small class="opacity-75">Analytics</small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Side - Login Form (Filament) -->
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Connexion Admin</h3>
                            <p class="text-muted">Entrez vos identifiants administrateur pour accéder au panel</p>
                        </div>
                        @if (filament()->hasRegistration())
                            <div class="mb-3 text-center text-warning small">
                                {{ __('filament-panels::pages/auth/login.actions.register.before') }}
                                {{ $this->registerAction }}
                            </div>
                        @endif
                        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}
                        <x-filament-panels::form id="form" wire:submit="authenticate">
                            {{ $this->form }}
                            <x-filament-panels::form.actions
                                :actions="$this->getCachedFormActions()"
                                :full-width="$this->hasFullWidthFormActions()"
                            />
                        </x-filament-panels::form>
                        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
