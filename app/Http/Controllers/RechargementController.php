<?php

namespace App\Http\Controllers;
use App\Models\Pack;
use Illuminate\Http\Request;
use FedaPay\FedaPay;
use FedaPay\Transaction;
use App\Models\User;
use App\Models\Transaction as UserTransaction;

class RechargementController extends Controller
{
   
    public function index()
    {
        $packs = Pack::all();
        return view('rechargements.index', compact('packs'));
    }

    public function verifyPayment(Request $request)
    {
        // Récupérer les données envoyées depuis le frontend
        $validated = $request->validate([
            'transaction_id' => 'required|string',
            'amount' => 'required|integer',
            'status' => 'required|string',
            'customer_email' => 'required|string',
            'customer_lastname' => 'required|string',
        ]);
    
        // Vérifier si la transaction est réussie
        if ($validated['status'] === 'success') {
            // Enregistrer la transaction dans la base de données
            $transaction = new Transaction();
            $transaction->transaction_id = $validated['transaction_id'];
            $transaction->user_id = auth()->id(); // Utilisateur authentifié
            $transaction->amount = $validated['amount'];
            $transaction->status = 'success';
            $transaction->save();
    
            // Mettre à jour les crédits de l'utilisateur
            $user = User::findOrFail(auth()->id());
    
            if ($validated['amount'] == 500) {
                $user->nbrecredit += 1;
            } elseif ($validated['amount'] == 1000) {
                $user->nbrecredit += 2;
            } elseif ($validated['amount'] == 2000) {
                $user->nbrecredit += 5;
            }
    
            $user->save();
    
            return response()->json(['status' => 'success', 'message' => 'Le paiement a été validé. Crédits mis à jour.']);
        }
    
        return response()->json(['status' => 'error', 'message' => 'Le paiement a échoué.']);
    }
    

    public function index2()
    {
        $transactions =Transaction::all();
        return view('rechargements.liste', compact('transactions'));
    }
}
