<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Feedback;

class HomeController extends Controller
{

    public function index()
    {

            $blogs = BlogPost::paginate(5);
            $feedbacks =Feedback::all();


        // Retourne la vue avec les blogs
        return view('acceuil.index', compact('blogs','feedbacks'));
    }

}
