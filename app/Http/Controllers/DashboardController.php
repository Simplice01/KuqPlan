<?php

namespace App\Http\Controllers;

use App\Models\DeletedUser;
use App\Models\Media;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        // Vérifier si l'utilisateur connecté est un administrateur
        if (auth()->user()->role === 'admin') {


            $today = now()->startOfDay();
            // Si l'utilisateur est admin, récupérer les données pour toutes les Medias et tous les utilisateurs
            $MediasCount = Media::count();





            $usersCount1 = User::where('gender', 'male')->count();
            $usersCount2 = User::where('gender', 'female')->count();
            $usersCount3 = DeletedUser::count();
            $usersCount4 = User::where('role', 'admin')->count();
            $usersCount5 = Transaction::count();
            $usersCount6 = DB::table('user_activities')
                ->select('user_id')
                ->where('activity_type', 'login')
                ->orderBy('activity_time', 'desc')
                ->distinct()
                ->count('user_id');
            $usersCount7 = User::where('statutcpt', 'nonvalide')->where('gender', 'female')->count();
            $usersCount8 = Transaction::sum('amount');






            // Récupération des données pour le graphique des Medias pour toutes les Medias
            $MediasData = DB::table('transactions')
                ->select(
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('COUNT(id) as Medias_total')
                )
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();

            // Récupération des données pour le graphique des utilisateurs
            $usersData = DB::table('users')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date'), DB::raw('count(*) as users_total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();


        }

        return view('dashboard.index', compact(
            'usersData',
            'MediasData',
            'MediasCount',
            'usersCount1',
            'usersCount2',
            'usersCount3',
            'usersCount4',
            'usersCount5',
            'usersCount6',
            'usersCount7',
            'usersCount8',
            
        ));
     }
}


