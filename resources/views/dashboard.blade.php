{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Tableau de bord</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/custom.css')}}">
	</head>
	<body class="hold-transition sidebar-mini">
		<!-- Site wrapper -->
		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<!-- Right navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
					  	<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>
				</ul>
				<div class="navbar-nav pl-2">
					<!-- <ol class="breadcrumb p-0 m-0 bg-white">
						<li class="breadcrumb-item active">Dashboard</li>
					</ol> -->
				</div>

				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" data-widget="fullscreen" href="#" role="button">
							<i class="fas fa-expand-arrows-alt"></i>
						</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
							<img src="{{ asset('img/avatar5.png')}}" class='img-circle elevation-2' width="40" height="40" alt="">
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
							<h4 class="h4 mb-0"><strong>{{ Auth::user()->name }}</strong></h4>
							<div class="mb-3">{{ Auth::user()->email }}</div>
							<div class="dropdown-divider"></div>
							<a href="{{route('profile.edit')}}" class="dropdown-item">
								<i class="fas fa-user-cog mr-2"></i> Profil
							</a>
							<div class="dropdown-divider"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();this.closest('form').submit();">
								    <i class="fas fa-sign-out-alt mr-2"></i> Se déconnecter
							    </a>
                            </form>
						</div>
					</li>
				</ul>
			</nav>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<!-- Brand Logo -->
				<a href="{{route('dashboard')}}" class="brand-link">
					<img src="{{asset('img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
					<span class="brand-text font-weight-light">SHOP</span>
				</a>
				<!-- Sidebar -->
				<div class="sidebar">
					<!-- Sidebar user (optional) -->
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<!-- Add icons to the links using the .nav-icon class
								with font-awesome or any other icon font library -->
							<li class="nav-item">
								<a href="{{route('dashboard')}}" class="nav-link">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>Tableau de bord</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{route('category.index')}}" class="nav-link">
									<i class="nav-icon fas fa-file-alt"></i>
									<p>Categories</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{route('produits.index')}}" class="nav-link">
									<i class="nav-icon fas fa-tag"></i>
									<p>Produits</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="{{route('commandes.index')}}" class="nav-link">
									<i class="nav-icon fas fa-shopping-bag"></i>
									<p>commandes</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{route('users.index')}}" class="nav-link">
									<i class="nav-icon  fas fa-users"></i>
									<p>Utilisateurs</p>
								</a>
							</li>
                            <li class="nav-item">
								<a href="{{route('home')}}" class="nav-link">
                                    <i class="fas fa-arrow-circle-left"></i>
									<p> Retour à l'accueil </p>
								</a>
							</li>
						</ul>
					</nav>
					<!-- /.sidebar-menu -->
				</div>
				<!-- /.sidebar -->
         	</aside>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Tableau de bord</h1>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-4 col-6">
								<div class="small-box card">
									<div class="inner">
										<h3> {{ $commandes }} </h3>
										<p>Nombres de commandes</p>
									</div>
									<div class="icon">
										<i class="ion ion-person-add"></i>
									</div>
									<a href="" class="small-box-footer">&nbsp;</a>
								</div>
							</div>

							<div class="col-lg-4 col-6">
								<div class="small-box card">
									<div class="inner">
										<h3> {{ $users }} </h3>
										<p>Nombres d'utilisateurs</p>
									</div>
									<div class="icon">
										<i class="ion ion-person-add"></i>
									</div>
									<a href="" class="small-box-footer">&nbsp;</a>
								</div>
							</div>

							<div class="col-lg-4 col-6">
								<div class="small-box card">
									<div class="inner">
										<h3> {{ number_format($total, 0, ',', ' ') }} FCFA</h3>
										<p>Prix total des commandes</p>
									</div>
									<div class="icon">
										<i class="ion ion-person-add"></i>
									</div>
									<a href="" class="small-box-footer">&nbsp;</a>
								</div>
							</div>

                            <div class="col-lg-4 col-6">
								<div class="small-box card">
									<div class="inner">
										<h3> {{ $categorie }} </h3>
										<p>Nombre de catégories</p>
									</div>
									<div class="icon">
										<i class="ion ion-person-add"></i>
									</div>
									<a href="" class="small-box-footer">&nbsp;</a>
								</div>
							</div>

                            <div class="col-lg-4 col-6">
								<div class="small-box card">
									<div class="inner">
										<h3> {{ $stats['en attente'] }} </h3>
										<p>Nombre de commandes en attente</p>
									</div>
									<div class="icon">
										<i class="ion ion-person-add"></i>
									</div>
									<a href="" class="small-box-footer">&nbsp;</a>
								</div>
							</div>

                            <div class="col-lg-4 col-6">
								<div class="small-box card">
									<div class="inner">
										<h3> {{ $stats['validee'] }} </h3>
										<p>Nombre de commandes validées</p>
									</div>
									<div class="icon">
										<i class="ion ion-person-add"></i>
									</div>
									<a href="" class="small-box-footer">&nbsp;</a>
								</div>
							</div>

                            <div class="col-lg-4 col-6">
								<div class="small-box card">
									<div class="inner">
										<h3> {{ $stats['expediee'] }} </h3>
										<p>Nombre de commandes expediées</p>
									</div>
									<div class="icon">
										<i class="ion ion-person-add"></i>
									</div>
									<a href="" class="small-box-footer">&nbsp;</a>
								</div>
							</div>

                            <div class="col-lg-4 col-6">
								<div class="small-box card">
									<div class="inner">
										<h3> {{ $stats['livree'] }} </h3>
										<p>Nombre de commandes livrées </p>
									</div>
									<div class="icon">
										<i class="ion ion-person-add"></i>
									</div>
									<a href="" class="small-box-footer">&nbsp;</a>
								</div>
							</div>

                            <div class="col-lg-4 col-6">
								<div class="small-box card">
									<div class="inner">
										<h3> {{ $produits }} </h3>
										<p>Nombre de produits</p>
									</div>
									<div class="icon">
										<i class="ion ion-person-add"></i>
									</div>
									<a href="" class="small-box-footer">&nbsp;</a>
								</div>
							</div>
						</div>
					</div>
					<!-- /.card -->
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
			<footer class="main-footer text-center">

				<strong>Copyright &copy; 2026 Shop Tous droits réservés .
			</footer>

		</div>
		<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<!-- AdminLTE App -->
		<script src="{{asset('js/adminlte.min.js')}}"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="{{asset('js/demo.js')}}"></script>
	</body>
</html>
