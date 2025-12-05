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
            'comment' => 'required|string',
        ]);

        // invio mail
        Mail::raw(
            "Hai ricevuto un nuovo messaggio dal sito.\n\n".
            "Nome: {$validated['name']}\n".
            "Email: {$validated['email']}\n".
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
        ]);

        // indirizzo email a cui inviare la richiesta di commissione
        $toEmail = 'luca.deirossi91@gmail.com'; // CAMBIA con l'email dell'artista

        Mail::send('emails.commissione', ['data' => $data], function ($message) use ($toEmail, $data) {
            $message->to($toEmail)
                ->replyTo($data['email'], $data['nome'])
                ->subject('Nuova richiesta opera su commissione');
        });

        return back()->with('success', 'La tua richiesta è stata inviata con successo. Ti risponderò al più presto.');
    }

}
