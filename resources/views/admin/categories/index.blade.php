@extends('layouts.template')

@section('title', 'Liste des catégories')
@section('titre', 'Les catégories')

@section('btn')

    <div class="col-sm-6 text-right">
	    <a href="{{route('category.create')}}" class="btn btn-primary">Nouvelle catégorie</a>
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
							<th class="text-center">Libellé</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>

                        @foreach ($categories as $category)

                            <tr>
                                <td class="text-center"> {{$category->id}} </td>
                                <td class="text-center"> {{$category->libelle}} </td>
                                <td class="text-center">

                                    <a href="{{route('category.show', $category)}}" class="btn btn-warning">
                                        Voir
                                    </a>

                                    <a href="{{route('category.edit', $category)}}" class="btn btn-primary">
                                        Modifier
                                    </a>

                                    <form action="{{ route('category.destroy', $category)}}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous supprimer cette catégorie ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach


					</tbody>
				</table>
			</div>

		</div>
	</div>

@endsection
