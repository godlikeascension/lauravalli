<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // validazione
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:30',
            'comment' => 'required|string',
        ]);

        // invio mail
        Mail::raw(
            "Hai ricevuto un nuovo messaggio dal sito.\n\n".
            "Nome: {$validated['name']}\n".
            "Email: {$validated['email']}\n".
            "Telefono: ".($validated['phone'] ?? '—')."\n".
            "Messaggio:\n{$validated['comment']}",
            function($message) {
                $message->to('lauravalliart@gmail.com')
                    ->subject('Nuovo messaggio dal form di contatto');
            }
        );

        return back()->with('success', 'Messaggio inviato con successo!');
    }
    public function sendCommissione(Request $request)
    {
        $data = $request->validate([
            'trasmettere'  => 'required',
            'raffigurare'  => 'required',
            'colori'       => 'required',
            'destinazione' => 'required',
            'motivo'       => 'required',
            'nome'         => 'required|string',
            'telefono'     => 'required|string',
            'email'        => 'required|email',
            'messaggio'    => 'nullable|string',
        ]);

        // indirizzo email a cui inviare la richiesta di commissione
        $toEmail = 'lauravalliart@gmail.com'; // CAMBIA con l'email dell'artista

        Mail::send('emails.commissione', ['data' => $data], function ($message) use ($toEmail, $data) {
            $message->to($toEmail)
                ->replyTo($data['email'], $data['nome'])
                ->subject('Nuova richiesta opera su commissione');
        });

        $locale = $request->input('_locale', 'it');
        $routeName = in_array($locale, ['en', 'es']) ? "{$locale}.commissioni.grazie" : 'commissioni.grazie';
        return redirect()->route($routeName);
    }

    public function sendGiftCard(Request $request)
    {
        $data = $request->validate([
            'nome'      => 'required|string|max:255',
            'email'     => 'required|email',
            'telefono'  => 'required|string|max:30',
            'valore'    => 'required|string',
            'messaggio' => 'nullable|string',
        ]);

        Mail::send('emails.gift-card', ['data' => $data], function ($message) use ($data) {
            $message->to('lauravalliart@gmail.com')
                ->replyTo($data['email'], $data['nome'])
                ->subject('Nuova richiesta Gift Card');
        });

        return response()->json(['success' => true]);
    }

}
