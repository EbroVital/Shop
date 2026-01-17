<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande confirmée - Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <nav class="navbar navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
                <i class="fas fa-shopping-cart"></i> Shop
            </a>
        </div>
    </nav>

    <div class="container py-5">

        {{-- MESSAGE DE SUCCÈS --}}
        <div class="text-center mb-5">
            <div class="mb-4">
                <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
            </div>
            <h1 class="text-success mb-3">Commande confirmée !</h1>
            <p class="lead">Merci pour votre commande #{{ $commande->id }}</p>
            <p class="text-muted">Un email de confirmation vous a été envoyé</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- DÉTAILS COMMANDE --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0">
                            <i class="fas fa-receipt"></i> Détails de votre commande
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1">
                                    <strong>N° de commande :</strong>
                                    {{ $commande->id }}
                                </p>
                                <p></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1">
                                    <strong>Date:</strong>
                                    {{ $commande->created_at->format('d/m/Y à H:i') }}
                                </p>
                                <p></p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <p class="mb-1">
                                <strong>Statut:</strong>
                                <span class="badge bg-warning">En attente de validation</span>
                            </p>

                        </div>

                        <div class="mb-3">
                            <p class="mb-1">
                                <strong>Adresse de livraison:</strong>
                                <p class="mb-0" style="white-space: pre-line;">{{ $commande->adresse_livraison }}</p>
                            </p>

                        </div>

                        <hr>

                        <h6 class="mb-3">Articles commandés</h6>
                        @foreach($commande->products as $produit)
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <strong>{{ $produit->nom }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $produit->pivot->quantite }} x {{ number_format($produit->pivot->prix_unitaire, 0, ',', ' ') }} FCFA</small>
                                </div>
                                <strong>{{ number_format($produit->pivot->quantite * $produit->pivot->prix_unitaire, 0, ',', ' ') }} FCFA</strong>
                            </div>
                        @endforeach

                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5>Total:</h5>
                            <h4 class="text-success">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</h4>
                        </div>
                    </div>
                </div>

                {{-- PROCHAINES ÉTAPES --}}
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle"></i> Prochaines étapes
                        </h5>
                    </div>
                    <div class="card-body">
                        <ol class="mb-0">
                            <li class="mb-2">Nous allons vérifier votre commande</li>
                            <li class="mb-2">Vous recevrez une confirmation par email</li>
                            <li class="mb-2">Votre commande sera préparée et expédiée</li>
                            <li>Livraison sous 2-5 jours ouvrés</li>
                        </ol>
                    </div>
                </div>

                {{-- BOUTONS --}}
                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-home"></i> Retour à l'accueil
                    </a>
                    <a href="{{route('user.commande')}}" class="btn btn-outline-primary">
                        <i class="fas fa-box"></i> Mes commandes
                    </a>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

