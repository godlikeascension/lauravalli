<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::post('/contatti', [ContactController::class, 'send'])->name('contatti.send');


Route::get('/', function () {
    return view('index');
});
Route::get('/commissioni', function () {
    return view('commissioni');
});

// Rotte per l'autenticazione
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/registrazione', [AuthController::class, 'showRegistrationForm'])->name('registrazione');
Route::post('/register', [AuthController::class, 'register'])->name('register');

