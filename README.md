# 🛒 Plateforme E-commerce

[![Laravel](https://img.shields.io/badge/Laravel-12-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2-blue.svg)](https://php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple.svg)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

> Application e-commerce complète développée avec Laravel 12 permettant la gestion de produits, catégories, commandes avec système de panier et notifications email.

---

##  Fonctionnalités

###  Côté Client

- **Catalogue produits**
  - Affichage des produits avec images, prix et stock
  - Filtrage par catégorie
  - Recherche par nom/description
  - Pagination des résultats

- **Système de panier**
  - Ajout/suppression de produits
  - Modification des quantités
  - Persistance en session (pas besoin de compte pour ajouter au panier)
  - Calcul automatique du total

- **Gestion des commandes**
  - Processus de checkout complet
  - Formulaire de livraison
  - Confirmation de commande
  - Email de confirmation automatique
  - Historique des commandes utilisateur

- **Authentification**
  - Inscription/Connexion (Laravel Breeze)
  - Profil utilisateur
  - Gestion des informations personnelles

###  Côté Administrateur

- **Gestion des catégories**
  - CRUD complet (Créer, Lire, Modifier, Supprimer)
  - Validation des données

- **Gestion des produits**
  - CRUD complet avec upload d'images
  - Gestion du stock
  - Association aux catégories
  - Validation des prix et quantités

- **Gestion des commandes**
  - Vue d'ensemble de toutes les commandes
  - Filtrage par statut (en attente, validée, expédiée, livrée)
  - Recherche par numéro de commande ou client
  - Modification du statut des commandes
  - Détails complets (produits, quantités, client, adresse)
  - Statistiques en temps réel

###  Système de notifications

- Email de confirmation de commande
- Détails complets de la commande dans l'email
- Template HTML responsive et professionnel

---

##  Technologies Utilisées

### Backend
- **Laravel 12** - Framework PHP
- **MySQL** - Base de données
- **Laravel Breeze** - Authentification
- **Eloquent ORM** - Relations de base de données

### Frontend
- **Blade** - Moteur de templates
- **Bootstrap 5.3** - Framework CSS
- **Font Awesome** - Icônes


### Outils
- **Composer** - Gestionnaire de dépendances PHP
- **Laragon/XAMPP** - Environnement de développement local

---

##  Prérequis

- PHP >= 8.2
- Composer
- MySQL >= 5.7 ou MariaDB
- Serveur web (Apache/Nginx) ou Laragon

---

##  Installation

### 1. Cloner le projet

```bash
git clone https://github.com/EbroVital/Shop.git
cd Shop
```

### 2. Installer les dépendances

```bash
# Dépendances PHP
composer install

```

### 3. Configuration de l'environnement

```bash
# Copier le fichier d'environnement
cp .env.example .env

# Générer la clé d'application
php artisan key:generate
```

### 4. Configurer la base de données

Modifier le fichier `.env` avec vos informations :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shop
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Créer la base de données

```bash
# Créer la base de données (si elle n'existe pas)
php artisan db:create

# Ou manuellement dans phpMyAdmin
CREATE DATABASE shop;
```

### 6. Migrations et données de test

```bash
# Exécuter les migrations
php artisan migrate

# (Optionnel) Insérer des données de test
php artisan db:seed
```

### 7. Lier le stockage public

```bash
php artisan storage:link
```

### 8. Compiler les assets

```bash
npm run dev
```

### 9. Lancer le serveur

```bash
php artisan serve
```

Accéder à l'application : **http://localhost:8000**

---

##  Configuration des emails

### Option 1 : Log (Développement)

Dans `.env` :

```env
MAIL_MAILER=log
```

Les emails seront écrits dans `storage/logs/laravel.log`

### Option 2 : Mailtrap (Test)

1. Créer un compte sur [Mailtrap.io](https://mailtrap.io)
2. Créer une inbox
3. Copier les credentials SMTP
4. Configurer `.env` :

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=votre_username
MAIL_PASSWORD=votre_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@Shop.com"
MAIL_FROM_NAME= "votre_app_name"
```

### Option 3 : Gmail (Production)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre-email@gmail.com
MAIL_PASSWORD=votre-mot-de-passe-application
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="votre-email@gmail.com"
MAIL_FROM_NAME= "votre_app_name"
```

**Note :** Pour Gmail, vous devez générer un [mot de passe d'application](https://myaccount.google.com/apppasswords)

---

##  Comptes de test

Après avoir exécuté `php artisan db:seed` :

### Administrateur
- **Email :** admin@test.com
- **Mot de passe :** password

### Utilisateur
- **Email :** user@test.com
- **Mot de passe :** password

---

##  Structure du projet

```
Shop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── ProduitController.php
│   │   │   │   └── CommandeController.php
│   │   │   ├── HomeController.php
│   │   │   └── PanierController.php
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php
│   │   └── Requests/
│   │       ├── CategoryRequest.php
│   │       └── ProductRequest.php
│   ├── Mail/
│   │   └── Order.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Categorie.php
│   │   ├── Produit.php
│   │   └── Commande.php
│   └── Helpers/
│       └── CartHelper.php
├── database/
│   ├── migrations/
│   │   ├── create_categories_table.php
│   │   ├── create_produits_table.php
│   │   ├── create_commandes_table.php
│   │   └── create_commande_produit_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   ├── views/
│   │   ├── home.blade.php
│   │   ├── panier/
│   │   │   ├── index.blade.php
│   │   │   ├── checkout.blade.php
│   │   │   └── confirmation.blade.php
│   │   ├── admin/
│   │   │   ├── categories/
│   │   │   ├── produits/
│   │   │   └── commandes/
│   │   └── mail/
│   │       └── commande.blade.php
│   └── css/
├── routes/
│   └── web.php
├── public/
│   └── storage/
├── .env.example
├── composer.json
└── README.md
```

---

##  Schéma de base de données

### Relations

```
users (1) ──────> (N) commandes (N) ────── (N) produits
                                   ↓
                            commande_produit
                            (table pivot)

categories (1) ──────> (N) produits
```

### Tables principales

**users**
- id, name, email, password, role, timestamps

**categories**
- id, libelle, timestamps

**produits**
- id, nom, description, prix, stock, image, categorie_id, timestamps

**commandes**
- id, user_id, total, statut, adresse_livraison, timestamps

**commande_produit** (pivot)
- id, commande_id, produit_id, quantite, prix_unitaire, timestamps

---

##  Fonctionnalités techniques

### Helper Cart (Gestion du panier)

Le système utilise un helper personnalisé pour gérer le panier en session :

```php
use App\Helpers\Cart;

// Ajouter au panier
Cart::add($produitId, $quantite);

// Retirer du panier
Cart::remove($produitId);

// Obtenir le contenu
$panier = Cart::getContent();

// Compter les articles
$count = Cart::count();

// Calculer le total
$total = Cart::getTotal();

// Vider le panier
Cart::clear();
```

### Relations Eloquent

#### One-to-Many (1:N)

```php
// Categorie → Produits
class Categorie extends Model {
    public function produits() {
        return $this->hasMany(Produit::class);
    }
}

// User → Commandes
class User extends Model {
    public function commandes() {
        return $this->hasMany(Commande::class);
    }
}
```

#### Many-to-Many (N:N)

```php
// Commande ↔ Produits
class Commande extends Model {
    public function produits() {
        return $this->belongsToMany(Produit::class, 'commande_produit')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }
}
```

### Middleware Admin

Protection des routes administrateur :

```php
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Routes admin
});
```

---

##  Tests

Pour tester l'application :

### Test manuel

1. **Créer un compte utilisateur**
2. **Ajouter des produits au panier** (sans être connecté)
3. **Voir le panier**
4. **Se connecter**
5. **Passer une commande**
6. **Vérifier l'email de confirmation** (logs ou Mailtrap)
7. **Se connecter en admin** et gérer la commande

### Test des emails

```bash
# Route de test
GET /test-email
```

Affiche l'email dans le navigateur sans l'envoyer.

---

##  Routes principales

### Public

```
GET  /                          Page d'accueil
GET  /panier                    Voir le panier
POST /panier/add/{produit}      Ajouter au panier
```

### Authentifié

```
GET  /checkout                  Page de commande
POST /checkout                  Traiter la commande
GET  /commande/{id}/confirmation Confirmation commande
GET  /mes-commandes                  Historique
```

### Admin

```
GET  /commandes           Liste des commandes
GET  /commandes/{id}      Détails commande
PATCH /commandes/{id}/statut Changer statut

GET  /produits            Liste produits
POST /produits            Créer produit
PUT  /produits/{id}       Modifier produit
DELETE /produits/{id}     Supprimer produit

GET  /categories          Liste catégories
POST /categories          Créer catégorie
PUT  /categories/{id}     Modifier catégorie
DELETE /categories/{id}   Supprimer catégorie
```

---

## Capture d'ecran
Accueil
<img width="1366" height="768" alt="accueil" src="https://github.com/user-attachments/assets/814094a0-0f96-4202-a863-21d5be4a782a" />
<img width="1366" height="768" alt="accueil(1)" src="https://github.com/user-attachments/assets/60add3b9-ae67-40c6-9f27-a885d7b71d12" />
Dashboard Admin
<img width="1366" height="768" alt="admin" src="https://github.com/user-attachments/assets/3dcea01a-45f9-45cd-b61d-930322e4b8bc" />
Panier d'un utilisateur
<img width="1366" height="768" alt="PANIER" src="https://github.com/user-attachments/assets/344ef3a0-9407-4dcc-a97e-a5463ebc5e3d" />
Validation d'une commande
<img width="1366" height="768" alt="commande" src="https://github.com/user-attachments/assets/7af163e0-d43c-4758-9f56-70032e94609d" />
<img width="1366" height="768" alt="commande(1)" src="https://github.com/user-attachments/assets/3e25f53f-8508-47f3-9c67-bdd0508c3504" />




##  Améliorations futures

### Fonctionnalités planifiées

- [ ] Page détails produit
- [ ] Système de paiement (Mobile Money, Stripe)
- [ ] Avis et notes sur les produits
- [ ] Wishlist (liste de souhaits)
- [ ] Filtres avancés (fourchette de prix, trier par...)
- [ ] Notifications email lors du changement de statut
- [ ] Dashboard admin avec graphiques
- [ ] Export des commandes (PDF, Excel)
- [ ] Gestion des promotions et codes promo
- [ ] Système de livraison avec tracking
- [ ] Multi-langues (FR/EN)
- [ ] Mode sombre

### Optimisations techniques

- [ ] Tests unitaires et fonctionnels
- [ ] Cache (Redis)
- [ ] Queue pour les emails
- [ ] API REST
- [ ] Optimisation des images
- [ ] CDN pour les assets
- [ ] Docker containerization

---

##  Problèmes connus

### Email ne part pas (Laragon + SSL)

**Erreur :** `failed loading cafile stream`

**Solution :**
1. Télécharger [cacert.pem](https://curl.se/ca/cacert.pem)
2. Placer dans `C:/laragon/bin/php/`
3. Modifier `php.ini` :
   ```ini
   curl.cainfo = "C:/laragon/bin/php/cacert.pem"
   openssl.cafile="C:/laragon/bin/php/cacert.pem"
   ```
4. Redémarrer Laragon

---

##  Contribution

Les contributions sont les bienvenues ! Pour contribuer :

1. Fork le projet
2. Créer une branche (`git checkout -b feature/amelioration`)
3. Commit les changements (`git commit -m 'Ajout fonctionnalité X'`)
4. Push vers la branche (`git push origin feature/amelioration`)
5. Ouvrir une Pull Request

---

##  Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

---

##  Auteur

**Ebro Vital**

- GitHub: [@EbroVital](https://github.com/EbroVital)
- Email: ebrovital02@gmail.com

---

##  Remerciements

- [Laravel](https://laravel.com) - Framework PHP
- [Bootstrap](https://getbootstrap.com) - Framework CSS
- [Font Awesome](https://fontawesome.com) - Icônes
- [Mailtrap](https://mailtrap.io) - Test d'emails

---

##  Ressources utiles

- [Documentation Laravel](https://laravel.com/docs)
- [Documentation Eloquent Relationships](https://laravel.com/docs/eloquent-relationships)
- [Bootstrap Documentation](https://getbootstrap.com/docs)


