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
}
