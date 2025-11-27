<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\Auth;

class PasswordResetController extends Controller
{
    public function showForgotPasswordForm()
{
    return view('auth.passwords.forgot');
}
// Envoi du code de réinitialisation
public function sendResetCode(Request $request)
{
    $request->validate(['email' => 'required|email|exists:users,email']);

    // Générer un code unique à 6 chiffres
    $code = random_int(100000, 999999);

    // Enregistrer le code et l'email dans la session
    $request->session()->put('password_reset_code', $code);
    $request->session()->put('password_reset_email', $request->email);

    // Envoi du code par email
    Mail::raw("Votre code de réinitialisation est : $code", function ($message) use ($request) {
        $message->to($request->email)
                ->subject('Réinitialisation de mot de passe');
    });

    return redirect()->route('password.confirm')->with('success', 'Le code a été envoyé à votre email.');
}

// Afficher le formulaire de confirmation
public function showConfirmationForm()
{
    return view('auth.passwords.confirm');
}

// Vérifier le code de réinitialisation
public function verifyResetCode(Request $request)
{
    $request->validate(['code' => 'required|numeric']);

    // Récupérer le code depuis la session
    $sessionCode = $request->session()->get('password_reset_code');
    $email = $request->session()->get('password_reset_email');

    // Vérification du code
    if ($request->code == $sessionCode) {
        return redirect()->route('password.reset.form');
    }

    return back()->withErrors(['code' => 'Le code est incorrect.']);
}

// Afficher le formulaire de réinitialisation du mot de passe
public function showResetForm()
{
    return view('auth.passwords.reset');
}

// Réinitialisation du mot de passe
public function resetPassword(Request $request)
{
    $request->validate([
        'password' => 'required|confirmed|min:8',
    ]);

    // Récupérer l'email depuis la session
    $email = $request->session()->get('password_reset_email');

    if (!$email) {
        return redirect()->route('password.request')->withErrors(['email' => 'Session expirée. Veuillez recommencer.']);
    }

    // Mettre à jour le mot de passe
    $user = User::where('email', $email)->first();
    if ($user) {
        $user->password = bcrypt($request->password);
        $user->save();

        // Supprimer les données de session
        $request->session()->forget(['password_reset_code', 'password_reset_email']);

        if (auth()->check()) {
            // L'utilisateur est connecté, redirige vers `users.index`
            return redirect()->route('users.index')->with('success', 'Vous êtes déjà connecté.');
        } else {
            // L'utilisateur n'est pas connecté, redirige vers `login`
            return redirect()->route('login')->with('success', 'Votre mot de passe a été réinitialisé.');
        }
    }

    return back()->withErrors(['email' => 'Utilisateur introuvable.']);
}

}
