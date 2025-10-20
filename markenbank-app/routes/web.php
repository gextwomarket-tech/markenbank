<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VirtualCardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

// Pages publiques
Route::get('/', [LandingController::class, 'index'])->name('home');

// Authentification
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Routes protégées (Dashboard)
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    // Dashboard principal
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    
    // Comptes bancaires
    Route::get('/accounts', [DashboardController::class, 'accounts'])->name('accounts');
    Route::post('/accounts', [DashboardController::class, 'createAccount'])->name('accounts.create');
    Route::get('/accounts/{account}', [DashboardController::class, 'showAccount'])->name('accounts.show');
    
    // Recharges
    Route::get('/topup', [TopupController::class, 'index'])->name('topup.index');
    Route::post('/topup', [TopupController::class, 'store'])->name('topup.store');
    Route::get('/topup/{topup}', [TopupController::class, 'show'])->name('topup.show');
    
    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::post('/transactions/transfer', [TransactionController::class, 'transfer'])->name('transactions.transfer');
    Route::get('/transactions/export/csv', [TransactionController::class, 'exportCsv'])->name('transactions.export');
    
    // Cartes virtuelles
    Route::get('/cards', [VirtualCardController::class, 'index'])->name('cards.index');
    Route::post('/cards', [VirtualCardController::class, 'store'])->name('cards.store');
    Route::post('/cards/{card}/freeze', [VirtualCardController::class, 'freeze'])->name('cards.freeze');
    Route::post('/cards/{card}/unfreeze', [VirtualCardController::class, 'unfreeze'])->name('cards.unfreeze');
    Route::delete('/cards/{card}', [VirtualCardController::class, 'destroy'])->name('cards.destroy');
    
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});
