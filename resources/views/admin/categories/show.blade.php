@extends('layouts.template')

@section('title', 'Voir une catégorie')
@section('titre', 'Voir une catégorie')

{{-- @section('btn')
    <a href="{{route('category.index')}}" class="btn btn-primary">Retour</a>
@endsection --}}

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3>Libellé : {{ $category->libelle }}</h3>

                <p> Les produits de cette catégorie :</p>

                @forelse ($category->products as $product)
                    <li> {{ $product->nom }} </li>
                @empty
                    <p class="alert alert-info text-center"> Aucun produit ajouté à cette catégorie </p>
                @endforelse


            </div>
        </div>

        <a href="{{ route('category.index') }}" class="btn btn-secondary mb-4">Retour à la liste</a>
    </div>

@endsection
