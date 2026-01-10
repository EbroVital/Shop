<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){

        // recuperer toutes categories
        $categories = Category::all();
        // id de la categorie
        $categorieId = $request->get('categorie');
        // query builder
        $query = Product::with('categorie');

        if($categorieId) {
            $query->where('categorie_id', $categorieId);
        }

        // recuperer tous les produits
        $produits = $query->get();

        return view('home', compact('produits', 'categories', 'categorieId'));
    }

}
