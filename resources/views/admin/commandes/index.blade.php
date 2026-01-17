@extends('layouts.template')

@section('title', 'Gestion des commandes')
@section('titre', 'Les Commandes')



@section('content')

    @if ( session('message') )
        <div class="alert alert-info text-center">
            {{ session('message') }}
        </div>
    @endif

    <div class="container-fluid">

        {{-- STATISTIQUES --}}
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Total</h5>
                        <h2>{{ $stats['total'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5>En attente</h5>
                        <h2>{{ $stats['en attente'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5>Validées</h5>
                        <h2>{{ $stats['validee'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Livrées</h5>
                        <h2>{{ $stats['livree'] }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- FILTRES --}}
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('commandes.index') }}" class="row g-3">

                    {{-- Recherche --}}
                    <div class="col-md-6">
                        <label>Rechercher</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control"
                                placeholder="N° commande, nom ou email client..."
                                value="{{ $search }}">
                        </div>
                    </div>

                    {{-- Filtre statut --}}
                    <div class="col-md-4">
                        <label>Statut</label>
                        <select name="statut" class="form-control">
                            <option value="">Tous les statuts</option>
                            <option value="en attente" {{ $statut ==  'en attente' ? 'selected' : '' }}>En attente</option>
                            <option value="validee" {{ $statut == 'validee' ? 'selected' : '' }}>Validée</option>
                            <option value="expediee" {{ $statut == 'expediee' ? 'selected' : '' }}>Expédiée</option>
                            <option value="livree" {{ $statut == 'livree' ? 'selected' : '' }}>Livrée</option>
                        </select>
                    </div>

                    {{-- Boutons --}}
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter"></i> Filtrer
                            </button>
                            <a href="{{ route('commandes.index') }}" class="btn btn-secondary">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- TABLEAU DES COMMANDES --}}
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fas fa-shopping-bag"></i> Liste des commandes
                    <span class="badge bg-secondary">{{ $commandes->total() }}</span>
                </h5>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Adresse de livraison</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($commandes as $commande)
                                <tr>
                                    <td><strong>{{ $commande->id }}</strong></td>
                                    <td>
                                        <div>{{ $commande->user->name }}</div>
                                        <small class="text-muted">{{ $commande->user->email }}</small>
                                    </td>
                                    <td>{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                                    <td><strong class="badge badge-success">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</strong></td>
                                    <td> {{ $commande->adresse_livraison }} </td>
                                    <td>
                                        @php
                                            $badges = [
                                                'en attente' => 'warning',
                                                'validee' => 'info',
                                                'expediee' => 'primary',
                                                'livree' => 'success'
                                            ];
                                            $badge = $badges[$commande->statut] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $badge }}">
                                            {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('commandes.show', $commande) }}"
                                        class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                        <p>Aucune commande trouvée</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="mt-3">
                    {{ $commandes->links() }}
                </div>
            </div>
        </div>

    </div>

@endsection
