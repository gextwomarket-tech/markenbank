@extends('layouts.app')

@section('title', 'Dashboard - Marken Bank')

@section('content')
<div class="container-fluid py-4" style="background: var(--bg-dark-1); min-height: 100vh;">
    <div class="container">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="mb-1">Bonjour, <span class="text-gradient">{{ auth()->user()->name }}</span>! 👋</h2>
                <p class="text-muted">Voici un aperçu de vos finances</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('dashboard.topup.index') }}" class="btn btn-gradient me-2">
                    <i class="fas fa-plus-circle me-1"></i>Recharger
                </a>
                <a href="{{ route('dashboard.accounts') }}" class="btn btn-outline-primary">
                    <i class="fas fa-wallet me-1"></i>Comptes
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show glass" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-muted mb-1">Solde Total</p>
                            <h3 class="mb-0">{{ formatCurrency($totalBalance, 'USD') }}</h3>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-arrow-up text-success me-2"></i>
                        <small class="text-success">+12.5% ce mois</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-muted mb-1">Comptes Actifs</p>
                            <h3 class="mb-0">{{ $accounts->count() }}</h3>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                    </div>
                    <small class="text-muted">{{ $activeCards }} cartes virtuelles</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-muted mb-1">Recharges</p>
                            <h3 class="mb-0">{{ $pendingTopups }}</h3>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <small class="text-warning">En attente d'approbation</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-muted mb-1">Transactions</p>
                            <h3 class="mb-0">{{ $recentTransactions->count() }}</h3>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                    </div>
                    <small class="text-muted">Ce mois-ci</small>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Accounts Overview -->
            <div class="col-lg-8">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-chart-line me-2 text-primary"></i>Mes Comptes</h5>
                        <a href="{{ route('dashboard.accounts') }}" class="btn btn-sm btn-outline-primary">
                            Voir tout
                        </a>
                    </div>
                    <div class="card-body">
                        @forelse($accounts as $account)
                        <div class="glass-card mb-3 p-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-gradient-primary rounded-circle p-3 me-3">
                                            <i class="fas fa-university text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Compte {{ $account->currency }}</h6>
                                            <small class="text-muted">{{ $account->account_number }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-md-center mt-2 mt-md-0">
                                    {!! getStatusBadge($account->status) !!}
                                </div>
                                <div class="col-md-3 text-md-end mt-2 mt-md-0">
                                    <h5 class="mb-0 text-gradient">{{ formatCurrency($account->balance, $account->currency) }}</h5>
                                    <small class="text-muted">Solde disponible</small>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5">
                            <i class="fas fa-wallet fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Aucun compte disponible</p>
                            <a href="{{ route('dashboard.accounts') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Créer un compte
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-bolt me-2 text-warning"></i>Actions Rapides</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            <a href="{{ route('dashboard.topup.index') }}" class="btn btn-outline-primary text-start">
                                <i class="fas fa-plus-circle me-2"></i>Recharger mon compte
                            </a>
                            <a href="{{ route('dashboard.transactions.index') }}" class="btn btn-outline-primary text-start">
                                <i class="fas fa-exchange-alt me-2"></i>Faire un transfert
                            </a>
                            <a href="{{ route('dashboard.cards.index') }}" class="btn btn-outline-primary text-start">
                                <i class="fas fa-credit-card me-2"></i>Demander une carte
                            </a>
                            <a href="{{ route('dashboard.transactions.index') }}" class="btn btn-outline-primary text-start">
                                <i class="fas fa-history me-2"></i>Voir l'historique
                            </a>
                            <a href="{{ route('dashboard.profile.edit') }}" class="btn btn-outline-primary text-start">
                                <i class="fas fa-user-cog me-2"></i>Gérer mon profil
                            </a>
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="text-muted small mb-2">Besoin d'aide?</p>
                            <a href="#" class="btn btn-sm btn-gradient">
                                <i class="fas fa-headset me-1"></i>Contacter le support
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-history me-2 text-info"></i>Transactions Récentes</h5>
                        <a href="{{ route('dashboard.transactions.index') }}" class="btn btn-sm btn-outline-primary">
                            Voir tout
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Référence</th>
                                        <th>Compte</th>
                                        <th class="text-end">Montant</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentTransactions as $transaction)
                                    <tr>
                                        <td>
                                            <small>{{ $transaction->created_at->format('d/m/Y H:i') }}</small>
                                        </td>
                                        <td>
                                            <i class="fas {{ getTransactionIcon($transaction->type) }} me-1"></i>
                                            {{ ucfirst($transaction->type) }}
                                        </td>
                                        <td>
                                            <code class="small">{{ $transaction->reference }}</code>
                                        </td>
                                        <td>
                                            <small>{{ $transaction->bankAccount->account_number }}</small>
                                        </td>
                                        <td class="text-end">
                                            <strong class="{{ $transaction->type == 'credit' ? 'text-success' : 'text-danger' }}">
                                                {{ $transaction->type == 'credit' ? '+' : '-' }}
                                                {{ formatCurrency($transaction->amount, $transaction->currency) }}
                                            </strong>
                                        </td>
                                        <td>{!! getStatusBadge($transaction->status) !!}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="fas fa-inbox fa-2x text-muted mb-2 d-block"></i>
                                            <p class="text-muted mb-0">Aucune transaction récente</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction Chart -->
        @if($monthlyTransactions->isNotEmpty())
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-chart-area me-2 text-success"></i>Activité du Mois</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="transactionChart" 
                                height="100"
                                data-labels='@json($monthlyTransactions->pluck('date'))'
                                data-credits='@json($monthlyTransactions->pluck('credit'))'
                                data-debits='@json($monthlyTransactions->pluck('debit'))'></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
