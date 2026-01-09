<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'prix',
        'image',
        'stock',
        'categorie_id'
    ];

    // un produit appartient à une seule categorie
    public function categorie(){
        return $this->belongsTo(Category::class);
    }

    // un produit peut avoir plusieurs commandes

    public function commandes(){
        return $this->belongsToMany(Commande::class, 'commandes_products')->withPivot('quantite', 'prix_unitaire')->withTimestamps();
    }
}
