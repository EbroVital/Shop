<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finaliser ma commande - Shop</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
                <i class="fas fa-shopping-cart"></i> Shop
            </a>

            <div class="navbar-nav ms-auto">
                <span class="nav-link">
                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                </span>
            </div>
        </div>
    </nav>

    {{-- CONTENU --}}
    <div class="container py-5">

        @if(session('message'))
            <div class="alert alert-danger alert-dismissible fade show text-center">
                <i class="fas fa-exclamation-circle"></i> {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif


        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show text-center">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ÉTAPES --}}
        <div class="mb-5">
            <div class="d-flex justify-content-center">
                <div class="text-center mx-3">
                    <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center"
                         style="width: 50px; height: 50px;">
                        <i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2 mb-0 small">Panier</p>
                </div>
                <div class="align-self-center" style="width: 100px; height: 2px; background: #ddd;"></div>
                <div class="text-center mx-3">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center"
                         style="width: 50px; height: 50px;">
                        2
                    </div>
                    <p class="mt-2 mb-0 small"><strong>Livraison</strong></p>
                </div>
                <div class="align-self-center" style="width: 100px; height: 2px; background: #ddd;"></div>
                <div class="text-center mx-3">
                    <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center"
                         style="width: 50px; height: 50px;">
                        3
                    </div>
                    <p class="mt-2 mb-0 small">Confirmation</p>
                </div>
            </div>
        </div>

        <div class="row">

            {{-- FORMULAIRE LIVRAISON --}}
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-truck"></i> Informations de livraison
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf

                            {{-- Infos client (pré-remplies) --}}
                            <div class="mb-4">
                                <h6 class="border-bottom pb-2 mb-3">Informations client</h6>
                                <p class="mb-1"><strong>Nom :</strong> {{ Auth::user()->name }}</p>
                                <p class="mb-0"><strong>Email :</strong> {{ Auth::user()->email }}</p>
                            </div>

                            {{-- Adresse de livraison --}}
                            <div class="mb-4">
                                <h6 class="border-bottom pb-2 mb-3">Adresse de livraison</h6>

                                <div class="mb-3">
                                    <label for="adresse" class="form-label">
                                        Adresse complète <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="adresse_livraison"
                                              id="adresse"
                                              rows="3"
                                              class="form-control @error('adresse_livraison') is-invalid @enderror"
                                              placeholder="Ex: Cocody, Angré 7ème Tranche, Rue des Jardins, Villa 123"
                                              required>{{ old('adresse_livraison') }}</textarea>
                                    @error('adresse_livraison')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">
                                        Indiquez votre adresse complète avec des détails précis
                                    </small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="telephone" class="form-label">
                                            Téléphone <span class="text-danger">*</span>
                                        </label>
                                        <input type="tel"
                                               name="telephone"
                                               id="telephone"
                                               class="form-control @error('telephone') is-invalid @enderror"
                                               placeholder="Ex: +225 07 XX XX XX XX"
                                               value="{{ old('telephone') }}"
                                               required>
                                        @error('telephone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="ville" class="form-label">
                                            Ville <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                               name="ville"
                                               id="ville"
                                               class="form-control @error('ville') is-invalid @enderror"
                                               placeholder="Ex: Abidjan"
                                               value="{{ old('ville') }}"
                                               required>
                                        @error('ville')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="remarques" class="form-label">
                                        Remarques (optionnel)
                                    </label>
                                    <textarea name="remarques"
                                              id="remarques"
                                              rows="2"
                                              class="form-control"
                                              placeholder="Ex: Livraison entre 14h et 18h, appeler avant de venir...">{{ old('remarques') }}</textarea>
                                </div>
                            </div>

                            {{-- Mode de paiement --}}
                            <div class="mb-4">
                                <h6 class="border-bottom pb-2 mb-3">Mode de paiement</h6>
                                <div class="alert alert-info text-center">
                                    <i class="fas fa-info-circle"></i>
                                    Paiement à la livraison (espèces uniquement)
                                </div>
                            </div>

                            {{-- Boutons --}}
                            <div class="d-flex gap-2">
                                <a href="{{ route('panier.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left"></i> Retour au panier
                                </a>
                                <button type="submit" class="btn btn-success flex-grow-1">
                                    <i class="fas fa-check"></i> Confirmer la commande
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- RÉSUMÉ COMMANDE --}}
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-receipt"></i> Résumé de la commande
                        </h5>
                    </div>
                    <div class="card-body">
                        {{-- Produits --}}
                        <h6 class="mb-3">Articles ({{ count($panier) }})</h6>
                        @foreach($panier as $id => $item)
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="flex-grow-1">
                                    <p class="mb-0"><strong>{{ $item['nom'] }}</strong></p>
                                    <small class="text-muted">{{ $item['quantite'] }} x {{ number_format($item['prix'], 0, ',', ' ') }} FCFA</small>
                                </div>
                                <strong>{{ number_format($item['prix'] * $item['quantite'], 0, ',', ' ') }} FCFA</strong>
                            </div>
                        @endforeach

                        <hr>

                        {{-- Totaux --}}
                        <div class="d-flex justify-content-between mb-2">
                            <span>Sous-total:</span>
                            <strong>{{ number_format($total, 0, ',', ' ') }} FCFA</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Livraison:</span>
                            <span class="text-success">Gratuite</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5>Total à payer:</h5>
                            <h4 class="text-success mb-0">{{ number_format($total, 0, ',', ' ') }} FCFA</h4>
                        </div>
                    </div>
                </div>

                {{-- Sécurité --}}
                <div class="card mt-3">
                    <div class="card-body text-center">
                        <i class="fas fa-shield-alt fa-3x text-success mb-2"></i>
                        <p class="mb-0 small text-muted">
                            Vos informations sont sécurisées
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">© 2026 Shop - Tous droits réservés</p>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
