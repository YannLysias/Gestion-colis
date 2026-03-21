<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Rapide Service</title>
	<link rel="icon" href="/Authentification/img/Rapide service.jpg">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="/../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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
                        @if (request()->routeIs('user.admin.index') )
                            <h4 class="page-title">Liste des Secretaires</h4>
                        @else
                            <h4 class="page-title">Liste des Clients</h4>
                        @endif
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
                                        @if (request()->routeIs('user.admin.index') )
										<div class="card-title">Secretaires</div>
                                        @else
                                        <div class="card-title">Clients</div>
                                        @endif
                                        @if (request()->routeIs('user.admin.index') )
                                        <a href="/user/admin/create" class="btn btn-primary">
                                            Ajouter un Secretaire
                                        </a>
                                        @else
                                        <a href="/user/user/create" class="btn btn-primary">
                                            Ajouter un Client
                                        </a>
                                        @endif
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered" id="colisTable" width="100%" cellspacing="0">
												<thead>
													<tr>
														<th>#</th>
														<th>Nom</th>
														<th>Prénoms</th>
														<th>Sexe</th>
														<th>Role</th>
														<th>telephone</th>
														<th>Agence</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
                                                    @foreach ($users as $index => $user)
                                                        @if (Auth::user()->role !== 'Secretaire' || $user->role === 'Client')
                                                        <tr>
                                                            <th scope="row">{{ $index + 1}}</th>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->prenom }}</td>
                                                            <td>{{ $user->sexe }}</td>
                                                            <td>{{ $user->role }}</td>
                                                            <td>{{ $user->telephone }}</td>
                                                            <td>
                                                                @foreach ($user->agences as $agence)
                                                                    {{ $agence->nom }}
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('user.user.show', $user->id) }}" class="btn btn-sm btn-success" title="Voir les détails">
                                                                    <i class="la la-eye"></i>
                                                                </a>
                                                                @if(auth()->user()->role === 'Secretaire')

                                                                @else
                                                                    <a href="{{ route('user.user.destroy', $user->id) }}" class="btn btn-sm btn-danger" title="Supprimer" onclick="event.preventDefault(); if(confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }">
                                                                        <i class="la la-trash"></i>
                                                                    </a>
                                                                @endif
                                                                <form id="delete-form-{{ $user->id }}" action="{{ route('user.user.destroy', $user->id) }}" method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
											</table>
                                            {{-- <div class="d-flex justify-content-center mt-3">
                                                {{ $users->links('pagination::bootstrap-4') }}
                                            </div> --}}
										</div>
									</div>
								</div>
							</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title"><i class="la la-frown-o"></i> Under Development</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<p>Currently the pro version of the <b>Ready Dashboard</b> Bootstrap is in progress development</p>
				<p>
				<b>We'll let you know when it's done</b></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal voir les detail -->
<div>   </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="/../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="/../assets/js/core/popper.min.js"></script>
<script src="/../assets/js/core/bootstrap.min.js"></script>
<script src="/../assets/js/plugin/chartist/chartist.min.js"></script>
<script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="/../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="/../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="/../assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="/../assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="/../assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="/../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<!-- Excel / PDF dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

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

<script>
    $(document).ready(function() {

        if ($.fn.DataTable.isDataTable('#colisTable')) {
            $('#colisTable').DataTable().destroy();
        }

        $('#colisTable').DataTable({
            dom: 'Bfrtip',

            buttons: [
                {
                    extend: 'copy',
                    text: '📋 Copier',
                    className: 'btn btn-secondary'
                },
                {
                    extend: 'excel',
                    text: '📊 Excel',
                    className: 'btn btn-secondary'
                },
                {
                    extend: 'pdf',
                    text: '📄 PDF',
                    className: 'btn btn-secondary'
                },
                {
                    extend: 'print',
                    text: '🖨️ Imprimer',
                    className: 'btn btn-secondary'
                }
            ],

            paging: true,
            searching: true,
            ordering: true,
            info: true,
            lengthChange: false,

            language: {
                search: "Rechercher:",
                paginate: {
                    previous: "Précédent",
                    next: "Suivant"
                },
                info: "Affichage de _START_ à _END_ sur _TOTAL_ colis",
                zeroRecords: "Aucun colis trouvé"
            }
        });

    });
</script>

</html>
