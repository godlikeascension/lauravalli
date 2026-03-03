<?php

namespace App\Http\Controllers;

use App\Models\Recensione;
use Illuminate\Http\Request;
use App\Models\Opera;
use App\Models\Collezione;
use App\Models\Faq;
use App\Models\Impostazione;
use App\Models\OperaImmagine;
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
            'immagine' => 'nullable|image|max:2048',
            'testo'    => 'required|string',
            'nome'     => 'required|string|max:255',
        ]);

        $pathImmagine = null;

        if ($request->hasFile('immagine')) {
            $pathImmagine = $request->file('immagine')->store('recensioni', 'public');
        }

        Recensione::create([
            'immagine' => $pathImmagine,
            'testo'    => $data['testo'],
            'nome'     => $data['nome'],
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
            'immagine' => 'nullable|image|max:2048',
            'testo'    => 'required|string',
            'nome'     => 'required|string|max:255',
        ]);

        if ($request->hasFile('immagine')) {
            $pathImmagine = $request->file('immagine')->store('recensioni', 'public');
            $recensione->immagine = $pathImmagine;
        }

        $recensione->testo = $data['testo'];
        $recensione->nome  = $data['nome'];
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
            'immagine'         => 'nullable|image|max:4096',
            'titolo'           => 'required|string|max:255',
            'prezzo'           => 'nullable|numeric|min:0',
            'venduto'          => 'nullable|boolean',
            'larghezza_cm'     => 'nullable|numeric|min:0',
            'altezza_cm'       => 'nullable|numeric|min:0',
            'opera_type'       => 'nullable|in:Olio su tela,Olio su legno,Olio su carta 300g',
            'year'             => 'nullable|integer|min:1800|max:2100',
            'descrizione_html' => 'nullable|string',
            'commissione'      => 'nullable|boolean',
            'collezione_id'    => 'nullable|exists:collezioni,id',
        ]);

        $pathImmagine = null;

        if ($request->hasFile('immagine')) {
            $pathImmagine = $request->file('immagine')->store('opere', 'public');
        }

        Opera::create([
            'immagine'         => $pathImmagine,
            'titolo'           => $data['titolo'],
            'prezzo'           => $data['prezzo'] ?? null,
            'venduto'          => $request->boolean('venduto'),
            'larghezza_cm'     => $data['larghezza_cm'] ?? null,
            'altezza_cm'       => $data['altezza_cm'] ?? null,
            'opera_type'       => $data['opera_type'] ?? null,
            'year'             => $data['year'] ?? null,
            'descrizione_html' => $data['descrizione_html'] ?? null,
            'commissione'      => $request->boolean('commissione'),
            'collezione_id'    => $data['collezione_id'] ?? null,
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
            'immagine'         => 'nullable|image|max:4096',
            'titolo'           => 'required|string|max:255',
            'prezzo'           => 'nullable|numeric|min:0',
            'venduto'          => 'nullable|boolean',
            'larghezza_cm'     => 'nullable|numeric|min:0',
            'altezza_cm'       => 'nullable|numeric|min:0',
            'opera_type'       => 'nullable|in:Olio su tela,Olio su legno,Olio su carta 300g',
            'year'             => 'nullable|integer|min:1800|max:2100',
            'descrizione_html' => 'nullable|string',
            'commissione'      => 'nullable|boolean',
            'collezione_id'    => 'nullable|exists:collezioni,id',
        ]);

        if ($request->hasFile('immagine')) {
            $pathImmagine = $request->file('immagine')->store('opere', 'public');
            $opera->immagine = $pathImmagine;
        }

        $opera->titolo           = $data['titolo'];
        $opera->prezzo           = $data['prezzo'] ?? null;
        $opera->venduto          = $request->boolean('venduto');
        $opera->larghezza_cm     = $data['larghezza_cm'] ?? null;
        $opera->altezza_cm       = $data['altezza_cm'] ?? null;
        $opera->opera_type       = $data['opera_type'] ?? null;
        $opera->year             = $data['year'] ?? null;
        $opera->descrizione_html = $data['descrizione_html'] ?? null;
        $opera->commissione      = $request->boolean('commissione');
        $opera->collezione_id    = $data['collezione_id'] ?? null;

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
        $collezioni = Collezione::orderBy('created_at', 'desc')->get();

        return view('dashboard.collezioni', compact('collezioni'));
    }

    public function collezioniCreate()
    {
        return view('dashboard.collezioni-create');
    }

    public function collezioniStore(Request $request)
    {
        $data = $request->validate([
            'nome'        => 'required|string|max:255',
            'descrizione' => 'nullable|string',
            'is_default'  => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $collezione = Collezione::create([
            'nome'        => $data['nome'],
            'descrizione' => $data['descrizione'] ?? null,
            'is_default'  => false,
            'is_featured' => false,
        ]);

        if ($request->boolean('is_default')) {
            Collezione::setDefault($collezione->id);
        }

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
            'nome'        => 'required|string|max:255',
            'descrizione' => 'nullable|string',
            'is_default'  => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $collezione->nome        = $data['nome'];
        $collezione->descrizione = $data['descrizione'] ?? null;
        $collezione->save();

        if ($request->boolean('is_default')) {
            // Imposta questa come default e rimuove il flag da tutte le altre
            Collezione::setDefault($collezione->id);
        } else {
            \Illuminate\Support\Facades\DB::table('collezioni')
                ->where('id', $collezione->id)
                ->update(['is_default' => false]);
        }

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
        $contenuto = Impostazione::get('artist_statement');
        return view('dashboard.artist-statement', compact('contenuto'));
    }

    public function artistStatementUpdate(Request $request)
    {
        $request->validate(['contenuto' => 'nullable|string']);
        Impostazione::set('artist_statement', $request->input('contenuto'));

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
        $faqs = Faq::orderBy('ordine')->orderBy('id')->get();
        return view('dashboard.faqs', compact('faqs'));
    }

    public function faqsCreate()
    {
        return view('dashboard.faqs-create');
    }

    public function faqsStore(Request $request)
    {
        $data = $request->validate([
            'domanda'      => 'required|string|max:255',
            'risposta_html' => 'required|string',
            'ordine'       => 'nullable|integer|min:0',
        ]);

        Faq::create([
            'domanda'      => $data['domanda'],
            'risposta_html' => $data['risposta_html'],
            'ordine'       => $data['ordine'] ?? 0,
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
            'domanda'      => 'required|string|max:255',
            'risposta_html' => 'required|string',
            'ordine'       => 'nullable|integer|min:0',
        ]);

        $faq->domanda       = $data['domanda'];
        $faq->risposta_html = $data['risposta_html'];
        $faq->ordine        = $data['ordine'] ?? 0;
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

}
