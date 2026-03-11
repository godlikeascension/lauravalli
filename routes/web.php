<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Models\Recensione;
use App\Models\Opera;
use App\Models\Collezione;
use App\Models\Faq;
use App\Models\Impostazione;

// ─────────────────────────────────────────────────────────────────────────────
// Form submissions (locale-agnostic POST routes)
// ─────────────────────────────────────────────────────────────────────────────
Route::post('/contatti', [ContactController::class, 'send'])->name('contatti.send');
Route::post('/commissioni-form', [ContactController::class, 'sendCommissione'])
    ->name('commissioni.send');
Route::post('/gift-card-form', [ContactController::class, 'sendGiftCard'])
    ->name('gift-card.send');

// ─────────────────────────────────────────────────────────────────────────────
// Public front-end pages — closures shared across locale groups
// ─────────────────────────────────────────────────────────────────────────────
$homeHandler = function () {
    $collezione = Collezione::where('is_featured', true)->with('opere')->first();
    return view('index', compact('collezione'));
};

$commissioniHandler = function () {
    $recensioni = Recensione::orderBy('created_at', 'desc')->get();
    $faqs       = Faq::where('tipo', 'commissioni')->orderBy('ordine')->orderBy('id')->get();
    return view('commissioni', compact('recensioni', 'faqs'));
};

$giftCardHandler = function () {
    $faqs = Faq::where('tipo', 'gift-card')->orderBy('ordine')->orderBy('id')->get();
    return view('gift-card', compact('faqs'));
};

$artistStatementHandler = function () {
    $locale   = App::getLocale();
    $chiave   = $locale !== 'it' ? "artist_statement_{$locale}" : 'artist_statement';
    $contenuto = Impostazione::get($chiave) ?: Impostazione::get('artist_statement');
    return view('artist-statement', compact('contenuto'));
};

$opereHandler = function () {
    $collezioni = Collezione::with('opere')->orderBy('ordine')->get();
    return view('collezioni-pubblica', compact('collezioni'));
};

$operaHandler = function (string $slug) {
    $locale = App::getLocale();

    // Find by locale slug, fallback to main slug
    $opera = null;
    if ($locale === 'en') {
        $opera = Opera::where('slug_en', $slug)->with(['immagini', 'collezione'])->first();
    } elseif ($locale === 'es') {
        $opera = Opera::where('slug_es', $slug)->with(['immagini', 'collezione'])->first();
    }
    if (!$opera) {
        $opera = Opera::where('slug', $slug)->with(['immagini', 'collezione'])->firstOrFail();
    }

    $altreOpere = $opera->collezione_id
        ? Opera::where('collezione_id', $opera->collezione_id)->where('id', '!=', $opera->id)->get()
        : collect();

    return view('opera', compact('opera', 'altreOpere'));
};

$commissioniGrazieHandler = function () {
    return view('commissioni-grazie');
};

// ─────────────────────────────────────────────────────────────────────────────
// ITALIAN routes (no prefix — existing URLs unchanged)
// ─────────────────────────────────────────────────────────────────────────────
Route::middleware('setlocale')->group(function () use (
    $homeHandler, $commissioniHandler, $giftCardHandler,
    $artistStatementHandler, $opereHandler, $operaHandler, $commissioniGrazieHandler
) {
    Route::get('/', $homeHandler)->name('home');
    Route::get('/commissioni', $commissioniHandler)->name('commissioni');
    Route::get('/gift-card', $giftCardHandler)->name('gift-card');
    Route::get('/artist-statement', $artistStatementHandler)->name('artist-statement');
    Route::get('/opere', $opereHandler)->name('collezioni.pubblica');
    Route::get('/opera/{slug}', $operaHandler)->name('opera.show');
    Route::get('/commissioni/grazie', $commissioniGrazieHandler)->name('commissioni.grazie');

    // Backward-compat redirect
    Route::redirect('/collezioni', '/opere', 301);
});

// ─────────────────────────────────────────────────────────────────────────────
// ENGLISH routes (/en/...)
// ─────────────────────────────────────────────────────────────────────────────
Route::prefix('en')->middleware('setlocale')->group(function () use (
    $homeHandler, $commissioniHandler, $giftCardHandler,
    $artistStatementHandler, $opereHandler, $operaHandler, $commissioniGrazieHandler
) {
    Route::get('/',              $homeHandler)->name('en.home');
    Route::get('/works',         $opereHandler)->name('en.collezioni.pubblica');
    Route::get('/artwork/{slug}',$operaHandler)->name('en.opera.show');
    Route::get('/commissions',   $commissioniHandler)->name('en.commissioni');
    Route::get('/gift-card',     $giftCardHandler)->name('en.gift-card');
    Route::get('/about',         $artistStatementHandler)->name('en.artist-statement');
    Route::get('/commissions/thank-you', $commissioniGrazieHandler)->name('en.commissioni.grazie');
});

// ─────────────────────────────────────────────────────────────────────────────
// SPANISH routes (/es/...)
// ─────────────────────────────────────────────────────────────────────────────
Route::prefix('es')->middleware('setlocale')->group(function () use (
    $homeHandler, $commissioniHandler, $giftCardHandler,
    $artistStatementHandler, $opereHandler, $operaHandler, $commissioniGrazieHandler
) {
    Route::get('/',              $homeHandler)->name('es.home');
    Route::get('/obras',         $opereHandler)->name('es.collezioni.pubblica');
    Route::get('/obra/{slug}',   $operaHandler)->name('es.opera.show');
    Route::get('/comisiones',    $commissioniHandler)->name('es.commissioni');
    Route::get('/gift-card',     $giftCardHandler)->name('es.gift-card');
    Route::get('/sobre-mi',      $artistStatementHandler)->name('es.artist-statement');
    Route::get('/comisiones/gracias', $commissioniGrazieHandler)->name('es.commissioni.grazie');
});

// ─────────────────────────────────────────────────────────────────────────────
// Auth
// ─────────────────────────────────────────────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─────────────────────────────────────────────────────────────────────────────
// Dashboard (protected)
// ─────────────────────────────────────────────────────────────────────────────
Route::middleware(['auth'])->group(function () {

    // RECENSIONI
    Route::get('/dashboard/recensioni', [AdminController::class, 'recensioniIndex'])->name('dashboard.recensioni');
    Route::get('/dashboard/recensioni/crea', [AdminController::class, 'recensioniCreate'])->name('dashboard.recensioni.create');
    Route::post('/dashboard/recensioni', [AdminController::class, 'recensioniStore'])->name('dashboard.recensioni.store');
    Route::get('/dashboard/recensioni/{recensione}/edit', [AdminController::class, 'recensioniEdit'])->name('dashboard.recensioni.edit');
    Route::put('/dashboard/recensioni/{recensione}', [AdminController::class, 'recensioniUpdate'])->name('dashboard.recensioni.update');
    Route::delete('/dashboard/recensioni/{recensione}', [AdminController::class, 'recensioniDestroy'])->name('dashboard.recensioni.destroy');

    // OPERE
    Route::get('/dashboard/opere', [AdminController::class, 'opereIndex'])->name('dashboard.opere.index');
    Route::get('/dashboard/opere/crea', [AdminController::class, 'opereCreate'])->name('dashboard.opere.create');
    Route::post('/dashboard/opere', [AdminController::class, 'opereStore'])->name('dashboard.opere.store');
    Route::get('/dashboard/opere/{opera}/edit', [AdminController::class, 'opereEdit'])->name('dashboard.opere.edit');
    Route::put('/dashboard/opere/{opera}', [AdminController::class, 'opereUpdate'])->name('dashboard.opere.update');
    Route::delete('/dashboard/opere/{opera}', [AdminController::class, 'opereDestroy'])->name('dashboard.opere.destroy');
    Route::post('/dashboard/opere/{opera}/immagini', [AdminController::class, 'opereAddImmagine'])->name('dashboard.opere.immagini.add');
    Route::delete('/dashboard/opere/{opera}/immagini/{immagine}', [AdminController::class, 'opereDeleteImmagine'])->name('dashboard.opere.immagini.delete');

    // COLLEZIONI
    Route::get('/dashboard/collezioni', [AdminController::class, 'collezioniIndex'])->name('dashboard.collezioni.index');
    Route::get('/dashboard/collezioni/crea', [AdminController::class, 'collezioniCreate'])->name('dashboard.collezioni.create');
    Route::post('/dashboard/collezioni', [AdminController::class, 'collezioniStore'])->name('dashboard.collezioni.store');
    Route::get('/dashboard/collezioni/{collezione}/edit', [AdminController::class, 'collezioniEdit'])->name('dashboard.collezioni.edit');
    Route::put('/dashboard/collezioni/{collezione}', [AdminController::class, 'collezioniUpdate'])->name('dashboard.collezioni.update');
    Route::delete('/dashboard/collezioni/{collezione}', [AdminController::class, 'collezioniDestroy'])->name('dashboard.collezioni.destroy');
    Route::get('/dashboard/collezioni/ordina', [AdminController::class, 'collezioniOrdina'])->name('dashboard.collezioni.ordina');
    Route::post('/dashboard/collezioni/salva-ordine', [AdminController::class, 'collezioniSalvaOrdine'])->name('dashboard.collezioni.salva-ordine');
    Route::post('/dashboard/collezioni/{collezione}/opere', [AdminController::class, 'collezioniAggiungiOpera'])->name('dashboard.collezioni.opere.add');
    Route::delete('/dashboard/collezioni/{collezione}/opere/{opera}', [AdminController::class, 'collezioniRimuoviOpera'])->name('dashboard.collezioni.opere.remove');

    // ARTIST STATEMENT
    Route::get('/dashboard/artist-statement', [AdminController::class, 'artistStatementEdit'])->name('dashboard.artist-statement');
    Route::post('/dashboard/artist-statement', [AdminController::class, 'artistStatementUpdate'])->name('dashboard.artist-statement.update');
    Route::post('/dashboard/upload-image', [AdminController::class, 'uploadImage'])->name('dashboard.upload-image');

    // FAQ COMMISSIONI
    Route::get('/dashboard/faqs', [AdminController::class, 'faqsIndex'])->name('dashboard.faqs.index');
    Route::get('/dashboard/faqs/crea', [AdminController::class, 'faqsCreate'])->name('dashboard.faqs.create');
    Route::post('/dashboard/faqs', [AdminController::class, 'faqsStore'])->name('dashboard.faqs.store');
    Route::get('/dashboard/faqs/{faq}/edit', [AdminController::class, 'faqsEdit'])->name('dashboard.faqs.edit');
    Route::put('/dashboard/faqs/{faq}', [AdminController::class, 'faqsUpdate'])->name('dashboard.faqs.update');
    Route::delete('/dashboard/faqs/{faq}', [AdminController::class, 'faqsDestroy'])->name('dashboard.faqs.destroy');

    // FAQ GIFT CARD
    Route::get('/dashboard/faqs-gift-card', [AdminController::class, 'faqsGiftCardIndex'])->name('dashboard.faqs-gift-card.index');
    Route::get('/dashboard/faqs-gift-card/crea', [AdminController::class, 'faqsGiftCardCreate'])->name('dashboard.faqs-gift-card.create');
    Route::post('/dashboard/faqs-gift-card', [AdminController::class, 'faqsGiftCardStore'])->name('dashboard.faqs-gift-card.store');
    Route::get('/dashboard/faqs-gift-card/{faq}/edit', [AdminController::class, 'faqsGiftCardEdit'])->name('dashboard.faqs-gift-card.edit');
    Route::put('/dashboard/faqs-gift-card/{faq}', [AdminController::class, 'faqsGiftCardUpdate'])->name('dashboard.faqs-gift-card.update');
    Route::delete('/dashboard/faqs-gift-card/{faq}', [AdminController::class, 'faqsGiftCardDestroy'])->name('dashboard.faqs-gift-card.destroy');

    // LINGUE
    Route::get('/dashboard/lingue', [AdminController::class, 'lingueIndex'])->name('dashboard.lingue');
    Route::post('/dashboard/lingue', [AdminController::class, 'lingueUpdate'])->name('dashboard.lingue.update');

    // TRADUZIONI PAGINE
    Route::get('/dashboard/traduzioni/{pagina}', [AdminController::class, 'traduzioniEdit'])->name('dashboard.traduzioni.edit');
    Route::post('/dashboard/traduzioni/{pagina}', [AdminController::class, 'traduzioniUpdate'])->name('dashboard.traduzioni.update');
});
