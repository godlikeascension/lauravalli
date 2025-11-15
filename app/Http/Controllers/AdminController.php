<?php

namespace App\Http\Controllers;

use App\Models\Recensione;
use Illuminate\Http\Request;
use App\Models\Opera;

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
        $opere = Opera::orderBy('created_at', 'desc')->get();

        return view('dashboard.opere', compact('opere'));
    }

    public function opereCreate()
    {
        return view('dashboard.opere-create');
    }

    public function opereStore(Request $request)
    {
        $data = $request->validate([
            'immagine'      => 'nullable|image|max:4096',
            'titolo'        => 'required|string|max:255',
            'prezzo'        => 'nullable|numeric|min:0',
            'venduto'       => 'nullable|boolean',
            'larghezza_cm'  => 'nullable|numeric|min:0',
            'altezza_cm'    => 'nullable|numeric|min:0',
            'descrizione_html' => 'nullable|string',
            'commissione'   => 'nullable|boolean',
        ]);

        $pathImmagine = null;

        if ($request->hasFile('immagine')) {
            $pathImmagine = $request->file('immagine')->store('opere', 'public');
        }

        Opera::create([
            'immagine'        => $pathImmagine,
            'titolo'          => $data['titolo'],
            'prezzo'          => $data['prezzo'] ?? null,
            'venduto'         => $request->boolean('venduto'),
            'larghezza_cm'    => $data['larghezza_cm'] ?? null,
            'altezza_cm'      => $data['altezza_cm'] ?? null,
            'descrizione_html'=> $data['descrizione_html'] ?? null,
            'commissione'     => $request->boolean('commissione'),
        ]);

        return redirect()
            ->route('dashboard.opere.index')
            ->with('success', 'Opera creata con successo.');
    }

    public function opereEdit(Opera $opera)
    {
        return view('dashboard.opere-edit', compact('opera'));
    }

    public function opereUpdate(Request $request, Opera $opera)
    {
        $data = $request->validate([
            'immagine'      => 'nullable|image|max:4096',
            'titolo'        => 'required|string|max:255',
            'prezzo'        => 'nullable|numeric|min:0',
            'venduto'       => 'nullable|boolean',
            'larghezza_cm'  => 'nullable|numeric|min:0',
            'altezza_cm'    => 'nullable|numeric|min:0',
            'descrizione_html' => 'nullable|string',
            'commissione'   => 'nullable|boolean',
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
        $opera->descrizione_html = $data['descrizione_html'] ?? null;
        $opera->commissione      = $request->boolean('commissione');

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

}
