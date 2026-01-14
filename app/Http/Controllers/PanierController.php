<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    // afficher le panier
    public function index(){

        $panier = Cart::getContent();
        $total = Cart::getTotal();

        return view('panier.index', compact('panier', 'total'));

    }

    // ajouter au panier
    public function add(Product $produit, Request $request){

        $quantite = $request->get('quantite', 1);
        $success = Cart::add($produit->id, $quantite);

        if(!$success){
            return back()->with('error', "Stock Insuffisant !");
        }

        return back()->with('message', 'Produit ajouté au panier');

    }

    // mettre à jour la quantité
    public function update(Product $produit, Request $request){

        $quantite = $request->get('quantite', 1);
        Cart::updateQuantite($produit->id, $quantite);

        return back()->with('message', 'Panier mis à jour');

    }

    // retirer du panier
    public function remove(Product $produit){

        Cart::clear($produit->id);
        return back()->with('message', 'Produit retiré du panier');
    }

    // page checkout ( Connexion requise )
    public function checkout(){

        $panier = Cart::getContent();
        $total = Cart::getTotal();

        if (empty($panier)) {
            return redirect()->route('home')->with('error', 'Votre panier est vide !');
        }
        return view('panier.checkout', compact('panier', 'total'));

    }

    // traiter la commande
    public function processCheckout(Request $request){}


}
