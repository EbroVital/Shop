
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-commerce - Accueil</title>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            body {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }
            .main-content {
                flex: 1;
            }
            .product-card {
                transition: transform 0.3s;
            }
            .product-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            }
            .product-image {
                height: 200px;
                background: #f8f9fa;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 4rem;
            }
            .hero {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 60px 0;
            }
        </style>
    </head>
    <body>


        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">

                <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
                    <i class="fas fa-shopping-cart"></i> Shop
                </a>

                {{-- Toggle pour mobile --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                {{-- Navigation --}}
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @auth
                            {{-- Si connecté --}}
                            <li class="nav-item">
                                <span class="nav-link">
                                    <i class="fas fa-user"></i> Bonjour, <strong>{{ Auth::user()->name }}</strong>
                                </span>
                            </li>

                            {{-- Admin --}}
                            @if(Auth::user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-cog"></i> Administrateur
                                    </a>
                                </li>
                            @endif

                            {{-- Panier --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('panier.index') }}">
                                    <i class="fas fa-shopping-cart"></i> Panier
                                    <span class="badge bg-primary">{{ \App\Helpers\Cart::count() }}</span>
                                </a>
                            </li>

                            {{-- Mes commandes --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-box"></i> Mes commandes
                                </a>
                            </li>

                            {{-- Déconnexion --}}
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link text-danger">
                                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                        @else
                            {{-- Si pas connecté --}}
                            <li class="nav-item">
                                <a class="btn btn-secondary" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt"></i> Se connecter
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary ms-2" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus"></i> S'inscrire
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        {{-- MAIN CONTENT --}}
        <div class="main-content">

            {{-- HERO SECTION --}}
            <div class="hero text-center">
                <div class="container">
                    <h1 class="display-4 fw-bold mb-3">
                        <i class="fas fa-rocket"></i> Bienvenue sur Shop
                    </h1>
                    <p class="lead">Découvrez nos produits de qualité aux meilleurs prix</p>
                </div>
            </div>

            {{-- LISTE DES PRODUITS --}}
            <div class="container py-5">

                {{-- SECTION RECHERCHE ET FILTRE --}}
                <div class="mb-4">

                    <div class="row g-3 align-items-end">

                        {{-- BARRE DE RECHERCHE --}}
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('home') }}">
                                {{-- Conserver le filtre catégorie si actif --}}
                                @if($categorieId)
                                    <input type="hidden" name="categorie" value="{{ $categorieId }}">
                                @endif

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text"
                                        name="search"
                                        class="form-control"
                                        placeholder="Rechercher un produit..."
                                        value="{{ $search }}">
                                    <button type="submit" class="btn btn-primary">
                                        Rechercher
                                    </button>

                                    {{-- Bouton Clear si recherche active --}}
                                    @if($search)
                                        <a href="{{ route('home') }}{{ $categorieId ? '?categorie='.$categorieId : '' }}"
                                        class="btn btn-outline-secondary">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>

                        {{-- FILTRE CATÉGORIE --}}
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('home') }}" class="d-flex gap-2">
                                {{-- Conserver la recherche si active --}}
                                @if($search)
                                    <input type="hidden" name="search" value="{{ $search }}">
                                @endif

                                <select name="categorie" class="form-select" onchange="this.form.submit()">
                                    <option value="">📂 Toutes les catégories</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $categorieId == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->libelle }}
                                        </option>
                                    @endforeach
                                </select>

                                {{-- Bouton Reset si filtre actif --}}
                                @if($categorieId)
                                    <a href="{{ route('home') }}{{ $search ? '?search='.$search : '' }}"
                                    class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </form>
                        </div>

                    </div>

                    {{-- AFFICHAGE DES FILTRES ACTIFS --}}
                    @if($search || $categorieId)
                        <div class="mt-3">
                            <span class="text-muted">
                                <i class="fas fa-filter"></i> Filtres actifs :
                            </span>

                            @if($search)
                                <span class="badge bg-info">
                                    Recherche : "{{ $search }}"
                                </span>
                            @endif

                            @if($categorieId)
                                <span class="badge bg-primary">
                                    Catégorie : {{ $categories->find($categorieId)->libelle }}
                                </span>
                            @endif

                            <a href="{{ route('home') }}" class="badge bg-secondary text-decoration-none">
                                <i class="fas fa-times"></i> Tout réinitialiser
                            </a>
                        </div>
                    @endif

                </div>

                {{-- TITRE AVEC COMPTEUR --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0 fw-bold">
                        <i class="fas fa-box-open"></i> Nos Produits
                        <span class="badge bg-secondary">{{ $produits->count() }}</span>
                    </h2>
                </div>

                @if($produits->count() > 0)
                    <div class="row g-4">
                        @foreach($produits as $produit)
                            <div class="col-md-6 col-lg-3">
                                <div class="card product-card h-100 shadow-sm">
                                    {{-- Image produit --}}
                                    <div class="product-image">
                                        @if($produit->image)
                                            <img src="{{ asset('storage/' . $produit->image) }}"
                                                alt="{{ $produit->nom }}"
                                                class="img-fluid">
                                        @else
                                            <i class="fas fa-box text-muted"></i>
                                        @endif
                                    </div>

                                    {{-- Corps de la carte --}}
                                    <div class="card-body">
                                        {{-- Catégorie --}}
                                        <span class="badge bg-primary mb-2">
                                            {{ $produit->categorie->libelle }}
                                        </span>

                                        {{-- Nom --}}
                                        <h5 class="card-title">{{ $produit->nom }}</h5>

                                        {{-- Description --}}
                                        @if($produit->description)
                                            <p class="card-text text-muted small">
                                                {{ Str::limit($produit->description, 60) }}
                                            </p>
                                        @endif

                                        {{-- Prix --}}
                                        <h4 class="text-primary fw-bold">
                                            {{ number_format($produit->prix, 0, ',', ' ') }} FCFA
                                        </h4>

                                        {{-- Stock --}}
                                        <p class="small mb-3">
                                            @if($produit->stock > 0)
                                                <i class="fas fa-check-circle text-success"></i>
                                                En stock ({{ $produit->stock }})
                                            @else
                                                <i class="fas fa-times-circle text-danger"></i>
                                                Rupture de stock
                                            @endif
                                        </p>

                                        {{-- Boutons --}}
                                        <div class="d-grid gap-2">
                                            <a href="" class="btn btn-outline-primary">
                                                <i class="fas fa-eye"></i> Voir détails
                                            </a>
                                            @if($produit->stock > 0)
                                                <form action="{{ route('panier.add', $produit) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success w-100">
                                                        <i class="fas fa-cart-plus"></i> Ajouter au panier
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-secondary w-100" disabled>
                                                    <i class="fas fa-ban"></i> Indisponible
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- Si aucun produit --}}
                    <div class="alert alert-info text-center py-5">
                        <i class="fas fa-info-circle fa-3x mb-3"></i>
                        <h4>Aucun produit disponible pour le moment</h4>
                        <p class="text-muted">Revenez plus tard !</p>
                    </div>
                @endif
            </div>

        </div>

        {{-- FOOTER --}}
        <footer class="bg-dark text-white py-4 mt-5">
            <div class="container text-center">
                <p class="mb-1">
                    <i class="fas fa-copyright"></i> 2026 Shop - Tous droits réservés
                </p>
                <p class="text-muted small">
                    {{-- Développé avec <i class="fas fa-heart text-danger"></i> par Vital --}}
                </p>
            </div>
        </footer>

        {{-- Bootstrap JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
