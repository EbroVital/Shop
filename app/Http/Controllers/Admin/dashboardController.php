<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Commande;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index(){

        $users = User::all()->where('role', 'user')->count();
        $commandes = Commande::count();
        $total = Commande::sum('total');
        $categorie = Category::count();
        $produits = Product::count();
        $stats = [
            'en attente' => Commande::where('statut', 'en attente')->count(),
            'validee' => Commande::where('statut', 'validée')->count(),
            'expediee' => Commande::where('statut', 'expediée')->count(),
            'livree' => Commande::where('statut', 'livrée')->count(),
        ];

        return view('dashboard', compact('users', 'commandes', 'total', 'categorie', 'stats', 'produits'));
    }
}
