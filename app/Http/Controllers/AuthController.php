<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RecensioneController;

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
    Route::get('/dashboard/recensioni', [AdminController::class, 'index'])
        ->name('dashboard.recensioni');

    // FORM CREAZIONE RECENSIONE
    Route::get('/dashboard/recensioni/crea', [AdminController::class, 'create'])
        ->name('dashboard.recensioni.create');

    // SALVATAGGIO NUOVA RECENSIONE
    Route::post('/dashboard/recensioni', [AdminController::class, 'store'])
        ->name('dashboard.recensioni.store');

    // FORM MODIFICA RECENSIONE
    Route::get('/dashboard/recensioni/{recensione}/edit', [AdminController::class, 'edit'])
        ->name('dashboard.recensioni.edit');

    // AGGIORNAMENTO RECENSIONE
    Route::put('/dashboard/recensioni/{recensione}', [AdminController::class, 'update'])
        ->name('dashboard.recensioni.update');

    // ELIMINAZIONE RECENSIONE
    Route::delete('/dashboard/recensioni/{recensione}', [AdminController::class, 'destroy'])
        ->name('dashboard.recensioni.destroy');
});
