<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Media;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DeletedUser;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\UploadedFile;



class UserController extends Controller
{
    public function index()
{
    $users = User::where('statutcpt', 'valide')
                 ->where('gender', 'female')
                 ->paginate(10);

    $currentUserId = auth()->id();

    if ($currentUserId) {
        $usersc = User::where('statutcpt', 'valide')
                     ->where('gender', 'female')
                     ->whereHas('activities', function ($query) use ($currentUserId) {
                         $query->where('user_id', $currentUserId);
                     })
                     ->get(); 
    } else {
        $usersc = collect();
    }

    $feedbacks = Feedback::all();

    return view('users.index', compact('users', 'usersc', 'feedbacks'));

}







public function filterUsers(Request $request)
{
    $query = User::query();

    // Filtrer par statut de compte non validé et genre féminin
    $query->where('statutcpt', 'valide')
          ->where('gender', 'female');

    // Filtrer par nom
    if ($request->has('name') && !empty($request->name)) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // Filtrer par ville
    if ($request->has('city') && !empty($request->city)) {
        $query->where('city', $request->city);
    }

    // Filtrer par peau
    if ($request->has('skin_tone') && !empty($request->skin_tone)) {
        $query->where('skin_tone', $request->skin_tone);
    }

    // Récupérer les utilisateurs filtrés
    $users = $query->get();

    // Retourner les résultats sous forme de JSON
    return response()->json($users);
}


    public function index2()
    {
        $users = User::where('gender','male')->get();
        return view('users.liste', compact('users'));
    }
    public function index3()
    {
        $users = User::where('gender','female')->get();
        return view('users.liste_', compact('users'));
    }

    public function index6()
    {
        $usersactivitys = UserActivity::all();
        return view('users.listeactivity', compact('usersactivitys'));
    }

    public function index7()
    {
        $usersdelockeds = Profile::all();
        return view('users.listedeblocked', compact('usersdelockeds'));
    }


    public function index5()
    {
        $usersdeleteds = DeletedUser::all();
        return view('users.listedeleted', compact('usersdeleteds'));
    }

    public function index4()
    {

        return view('users.import', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }


    // public function showchangepass()
    // {
    //     return view('users.show');
    // }


    public function changepass(Request $request, $user){
        $request->validate([
            'passwordanc' => 'required|string|max:40',
            'password' => 'required|string|max:40',
        ]);

        if(!Hash::check($request->passwordanc,Auth::user()->password)){
            // return back()->withErrors(['passwordanc'=>'Le mot de passe actuel est incorrect']);
            return back()->with('error', 'Le mot de passe actuel est incorrect');
        }

        // Trouver l'utilisateur par ID
        $user = User::findOrFail($user);

        // Mise à jour des champs spécifiques
        $user->update(['password' => Hash::make($request->password)]);
         // Hachage du mot de passe

        $user->save();

        // Redirection en fonction du rôle de l'utilisateur
        if (auth()->user()->role == 'admin') {
            return back()->with('success', 'Le mot de passe a été mis à jour ');
        } else {
            return back()->with('success', 'Le mot de passe a été mis à jour ');
        }

    }

    public function activecpt(Request $request, $user){

        // Trouver l'utilisateur par ID
        $user = User::findOrFail($user);

        // Mise à jour des champs spécifiques
        $user->update(['statutcpt' => 'valide']);
         // Hachage du mot de passe

        $user->save();

        // Redirection en fonction du rôle de l'utilisateur
        if (auth()->user()->role == 'admin') {
            return back()->with('success', 'Compte activé ');
        } else {
            return back()->with('success', 'Compte activé');
        }

    }

    public function desactivecpt(Request $request, $user){

        // Trouver l'utilisateur par ID
        $user = User::findOrFail($user);

        // Mise à jour des champs spécifiques
        $user->update(['statutcpt' => 'nonvalide']);
         // Hachage du mot de passe

        $user->save();

        // Redirection en fonction du rôle de l'utilisateur
        if (auth()->user()->role == 'admin') {
            return back()->with('success', 'Compte désactivé');
        } else {
            return back()->with('success', 'Compte désactivé');
        }

    }

    public function deblocage(Request $request, $id){

        // Trouver l'utilisateur par ID
        $userId = auth()->id();
        $today = Carbon::today();

        $user = User::findOrFail($userId);

        if($user->nbrecredit==0){
            return back()->with('error', 'Crédit insuffisant veuillez recharger');

        }else{


        $profil=Profile::where('user_id',$userId)->where('unlocked_by_user_id',$id)->first();
        if($profil){
            $profil->update(['status' => 'unlocked']);

        }else{

        $profil = Profile::create([
            'user_id' => $userId,// Ajout du chemin de l'image
            'unlocked_by_user_id' => $id, // Valeur par défaut
            'status' => 'unlocked',
            'locked_at' => $today, // Valeur par défaut
        ]);

        }


            $user = User::findOrFail($userId);

            $user->nbrecredit-= 1;

            $user->save();


            return back()->with('success', 'Compte désactivé');
        }

    }



    public function changeprofil(Request $request, $user){
        $request->validate([
            'imgprofil' => 'required|image|mimes:jpeg,png,jpg,gif,wepb|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('imgprofil')) {
            // Récupérer l'image
            $image = $request->file('imgprofil');

            // Générer un nom de fichier unique avec l'extension
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Stocker l'image dans le répertoire 'public/images'
            $imagePath = $image->storeAs('public/images', $imageName, 'public');
        }




        // Trouver l'utilisateur par ID
        $user = User::findOrFail($user);

        // Mise à jour des champs spécifiques
        $user->update(['imgprofil' => $imagePath]);
         // Hachage du mot de passe

        $user->save();

        // Redirection en fonction du rôle de l'utilisateur
        if (auth()->user()->role == 'admin') {
            return back()->with('success', 'Image de profil  mis à jour');
        } else {
            return back()->with('success', 'Image de profil  mis à jour');
        }

    }

    public function confirmation()
{
    return view('users.confirmation'); // Page de confirmation
}


public function store(Request $request)
{
    // Validation des champs
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|max:40',
        'age' => 'nullable|numeric|max:40',
        'gender' => 'nullable|string|max:40',
        'tel' => 'nullable|string|max:40',
        'skin_tone' => 'nullable|string|max:40',
        'nbrecredit' => 'nullable|numeric|max:40',
        'imgprofil' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'city' => 'nullable|string|max:40',
        'role' => 'nullable|string|max:40',
        'statut' => 'nullable|string|max:40',
        'statutcpt' => 'nullable|string|max:40',
    ]);
    
    // Extraire les champs depuis la requête
   

    // Traitement de l'image de profil
    $imagePath = null;
    if ($request->hasFile('imgprofil')) {
        // Sauvegarder l'image dans 'public/images'
        $image = $request->file('imgprofil');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('public/images', $imageName, 'public');
    }

    // Stockage des données dans la session (incluant l'image)
    $userData = $request->all(); // Récupérer toutes les données
    $userData['imgprofil'] = $imagePath; // Ajouter le chemin de l'image

    // Générer un code unique de confirmation basé sur l'ID
    $lastId = DB::table('users')->max('id');
    $generatedCode = $lastId + 1000;

    // Sauvegarder les données dans la session pour validation
    $request->session()->put('user_data', $userData);
    $request->session()->put('generated_code', $generatedCode);
  

    // Envoi de l'email de confirmation
    Mail::raw("Votre code de confirmation est : $generatedCode", function ($message) use ($request) {
        $message->to($request->email)
                ->subject('Code de confirmation');
    });

    // Rediriger vers la page de confirmation
    return redirect()->route('users.confirmation');
}



public function verify(Request $request)
{
    // Récupérer le code généré et les données de l'utilisateur depuis la session
    $generatedCode = $request->session()->get('generated_code');
    $userData = $request->session()->get('user_data');
    

    // Vérifier le code
    if ($request->code == $generatedCode) {
        // Créer l'utilisateur avec les données de la session
        $user = new User();
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password = bcrypt($userData['password']);
        $user->tel = $userData['tel'];
        $user->age = $userData['age'];
        $user->city = $userData['city'];
        $user->skin_tone = $userData['skin_tone'];
        $user->gender = $userData['gender'];  // Genre basé sur les données de la session
        $user->nbrecredit = 0; 
        $user->statutcpt='nonvalide';  // Initialisation des crédits à 0

        // Vérifier si l'image existe dans les données et l'enregistrer
        if (isset($userData['imgprofil'])) {
            $user->imgprofil = $userData['imgprofil'];  // Récupérer le chemin de l'image depuis la session
        }

        // Sauvegarder l'utilisateur dans la base de données
        $user->save();

        // Supprimer les données temporaires de session
        $request->session()->forget(['user_data', 'generated_code']);

        // Rediriger avec un message de succès
        if (auth()->check() && auth()->user()->role === 'admin') {
            // Si l'utilisateur connecté est un admin, redirection vers le tableau de bord admin
            return redirect()->route('users.index')->with('success', 'Client ajouté avec succès.');
        } else {
            // Connexion automatique du nouvel utilisateur
            auth()->login($user);

            // Enregistrer l'activité de connexion dans la table user_activities
            UserActivity::create([
                'user_id' => $user->id,
                'activity_type' => 'login', // Type d'activité, ici 'login'
                'activity_time' => now(),   // Heure de l'activité
            ]);

            // Redirection vers le tableau de bord spécifique du nouvel utilisateur
            return redirect()->route('users.index')->with('success', 'Vous êtes maintenant connecté.');
        }
    } else {
        // Retourner à la page de confirmation avec une erreur
        return back()->withErrors(['code' => 'Le code saisi est incorrect.']);
    }
}






    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'tel' => 'required|string|max:40',
            'skin_tone' => 'required|string|max:40',
            'city' => 'required|string|max:40',
        ]);

        // Trouver l'utilisateur par ID
        $user = User::findOrFail($id);

        // Mise à jour des champs spécifiques
        $user->update($request->only([  'tel','skin_tone','city']));
        $user->save();


        // Redirection en fonction du rôle de l'utilisateur
        if (auth()->user()->role == 'admin') {
            return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
        } else {
            return redirect()->route('users.index')->with('success', 'Votre compte a été mis à jour.');
        }
    }


    public function destroydeblocked($id)
    {
        $user = Profile::findOrFail($id);

        // Delete the user
        $user->delete();

        return redirect()->route('users.listedeblocked')->with('success', 'Utilisateur supprimé avec succès.');
    }




    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Store user information in DeletedUsers before deletion
        DeletedUser::create([
            'original_user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'other_info' => json_encode([ // Replace 'other_info' with actual additional data if needed
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]),
            'deleted_at' => now(),
        ]);

        // Delete the user
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        $userId = auth()->id();
        $profil=Profile::where('user_id',$userId)->where('unlocked_by_user_id',$id)->first();

        if($profil){
            if($profil->status=='unlocked'){
            $etat="visible";
        }else{
            $etat="nonvisible";
        }
        }else{
            $etat="nonvisible";
        }
        $media = Media::where('user_id', $id)->get();

        return view('users.show', [
            'user' => $user,
            'medias' => $media,
            'etat'=> $etat,
        ]);
     }



}








