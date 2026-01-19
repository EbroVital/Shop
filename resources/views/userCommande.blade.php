
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Mes commandes </title>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        {{-- <style>
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
        </style> --}}
    </head>
    <body>

        {{-- NAVBAR --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                {{-- Logo --}}
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

                        {{-- Lien Panier (VISIBLE PAR TOUS) --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('panier.index') }}">
                                <i class="fas fa-shopping-cart"></i> Panier
                                <span class="badge bg-danger">{{ \App\Helpers\Cart::count() }}</span>
                            </a>
                        </li>

                        @auth
                            {{-- Si connecté --}}
                            <li class="nav-item">
                                <span class="nav-link">
                                    <i class="fas fa-user"></i> Bonjour, <strong>{{ Auth::user()->name }}</strong>
                                </span>
                            </li>

                            {{-- Mes commandes --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('user.commande')}}">
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

        <div class="container py-5">
            <h2 class="mb-4">
                <i class="fas fa-box"></i> Historique de mes Commandes
            </h2>

            @if($commandes->count() > 0)

                {{-- BOUCLE SUR LES COMMANDES --}}
                @foreach($commandes as $commande)
                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    Commande #{{ $commande->id }}
                                </h5>
                                <div>
                                    @php
                                        $badges = [
                                            'en attente' => 'warning',
                                            'validée' => 'info',
                                            'expediée' => 'primary',
                                            'livrée' => 'success'
                                        ];
                                        $badge = $badges[$commande->statut] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $badge }}">
                                        {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                    </span>
                                </div>
                            </div>
                            <small>{{ $commande->created_at->format('d/m/Y à H:i') }}</small>
                        </div>

                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th class="text-center">Prix unitaire</th>
                                        <th class="text-center">Quantité</th>
                                        <th class="text-end">Sous-total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- BOUCLE SUR LES PRODUITS DE CETTE COMMANDE --}}
                                    @foreach($commande->products as $produit)
                                        <tr>
                                            <td>{{ $produit->nom }}</td>
                                            <td class="text-center">
                                                {{ number_format($produit->pivot->prix_unitaire, 0, ',', ' ') }} FCFA
                                            </td>
                                            <td class="text-center">
                                                {{ $produit->pivot->quantite }}
                                            </td>
                                            <td class="text-end">
                                                <strong>
                                                    {{ number_format($produit->pivot->prix_unitaire * $produit->pivot->quantite, 0, ',', ' ') }} FCFA
                                                </strong>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"><strong>TOTAL :</strong></td>
                                        <td class="text-end">
                                            <h5 class="text-success mb-0">
                                                {{ number_format($commande->total, 0, ',', ' ') }} FCFA
                                            </h5>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="mt-3">
                                <p class="mb-1"><strong>Adresse de livraison:</strong></p>
                                <p class="text-muted mb-0" style="white-space: pre-line;">
                                    {{ $commande->adresse_livraison }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            @else
                {{-- AUCUNE COMMANDE --}}
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-inbox fa-3x mb-3"></i>
                    <h4>Aucune commande pour l'instant</h4>
                    <p class="text-muted">Commencez vos achats dès maintenant !</p>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-shopping-cart"></i> Découvrir nos produits
                    </a>
                </div>
            @endif
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
