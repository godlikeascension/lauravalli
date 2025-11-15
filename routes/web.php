<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Models\Recensione;

// -----------------------------
// Form contatti
// -----------------------------
Route::post('/contatti', [ContactController::class, 'send'])->name('contatti.send');

// -----------------------------
// Pagine pubbliche sito
// -----------------------------
Route::get('/', function () {
    return view('index');
});

Route::get('/commissioni', function () {
    return view('commissioni');
});

// -----------------------------
// Autenticazione
// -----------------------------
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route::get('/registrazione', [AuthController::class, 'showRegistrationForm'])->name('registrazione');
// Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// -----------------------------
// Dashboard (area admin/pannello) - protetta da auth
// -----------------------------
Route::middleware(['auth'])->group(function () {

    // LISTA RECENSIONI (pagina con tabella + bottone "Aggiungi recensione")
    Route::get('/dashboard/recensioni', [AdminController::class, 'recensioniIndex'])
        ->name('dashboard.recensioni');

    // FORM CREAZIONE RECENSIONE
    Route::get('/dashboard/recensioni/crea', [AdminController::class, 'recensioniCreate'])
        ->name('dashboard.recensioni.create');

    // SALVATAGGIO NUOVA RECENSIONE
    Route::post('/dashboard/recensioni', [AdminController::class, 'recensioniStore'])
        ->name('dashboard.recensioni.store');

    // FORM MODIFICA RECENSIONE
    Route::get('/dashboard/recensioni/{recensione}/edit', [AdminController::class, 'recensioniEdit'])
        ->name('dashboard.recensioni.edit');

    // AGGIORNAMENTO RECENSIONE
    Route::put('/dashboard/recensioni/{recensione}', [AdminController::class, 'recensioniUpdate'])
        ->name('dashboard.recensioni.update');

    // ELIMINAZIONE RECENSIONE
    Route::delete('/dashboard/recensioni/{recensione}', [AdminController::class, 'recensioniDestroy'])
        ->name('dashboard.recensioni.destroy');
});
Route::get('/commissioni', function () {
    $recensioni = Recensione::orderBy('created_at', 'desc')->get();
    return view('commissioni', compact('recensioni'));
});

