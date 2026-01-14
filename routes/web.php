<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\Admin\userController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\productController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Route accessible à tous

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/produit/{id}', [productController::class, 'show'])->name('showProduct');
Route::get('panier', [PanierController::class, 'index'])->name('panier.index');
Route::post('panier/add/{produit}', [PanierController::class, 'add'])->name('panier.add');
Route::patch('panier/update/{produit}', [PanierController::class, 'update'])->name('panier.update');
Route::delete('panier/remove/{produit}', [PanierController::class, 'remove'])->name('panier.remove');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('checkout', [PanierController::class, 'checkout'])->name('checkout');
    Route::post('checkout', [PanierController::class, 'processCheckout'])->name('checkout.process');

});


Route::middleware(['auth', 'admin'])->group(function () {

    // route CRUD des produits par l'administrateur
    Route::resource('produits', AdminProductController::class);

    // route pour CRUD des categories par l'administrateur
    Route::resource('category', AdminCategoryController::class);

    // route pour les commandes
    Route::get('commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::get('commandes/{commande}', [CommandeController::class, 'show'])->name('commandes.show');
    Route::patch('commandes/{commande}/statut', [CommandeController::class, 'updateStatut'])->name('commandes.updateStatut');

    // liste des utilisateurs inscrits sur l'app
    Route::get('/users', [userController::class, 'index'])->name('users.index');

});


require __DIR__.'/auth.php';
