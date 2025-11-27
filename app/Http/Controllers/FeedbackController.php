<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
{
    $feedbacks = Feedback::all();
    return view('feedbacks.index', compact('feedbacks'));
}

public function index2()
{
    // Récupère toutes les entrées de feedback
    $feedbacks = Feedback::all();
    
    // Retourne la vue 'acceuil' en passant la variable feedbacks
    return view('acceuil', compact('feedbacks'));
}

    public function create()
    
    {
        $feedbacks = Feedback::all();
        return view('feedbacks.create',compact('feedbacks'));
    }

    public function store(Request $request)
    {

        $userId = auth()->id();
        // Validation des données
        $request->validate([
            'content' =>'required|string|max:255',
        ]);
        // Création d'un nouvel utilisateur avec le mot de passe haché
        $feedback = Feedback::create([
            'user_id' =>$userId,
            'content' => $request->content,
        ]);

        if (auth()->user()->role == 'admin') {
            return redirect()->route('feedbacks.index')->with('success', 'Avis ajouté avec succes.');
        } else {
            return redirect()->route('users.index')->with('success', 'Avis ajouté avec succes.');
        }


}

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);

        $feedback->delete();

        return redirect()->route('feedbacks.index')->with('success', 'Avis supprimé avec succès.');
    }
}
