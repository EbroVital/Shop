<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier - Shop</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    {{-- NAVBAR (copie celle de home.blade.php) --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
                <i class="fas fa-shopping-cart"></i> Shop
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <span class="nav-link">
                                <i class="fas fa-user"></i> Bonjour, <strong>{{ Auth::user()->name }}</strong>
                            </span>
                        </li>

                        @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-cog"></i> Administrateur
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('panier.index') }}">
                                <i class="fas fa-shopping-cart"></i> Panier
                                <span class="badge bg-danger">{{ \App\Helpers\Cart::count() }}</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-danger">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-home"></i> Accueil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('panier.index') }}">
                                <i class="fas fa-shopping-cart"></i> Panier
                                <span class="badge bg-primary">{{ \App\Helpers\Cart::count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
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

    {{-- CONTENU PRINCIPAL --}}
    <div class="container py-5">

        {{-- TITRE --}}
        <h2 class="mb-4">
            <i class="fas fa-shopping-cart"></i> Mon Panier
        </h2>

        {{-- MESSAGES FLASH --}}
        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show text-center">
                <i class="fas fa-check-circle"></i> {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show text-center">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">

            {{-- LISTE DES PRODUITS --}}
            <div class="col-md-8">
                @if(empty($panier))
                    {{-- PANIER VIDE --}}
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-shopping-cart fa-5x text-muted mb-3"></i>
                            <h4>Votre panier est vide</h4>
                            <p class="text-muted">Ajoutez des produits pour commencer vos achats</p>
                            <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-arrow-left"></i> Continuer mes achats
                            </a>
                        </div>
                    </div>
                @else
                    {{-- PRODUITS DU PANIER --}}
                    <div class="card">
                        <div class="card-body">
                            @foreach($panier as $id => $item)
                                <div class="row align-items-center mb-3 pb-3 border-bottom">

                                    {{-- Image --}}
                                    <div class="col-md-2">
                                        <div class="bg-light p-2 text-center" style="height: 80px;">
                                            @if($item['image'])
                                                <img src="{{ asset('storage/' . $item['image']) }}"
                                                     alt="{{ $item['nom'] }}"
                                                     class="img-fluid"
                                                     style="max-height: 100%;">
                                            @else
                                                <i class="fas fa-box fa-3x text-muted"></i>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Nom --}}
                                    <div class="col-md-4">
                                        <h5 class="mb-1">{{ $item['nom'] }}</h5>
                                        <p class="text-muted mb-0">
                                            {{ number_format($item['prix'], 0, ',', ' ') }} FCFA
                                        </p>
                                    </div>

                                    {{-- Quantité --}}
                                    <div class="col-md-3">
                                        <form action="{{ route('panier.update', $id) }}" method="POST" class="d-flex align-items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <label class="me-2">Quantité:</label>
                                            <input type="number"
                                                   name="quantite"
                                                   value="{{ $item['quantite'] }}"
                                                   min="1"
                                                   class="form-control form-control-sm"
                                                   style="width: 70px;"
                                                   onchange="this.form.submit()">
                                        </form>
                                    </div>

                                    {{-- Sous-total --}}
                                    <div class="col-md-2">
                                        <strong class="text-primary">
                                            {{ number_format($item['prix'] * $item['quantite'], 0, ',', ' ') }} FCFA
                                        </strong>
                                    </div>

                                    {{-- Bouton supprimer --}}
                                    <div class="col-md-1">
                                        <form action="{{ route('panier.remove', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Retirer ce produit ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- CONTINUER LES ACHATS --}}
                    <a href="{{ route('home') }}" class="btn btn-outline-primary mt-3">
                        <i class="fas fa-arrow-left"></i> Continuer mes achats
                    </a>
                @endif
            </div>

            {{-- RÉSUMÉ --}}
            @if(!empty($panier))
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-calculator"></i> Résumé de la commande
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Sous-total:</span>
                                <strong>{{ number_format($total, 0, ',', ' ') }} FCFA</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Livraison:</span>
                                <span class="text-success ">Gratuite</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Total:</strong>
                                <h4 class="text-primary mb-0">{{ number_format($total, 0, ',', ' ') }} FCFA</h4>
                            </div>

                            @auth
                                {{-- Si connecté : Commander --}}
                                <a href="{{ route('checkout') }}" class="btn btn-success w-100 btn-lg">
                                    <i class="fas fa-credit-card"></i> Passer la commande
                                </a>
                            @else
                                {{-- Si pas connecté : Se connecter pour commander --}}
                                <div class="alert alert-warning text-center">
                                    <i class="fas fa-info-circle"></i>
                                    Connectez-vous pour finaliser votre commande
                                </div>
                                <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2">
                                    <i class="fas fa-sign-in-alt"></i> Se connecter
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-user-plus"></i> S'inscrire
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-1">
                <i class="fas fa-copyright"></i> 2025 Shop - Tous droits réservés
            </p>
            {{-- <p class="text-muted small">
                Développé avec <i class="fas fa-heart text-danger"></i> par Vital
            </p> --}}
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
