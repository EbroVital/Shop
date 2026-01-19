@extends('layouts.template')

@section('title', 'Modifier une commande')
@section('titre', 'Les Commandes en cours')

@section('content')


    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="fas fa-shopping-bag"></i> Commande #{{ $commande->id }}
            </h2>
        </div>

        <div class="row">

            {{-- INFOS COMMANDE --}}
            <div class="col-md-8">

                {{-- PRODUITS --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0"><i class="fas fa-box"></i> Produits commandés</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Produit</th>
                                    <th class="text-center">Prix unitaire</th>
                                    <th class="text-center">Quantité</th>
                                    <th class="text-center">Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commande->products as $produit)
                                    <tr>
                                        <td class="text-center">{{ $produit->nom }}</td>
                                        <td class="text-center">{{ number_format($produit->pivot->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                                        <td class="text-center">{{ $produit->pivot->quantite }}</td>
                                        <td class="text-center"><strong>{{ number_format($produit->pivot->prix_unitaire * $produit->pivot->quantite, 0, ',', ' ') }} FCFA</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>TOTAL:</strong></td>
                                    <td><h4 class="text-primary mb-0">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</h4></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                {{-- ADRESSE LIVRAISON --}}
                <div class="card">
                    <div class="card-header bg-info text-white text-center">
                        <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Adresse de livraison</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $commande->adresse_livraison }}</p>
                    </div>
                </div>

            </div>

            {{-- SIDEBAR --}}
            <div class="col-md-4">

                {{-- INFO CLIENT --}}
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white text-center">
                        <h5 class="mb-0"><i class="fas fa-user"></i> Client</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Nom:</strong> {{ $commande->user->name }}</p>
                        <p><strong>Email:</strong> {{ $commande->user->email }}</p>
                        <p class="mb-0"><strong>Date commande :</strong> {{ $commande->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>

                {{-- GESTION STATUT --}}
                <div class="card">
                    <div class="card-header bg-warning text-dark text-center">
                        <h5 class="mb-0"><i class="fas fa-edit"></i> Modifier le statut</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('commandes.updateStatut', $commande) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label>Statut actuel:</label>
                                <p>
                                    @php
                                        $badges = [
                                            'en attente' => 'warning',
                                            'validée' => 'info',
                                            'expediée' => 'primary',
                                            'livrée' => 'success'
                                        ];
                                        $badge = $badges[$commande->statut] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $badge }} fs-6">
                                        {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                    </span>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label for="statut">Nouveau statut:</label>
                                <select name="statut" id="statut" class="form-control" required>
                                    <option value="en attente" {{ $commande->statut == 'en attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="validée" {{ $commande->statut == 'validée' ? 'selected' : '' }}>Validée</option>
                                    <option value="expediée" {{ $commande->statut == 'expediée' ? 'selected' : '' }}>Expédiée</option>
                                    <option value="livrée" {{ $commande->statut == 'livrée' ? 'selected' : '' }}>Livrée</option>
                                </select>
                            </div>

                            <div class="d-grid  gap-2 d-md-block">

                                <button type="submit" class="btn btn-success">
                                     Mettre à jour
                                </button>

                                <a href="{{ route('commandes.index') }}" class="btn btn-secondary">
                                     Retour
                                </a>

                            </div>

                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>


@endsection
