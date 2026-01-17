<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCommandeController extends Controller
{
    public function index() {

        $commandes = Commande::with('products')->where('user_id', Auth::user()->id)->latest()->get();

        // dd($UserCommande);

        return view('userCommande', compact('commandes'));

    }
}
