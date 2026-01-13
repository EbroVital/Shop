<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Product::with('categorie')->get();
        return view('admin.produits.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.produits.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $produit = new Product();

        $produit->nom = $request->nom ;
        $produit->description = $request->description ;
        $produit->prix = $request->prix ;
        $produit->stock = $request->stock ;
        $produit->categorie_id = $request->categorie_id ;

        // Gestion de l'image si présente
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('produits', 'public');
            $produit->image = $path;
        }

        $produit->save();

        return redirect()->route('produits.index')->with('message', 'Le produit a bien été ajouté');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $produit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $produit)
    {
        $categories = Category::all();
        return view('admin.produits.edit', compact('produit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $produit)
    {
        $produit->update($request->all());

        return redirect()->route('produits.index')->with('message', 'Le produit a été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $produit)
    {

        $produit->delete();

        return redirect()->route('produits.index')->with('message', 'Le produit a été supprimé');
    }
}
