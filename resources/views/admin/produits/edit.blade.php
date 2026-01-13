@extends('layouts.template')

@section('title', "Modifier un produit")
@section('titre', "Modifier un produit")


@section('content')

    <div class="container-fluid">

        <form action="{{ route('produits.update', $produit) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="title">Nom</label>
                                        <input type="text" name="nom" id="title" class="form-control @error('nom') is-invalid @enderror" placeholder="nom" value= "{{ old('nom', $produit->nom ) }}">
                                        @error('nom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{ old('description', $produit->description)  }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Image du produit</h2>
                            <div id="image" class="dropzone dz-clickable">
                                <input type="file" name="image" id="" class="form-control @error('image') is-invalid @enderror" value="{{ old('image', $produit->image )  }}">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="price">prix</label>
                                        <input type="text" name="prix" id="price" class="form-control @error('prix') is-invalid @enderror" placeholder="prix" value="{{ old('prix', $produit->prix )  }}">
                                        @error('prix')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="sku">Stock</label>
                                <input type="number" name="stock" id="sku" class="form-control @error('stock') is-invalid @enderror" placeholder="stock" value="{{ old('stock', $produit->stock )   }}">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h4  mb-3">Catégorie du produit</h2>
                            <div class="mb-3">
                                <label for="category">Les catégories</label>
                                <select name="categorie_id" id="category_id" class="form-control" required>
                                    <option value="">-- Choisissez une catégorie --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ (old('categorie_id') ?? ($produit->categorie_id ?? '')) == $category->id ? 'selected' : '' }}>
                                                {{ $category->libelle }}
                                            </option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pb-5 pt-3">
                <button class="btn btn-success">Ajouter</button>
                <a href="{{route('produits.index')}}" class="btn btn-outline-dark ml-3">Annuler</a>
            </div>

        </form>

	</div>

@endsection
