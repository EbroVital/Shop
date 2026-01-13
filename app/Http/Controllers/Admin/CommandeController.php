<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    // liste des commandes
    public function index(Request $request){

        // recuperer les filtres pour la recherche
        $statut = $request->get('statut');
        $search = $request->get('search');

        // query builder
        $query = Commande::with('user', 'products')->latest();

        // filtre par statut
        if($statut) {
            $query->where('statut', $statut);
        }

        // filtre par recherche de commande ou nom du client
        if($search) {

            $query->where(function ($q) use ($search) {

                $q->where('id', 'LIKE', "%{$search}%")->orWhereHas('user', function ($q2) use ($search) {
                    $q2->where('name', "LIKE", "%{$search}%")->orWhere('email', "LIKE", "%{$search}%");
                });

            });
        }

        // pagination
        $commandes = $query->paginate(10);

        // Statistiques rapides
        $stats = [
            'total' => Commande::count(),
            'en_attente' => Commande::where('statut', 'en_attente')->count(),
            'validee' => Commande::where('statut', 'validée')->count(),
            'expediee' => Commande::where('statut', 'expediée')->count(),
            'livree' => Commande::where('statut', 'livrée')->count(),
        ];

        return view('admin.commandes.index', compact('commandes', 'statut', 'search', 'stats'));


    }

    // detail d'une commande
    public function show(Commande $commande){

        $commande->load('user', 'products');
        return view('admin.commandes.show', compact('commande'));

    }

    // changer le statut d'un commande
    public function updateStatut(Request $request, Commande $commande ) {

         $request->validate([
            'statut' => 'required|in:en_attente,validée,expediée,livrée'
        ]);

        $commande->statut = $request->statut;
        $commande->save();

        return back()->with('message', 'Statut de la commande mis à jour avec succès !');

    }
}
