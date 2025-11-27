<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\BlogPost;

class BlogController extends Controller
{

    public function index()
    {

            $blogs = BlogPost::paginate(5);



        // Retourne la vue avec les blogs
        return view('blogs.index', compact('blogs'));
    }

   public function create()
    
    {
        $blogs = BlogPost::all();
        return view('blogs.create',compact('blogs'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        // Validation des données

        $userId = auth()->id();

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,wepb|max:2048',
            'content' => 'required|string',
        ]);

        
                
        $blog = new BlogPost(); // Créer une nouvelle instance de blog

        $blog->title = $request->input('title');
        $blog->user_id = $userId;
        $blog->content = $request->input('content');



        $imagePath=null;

    if ($request->hasFile('image')) {
        // Récupérer l'image
        $image = $request->file('image');

        // Générer un nom de fichier unique avec l'extension
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Stocker l'image dans le répertoire 'public/images'
        $imagePath = $image->storeAs('public/images', $imageName, 'public');
    }
    $blog->image = $imagePath;
    $blog->save();

    return redirect()->route('blogs.index')->with('success', 'blog mise à jour avec succès.');

    }


    public function edit($id)
    {
        $blog = BlogPost::findOrFail($id);
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
        ]);
    
        // Récupérer l'instance du blog en utilisant l'ID
        $blog = BlogPost::findOrFail($id); // Utilise findOrFail pour lancer une erreur si le blog n'est pas trouvé
    
        // Mettre à jour les attributs
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
    
        // Gérer le téléchargement de l'image si une nouvelle image est envoyée
        if ($request->hasFile('image')) {
            // Récupérer l'image
            $image = $request->file('image');
    
            // Générer un nom de fichier unique avec l'extension
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            // Stocker l'image dans le répertoire 'public/images' et enregistrer le chemin
            $imagePath = $image->storeAs('public/images', $imageName, 'public');
            
            // Mettre à jour le chemin de l'image dans le modèle
            $blog->image = $imagePath;
        }
    
        // Enregistrer les modifications
        $blog->save();
    
        return redirect()->route('blogs.index')->with('success', 'Blog mis à jour avec succès.');
    }
    



    public function show($id)
    {
        // Récupérer la blog en fonction de l'ID
        $blog = BlogPost::findOrFail($id);



        // Retourner la vue avec les données de la blog, le nombre de likes et le statut 'liked'
        return view('blogs.show', compact('blog'));
    }



    public function destroy($id)
    {
        // Trouve le produit par ID et le supprime
        $blog = BlogPost::findOrFail($id);

        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Produit effacé avec succès.');
    }

}
