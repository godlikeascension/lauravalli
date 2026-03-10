<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Models\Recensione;
use App\Models\Opera;
use App\Models\Collezione;
use App\Models\Faq;
use App\Models\Impostazione;

// -----------------------------
// Form contatti
// -----------------------------
Route::post('/contatti', [ContactController::class, 'send'])->name('contatti.send');
Route::post('/commissioni-form', [ContactController::class, 'sendCommissione'])
    ->name('commissioni.send');
Route::post('/gift-card-form', [ContactController::class, 'sendGiftCard'])
    ->name('gift-card.send');
Route::get('/commissioni/grazie', function () {
    return view('commissioni-grazie');
})->name('commissioni.grazie');


// -----------------------------
// Pagine pubbliche sito
// -----------------------------
Route::get('/', function () {
    $collezione = Collezione::where('is_featured', true)
        ->with('opere')
        ->first();

    return view('index', compact('collezione'));
});

Route::get('/commissioni', function () {
    $recensioni = Recensione::orderBy('created_at', 'desc')->get();
    $faqs       = Faq::where('tipo', 'commissioni')->orderBy('ordine')->orderBy('id')->get();
    return view('commissioni', compact('recensioni', 'faqs'));
});
Route::get('/gift-card', function () {
    $faqs = Faq::where('tipo', 'gift-card')->orderBy('ordine')->orderBy('id')->get();
    return view('gift-card', compact('faqs'));
})->name('gift-card');
Route::get('/artist-statement', function () {
    $contenuto = Impostazione::get('artist_statement');
    return view('artist-statement', compact('contenuto'));
});
Route::get('/opere', function () {
    $collezioni = Collezione::with('opere')
        ->orderBy('ordine')
        ->get();
    return view('collezioni-pubblica', compact('collezioni'));
})->name('collezioni.pubblica');

// Redirect vecchio URL per backward compatibility
Route::redirect('/collezioni', '/opere', 301);

Route::get('/opera/{slug}', function (string $slug) {
    $opera = Opera::where('slug', $slug)
        ->with(['immagini', 'collezione'])
        ->firstOrFail();

    $altreOpere = $opera->collezione_id
        ? Opera::where('collezione_id', $opera->collezione_id)
            ->where('id', '!=', $opera->id)
            ->get()
        : collect();

    return view('opera', compact('opera', 'altreOpere'));
})->name('opera.show');

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
    // -----------------------------
    // OPERE - gestione da dashboard
    // -----------------------------
    Route::get('/dashboard/opere', [AdminController::class, 'opereIndex'])
        ->name('dashboard.opere.index');

    Route::get('/dashboard/opere/crea', [AdminController::class, 'opereCreate'])
        ->name('dashboard.opere.create');

    Route::post('/dashboard/opere', [AdminController::class, 'opereStore'])
        ->name('dashboard.opere.store');

    Route::get('/dashboard/opere/{opera}/edit', [AdminController::class, 'opereEdit'])
        ->name('dashboard.opere.edit');

    Route::put('/dashboard/opere/{opera}', [AdminController::class, 'opereUpdate'])
        ->name('dashboard.opere.update');

    Route::delete('/dashboard/opere/{opera}', [AdminController::class, 'opereDestroy'])
        ->name('dashboard.opere.destroy');

    Route::post('/dashboard/opere/{opera}/immagini', [AdminController::class, 'opereAddImmagine'])
        ->name('dashboard.opere.immagini.add');

    Route::delete('/dashboard/opere/{opera}/immagini/{immagine}', [AdminController::class, 'opereDeleteImmagine'])
        ->name('dashboard.opere.immagini.delete');

    // -----------------------------
    // COLLEZIONI - gestione da dashboard
    // -----------------------------
    Route::get('/dashboard/collezioni', [AdminController::class, 'collezioniIndex'])
        ->name('dashboard.collezioni.index');

    Route::get('/dashboard/collezioni/crea', [AdminController::class, 'collezioniCreate'])
        ->name('dashboard.collezioni.create');

    Route::post('/dashboard/collezioni', [AdminController::class, 'collezioniStore'])
        ->name('dashboard.collezioni.store');

    Route::get('/dashboard/collezioni/{collezione}/edit', [AdminController::class, 'collezioniEdit'])
        ->name('dashboard.collezioni.edit');

    Route::put('/dashboard/collezioni/{collezione}', [AdminController::class, 'collezioniUpdate'])
        ->name('dashboard.collezioni.update');

    Route::delete('/dashboard/collezioni/{collezione}', [AdminController::class, 'collezioniDestroy'])
        ->name('dashboard.collezioni.destroy');

    Route::get('/dashboard/collezioni/ordina', [AdminController::class, 'collezioniOrdina'])
        ->name('dashboard.collezioni.ordina');

    Route::post('/dashboard/collezioni/salva-ordine', [AdminController::class, 'collezioniSalvaOrdine'])
        ->name('dashboard.collezioni.salva-ordine');

    Route::post('/dashboard/collezioni/{collezione}/opere', [AdminController::class, 'collezioniAggiungiOpera'])
        ->name('dashboard.collezioni.opere.add');

    Route::delete('/dashboard/collezioni/{collezione}/opere/{opera}', [AdminController::class, 'collezioniRimuoviOpera'])
        ->name('dashboard.collezioni.opere.remove');

    // -----------------------------
    // ARTIST STATEMENT
    // -----------------------------
    Route::get('/dashboard/artist-statement', [AdminController::class, 'artistStatementEdit'])
        ->name('dashboard.artist-statement');

    Route::post('/dashboard/artist-statement', [AdminController::class, 'artistStatementUpdate'])
        ->name('dashboard.artist-statement.update');

    Route::post('/dashboard/upload-image', [AdminController::class, 'uploadImage'])
        ->name('dashboard.upload-image');

    // -----------------------------
    // FAQ
    // -----------------------------
    Route::get('/dashboard/faqs', [AdminController::class, 'faqsIndex'])
        ->name('dashboard.faqs.index');
    Route::get('/dashboard/faqs/crea', [AdminController::class, 'faqsCreate'])
        ->name('dashboard.faqs.create');
    Route::post('/dashboard/faqs', [AdminController::class, 'faqsStore'])
        ->name('dashboard.faqs.store');
    Route::get('/dashboard/faqs/{faq}/edit', [AdminController::class, 'faqsEdit'])
        ->name('dashboard.faqs.edit');
    Route::put('/dashboard/faqs/{faq}', [AdminController::class, 'faqsUpdate'])
        ->name('dashboard.faqs.update');
    Route::delete('/dashboard/faqs/{faq}', [AdminController::class, 'faqsDestroy'])
        ->name('dashboard.faqs.destroy');

    // FAQ Gift Card
    Route::get('/dashboard/faqs-gift-card', [AdminController::class, 'faqsGiftCardIndex'])
        ->name('dashboard.faqs-gift-card.index');
    Route::get('/dashboard/faqs-gift-card/crea', [AdminController::class, 'faqsGiftCardCreate'])
        ->name('dashboard.faqs-gift-card.create');
    Route::post('/dashboard/faqs-gift-card', [AdminController::class, 'faqsGiftCardStore'])
        ->name('dashboard.faqs-gift-card.store');
    Route::get('/dashboard/faqs-gift-card/{faq}/edit', [AdminController::class, 'faqsGiftCardEdit'])
        ->name('dashboard.faqs-gift-card.edit');
    Route::put('/dashboard/faqs-gift-card/{faq}', [AdminController::class, 'faqsGiftCardUpdate'])
        ->name('dashboard.faqs-gift-card.update');
    Route::delete('/dashboard/faqs-gift-card/{faq}', [AdminController::class, 'faqsGiftCardDestroy'])
        ->name('dashboard.faqs-gift-card.destroy');
});

