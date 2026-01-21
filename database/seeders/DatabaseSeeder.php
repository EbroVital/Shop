<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Créer un admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Créer un user normal
        User::create([
            'name' => 'user',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);

        // Créer des catégories
        $categories = [
            'Électronique',
            'Vêtements',
            'Livres',
            'Sport'
        ];

        foreach ($categories as $cat) {
            Category::create(['libelle' => $cat]);
        }

        // Créer des produits
        $produits = [
            ['nom' => 'iPhone 15', 'prix' => 500000, 'stock' => 10, 'categorie_id' => 1],
            ['nom' => 'MacBook Pro', 'prix' => 1200000, 'stock' => 5, 'categorie_id' => 1],
            ['nom' => 'T-Shirt Nike', 'prix' => 15000, 'stock' => 50, 'categorie_id' => 2],
            ['nom' => 'Jean Levis', 'prix' => 35000, 'stock' => 30, 'categorie_id' => 2],
            ['nom' => 'Clean Code', 'prix' => 12000, 'stock' => 20, 'categorie_id' => 3],
            ['nom' => 'Ballon de foot', 'prix' => 8000, 'stock' => 40, 'categorie_id' => 4],
        ];

        foreach ($produits as $p) {
            Product::create($p);
        }
    }
}
