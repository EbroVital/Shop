<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'total',
        'user_id',
        'statut',
        'addresse_livraison'
    ];

    // une commande concerne un utilisateur

    public function user(){
        return $this->belongsTo(User::class);
    }

    // une commande concerne plusieurs produits

    public function products(){
        return $this->hasMany(Product::class, 'commandes_products')->withPivot('quantite', 'prix_unitaire')->withTimestamps();
    }
}
