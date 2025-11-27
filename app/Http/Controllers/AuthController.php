<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserActivity;


class AuthController extends Controller
{
    
    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Gère la requête de connexion
    public function login(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tentative d'authentification de l'utilisateur
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Prévention contre les attaques de fixation de session

            // Enregistrement de l'activité de connexion
            UserActivity::create([
                'user_id' => Auth::id(),
                'activity_type' => 'login',
                'activity_time' => now(),
            ]);

            // Redirection en fonction du rôle de l'utilisateur
            $user = Auth::user();
            return match ($user->role) {
                'admin' => redirect()->route('dashboard')->with('success', 'Bienvenue, administrateur!'),
                'user' => redirect()->intended('/users')->with('success', 'Vous êtes maintenant connecté.'),
                default => redirect()->route('home')->with('success', 'Vous êtes maintenant connecté.'),
            };
        }

        // Si l'authentification échoue, rediriger avec une erreur
        return back()->withErrors(['email' => 'Les identifiants fournis sont incorrects.']);
    }

    // Gère la requête de déconnexion
    public function logout(Request $request)
    {
        // Enregistrement de l'activité de déconnexion avant la déconnexion de l'utilisateur
        UserActivity::create([
            'user_id' => Auth::id(),
            'activity_type' => 'logout',
            'activity_time' => now(),
        ]);

        Auth::logout(); // Déconnexion de l'utilisateur
        $request->session()->invalidate(); // Invalidation de la session
        $request->session()->regenerateToken(); // Régénération du token CSRF

        // Redirection vers la page souhaitée après déconnexion
        return redirect()->route('home')->with('success', 'Vous vous êtes déconnecté.');
    }
}
