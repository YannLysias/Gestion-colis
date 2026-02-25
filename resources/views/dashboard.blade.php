<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Rapide Service</title>
	<link rel="icon" href="/Authentification/img/Rapide service.jpg">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
                @include('layouts.sidbar')
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Dashboard</h4>
						<div class="row">
							<div class="col-md-3">
								<div class="card card-stats card-warning">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-exchange"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Total : {{ $colisEnregistres }} colis</p>
													<h4 class="card-category">{{ $montantEnregistres }} $</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats card-success">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-truck"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Arrivé : {{ $colisArrive }} colis</p>
													<h4 class="card-category">{{ $montantArrive }} $</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats card-danger">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-dropbox"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Livré : {{ $colisLivres }} colis</p>
													<p class="card-category">{{ $montantLivres }} $</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats card-primary">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-clock-o"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">En attente : {{ $colisEnAttente }} colis</p>
                                                    <p class="card-category">{{ $montantEnAttente }} $</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

    						<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center icon-warning">
													<i class="la la-truck text-warning"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Groupages</p>
                                                    <h4 class="card-title">{{$groupage}}</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-user text-success"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Clients</p>
                                                    <h4 class="card-title">{{ $clients }}</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-users text-primary"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Secrétaires</p>
                                                    <h4 class="card-title">{{ $secretaire }}</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-newspaper-o text-danger"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Agences</p>
                                                    <h4 class="card-title">{{ $agences }}</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> 
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Taux de Livraison</h4>
                                        <p class="card-category">Performance globale</p>
									</div>
									<div class="card-body">
										<div id="task-complete" class="chart-circle mt-4 mb-3"></div>
									</div>
									<div class="card-footer">
										<i class="la la-circle text-success"></i> {{ $tauxLivraison }}% Livrés
									</div>
								</div>
							</div>
							<div class="col-md-9">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Evolution des Colis</h4>
                                        <p class="card-category">Statistiques mensuelles</p>
									</div>
									<div class="card-body">
										<div class="mapcontainer">
											<div style="height:300px;">
                                                <canvas id="evolutionColis"></canvas>
                                            </div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row row-card-no-pd">
							<div class="col-md-4">
								<div class="card">
									<div class="card-body">
										<p class="fw-bold mt-1">Chiffre d'Affaire Total</p>
										<h4><b>{{ number_format($caTotal, 0, ',', ' ') }} $</b></h4>
										<a href="{{ route('colis.list_colis.index') }}" class="btn btn-primary btn-full text-left mt-3 mb-3"><i class="la la-plus"></i> Voir les colis</a>
									</div>
									<div class="card-footer">
										<ul class="nav">
											<li class="nav-item"><a class="btn btn-default btn-link" href="#"><i class="la la-history"></i> Historique</a></li>
											<li class="nav-item ml-auto"><a class="btn btn-default btn-link" href="#"><i class="la la-refresh"></i>Actualiser</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="card">
									<div class="card-body">
										<div class="progress-card">
											<div class="d-flex justify-content-between mb-1">
												<span class="text-muted">Taux Livraison</span>
                                                <span class="text-muted fw-bold"> {{ $tauxLivraison }}%</span>
											</div>
											<div class="progress mb-2" style="height: 7px;">
                                                <div class="progress-bar bg-success"
                                                    style="width: {{ $tauxLivraison }}%">
                                                </div>
                                            </div>
										</div>
										<div class="progress-card">
											<div class="d-flex justify-content-between mb-1">
												<span class="text-muted">Colis arrivés</span>
                                                <span class="text-muted fw-bold"> {{ $tauxArrivé }}%</span>
											</div>
											<div class="progress mb-2" style="height: 7px;">
												<div class="progress-bar bg-info" role="progressbar" style="width: {{ $tauxArrivé }}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="{{ $tauxArrivé }}%"></div>
											</div>
										</div>
										<div class="progress-card">
											<div class="d-flex justify-content-between mb-1">
												<span class="text-muted">En attente</span>
                                                <span class="text-muted fw-bold"> {{ $tauxAttente }}%</span>
											</div>
											<div class="progress mb-2" style="height: 7px;">
												<div class="progress-bar bg-primary" role="progressbar" style="width: {{ $tauxAttente }}%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="{{ $tauxAttente }}%"></div>
											</div>
										</div>
										<div class="progress-card">
											<div class="d-flex justify-content-between mb-1">
												<span class="text-muted">En cours</span>
                                                <span class="text-muted fw-bold"> {{ $tauxCours }}%</span>
											</div>
											<div class="progress mb-2" style="height: 7px;">
												<div class="progress-bar bg-warning" role="progressbar" style="width: {{ $tauxCours }}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="{{ $tauxCours }}%"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body">
										<p class="fw-bold mt-1">Statistiques du Jour</p>
										<div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center icon-warning">
                                                    <i class="la la-box text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 d-flex align-items-center">
                                                <div class="numbers">
                                                    <p class="card-category">Colis</p>
                                                    <h4 class="card-title">{{ $colisAujourdHui }}</h4>
                                                </div>
                                            </div>
                                        </div>
										<hr/>
										<div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="la la-money text-success"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 d-flex align-items-center">
                                                <div class="numbers">
                                                    <p class="card-category">CA du jour</p>
                                                    <h4 class="card-title">
                                                        {{ number_format($caAujourdHui,0,',',' ') }} $
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Répartition des Colis</h4>
                                        <p class="card-category">Selon le statut actuel</p>
									</div>
									<div class="card-body">
										<canvas id="statutChart"></canvas>
									</div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Chiffre d’Affaire Annuel</h4>
                                        <p class="card-category">Evolution mensuelle</p>
									</div>
									<div class="card-body">
										<canvas id="caChart"></canvas>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header ">
										<h4 class="card-title">Top 5 Meilleurs Clients</h4>
                                        <p class="card-category">Classement par nombre de colis envoyés</p>
									</div>
									<div class="card-body">
										<table class="table table-head-bg-success table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Client</th>
                                                <th>Colis</th>
                                                <th>Kilos (Kg)</th>
                                                <th>Montant ($)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($topClients as $index => $client)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $client->client->name ?? 'N/A' }} {{ $client->client->prenom ?? 'N/A' }}</td>
                                                <td><b>{{ $client->total_colis }}</b></td>
                                                <td>{{ number_format($client->total_kilos, 2, ',', ' ') }}</td>
                                                <td>{{ number_format($client->total_montant, 0, ',', ' ') }} $</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
									</div>
								</div>
							</div>
							{{-- <div class="col-md-6">
								<div class="card card-tasks">
									<div class="card-header ">
										<h4 class="card-title">Tasks</h4>
										<p class="card-category">To Do List</p>
									</div>
									<div class="card-body ">
										<div class="table-full-width">
											<table class="table">
												<thead>
													<tr>
														<th>
															<div class="form-check">
																<label class="form-check-label">
																	<input class="form-check-input  select-all-checkbox" type="checkbox" data-select="checkbox" data-target=".task-select">
																	<span class="form-check-sign"></span>
																</label>
															</div>
														</th>
														<th>Task</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<div class="form-check">
																<label class="form-check-label">
																	<input class="form-check-input task-select" type="checkbox">
																	<span class="form-check-sign"></span>
																</label>
															</div>
														</td>
														<td>Planning new project structure</td>
														<td class="td-actions text-right">
															<div class="form-button-action">
																<button type="button" data-toggle="tooltip" title="Edit Task" class="btn btn-link <btn-simple-primary">
																	<i class="la la-edit"></i>
																</button>
																<button type="button" data-toggle="tooltip" title="Remove" class="btn btn-link btn-simple-danger">
																	<i class="la la-times"></i>
																</button>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															<div class="form-check">
																<label class="form-check-label">
																	<input class="form-check-input task-select" type="checkbox">
																	<span class="form-check-sign"></span>
																</label>
															</div>
														</td>
														<td>Update Fonts</td>
														<td class="td-actions text-right">
															<div class="form-button-action">
																<button type="button" data-toggle="tooltip" title="Edit Task" class="btn btn-link <btn-simple-primary">
																	<i class="la la-edit"></i>
																</button>
																<button type="button" data-toggle="tooltip" title="Remove" class="btn btn-link btn-simple-danger">
																	<i class="la la-times"></i>
																</button>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															<div class="form-check">
																<label class="form-check-label">
																	<input class="form-check-input task-select" type="checkbox">
																	<span class="form-check-sign"></span>
																</label>
															</div>
														</td>
														<td>Add new Post
														</td>
														<td class="td-actions text-right">
															<div class="form-button-action">
																<button type="button" data-toggle="tooltip" title="Edit Task" class="btn btn-link <btn-simple-primary">
																	<i class="la la-edit"></i>
																</button>
																<button type="button" data-toggle="tooltip" title="Remove" class="btn btn-link btn-simple-danger">
																	<i class="la la-times"></i>
																</button>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															<div class="form-check">
																<label class="form-check-label">
																	<input class="form-check-input task-select" type="checkbox">
																	<span class="form-check-sign"></span>
																</label>
															</div>
														</td>
														<td>Finalise the design proposal</td>
														<td class="td-actions text-right">
															<div class="form-button-action">
																<button type="button" data-toggle="tooltip" title="Edit Task" class="btn btn-link <btn-simple-primary">
																	<i class="la la-edit"></i>
																</button>
																<button type="button" data-toggle="tooltip" title="Remove" class="btn btn-link btn-simple-danger">
																	<i class="la la-times"></i>
																</button>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="card-footer ">
										<div class="stats">
											<i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
										</div>
									</div>
								</div>
							</div> --}}
						</div>
					</div>
				</div>
			     <footer class="footer">
					<div class="container-fluid">
						<nav class="pull-left">
							<ul class="nav">
								<li class="nav-item">
									<a class="nav-link" href="#">
										Accueil
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">
										Aide
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">
										Licenses
									</a>
								</li>
							</ul>
						</nav>
						<div class="copyright ml-auto">
							 2026, made with <i class="la la-heart heart text-danger"></i> St <a href="http://www.themekita.com">Lysam SERVICES</a>
						</div>
					</div>
				</footer>
			</div>
		</div>
	</div> -->

</body>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/chartist/chartist.min.js"></script>
<script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<script src="assets/js/demo.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const ctx2 = document.getElementById('caChart');

        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: [
                    "Jan", "Fév", "Mar", "Avr", "Mai", "Jun",
                    "Jul", "Aoû", "Sep", "Oct", "Nov", "Déc"
                ],
                datasets: [{
                    label: 'CA ($)',
                    data: @json($statCA),
                    backgroundColor: '#1572E8'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('statutChart');

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Livrés', 'En cours', 'En attente' , 'Arrivés'],
            datasets: [{
                data: [
                    {{ $colisLivres }},
                    {{ $colisEnCours }},
                    {{ $colisEnAttente }},
                    {{ $colisArrive }}
                ],
                backgroundColor: [
                    '#28a745',
                    '#17a2b8',
                    '#6c757d',
                    '#ffc107'
                ]
            }]
        },
        options: {
            responsive: true
        }
    });

});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const ctx = document.getElementById('evolutionColis');

        if (!ctx) {
            console.log("Canvas non trouvé !");
            return;
        }

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    "Jan", "Fév", "Mar", "Avr", "Mai", "Jun",
                    "Jul", "Aoû", "Sep", "Oct", "Nov", "Déc"
                ],
                datasets: [{
                    label: 'Nombre de colis',
                    data: @json($statistiques),
                    borderColor: '#1572E8',
                    backgroundColor: 'rgba(21,114,232,0.2)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

    });
</script>
</html>
