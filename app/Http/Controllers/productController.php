<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class productController extends Controller
{
    public function show(Product $produit) {

        $produit::with('categorie')->get();
        return view('show', compact('produit'));

    }

   

}
