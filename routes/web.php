<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\RechargementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Auth\ForgotPasswordController;



// Afficher le formulaire pour récupérer le mot de passe



use App\Models\Feedback;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route pour la page d'accueil
// Route::get('/acceuil', [HomeController::class, 'acceuil'])->name('acceuil');



Route::get('/', function () {
    return redirect()->route('acceuil.index');
})->name('home');

// Route::get('/acceuil', function () {
//     return view('acceuil.index');
// })->name('acceuil.index');

Route::get('/users/conditions', function () {
    return view('users.conditions');
})->name('users.conditions');

Route::get('/password/forgot', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('/password/send-code', [PasswordResetController::class, 'sendResetCode'])->name('password.send-code');
Route::get('/password/confirm', [PasswordResetController::class, 'showConfirmationForm'])->name('password.confirm');
Route::post('/password/verify-code', [PasswordResetController::class, 'verifyResetCode'])->name('password.verify-code');
Route::get('/password/reset', [PasswordResetController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.reset');




Route::resource('acceuil', HomeController::class);

Route::resource('feedbacks', FeedbackController::class);
Route::resource('blogs', BlogController::class);
Route::get('/users/confirmation', [UserController::class, 'confirmation'])->name('users.confirmation');
Route::post('/users/confirmation', [UserController::class, 'verifyCode'])->name('users.verifyCode');
Route::post('verify/{code}', [UserController::class, 'verify'])->name('users.verify');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::post('/users', [UserController::class, 'store'])->name('users.store'); // Enregistrer un utilisateur



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


// Protection des routes avec le middleware 'auth'
Route::middleware('auth')->group(function () {

    // Route de déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Routes protégées par le rôle d'administrateur pour lister les utilisateurs
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/users/liste', [UserController::class, 'index2'])->name('users.liste');
        Route::get('/users/listedeleted', [UserController::class, 'index5'])->name('users.listedeleted');
        Route::get('/users/listeactivity', [UserController::class, 'index6'])->name('users.listeactivity');
        Route::get('/users/listedeblocked', [UserController::class, 'index7'])->name('users.listedeblocked');
        Route::get('/medias/liste', [MediaController::class, 'index2'])->name('medias.liste');
        Route::get('/medias/listedeleted', [MediaController::class, 'index3'])->name('medias.listedeleted');
        Route::get('/rechargements/liste', [RechargementController::class, 'index2'])->name('rechargements.liste');
        Route::get('/users/liste_', [UserController::class, 'index3'])->name('users.liste_');
        Route::get('/users/import', [UserController::class, 'index4'])->name('users.import');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/users/{user}/desactivecpt', [UserController::class, 'desactivecpt'])->name('users.desactivecpt');
        Route::post('/users/{user}/activecpt', [UserController::class, 'activecpt'])->name('users.activecpt');
        // Route::resource('blogs', BlogController::class)->except(['index', 'show']);
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Suppression
    });

    // Routes pour les actions utilisateur (changements de mot de passe, profil, désactivation/activation de compte, déblocage de profil)
    Route::post('/filter-users', [UserController::class, 'filterUsers'])->name('filter.users');
    Route::post('/users/{user}/changepass', [UserController::class, 'changepass'])->name('users.changepass');
    Route::post('/users/{user}/changeprofil', [UserController::class, 'changeprofil'])->name('users.changeprofil');
    Route::post('/users/{id}/deblocage', [UserController::class, 'deblocage'])->name('users.deblocage');
    Route::delete('users/{id}/destroydeblocked', [UserController::class, 'destroydeblocked'])->name('users.destroydeblocked');
    Route::post('/rechargements/operation', [RechargementController::class, 'operation'])->name('rechargements.operation');
    Route::get('/rechargement', [RechargementController::class, 'index'])->name('rechargements.index');
    Route::post('/initiate-payment', [RechargementController::class, 'initiatePayment'])->name('rechargements.initiatePayment');
    Route::get('/payment-success', [RechargementController::class, 'success'])->name('rechargements.success');
    Route::get('/payment-error', [RechargementController::class, 'error'])->name('rechargements.error');

    Route::post('/rechargements/initiate-payment', [RechargementController::class, 'initiatePayment'])->name('rechargements.initiatePayment');
    Route::post('/rechargements/verify-payment', [RechargementController::class, 'verifyPayment'])->name('rechargements.verifyPayment');


    Route::resource('rechargements', RechargementController::class);
    Route::resource('medias', MediaController::class);

    // Routes pour UserController avec les méthodes explicites
    Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Liste des utilisateurs
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show'); // Afficher un utilisateur
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // Formulaire de modification
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update'); // Mise à jour complète
    Route::patch('/users/{user}', [UserController::class, 'update']); // Mise à jour partielle


});





