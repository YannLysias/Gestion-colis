<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Rapide Service</title>
	<link rel="icon" href="/Authentification/img/Rapide service.jpg">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="/../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="/../assets/css/ready.css">
	<link rel="stylesheet" href="/../assets/css/demo.css">
</head>
<style>
    .pagination {
        font-size: 12px;
    }

    .page-link {
        padding: 4px 8px;
    }
</style>
<body>
	<div class="wrapper">
		<div class="main-header">
            @include('layouts.sidbar')
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Listes des Colis</h4>
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
										<div class="card-title">Colis</div>

                                         {{-- <div class="d-flex align-items-center">
                                            <input type="text" id="searchNumControl" class="form-control me-2" placeholder="Numéro de colis" style="width: 250px;">
                                            <button id="btnSearchTransfert" class="btn btn-success">Rechercher</button>
                                        </div> --}}

										 <a href="/groupage/create" class="btn btn-primary">
                                            Creer un groupage
                                        </a>
									</div>
									<div class="card-body">
										<div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Numéro Groupage</th>
                                                        <th>Statut</th>
                                                        <th>Poids Total (kg)</th>
                                                        <th>Agence de reception</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($groupages as $index => $groupage)
                                                    <tr data-bs-toggle="collapse"
                                                        data-bs-target="#groupage{{ $groupage->id }}"
                                                        aria-expanded="false"
                                                        style="cursor: pointer; background-color:#f8f9fa;">
                                                        
                                                        <th>{{ $groupages->firstItem() + $index }}</th>
                                                        <td>{{ $groupage->code_groupage }}</td>
                                                        <td>
                                                            <span class="badge bg-{{ $groupage->statut === 'en_attente' ? 'warning' : ($groupage->statut === 'en_cours' ? 'info' : 'success') }}">
                                                                {{ $groupage->statut }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $groupage->poids_total }}</td>
                                                        <td>{{ $groupage->agence->nom }}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="la la-ellipsis-v"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="{{ route('groupage.show', $groupage->id) }}" class="dropdown-item">
                                                                        <i class="la la-eye"></i> Voir les détails
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <button class="dropdown-item ouvrir-edit-modal" data-id="{{ $groupage->id }}" data-bs-toggle="modal" data-bs-target="#editGroupageModal" type="button"><i class="la la-edit" onclick="event.stopPropagation();"></i> Modifier</button>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>

                                                    <!-- Ligne collapse -->
                                                    <tr class="collapse" id="groupage{{ $groupage->id }}">
                                                        <td colspan="5">
                                                            @php
                                                                $colis = App\Models\Colis::whereIn('code_colis', $groupage->colis_ids)->get();
                                                            @endphp
                                                            <table class="table table-sm table-striped" style="color: #333;">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Code</th>
                                                                        <th>Destinataire</th>
                                                                        <th>Tél Destinataire</th>
                                                                        <th>Poids</th>
                                                                        <th>Montant</th>
                                                                        <th>Paiement</th>
                                                                        <th>Statut</th>
                                                                        <th>
                                                                            <button class="btn btn-sm btn-info ouvrir-modal"
                                                                                    data-id="{{ $groupage->id }}"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#ajouterColisModal">
                                                                                <i class="la la-plus"></i>
                                                                            </button>
                                                                        </th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($colis as $coli)
                                                                        <tr>
                                                                            <td>{{ $coli->code_colis }}</td>
                                                                            <td>{{ $coli->destinateur_nom }}</td>
                                                                            <td>{{ $coli->destinateur_telephone }}</td>
                                                                            <td>{{ $coli->poid }} kg</td>
                                                                            <td>{{ number_format($coli->montant, 0, ',', ' ') }} $</td>
                                                                             <td>{{ $coli->paiement }}</td>
                                                                             <td>{{ $coli->statut }}</td>
                                                                             <td>
                                                                                <form action="{{ route('groupage.supprimerColisGrouper', [$groupage->id, $coli->code_colis]) }}"
                                                                                    method="POST"
                                                                                    style="display:inline-block"
                                                                                    onsubmit="return confirm('Êtes-vous sûr ?')">

                                                                                    @csrf
                                                                                    @method('DELETE')

                                                                                    <button class="btn btn-sm btn-danger">
                                                                                        <i class="la la-trash"></i>
                                                                                    </button>
                                                                                </form>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>

                                            <div class="d-flex justify-content-center mt-3">
                                                {{ $groupages->links('pagination::bootstrap-4') }}
                                            </div>
                                        </div>
									</div>
								</div>
							</div>
	</div>
</div>
<!-- Modal -->
{{-- Modal edit groupage --}}
<div class="modal fade" id="editGroupageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-edit-groupage" action="{{ route('groupage.updateStatut', $groupage->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Modifier le groupage N°{{ $groupage->code_groupage }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="statut" class="form-label">Statut</label>
                        <select name="statut" id="statut" class="form-control" required>
                            <option value="">Sélectionner un statut</option>
                            <option value="en_cours">En cours</option>
                            <option value="arrivé">arrivé</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Enregistrer</button>  
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Ajout Colis -->
<div class="modal fade" id="ajouterColisModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-ajout-colis" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter des colis au groupage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label>Choisir colis</label>
                    <select name="colis_ids[]" class="form-control select2" multiple required>
                        @foreach($colisDisponibles as $c)
                            <option value="{{ $c->code_colis }}">
                                {{ $c->code_colis }} | ({{ $c->poid }} kg) | {{ $c->destinateur_nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal Ajout Colis --> --}}

<script>
    $(document).ready(function() {
        $('#ajouterColisModal{{ $groupage->id }} .select2').select2({
            dropdownParent: $('#ajouterColisModal{{ $groupage->id }}'),
            placeholder: "Sélectionner un ou plusieurs colis",
            width: '100%'
        });
    });
</script>

</body>
<script src="/../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
    $(document).ready(function() {
        $('#ajouterColisModal .select2').select2({
            dropdownParent: $('#ajouterColisModal'),
            placeholder: "Sélectionner un ou plusieurs colis",
            width: '100%'
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        var editModal = document.getElementById('editGroupageModal');

        editModal.addEventListener('show.bs.modal', function (event) {

            var button = event.relatedTarget;
            var groupageId = button.getAttribute('data-id');

            console.log("ID sélectionné:", groupageId);

            var form = editModal.querySelector('form');

            form.action = "/groupage/" + groupageId;

        });

    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let boutons = document.querySelectorAll(".ouvrir-modal");
    let form = document.getElementById("form-ajout-colis");

    boutons.forEach(function(btn) {
        btn.addEventListener("click", function () {

            let groupageId = this.getAttribute("data-id");

            // Génère l'URL correcte selon ta route
            form.action = "/groupage/" + groupageId + "/ajouter-colis";

        });
    });

});
</script>

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
<script>
    document.getElementById('btnSearchColis').addEventListener('click', function () {
    let code = document.getElementById('searchCodeColis').value;
    if (!code) return;

    fetch(`/colis/search?code_colis=${code}`)
        .then(response => response.json())
        .then(data => {
            let tbody = document.getElementById('colis-result');
            tbody.innerHTML = '';

            if (data.length > 0) {
                data.forEach((colis, index) => {
                    tbody.innerHTML += `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${colis.code_colis}</td>
                            <td>${colis.destinateur_nom}</td>
                            <td>${colis.destinateur_prenom}</td>
                            <td>${colis.destinateur_telephone}</td>
                            <td>${colis.poid}</td>
                            <td>${new Intl.NumberFormat('fr-FR').format(colis.montant)} FCFA</td>
                            <td>${colis.paiement}</td>
                            <td>
                                <a href="/colis/${colis.id}" class="btn btn-sm btn-info">
                                    <i class="la la-eye"></i>
                                </a>
                            </td>
                        </tr>`;
                });
            } else {
                tbody.innerHTML = `<tr><td colspan="9" class="text-center text-danger">Aucun colis trouvé.</td></tr>`;
            }
        });
});
</script>
</html>
