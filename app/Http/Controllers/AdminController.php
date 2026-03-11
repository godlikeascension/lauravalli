<?php

namespace App\Http\Controllers;

use App\Models\Recensione;
use Illuminate\Http\Request;
use App\Models\Opera;
use App\Models\Collezione;
use App\Models\Faq;
use App\Models\Impostazione;
use App\Models\OperaImmagine;
use App\Models\TraduzionePagina;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // LISTA RECENSIONI
    public function recensioniIndex()
    {
        $recensioni = Recensione::orderBy('created_at', 'desc')->get();

        // La view sarà resources/views/dashboard/recensioni.blade.php
        return view('dashboard.recensioni', compact('recensioni'));
    }

    // FORM CREAZIONE
    public function recensioniCreate()
    {
        // resources/views/dashboard/recensioni-create.blade.php
        return view('dashboard.recensioni-create');
    }

    // SALVATAGGIO NUOVA RECENSIONE
    public function recensioniStore(Request $request)
    {
        $data = $request->validate([
            'immagine'  => 'nullable|image|max:2048',
            'testo'     => 'required|string',
            'testo_en'  => 'nullable|string',
            'testo_es'  => 'nullable|string',
            'nome'      => 'required|string|max:255',
        ]);

        $pathImmagine = null;

        if ($request->hasFile('immagine')) {
            $pathImmagine = $request->file('immagine')->store('recensioni', 'public');
        }

        Recensione::create([
            'immagine'  => $pathImmagine,
            'testo'     => $data['testo'],
            'testo_en'  => $data['testo_en'] ?? null,
            'testo_es'  => $data['testo_es'] ?? null,
            'nome'      => $data['nome'],
        ]);

        return redirect()
            ->route('dashboard.recensioni')
            ->with('success', 'Recensione creata con successo.');
    }

    // FORM MODIFICA
    public function recensioniEdit(Recensione $recensione)
    {
        // resources/views/dashboard/recensioni-edit.blade.php
        return view('dashboard.recensioni-edit', compact('recensione'));
    }

    // AGGIORNAMENTO
    public function recensioniUpdate(Request $request, Recensione $recensione)
    {
        $data = $request->validate([
            'immagine'  => 'nullable|image|max:2048',
            'testo'     => 'required|string',
            'testo_en'  => 'nullable|string',
            'testo_es'  => 'nullable|string',
            'nome'      => 'required|string|max:255',
        ]);

        if ($request->hasFile('immagine')) {
            $pathImmagine = $request->file('immagine')->store('recensioni', 'public');
            $recensione->immagine = $pathImmagine;
        }

        $recensione->testo    = $data['testo'];
        $recensione->testo_en = $data['testo_en'] ?? null;
        $recensione->testo_es = $data['testo_es'] ?? null;
        $recensione->nome     = $data['nome'];
        $recensione->save();

        return redirect()
            ->route('dashboard.recensioni')
            ->with('success', 'Recensione aggiornata con successo.');
    }

    // ELIMINAZIONE
    public function recensioniDestroy(Recensione $recensione)
    {
        $recensione->delete();

        return redirect()
            ->route('dashboard.recensioni')
            ->with('success', 'Recensione eliminata con successo.');
    }
    // =============================
// OPERE - Dashboard
// =============================

    public function opereIndex()
    {
        $opere = Opera::with('collezione')->orderBy('created_at', 'desc')->get();
        $collezioni = Collezione::orderBy('nome')->get();

        return view('dashboard.opere', compact('opere', 'collezioni'));
    }

    public function opereCreate()
    {
        $collezioni = Collezione::orderBy('nome')->get();

        return view('dashboard.opere-create', compact('collezioni'));
    }

    public function opereStore(Request $request)
    {
        $data = $request->validate([
            'immagine'            => 'nullable|image|max:4096',
            'titolo'              => 'required|string|max:255',
            'titolo_en'           => 'nullable|string|max:255',
            'titolo_es'           => 'nullable|string|max:255',
            'prezzo'              => 'nullable|numeric|min:0',
            'venduto'             => 'nullable|boolean',
            'larghezza_cm'        => 'nullable|numeric|min:0',
            'altezza_cm'          => 'nullable|numeric|min:0',
            'opera_type'          => 'nullable|in:Olio su tela,Olio su legno,Olio su carta 300g',
            'year'                => 'nullable|integer|min:1800|max:2100',
            'descrizione_html'    => 'nullable|string',
            'descrizione_html_en' => 'nullable|string',
            'descrizione_html_es' => 'nullable|string',
            'commissione'         => 'nullable|boolean',
            'collezione_id'       => 'nullable|exists:collezioni,id',
        ]);

        $pathImmagine = null;

        if ($request->hasFile('immagine')) {
            $pathImmagine = $request->file('immagine')->store('opere', 'public');
        }

        Opera::create([
            'immagine'            => $pathImmagine,
            'titolo'              => $data['titolo'],
            'titolo_en'           => $data['titolo_en'] ?? null,
            'titolo_es'           => $data['titolo_es'] ?? null,
            'prezzo'              => $data['prezzo'] ?? null,
            'venduto'             => $request->boolean('venduto'),
            'larghezza_cm'        => $data['larghezza_cm'] ?? null,
            'altezza_cm'          => $data['altezza_cm'] ?? null,
            'opera_type'          => $data['opera_type'] ?? null,
            'year'                => $data['year'] ?? null,
            'descrizione_html'    => $data['descrizione_html'] ?? null,
            'descrizione_html_en' => $data['descrizione_html_en'] ?? null,
            'descrizione_html_es' => $data['descrizione_html_es'] ?? null,
            'commissione'         => $request->boolean('commissione'),
            'collezione_id'       => $data['collezione_id'] ?? null,
        ]);

        return redirect()
            ->route('dashboard.opere.index')
            ->with('success', 'Opera creata con successo.');
    }

    public function opereEdit(Opera $opera)
    {
        $opera->load('immagini');
        $collezioni = Collezione::orderBy('nome')->get();

        return view('dashboard.opere-edit', compact('opera', 'collezioni'));
    }

    public function opereAddImmagine(Request $request, Opera $opera)
    {
        if ($opera->immagini()->count() >= 8) {
            return response()->json(['error' => 'Massimo 8 immagini aggiuntive raggiunto.'], 422);
        }

        $request->validate(['immagine' => 'required|image|max:4096']);

        $path = $request->file('immagine')->store('opere', 'public');
        $immagine = $opera->immagini()->create(['path' => $path]);

        return response()->json([
            'id'  => $immagine->id,
            'url' => asset('storage/' . $path),
        ]);
    }

    public function opereDeleteImmagine(Opera $opera, OperaImmagine $immagine)
    {
        if ((int) $immagine->opera_id !== (int) $opera->id) {
            abort(403);
        }

        Storage::disk('public')->delete($immagine->path);
        $immagine->delete();

        return response()->json(['ok' => true]);
    }

    public function opereUpdate(Request $request, Opera $opera)
    {
        $data = $request->validate([
            'immagine'            => 'nullable|image|max:4096',
            'titolo'              => 'required|string|max:255',
            'titolo_en'           => 'nullable|string|max:255',
            'titolo_es'           => 'nullable|string|max:255',
            'prezzo'              => 'nullable|numeric|min:0',
            'venduto'             => 'nullable|boolean',
            'larghezza_cm'        => 'nullable|numeric|min:0',
            'altezza_cm'          => 'nullable|numeric|min:0',
            'opera_type'          => 'nullable|in:Olio su tela,Olio su legno,Olio su carta 300g',
            'year'                => 'nullable|integer|min:1800|max:2100',
            'descrizione_html'    => 'nullable|string',
            'descrizione_html_en' => 'nullable|string',
            'descrizione_html_es' => 'nullable|string',
            'commissione'         => 'nullable|boolean',
            'collezione_id'       => 'nullable|exists:collezioni,id',
        ]);

        if ($request->hasFile('immagine')) {
            $pathImmagine = $request->file('immagine')->store('opere', 'public');
            $opera->immagine = $pathImmagine;
        }

        $opera->titolo              = $data['titolo'];
        $opera->titolo_en           = $data['titolo_en'] ?? null;
        $opera->titolo_es           = $data['titolo_es'] ?? null;
        $opera->prezzo              = $data['prezzo'] ?? null;
        $opera->venduto             = $request->boolean('venduto');
        $opera->larghezza_cm        = $data['larghezza_cm'] ?? null;
        $opera->altezza_cm          = $data['altezza_cm'] ?? null;
        $opera->opera_type          = $data['opera_type'] ?? null;
        $opera->year                = $data['year'] ?? null;
        $opera->descrizione_html    = $data['descrizione_html'] ?? null;
        $opera->descrizione_html_en = $data['descrizione_html_en'] ?? null;
        $opera->descrizione_html_es = $data['descrizione_html_es'] ?? null;
        $opera->commissione         = $request->boolean('commissione');
        $opera->collezione_id       = $data['collezione_id'] ?? null;

        $opera->save();

        return redirect()
            ->route('dashboard.opere.index')
            ->with('success', 'Opera aggiornata con successo.');
    }

    public function opereDestroy(Opera $opera)
    {
        $opera->delete();

        return redirect()
            ->route('dashboard.opere.index')
            ->with('success', 'Opera eliminata con successo.');
    }

    // =============================
    // COLLEZIONI - Dashboard
    // =============================

    public function collezioniIndex()
    {
        $collezioni = Collezione::orderBy('ordine')->get();

        return view('dashboard.collezioni', compact('collezioni'));
    }

    public function collezioniOrdina()
    {
        $collezioni = Collezione::orderBy('ordine')->get();

        return view('dashboard.collezioni-ordina', compact('collezioni'));
    }

    public function collezioniSalvaOrdine(Request $request)
    {
        $data = $request->validate([
            'ordine'   => 'required|array',
            'ordine.*' => 'integer|exists:collezioni,id',
        ]);

        foreach ($data['ordine'] as $position => $id) {
            \Illuminate\Support\Facades\DB::table('collezioni')
                ->where('id', $id)
                ->update(['ordine' => $position + 1]);
        }

        return response()->json(['success' => true]);
    }

    public function collezioniCreate()
    {
        return view('dashboard.collezioni-create');
    }

    public function collezioniStore(Request $request)
    {
        $data = $request->validate([
            'nome'           => 'required|string|max:255',
            'nome_en'        => 'nullable|string|max:255',
            'nome_es'        => 'nullable|string|max:255',
            'descrizione'    => 'nullable|string',
            'descrizione_en' => 'nullable|string',
            'descrizione_es' => 'nullable|string',
            'is_featured'    => 'nullable|boolean',
        ]);

        $maxOrdine = \Illuminate\Support\Facades\DB::table('collezioni')->max('ordine') ?? 0;

        $collezione = Collezione::create([
            'nome'           => $data['nome'],
            'nome_en'        => $data['nome_en'] ?? null,
            'nome_es'        => $data['nome_es'] ?? null,
            'descrizione'    => $data['descrizione'] ?? null,
            'descrizione_en' => $data['descrizione_en'] ?? null,
            'descrizione_es' => $data['descrizione_es'] ?? null,
            'is_featured'    => false,
            'ordine'         => $maxOrdine + 1,
        ]);

        if ($request->boolean('is_featured')) {
            Collezione::setFeatured($collezione->id);
        }

        return redirect()
            ->route('dashboard.collezioni.index')
            ->with('success', 'Collezione creata con successo.');
    }

    public function collezioniEdit(Collezione $collezione)
    {
        $collezione->load('opere');

        $opereDisponibili = Opera::with('collezione')
            ->where(function ($q) use ($collezione) {
                $q->whereNull('collezione_id')
                  ->orWhere('collezione_id', '!=', $collezione->id);
            })->orderBy('titolo')->get();

        return view('dashboard.collezioni-edit', compact('collezione', 'opereDisponibili'));
    }

    public function collezioniAggiungiOpera(Request $request, Collezione $collezione)
    {
        $data = $request->validate(['opera_id' => 'required|exists:opere,id']);

        Opera::where('id', $data['opera_id'])->update(['collezione_id' => $collezione->id]);

        return redirect()
            ->route('dashboard.collezioni.edit', $collezione->id)
            ->with('success', 'Opera aggiunta alla collezione.');
    }

    public function collezioniRimuoviOpera(Collezione $collezione, Opera $opera)
    {
        $opera->collezione_id = null;
        $opera->save();

        return redirect()
            ->route('dashboard.collezioni.edit', $collezione->id)
            ->with('success', 'Opera rimossa dalla collezione.');
    }

    public function collezioniUpdate(Request $request, Collezione $collezione)
    {
        $data = $request->validate([
            'nome'           => 'required|string|max:255',
            'nome_en'        => 'nullable|string|max:255',
            'nome_es'        => 'nullable|string|max:255',
            'descrizione'    => 'nullable|string',
            'descrizione_en' => 'nullable|string',
            'descrizione_es' => 'nullable|string',
            'is_featured'    => 'nullable|boolean',
        ]);

        $collezione->nome           = $data['nome'];
        $collezione->nome_en        = $data['nome_en'] ?? null;
        $collezione->nome_es        = $data['nome_es'] ?? null;
        $collezione->descrizione    = $data['descrizione'] ?? null;
        $collezione->descrizione_en = $data['descrizione_en'] ?? null;
        $collezione->descrizione_es = $data['descrizione_es'] ?? null;
        $collezione->save();

        if ($request->boolean('is_featured')) {
            // Imposta questa come featured e rimuove il flag da tutte le altre
            Collezione::setFeatured($collezione->id);
        } else {
            \Illuminate\Support\Facades\DB::table('collezioni')
                ->where('id', $collezione->id)
                ->update(['is_featured' => false]);
        }

        return redirect()
            ->route('dashboard.collezioni.index')
            ->with('success', 'Collezione aggiornata con successo.');
    }

    public function collezioniDestroy(Collezione $collezione)
    {
        $collezione->delete();

        return redirect()
            ->route('dashboard.collezioni.index')
            ->with('success', 'Collezione eliminata con successo.');
    }

    // ── ARTIST STATEMENT ──────────────────────────────────────────────────────

    public function artistStatementEdit()
    {
        $contenuto    = Impostazione::get('artist_statement');
        $contenuto_en = Impostazione::get('artist_statement_en');
        $contenuto_es = Impostazione::get('artist_statement_es');
        return view('dashboard.artist-statement', compact('contenuto', 'contenuto_en', 'contenuto_es'));
    }

    public function artistStatementUpdate(Request $request)
    {
        $request->validate([
            'contenuto'    => 'nullable|string',
            'contenuto_en' => 'nullable|string',
            'contenuto_es' => 'nullable|string',
        ]);
        Impostazione::set('artist_statement',    $request->input('contenuto'));
        Impostazione::set('artist_statement_en', $request->input('contenuto_en'));
        Impostazione::set('artist_statement_es', $request->input('contenuto_es'));

        return back()->with('success', 'Artist statement aggiornato con successo.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate(['upload' => 'required|image|max:10240']);

        $path = $request->file('upload')->store('artist-statement', 'public');

        return response()->json(['url' => asset('storage/' . $path)]);
    }

    // -----------------------------
    // FAQ CRUD
    // -----------------------------
    public function faqsIndex()
    {
        $faqs = Faq::where('tipo', 'commissioni')->orderBy('ordine')->orderBy('id')->get();
        return view('dashboard.faqs', compact('faqs'));
    }

    public function faqsCreate()
    {
        return view('dashboard.faqs-create');
    }

    public function faqsStore(Request $request)
    {
        $data = $request->validate([
            'domanda'          => 'required|string|max:255',
            'risposta_html'    => 'required|string',
            'ordine'           => 'nullable|integer|min:0',
            'domanda_en'       => 'nullable|string|max:255',
            'domanda_es'       => 'nullable|string|max:255',
            'risposta_html_en' => 'nullable|string',
            'risposta_html_es' => 'nullable|string',
        ]);

        Faq::create([
            'domanda'          => $data['domanda'],
            'risposta_html'    => $data['risposta_html'],
            'ordine'           => $data['ordine'] ?? 0,
            'tipo'             => 'commissioni',
            'domanda_en'       => $data['domanda_en'] ?? null,
            'domanda_es'       => $data['domanda_es'] ?? null,
            'risposta_html_en' => $data['risposta_html_en'] ?? null,
            'risposta_html_es' => $data['risposta_html_es'] ?? null,
        ]);

        return redirect()->route('dashboard.faqs.index')
            ->with('success', 'FAQ creata con successo.');
    }

    public function faqsEdit(Faq $faq)
    {
        return view('dashboard.faqs-edit', compact('faq'));
    }

    public function faqsUpdate(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'domanda'          => 'required|string|max:255',
            'risposta_html'    => 'required|string',
            'ordine'           => 'nullable|integer|min:0',
            'domanda_en'       => 'nullable|string|max:255',
            'domanda_es'       => 'nullable|string|max:255',
            'risposta_html_en' => 'nullable|string',
            'risposta_html_es' => 'nullable|string',
        ]);

        $faq->domanda          = $data['domanda'];
        $faq->risposta_html    = $data['risposta_html'];
        $faq->ordine           = $data['ordine'] ?? 0;
        $faq->domanda_en       = $data['domanda_en'] ?? null;
        $faq->domanda_es       = $data['domanda_es'] ?? null;
        $faq->risposta_html_en = $data['risposta_html_en'] ?? null;
        $faq->risposta_html_es = $data['risposta_html_es'] ?? null;
        $faq->save();

        return redirect()->route('dashboard.faqs.index')
            ->with('success', 'FAQ aggiornata con successo.');
    }

    public function faqsDestroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('dashboard.faqs.index')
            ->with('success', 'FAQ eliminata.');
    }

    // -----------------------------
    // FAQ Gift Card CRUD
    // -----------------------------
    public function faqsGiftCardIndex()
    {
        $faqs = Faq::where('tipo', 'gift-card')->orderBy('ordine')->orderBy('id')->get();
        return view('dashboard.faqs-gift-card', compact('faqs'));
    }

    public function faqsGiftCardCreate()
    {
        return view('dashboard.faqs-gift-card-create');
    }

    public function faqsGiftCardStore(Request $request)
    {
        $data = $request->validate([
            'domanda'          => 'required|string|max:255',
            'risposta_html'    => 'required|string',
            'ordine'           => 'nullable|integer|min:0',
            'domanda_en'       => 'nullable|string|max:255',
            'domanda_es'       => 'nullable|string|max:255',
            'risposta_html_en' => 'nullable|string',
            'risposta_html_es' => 'nullable|string',
        ]);

        Faq::create([
            'domanda'          => $data['domanda'],
            'risposta_html'    => $data['risposta_html'],
            'ordine'           => $data['ordine'] ?? 0,
            'tipo'             => 'gift-card',
            'domanda_en'       => $data['domanda_en'] ?? null,
            'domanda_es'       => $data['domanda_es'] ?? null,
            'risposta_html_en' => $data['risposta_html_en'] ?? null,
            'risposta_html_es' => $data['risposta_html_es'] ?? null,
        ]);

        return redirect()->route('dashboard.faqs-gift-card.index')
            ->with('success', 'FAQ creata con successo.');
    }

    public function faqsGiftCardEdit(Faq $faq)
    {
        return view('dashboard.faqs-gift-card-edit', compact('faq'));
    }

    public function faqsGiftCardUpdate(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'domanda'          => 'required|string|max:255',
            'risposta_html'    => 'required|string',
            'ordine'           => 'nullable|integer|min:0',
            'domanda_en'       => 'nullable|string|max:255',
            'domanda_es'       => 'nullable|string|max:255',
            'risposta_html_en' => 'nullable|string',
            'risposta_html_es' => 'nullable|string',
        ]);

        $faq->domanda          = $data['domanda'];
        $faq->risposta_html    = $data['risposta_html'];
        $faq->ordine           = $data['ordine'] ?? 0;
        $faq->domanda_en       = $data['domanda_en'] ?? null;
        $faq->domanda_es       = $data['domanda_es'] ?? null;
        $faq->risposta_html_en = $data['risposta_html_en'] ?? null;
        $faq->risposta_html_es = $data['risposta_html_es'] ?? null;
        $faq->save();

        return redirect()->route('dashboard.faqs-gift-card.index')
            ->with('success', 'FAQ aggiornata con successo.');
    }

    public function faqsGiftCardDestroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('dashboard.faqs-gift-card.index')
            ->with('success', 'FAQ eliminata.');
    }

    // -----------------------------
    // LINGUE
    // -----------------------------
    public function lingueIndex()
    {
        $lingua_en = Impostazione::get('lingua_en_attiva', '0');
        $lingua_es = Impostazione::get('lingua_es_attiva', '0');
        return view('dashboard.lingue', compact('lingua_en', 'lingua_es'));
    }

    public function lingueUpdate(Request $request)
    {
        Impostazione::set('lingua_en_attiva', $request->has('lingua_en') ? '1' : '0');
        Impostazione::set('lingua_es_attiva', $request->has('lingua_es') ? '1' : '0');
        return back()->with('success', 'Impostazioni lingue aggiornate.');
    }

    // -----------------------------
    // TRADUZIONI PAGINE
    // -----------------------------
    public function traduzioniEdit(string $pagina)
    {
        $righe = TraduzionePagina::where('pagina', $pagina)->orderBy('chiave')->get();
        return view('dashboard.traduzioni-pagine', compact('pagina', 'righe'));
    }

    public function traduzioniUpdate(Request $request, string $pagina)
    {
        $data = $request->validate(['traduzioni' => 'nullable|array']);
        $traduzioni = $data['traduzioni'] ?? [];

        foreach ($traduzioni as $chiave => $valori) {
            TraduzionePagina::updateOrCreate(
                ['pagina' => $pagina, 'chiave' => $chiave],
                [
                    'it' => $valori['it'] ?? null,
                    'en' => $valori['en'] ?? null,
                    'es' => $valori['es'] ?? null,
                ]
            );
        }

        return back()->with('success', 'Traduzioni salvate.');
    }

}
