<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['libelle'];

    // une categorie contient plusieurs produits
    public function products(){
        return $this->hasMany(Product::class, 'categorie_id');
    }
}
