			<div class="logo-header">
				<img src="/Authentification/img/Rapide service.jpg" style="width: 130px; height: 50px;" alt="Rapide service" class="img-fluid">
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">

					<form class="navbar-left navbar-form nav-search mr-md-3" action="">
						<div class="input-group">
							<input type="text" placeholder="Search ..." class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">
									<i class="la la-search search-icon"></i>
								</span>
							</div>
						</div>
					</form>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="/../assets/img/image user.jpg" alt="user-img" width="36" class="img-circle"><span >{{ Auth::user()->name }}</span></span> </a>
							<ul class="dropdown-menu dropdown-user">
									<a class="dropdown-item" href="#"><i class="ti-settings"></i>Profil</a>
									<div class="dropdown-divider"></div>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" class="dropdown-item"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                            <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                                        </a>
                                    </form>

									{{-- <a class="dropdown-item" href="#"><i class="fa fa-power-off"></i> Logout</a> --}}
								</ul>
								<!-- /.dropdown-user -->
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<div class="user">
						<div class="photo">
							<img src="/../assets/img/image user.jpg">
						</div>

                        @if (Auth::user()->role == 'Client')

                        @endif

						<div class="info">
							<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ Auth::user()->name }}
									<span class="user-level">{{ Auth::user()->role }}</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
							<a href="{{ route('dashboard') }}">
								<i class="la la-dashboard"></i>
								<p>Tableau de Bord</p>
								<span class="badge badge-count"></span>
							</a>
						</li>
                    @if (Auth::user()->role == "Secretaire" || Auth::user()->role === 'Super-admin')
						{{-- <li class="nav-item {{ request()->routeIs('transfert.list_transfert.index') ? 'active' : '' }}">
							<a href="{{ route('transfert.list_transfert.index') }}">
								<i class="la la-exchange"></i>
								<p>Gestion des Transferts</p>
							</a>
						</li> --}}
						<li class="nav-item {{ request()->routeIs('colis.list_colis.index') ? 'active' : '' }}">
							<a href="{{ route('colis.list_colis.index') }}">
								<i class="la la-truck"></i>
								<p>Gestion des Colis</p>
								<span class="badge badge-count"></span>
							</a>
						</li>
                        <li class="nav-item {{ request()->routeIs('user.admin.index') ? 'active' : '' }}">
							<a href="{{ route('user.admin.index') }}">
								<i class="la la-users"></i>
                                    <p>Secretaire</p>
								<span class="badge badge-count"></span>
							</a>
						</li>
                        <li class="nav-item {{ request()->routeIs('agence.index') ? 'active' : '' }}">
							<a href="{{ route('agence.index') }}">
								<i class="la la-newspaper-o"></i>
								<p>Agences</p>
								<span class="badge badge-count"></span>
							</a>
						</li>
                        <li class="nav-item {{ request()->routeIs('user.user.index') ? 'active' : '' }}">
							<a href="{{ route('user.user.index') }}">
								<i class="la la-users"></i>
								<p>
                                    Clients
                                </p>
								<span class="badge badge-count"></span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="#">
								<i class="la la-truck"></i>
								<p>
                                    Groupage
                                </p>
								<span class="badge badge-count"></span>
							</a>
						</li>
                    @endif

                        {{-- <li class="nav-item active">
							<a href="#">
								<i class="la la-dashboard"></i>
								<p>Paiements</p>
								<span class="badge badge-count">9</span>
							</a>
						</li>
                        <li class="nav-item active">
							<a href="index.html">
								<i class="la la-dashboard"></i>
								<p>Paramètres</p>
								<span class="badge badge-count">0</span>
							</a>
						</li> --}}
					</ul>
				</div>
			</div>
			<div class="main-panel">
