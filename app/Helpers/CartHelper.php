<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class Cart
{
    /**
     * Ajouter un produit au panier
     */
    public static function add($produitId, $quantite = 1)
    {
        $produit = Product::findOrFail($produitId);

        // Vérifier le stock
        if ($produit->stock < $quantite) {
            return false; // Pas assez de stock
        }

        // Récupérer le panier actuel (ou tableau vide)
        $panier = Session::get('panier', []);

        // Si le produit existe déjà, augmenter la quantité
        if (isset($panier[$produitId])) {
            $panier[$produitId]['quantite'] += $quantite;
        } else {
            // Sinon, l'ajouter
            $panier[$produitId] = [
                'nom' => $produit->nom,
                'prix' => $produit->prix,
                'quantite' => $quantite,
                'image' => $produit->image
            ];
        }

        // Sauvegarder dans la session
        Session::put('panier', $panier);

        return true;
    }

    /**
     * Retirer un produit du panier
     */
    public static function remove($produitId)
    {
        $panier = Session::get('panier', []);

        if (isset($panier[$produitId])) {

            unset($panier[$produitId]);
            Session::put('panier', $panier);

        }
    }

    /**
     * Mettre à jour la quantité
     */
    public static function updateQuantite($produitId, $quantite)
    {
        $panier = Session::get('panier', []);

        if (isset($panier[$produitId])) {

            if ($quantite <= 0) {
                unset($panier[$produitId]);
            } else {
                $panier[$produitId]['quantite'] = $quantite;
            }
            Session::put('panier', $panier);

        }
    }

    /**
     * Vider le panier
     */
    public static function clear()
    {
        Session::forget('panier');
    }

    /**
     * Obtenir le contenu du panier
     */
    public static function getContent()
    {
        return Session::get('panier', []);
    }

    /**
     * Compter les articles
     */
    public static function count()
    {
        $panier = Session::get('panier', []);
        return array_sum(array_column($panier, 'quantite'));
    }

    /**
     * Calculer le total
     */
    public static function getTotal()
    {
        $panier = Session::get('panier', []);
        $total = 0;

        foreach ($panier as $item) {
            $total += $item['prix'] * $item['quantite'];
        }

        return $total;
    }
}
