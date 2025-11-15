<?php

namespace App\Http\Controllers;

use App\Models\Recensione;
use Illuminate\Http\Request;

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
}
