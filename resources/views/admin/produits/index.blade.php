@extends('layouts.template')

@section('title', 'Liste des produits')
@section('titre', 'Les Produits')

@section('btn')

    <div class="col-sm-6 text-right">
	    <a href="{{route('produits.create')}}" class="btn btn-primary">Nouveau produit</a>
    </div>


@endsection


@section('content')

    @if ( session('message') )
        <div class="alert alert-info text-center">
            {{ session('message') }}
        </div>
    @endif

    <div class="container-fluid">
		<div class="card">
			<div class="card-body table-responsive p-0">
				<table class="table table-hover text-nowrap">
					<thead>
						<tr>
							<th class="text-center">ID</th>
							<th class="text-center">Image</th>
							<th class="text-center">Nom</th>
							<th class="text-center">Description</th>
							<th class="text-center">Prix</th>
							<th class="text-center">Stock</th>
							<th class="text-center">Catégorie</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>

                        @forelse ($produits as $produit)

                            <tr>
                               <td class="text-center"> {{ $produit->id }} </td>
                               <td class="text-center">
                                    @if($produit->image)
                                        <img src="{{ asset('storage/' . $produit->image) }}"
                                                alt="{{ $produit->nom }}"
                                                class="img-fluid">
                                    @else
                                        <i class="fas fa-box text-muted"></i>
                                    @endif
                                </td>
                               <td class="text-center"> {{ $produit->nom }} </td>
                               <td class="text-center"> {{ $produit->description ?? "Pas de description" }} </td>
                               <td class="text-center">
                                 <span class="badge badge-success"> {{ $produit->prix }} FCFA </span>
                                </td>
                               <td class="text-center">
                                    @if($produit->stock > 0)
                                        <i class="fas fa-check-circle text-success"></i>
                                        En stock ({{ $produit->stock }})
                                     @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                        Rupture de stock
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-primary">
                                        {{ $produit->categorie->libelle }}
                                    </span>
                                </td>
                               <td class="text-center">
                                    <a href="{{route('produits.edit', $produit)}}" class="btn btn-warning">
                                        Modifier
                                    </a>

                                    <form action="{{ route('produits.destroy', $produit)}}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous supprimer ce produit ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Supprimer</button>
                                    </form>
                               </td>
                            </tr>

                        @empty
                            <p class="alert alert-info text-center"> Aucun produit ajouté</p>
                        @endforelse

					</tbody>
				</table>
			</div>
		</div>
    </div>

@endsection
