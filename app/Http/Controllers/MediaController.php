<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Media;
use App\Models\DeletedMedia;
use Illuminate\Http\Request;

class MediaController extends Controller

{
public function store(Request $request)
{
    $userId = auth()->id();

    // Validation des données
    $request->validate([
        'file_path' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $imagePath = null; // Initialisation de la variable pour le chemin de l'image

    // Vérification si le fichier est présent
    if ($request->hasFile('file_path')) {
        // Récupérer l'image
        $image = $request->file('file_path');

        // Générer un nom de fichier unique avec l'extension
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Stocker l'image dans le répertoire 'public/images'
        $imagePath = $image->storeAs('public/images', $imageName, 'public');
    }

    // Création d'un nouveau média pour l'utilisateur
    $media = Media::create([
        'user_id' => $userId,
        'type' => 'image',
        'file_path' => basename($imagePath), // Sauvegarder seulement le nom du fichier
    ]);

    // Redirection vers la page de profil de l'utilisateur avec un message de succès
    return redirect()->route('users.show', ['user' => $userId])->with('success', 'Publication mise à jour avec succès.');
}


    public function index2()
    {
        $medias =Media::all();
        return view('medias.liste', compact('medias'));
    }

    public function index3()
    {
        $mediasdeleteds =DeletedMedia::all();
        return view('medias.listedeleted', compact('mediasdeleteds'));
    }


public function show($id)
{
    $media = Media::findOrFail($id);

    return view('medias.show', [
        'media' => $media
    ]);
 }

 public function destroy($id)
 {
     // Retrieve the media item
     $media = Media::findOrFail($id);

     // Log the media details in deleted_media before deleting
     DeletedMedia::create([
         'user_id' => $media->user_id,
         'file_path' => $media->file_path,
         'deleted_at' => now(),
     ]);

     // Delete the media from the Media table
     $media->delete();

     // Determine redirection based on user role
     if (auth()->user()->role == 'admin') {
         // Redirect to the admin dashboard if the user is an admin
         return redirect()->route('medias.liste')->with('success', 'Média supprimé avec succès.');
     } else {
         // Redirect to the user's profile if the user is not an admin
         return redirect()->route('users.show', ['user' => $media->user_id])->with('success', 'Média supprimé avec succès.');
     }

 }





}
