<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){

        // recuperer les categories
        $categories = Category::all();

        // recuperer les parametres de recherche
        $categorieId = $request->get('categorie');
        $search = $request->get('search');

        // query builder
        $query = Product::with('categorie');

        // recuperer les categories s'il y en a
        if($categorieId) {
            $query->where('categorie_id', $categorieId);
        }

        // filtre par saisie
        if($search){
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'LIKE', "%{$search}%")->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // recuperer les produits
        $produits = $query->get();

        return view('home', compact('produits', 'categories', 'categorieId', 'search'));

    }

}
