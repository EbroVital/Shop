<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Http\Requests\checkoutRequest;
use App\Models\Commande;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        Cart::remove($produit->id);
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
    public function processCheckout(Request $request) {

        // Validation
        $validated = $request->validate([
            'adresse_livraison' => 'required|string|min:10',
            'telephone' => 'required|string',
            'ville' => 'required|string',
            'remarques' => 'nullable|string'
        ], [
            'adresse_livraison.required' => 'L\'adresse de livraison est obligatoire',
            'adresse_livraison.min' => 'L\'adresse doit contenir au moins 10 caractères',
            'telephone.required' => 'Le numéro de téléphone est obligatoire',
            'ville.required' => 'La ville est obligatoire'
        ]);

        // Récupérer le panier
        $panier = Cart::getContent();

        // Vérifier que le panier n'est pas vide
        if (empty($panier)) {
            return redirect()->route('home')->with('error', 'Votre panier est vide !');
        }

        // Calculer le total
        $total = Cart::getTotal();

        // Construire l'adresse complète
        $adresseComplete = $validated['adresse_livraison'] . "\n";
        $adresseComplete .= $validated['ville'] . "\n";
        $adresseComplete .= "Tél: " . $validated['telephone'];
        if (!empty($validated['remarques'])) {
            $adresseComplete .= "\nRemarques: " . $validated['remarques'];
        }

    try {
        // Transaction pour garantir la cohérence
        DB::beginTransaction();

        // Créer la commande
        $commande = Commande::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'statut' => 'en attente',
            'adresse_livraison' => $adresseComplete
        ]);

        // Attacher les produits avec leurs quantités et prix
        foreach ($panier as $produitId => $item) {
            $commande->products()->attach($produitId, [
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix']
            ]);

            // Optionnel : Décrémenter le stock
            $produit = Product::find($produitId);
            if ($produit) {
                $produit->stock -= $item['quantite'];
                $produit->save();
            }
        }

        // Valider la transaction
        DB::commit();

        // Vider le panier
        Cart::clear();

        // Rediriger vers page de confirmation
        return redirect()->route('commande.confirmation', $commande->id)
                         ->with('success', 'Votre commande a été enregistrée avec succès !');

    } catch (\Exception $e) {
        // Annuler en cas d'erreur
        DB::rollBack();
        Log::error($e->getMessage());
        return back()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
    }
}

    // page de confirmation de la commande
    public function confirmation(Commande $commande){

        // verifier si c'est bien la commande de l'utilisateur connecté
        if( $commande->user_id !== auth()->id() ){
            abort(403);
        }

        return view('panier.confirmation', compact('commande'));

    }


}
