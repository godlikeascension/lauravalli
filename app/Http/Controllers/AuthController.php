<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostra il form di login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Gestisce la richiesta di login
    public function login(Request $request)
    {
        // Validazione dei dati in ingresso
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tentativo di autenticazione
        if (Auth::attempt($credentials)) {
            // Rigenera la sessione per prevenire fixation attack
            $request->session()->regenerate();

            // Reindirizza l'utente alla dashboard o alla pagina desiderata
            return redirect()->intended(route('dashboard.recensioni'));
        }

        // In caso di errore, si ritorna al form con messaggi di errore
        return back()->withErrors([
            'email' => 'Le credenziali fornite non corrispondono ai nostri record.',
        ])->onlyInput('email');
    }

    // Mostra il form di registrazione
    public function showRegistrationForm()
    {
        return view('auth.registration');
    }

    // Gestisce la registrazione di un nuovo utente
    public function register(Request $request)
    {
        // Validazione dei dati in ingresso
        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'max:255', 'unique:users'],
            'password'              => ['required', 'confirmed', 'min:8'],
        ]);

        // Creazione dell'utente
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Login automatico dopo la registrazione
        Auth::login($user);

        // Reindirizza alla dashboard o alla pagina desiderata
        return redirect()->intended(route('dashboard.recensioni'));
    }

    // Gestisce il logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalida la sessione corrente e rigenera il token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Reindirizza alla homepage o al form di login
        return redirect('/login');

    }
}
