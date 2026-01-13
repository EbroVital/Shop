@extends('layouts.template')

@section('title', 'Liste des utilisateurs')
@section('titre', 'Les utilisateurs')


@section('content')

    <div class="container-fluid">
		<div class="card">
			<div class="card-body table-responsive p-0">
				<table class="table table-hover text-nowrap">
					<thead>
						<tr>
                            <th class="text-center">#</th>
							<th class="text-center">Nom</th>
							<th class="text-center">Email</th>
							<th class="text-center">Date d'enregistrement</th>
						</tr>
					</thead>
					<tbody>

                        @forelse ($users as $user)

                            <tr>
                               <td class="text-center"> {{ $user->id }} </td>
                               <td class="text-center"> {{ $user->name }} </td>
                               <td class="text-center"> {{ $user->email  }} </td>
                                <td class="text-center">
                                    {{ $user->created_at->format('d/m/Y H:i') }}
                                </td>

                            </tr>

                        @empty
                            <p class="alert alert-info text-center"> Aucun Utilisateur enregistré</p>
                        @endforelse

					</tbody>
				</table>
			</div>
		</div>
    </div>

@endsection
