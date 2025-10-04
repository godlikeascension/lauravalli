<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::post('/contatti', [ContactController::class, 'send'])->name('contatti.send');


Route::get('/', function () {
    return view('index');
});
Route::get('/commissioni', function () {
    return view('commissioni');
});
