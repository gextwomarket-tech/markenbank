@extends('layouts.dashboard')

@section('title', __('dashboard.overview') . ' - ' . __('app_name'))

@push('styles')
<style>
.quick-action-btn {
    padding: 1rem;
    border-radius: 15px;
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: block;
}

.quick-action-btn:hover {
    transform: translateY(-5px);
    border-color: var(--primary);
    box-shadow: 0 10px 30px rgba(0, 102, 255, 0.2);
}

.quick-action-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.75rem;
    font-size: 1.5rem;
    color: white;
}

.transaction-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    border-radius: 12px;
    background: var(--glass-bg);
    margin-bottom: 0.75rem;
    transition: all 0.3s ease;
}

.transaction-item:hover {
    background: var(--glass-bg);
    transform: translateX(5px);
}

.transaction-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
}

.currency-tab {
    padding: 1rem;
    border-radius: 15px;
    background: var(--glass-bg);
    border: 2px solid transparent;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.currency-tab:hover {
    border-color: var(--primary);
}

.currency-tab.active {
    border-color: var(--primary);
    background: var(--glass-bg);
}

.account-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
}
</style>
@endpush

@section('content')
<div class="row g-4">
    <!-- Welcome Section -->
    <div class="col-12">
        <div class="glass-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="mb-2">{{ __('dashboard.welcome') }}, {{ auth()->user()->name }}! 🎉</h3>
                    <p class="text-muted mb-3">Voici un aperçu de vos finances aujourd'hui.</p>
                    @if(!auth()->user()->isVerified())
                        <div class="alert alert-warning mb-0">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Votre compte n'est pas encore vérifié. Veuillez soumettre vos documents KYC.
                            <a href="#" class="alert-link ms-2">Vérifier maintenant</a>
                        </div>
                    @endif
                </div>
                <div class="col-md-4 text-end d-none d-md-block">
                    <div class="text-muted">
                        <i class="fas fa-calendar-alt me-2"></i>{{ \Carbon\Carbon::now()->format('d M Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="col-md-3 col-6">
        <div class="stat-card">
            <div class="stat-icon bg-gradient-primary">
                <i class="fas fa-wallet text-white"></i>
            </div>
            <div class="stat-value text-gradient">
                {{ formatCurrency($totalBalance ?? 0, $mainCurrency ?? 'EUR') }}
            </div>
            <div class="stat-label">{{ __('dashboard.total_balance') }}</div>
        </div>
    </div>
    
    <div class="col-md-3 col-6">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, var(--success) 0%, var(--accent) 100%);">
                <i class="fas fa-exchange-alt text-white"></i>
            </div>
            <div class="stat-value" style="color: var(--success);">
                {{ $totalTransactions ?? 0 }}
            </div>
            <div class="stat-label">{{ __('transactions.all_transactions') }}</div>
        </div>
    </div>
    
    <div class="col-md-3 col-6">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, var(--warning) 0%, var(--danger) 100%);">
                <i class="fas fa-credit-card text-white"></i>
            </div>
            <div class="stat-value" style="color: var(--warning);">
                {{ $totalCards ?? 0 }}
            </div>
            <div class="stat-label">{{ __('cards.my_cards') }}</div>
        </div>
    </div>
    
    <div class="col-md-3 col-6">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, var(--accent) 0%, var(--primary) 100%);">
                <i class="fas fa-globe-americas text-white"></i>
            </div>
            <div class="stat-value" style="color: var(--accent);">
                {{ $totalAccounts ?? 0 }}
            </div>
            <div class="stat-label">{{ __('dashboard.accounts') }}</div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-12">
        <h5 class="mb-3">{{ __('dashboard.quick_actions') }}</h5>
        <div class="row g-3">
            <div class="col-md-3 col-6">
                <a href="{{ route('dashboard.topup.index') }}" class="quick-action-btn">
                    <div class="quick-action-icon bg-gradient-primary">
                        <i class="fas fa-arrow-circle-up"></i>
                    </div>
                    <h6 class="mb-0">{{ __('dashboard.topup') }}</h6>
                    <small class="text-muted">Recharger mon compte</small>
                </a>
            </div>
            
            <div class="col-md-3 col-6">
                <a href="#" class="quick-action-btn" data-bs-toggle="modal" data-bs-target="#transferModal">
                    <div class="quick-action-icon" style="background: linear-gradient(135deg, var(--success), var(--accent));">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <h6 class="mb-0">{{ __('dashboard.transfer') }}</h6>
                    <small class="text-muted">Transfert d'argent</small>
                </a>
            </div>
            
            <div class="col-md-3 col-6">
                <a href="{{ route('dashboard.cards.index') }}" class="quick-action-btn">
                    <div class="quick-action-icon" style="background: linear-gradient(135deg, var(--warning), var(--danger));">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h6 class="mb-0">{{ __('cards.request_card') }}</h6>
                    <small class="text-muted">Carte virtuelle</small>
                </a>
            </div>
            
            <div class="col-md-3 col-6">
                <a href="{{ route('dashboard.accounts') }}" class="quick-action-btn">
                    <div class="quick-action-icon" style="background: linear-gradient(135deg, var(--accent), var(--primary));">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <h6 class="mb-0">{{ __('dashboard.add_account') }}</h6>
                    <small class="text-muted">Nouveau compte</small>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Accounts & Virtual Card -->
    <div class="col-lg-8">
        <!-- Currency Accounts Tabs -->
        <div class="glass-card mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0"><i class="fas fa-wallet me-2"></i>{{ __('dashboard.accounts') }}</h5>
                <a href="{{ route('dashboard.accounts') }}" class="btn btn-sm btn-outline-primary">
                    {{ __('dashboard.view_all') }} <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            
            @if(isset($accounts) && $accounts->count() > 0)
                <div class="row g-3">
                    @foreach($accounts as $account)
                        <div class="col-md-6">
                            <div class="currency-tab {{ $loop->first ? 'active' : '' }}">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="fs-3">{{ getCurrencySymbol($account->currency) }}</span>
                                    <span class="account-badge bg-success">{{ $account->status }}</span>
                                </div>
                                <h4 class="mb-1">{{ formatCurrency($account->balance, $account->currency) }}</h4>
                                <small class="text-muted">{{ $account->currency }} Account</small>
                                <div class="mt-2">
                                    <small class="text-muted d-block">IBAN: {{ $account->iban }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-wallet fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Aucun compte disponible</p>
                    <a href="{{ route('dashboard.accounts') }}" class="btn btn-gradient">
                        <i class="fas fa-plus me-2"></i>Créer un compte
                    </a>
                </div>
            @endif
        </div>
        
        <!-- Chart -->
        <div class="glass-card">
            <h5 class="mb-3"><i class="fas fa-chart-line me-2"></i>Historique des transactions</h5>
            <canvas id="transactionChart" height="300"></canvas>
        </div>
    </div>
    
    <!-- Virtual Card & Recent Transactions -->
    <div class="col-lg-4">
        <!-- Virtual Card -->
        @if(isset($primaryCard))
            <div class="virtual-card mb-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <small>Carte Virtuelle</small>
                        <h6 class="mb-0">{{ __('app_name') }}</h6>
                    </div>
                    <i class="fab fa-cc-visa fa-2x"></i>
                </div>
                
                <div class="card-chip"></div>
                
                <div class="card-number mb-3">
                    {{ $primaryCard->card_number_masked }}
                </div>
                
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="d-block opacity-75">Titulaire</small>
                        <strong>{{ strtoupper(auth()->user()->name) }}</strong>
                    </div>
                    <div>
                        <small class="d-block opacity-75">Expire</small>
                        <strong>{{ $primaryCard->card_expiry }}</strong>
                    </div>
                </div>
            </div>
        @else
            <div class="glass-card mb-4 text-center p-4">
                <i class="fas fa-credit-card fa-3x text-muted mb-3"></i>
                <h6 class="mb-2">Aucune carte virtuelle</h6>
                <p class="text-muted small mb-3">Créez votre première carte virtuelle gratuitement</p>
                <a href="{{ route('dashboard.cards.index') }}" class="btn btn-gradient btn-sm">
                    <i class="fas fa-plus me-2"></i>{{ __('cards.request_card') }}
                </a>
            </div>
        @endif
        
        <!-- Recent Transactions -->
        <div class="glass-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0"><i class="fas fa-history me-2"></i>{{ __('dashboard.recent_transactions') }}</h5>
                <a href="{{ route('dashboard.transactions.index') }}" class="text-primary text-decoration-none">
                    {{ __('dashboard.view_all') }}
                </a>
            </div>
            
            @if(isset($recentTransactions) && $recentTransactions->count() > 0)
                @foreach($recentTransactions as $transaction)
                    <div class="transaction-item">
                        <div class="transaction-icon {{ $transaction->type === 'credit' ? 'bg-success' : ($transaction->type === 'debit' ? 'bg-danger' : 'bg-primary') }}">
                            <i class="fas {{ getTransactionIcon($transaction->type) }} text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ ucfirst($transaction->type) }}</h6>
                            <small class="text-muted">{{ $transaction->created_at->format('d M Y, H:i') }}</small>
                        </div>
                        <div class="text-end">
                            <strong class="{{ $transaction->type === 'credit' ? 'text-success' : 'text-danger' }}">
                                {{ $transaction->type === 'credit' ? '+' : '-' }}{{ formatCurrency($transaction->amount, $transaction->currency) }}
                            </strong>
                            <br>
                            <small class="text-muted">{!! getStatusBadge($transaction->status) !!}</small>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-4">
                    <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                    <p class="text-muted">{{ __('dashboard.no_transactions') }}</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Transfer Modal -->
<div class="modal fade" id="transferModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: var(--bg-dark-2); border: 1px solid var(--border-color);">
            <div class="modal-header border-0">
                <h5 class="modal-title">{{ __('dashboard.transfer') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: invert(1);"></button>
            </div>
            <form action="{{ route('dashboard.transactions.transfer') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="from_account" class="form-label">De</label>
                        <select class="form-select" id="from_account" name="from_account_id" required>
                            <option value="">Sélectionner un compte</option>
                            @if(isset($accounts))
                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}">
                                        {{ $account->currency }} - {{ formatCurrency($account->balance, $account->currency) }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="to_account" class="form-label">Vers</label>
                        <select class="form-select" id="to_account" name="to_account_id" required>
                            <option value="">Sélectionner un compte</option>
                            @if(isset($accounts))
                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}">
                                        {{ $account->currency }} - {{ $account->account_number }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="amount" class="form-label">Montant</label>
                        <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (optionnel)</label>
                        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-gradient">
                        <i class="fas fa-paper-plane me-2"></i>Transférer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Transaction Chart
const ctx = document.getElementById('transactionChart');
if (ctx) {
    const data = {
        labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
        datasets: [
            {
                label: 'Entrées',
                data: @json($chartData['income'] ?? [12, 19, 15, 25, 22, 30, 28, 32, 28, 35, 30, 38]),
                borderColor: 'rgb(0, 209, 160)',
                backgroundColor: 'rgba(0, 209, 160, 0.1)',
                tension: 0.4,
                fill: true
            },
            {
                label: 'Sorties',
                data: @json($chartData['expenses'] ?? [8, 11, 10, 15, 13, 18, 16, 20, 18, 22, 19, 25]),
                borderColor: 'rgb(255, 71, 87)',
                backgroundColor: 'rgba(255, 71, 87, 0.1)',
                tension: 0.4,
                fill: true
            }
        ]
    };
    
    new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: 'rgb(160, 174, 192)',
                        usePointStyle: true,
                        padding: 15
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)'
                    },
                    ticks: {
                        color: 'rgb(160, 174, 192)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)'
                    },
                    ticks: {
                        color: 'rgb(160, 174, 192)'
                    }
                }
            }
        }
    });
}
</script>
@endpush
