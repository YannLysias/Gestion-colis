<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Formulaire</title>
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
                    <h4>Détails du transfert N° : {{ $transfert->numero_de_controle }}</h4>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                        </div>
                    @endif

                    <div class="container">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Motif :</strong> {{ $transfert->motif_du_transfert }}</li>
                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Date :</strong> {{ $transfert->created_at }}</li>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Montant à envoyer :</strong> {{ number_format($transfert->montant_a_envoyer, 0, ',', ' ') }} FCFA</li>
                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Destinateur Email :</strong> {{ $transfert->destinateur_email }}</li>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">

                                <li class="list-group-item"><strong>Montant à recevoir :</strong> {{ number_format($transfert->montant_a_recevoir, 0, ',', ' ') }} FCFA</li>

                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Destinateur Nom :</strong> {{ $transfert->destinateur_nom }} {{ $transfert->destinateur_prenom }}</li>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Statut :</strong> {{ ucfirst(str_replace('_', ' ', $transfert->statut)) }}</li>

                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Destinateur N° téléphone:</strong> {{ $transfert->destinateur_telephone }}</li>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>{{ $transfert->type_piece_identite }} :</strong> {{ $transfert->numero_piece_identite }}</li>
                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Agence :</strong> {{ $transfert->AgenceTransfert->nom ?? 'N/A' }} ({{ $transfert->AgenceTransfert->pays ?? 'N/A' }})</li>
                            </div>
                        </div>
                    </div>

                     <h4>Détails d'expédition</h4>
                    <div class="container">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Nom Expéditeur :</strong> {{ $transfert->client->name }} {{ $transfert->client->prenom }}</li>
                            </div>
                            <div class="col-md-6">
                                @foreach($transfert->client->agences as $agence)
                                    <li class="list-group-item"><strong>Agence d'expédition : {{$agence->nom ?? 'N/A'}} ({{$agence->pays ?? 'N/A'}})</strong>
                                    </li>
                                @endforeach
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">

                                <li class="list-group-item"><strong>Téléphone Expéditeur :</strong> {{ $transfert->client->telephone }} ({{ $transfert->client->email }})</li>

                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Secretaire :</strong> {{ $transfert->User->name }} {{ $transfert->User->prenom }}</li>
                            </div>
                        </div>
                    </div>


                    <!-- Bouton pour ouvrir le modal -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edittransfertModal">
                        Modifier
                    </button>
                    <a href="{{ route('transfert.imprimer', $transfert->id) }}" target="_blank" class="btn btn-success">
                        Imprimer
                    </a>

                    <!-- Modal -->
                        <!-- Modal de modification -->
                        <div class="modal fade" id="edittransfertModal" tabindex="-1" aria-labelledby="edittransfertModalLabel" aria-hidden="true">
                       <div class="modal-dialog modal-lg">
                            <form method="POST" action="{{ route('transfert.list_transfert.update', $transfert->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modifier les informations du transfert</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        {{-- Montant à envoyer --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Montant à envoyer</label>
                                            <input type="number" step="0.01" name="montant_a_envoyer" class="form-control"
                                                value="{{ old('montant_a_envoyer', $transfert->montant_a_envoyer) }}" required>
                                            @error('montant_a_envoyer')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Montant à recevoir --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Montant à recevoir</label>
                                            <input type="number" step="0.01" name="montant_a_recevoir" class="form-control"
                                                value="{{ old('montant_a_recevoir', $transfert->montant_a_recevoir) }}" readonly>
                                            @error('montant_a_recevoir')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Taux de change --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Taux de change</label>
                                            <input type="number" step="0.01" name="taux_de_change" class="form-control"
                                                value="{{ old('taux_de_change', $transfert->taux_de_change) }}" readonly>
                                            @error('taux_de_change')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- valisation --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Statut du retrait</label>
                                            <select name="statut" class="form-control" required>
                                                <option value="">-- Choisir --</option>
                                                <option value="En_attente" @selected($transfert->statut == 'En_attente')>En_attente</option>
                                                <option value="Validé" @selected($transfert->statut == 'Validé')>Validé</option>
                                            </select>
                                        </div>

                                        {{-- Numéro de contrôle --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Numéro de contrôle</label>
                                            <input type="text" name="numero_de_controle" class="form-control"
                                                value="{{ old('numero_de_controle', $transfert->numero_de_controle) }}" readonly>
                                        </div>

                                        {{-- Motif --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Motif du transfert</label>
                                            <input type="text" name="motif_du_transfert" class="form-control"
                                                value="{{ old('motif_du_transfert', $transfert->motif_du_transfert) }}">
                                        </div>

                                        {{-- Type pièce d'identité --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Type de pièce</label>
                                            <select name="type_piece_identite" class="form-control" required>
                                                <option value="">-- Choisir --</option>
                                                <option value="Passport" @selected($transfert->type_piece_identite == 'Passport')>Passport</option>
                                                <option value="Carte consulaire" @selected($transfert->type_piece_identite == 'Carte consulaire')>Carte consulaire</option>
                                                <option value="Carte nationale" @selected($transfert->type_piece_identite == 'Carte nationale')>Carte nationale</option>
                                                <option value="Carte électorale" @selected($transfert->type_piece_identite == 'Carte électorale')>Carte électorale</option>
                                            </select>
                                        </div>

                                        {{-- Numéro de pièce --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Numéro de pièce</label>
                                            <input type="text" name="numero_piece_identite" class="form-control"
                                                value="{{ old('numero_piece_identite', $transfert->numero_piece_identite) }}">
                                        </div>

                                        {{-- Destinateur --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Nom Destinateur</label>
                                            <input type="text" name="destinateur_nom" class="form-control"
                                                value="{{ old('destinateur_nom', $transfert->destinateur_nom) }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Prénom Destinateur</label>
                                            <input type="text" name="destinateur_prenom" class="form-control"
                                                value="{{ old('destinateur_prenom', $transfert->destinateur_prenom) }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Téléphone Destinateur</label>
                                            <input type="text" name="destinateur_telephone" class="form-control"
                                                value="{{ old('destinateur_telephone', $transfert->destinateur_telephone) }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Email Destinateur</label>
                                            <input type="email" name="destinateur_email" class="form-control"
                                                value="{{ old('destinateur_email', $transfert->destinateur_email) }}">
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
