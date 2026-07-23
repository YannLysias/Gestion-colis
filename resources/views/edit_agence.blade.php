<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Rapide Service</title>
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
                <div class="container">
                    <h4>Détails du Agence</h4>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="container">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Nom :</strong> {{ $agence->nom }}</li>
                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Ville :</strong> {{ $agence->ville }}</li>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Pays :</strong> {{ $agence->pays }}</li>
                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Adresse :</strong> {{ $agence->adresse_complete }}</li>
                            </div>
                        </div>
                        </div>
                    </div>


                    <!-- Bouton pour ouvrir le modal -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editColisModal">
                        Modifier
                    </button>

                    <!-- Modal -->
                        <!-- Modal de modification -->
                        <div class="modal fade" id="editColisModal" tabindex="-1" aria-labelledby="editColisModalLabel" aria-hidden="true">
                       <div class="modal-dialog modal-lg">
                            <form method="POST" action="{{ route('agence.update', $agence->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modifier les informations de l'agence</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>

                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <!-- Poids -->
                                            <div class="col-md-6">
                                                <label class="form-label">Agence</label>
                                                <input type="text" class="form-control" name="agence" value="{{ old('agence', $agence->nom) }}" required>
                                                @error('agence')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <!-- Type -->
                                            <div class="col-md-6">
                                                <label class="form-label">Ville</label>
                                                <input type="text" class="form-control" name="ville" value="{{ old('ville', $agence->ville) }}" required>
                                                @error('ville')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <!-- Paiement -->
                                            <div class="col-md-6">
                                                <label class="form-label">Pays</label>
                                                <select class="form-control" name="pays" required>
                                                    <option value="RD Congo" @selected($agence->pays == 'RD Congo')>RD Congo</option>
                                                    <option value="R. Bénin" @selected($agence->pays == 'R. Bénin')>R. Bénin</option>
                                                </select>
                                                @error('pays')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <!-- Destinateur -->
                                            <div class="col-md-6">
                                                <label class="form-label">Adresse</label>
                                                <input type="text" class="form-control" name="adresse_complete" value="{{ old('adresse_complete', $agence->adresse_complete) }}" required>
                                                @error('adresse_complete')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer mt-4">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>

                </div>


					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<!-- Bootstrap JS with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
    function calculerMontant() {
        let poid = parseFloat(document.getElementById("poid").value);
        let montant = 0;
        if (!isNaN(poid)) {
            montant = poid * 3000;
        }
        document.getElementById("montant_apercu").innerText = montant.toLocaleString('fr-FR') + " FCFA";
    }
</script>

</html>
