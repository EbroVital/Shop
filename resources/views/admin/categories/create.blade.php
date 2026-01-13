@extends('layouts.template')

@section('title', 'Créer une catégorie')
@section('titre', 'Créer une catégorie')

{{-- @section('btn')
    <a href="{{route('category.index')}}" class="btn btn-primary">Retour</a>
@endsection --}}

@section('content')

    <div class="container-fluid">
        
        <form action="{{ route('category.store') }}" method="POST">
            @csrf

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="libelle">Libellé</label>
                        <input type="text"
                               name="libelle"
                               id="libelle"
                               class="form-control @error('libelle') is-invalid @enderror"
                               placeholder="Libellé"
                               value="{{ old('libelle') }}">
                        @error('libelle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
                <a href="{{ route('category.index') }}" class="btn btn-outline-dark ms-3">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>

@endsection
