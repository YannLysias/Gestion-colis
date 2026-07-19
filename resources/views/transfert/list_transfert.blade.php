<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Rapide Service</title>
	<link rel="icon" href="/Authentification/img/Rapide service.jpg">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="/../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="/../assets/css/ready.css">
	<link rel="stylesheet" href="/../assets/css/demo.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
                @include('layouts.sidbar')
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Tables</h4>
						<div class="row">
							<div class="col-md-12">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                                    </div>
                                @endif
								<div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <div class="card-title">Listes des transferts</div>

                                       <div class="d-flex align-items-center">
                                            <input type="text" id="searchNumControl" class="form-control me-2" placeholder="Numéro de contrôle" style="width: 250px;">
                                            <button id="btnSearchTransfert" class="btn btn-success">Rechercher</button>
                                        </div>

                                        <a href="/transfert/list_transfert/create" class="btn btn-primary">
                                            Faire un transfert
                                        </a>
                                    </div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>#</th>
														<th>Numero de controle</th>
														<th>Nom Destinateur </th>
														<th>Prénom(s) Destinateur</th>
														<th>Télephone Destinateur</th>
														<th>Montant à envoyer</th>
														<th>Montant à recevoir</th>
														<th>Retrait</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody id="transfert-result">
                                                    @foreach ( $transferts as $index => $transfert)
                                                    <tr>
														<th scope="row">{{$index + 1}}</th>
														<td>{{ $transfert->numero_de_controle }}</td>
                                                        <td>{{ $transfert->destinateur_nom }}</td>
                                                        <td>{{ $transfert->destinateur_prenom }}</td>
                                                        <td>{{ $transfert->destinateur_telephone }}</td>
                                                        <td>{{ $transfert->montant_a_envoyer}}</td>
                                                        <td>{{ $transfert->montant_a_recevoir }}</td>
                                                        <td>{{ $transfert->statut }}</td>
                                                        <td>
                                                            <a href="{{ route('transfert.list_transfert.show', $transfert->id) }}" class="btn btn-sm btn-info" title="Voir les détails">
                                                                <i class="la la-eye"></i>
                                                            </a>
                                                        </td>
													</tr>
                                                    @endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
	</div>
</div>
</body>

<script>
document.getElementById('btnSearchTransfert').addEventListener('click', function() {
    const numero = document.getElementById('searchNumControl').value;

    if (numero.length >= 10) {
        fetch(`/transfert/search-by-numero?numero=${numero}`)
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('transfert-result');
                tbody.innerHTML = ''; // Clear old result

                if (data.success) {
                    const t = data.transfert;

                    tbody.innerHTML = `
                        <tr>
                            <td>*</td>
                            <td>${t.numero_de_controle}</td>
                            <td>${t.destinateur_nom}</td>
                            <td>${t.destinateur_prenom}</td>
                            <td>${t.destinateur_telephone}</td>
                            <td>${t.montant_a_envoyer}</td>
                            <td>${t.montant_a_recevoir}</td>
                            <td>${t.statut}</td>
                            <td>
                                <a href="/transfert/list_transfert/${t.id}" class="btn btn-sm btn-info">
                                    <i class="la la-eye"></i>
                                </a>
                            </td>
                        </tr>
                    `;
                } else {
                    tbody.innerHTML = `<tr><td colspan="9" class="text-danger text-center">Aucun transfert trouvé</td></tr>`;
                }
            });
    } else {
        alert("Numéro de contrôle invalide");
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="/../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="/../assets/js/core/popper.min.js"></script>
<script src="/../assets/js/core/bootstrap.min.js"></script>
<script src="/../assets/js/plugin/chartist/chartist.min.js"></script>
<script src="/../assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="/../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="/../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="/../assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="/../assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="/../assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="/../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="/../assets/js/ready.min.js"></script>
<script>
	$('#displayNotif').on('click', function(){
		var placementFrom = $('#notify_placement_from option:selected').val();
		var placementAlign = $('#notify_placement_align option:selected').val();
		var state = $('#notify_state option:selected').val();
		var style = $('#notify_style option:selected').val();
		var content = {};

		content.message = 'Turning standard Bootstrap alerts into "notify" like notifications';
		content.title = 'Bootstrap notify';
		if (style == "withicon") {
			content.icon = 'la la-bell';
		} else {
			content.icon = 'none';
		}
		content.url = 'index.html';
		content.target = '_blank';

		$.notify(content,{
			type: state,
			placement: {
				from: placementFrom,
				align: placementAlign
			},
			time: 1000,
		});
	});
</script>
</html>
