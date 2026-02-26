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
                <div class="container">
                    <h4>Détails du colis N° : {{ $colis->code_colis }}</h4>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                        </div>
                    @endif

                    <div class="container">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Poids :</strong> {{ $colis->poid }} kg</li>
                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Date :</strong> {{ $colis->created_at }}</li>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Montant :</strong> {{ number_format($colis->montant, 0, ',', ' ') }} $</li>
                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Destinataire Email :</strong> {{ $colis->destinateur_email }}</li>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item">
                                    <strong>Paiement : </strong> {{ $colis->paiement }}

                                    @if($colis->paiement === 'partiel')
                                        <br>
                                        <strong>Montant payé :</strong> {{ number_format($colis->montant_avance, 0, ',', ' ') }} $ <br>
                                        <strong>Reste à payer :</strong> {{ number_format($colis->montant - $colis->montant_avance, 0, ',', ' ') }} $
                                    @endif
                                </li>
                                @error('statut')
                                    <div class="d-block text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Destinataire Nom :</strong> {{ $colis->destinateur_nom }} {{ $colis->destinateur_prenom }}</li>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Statut :</strong> {{ ucfirst(str_replace('_', ' ', $colis->statut)) }}</li>
                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Destinataire N° téléphone:</strong> {{ $colis->destinateur_telephone }}</li>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Type :</strong> {{ $colis->type }}</li>
                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Agence :</strong> {{ $colis->AgenceTransfert->nom ?? 'N/A' }} ({{ $colis->AgenceTransfert->pays ?? 'N/A' }})</li>
                            </div>
                        </div>
                    </div>

                     <h4>Détails d'expédition</h4>
                    <div class="container">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Nom Expéditeur :</strong> {{ $colis->client->name }} {{ $colis->client->prenom }}</li>
                            </div>
                            <div class="col-md-6">
                                @foreach($colis->client->agences as $agence)
                                    <li class="list-group-item"><strong>Agence d'expédition : {{$agence->nom ?? 'N/A'}} ({{$agence->pays ?? 'N/A'}})</strong>
                                    </li>
                                @endforeach
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">

                                <li class="list-group-item"><strong>Téléphone Expéditeur :</strong> {{ $colis->client->telephone }} ({{ $colis->client->email }})</li>

                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Secretaire :</strong> {{ $colis->User->name }} {{ $colis->User->prenom }}</li>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editColisModal" @if($colis->statut === 'livré') disabled @endif>
                        Modifier
                    </button>
                    <a href="{{ route('colis.imprimer', $colis->id) }}" target="_blank" class="btn btn-success">
                        Imprimer
                    </a>

                    <!-- Modal -->
                        <!-- Modal de modification -->
                        <div class="modal fade" id="editColisModal" tabindex="-1" aria-labelledby="editColisModalLabel" aria-hidden="true">
                       <div class="modal-dialog modal-lg">
                            <form method="POST" action="{{ route('colis.list_colis.update', $colis->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modifier les informations du colis</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>

                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <!-- Poids -->
                                            <div class="col-md-6">
                                                <label class="form-label">Poids (kg)</label>
                                                <input type="number" step="0.01" class="form-control" name="poid" value="{{ old('poid', $colis->poid) }}" required>
                                                @error('poid')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <!-- Type -->
                                            <div class="col-md-6">
                                                <label class="form-label">Type</label>
                                                <select class="form-control" name="type">
                                                    <option value="document" @selected($colis->type == 'document')>Document</option>
                                                    <option value="marchandise" @selected($colis->type == 'marchandise')>Marchandise</option>
                                                    <option value="electronique" @selected($colis->type == 'electronique')>Électronique</option>
                                                    <option value="medical" @selected($colis->type == 'medical')>Médical</option>
                                                    <option value="cosmetique" @selected($colis->type == 'cosmetique')>Cosmétique</option>
                                                    <option value="fragile" @selected($colis->type == 'fragile')>Fragile</option>
                                                    <option value="autre" @selected($colis->type == 'autre')>Autre</option>
                                                </select>
                                                @error('type')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <!-- Paiement -->
                                            <div class="col-md-6">
                                                <label class="form-label">Paiement</label>
                                                <select class="form-control" id="paiementSelect" name="paiement" required>
                                                    <option value="payé" @selected($colis->paiement == 'payé')>Payé</option>
                                                    <option value="non_payé" @selected($colis->paiement == 'non_payé')>Non Payé</option>
                                                    <option value="partiel" @selected($colis->paiement == 'partiel')>Partiel</option>
                                                </select>
                                                @error('paiement')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                             <!-- Montant avancé (affiché uniquement si paiement partiel) -->
                                             <div class="col-md-6 d-none" id="montantAvanceGroup">
                                                <label class="form-label text-danger" style="color: red;">Montant avancé ($)</label>
                                                <input type="number" step="0.01" class="form-control" name="montant_avance" value="{{ old('montant_avance', $colis->montant_avance) }}">
                                                @error('montant_avance')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <!-- Statut -->
                                            <div class="col-md-6">
                                                <label class="form-label">Statut</label>
                                                <select class="form-control" name="statut">
                                                    <option value="en_attente" @selected($colis->statut == 'en_attente')>En attente</option>
                                                    <option value="en_cours" @selected($colis->statut == 'en_cours')>En cours</option>
                                                    <option value="arrivé" @selected($colis->statut == 'arrivé')>Arrivé</option>
                                                    <option value="livré" @selected($colis->statut == 'livré')>Livré</option>
                                                </select>
                                            </div>

                                            <!-- Destinateur -->
                                            <div class="col-md-6">
                                                <label class="form-label">Nom Destinateur</label>
                                                <input type="text" class="form-control" name="destinateur_nom" value="{{ old('destinateur_nom', $colis->destinateur_nom) }}" required>
                                                @error('destinateur_nom')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Prénom Destinateur</label>
                                                <input type="text" class="form-control" name="destinateur_prenom" value="{{ old('destinateur_prenom', $colis->destinateur_prenom) }}" required>
                                                @error('destinateur_prenom')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Email Destinateur</label>
                                                <input type="email" class="form-control" name="destinateur_email" value="{{ old('destinateur_email', $colis->destinateur_email) }}">
                                                @error('destinateur_email')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Téléphone Destinateur</label>
                                                <input type="text" class="form-control" name="destinateur_telephone" value="{{ old('destinateur_telephone', $colis->destinateur_telephone) }}" required>
                                                @error('destinateur_telephone')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer mt-4">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-success">Enregistrer</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.getElementById('paiementSelect').addEventListener('change', function () {

        let montantGroup = document.getElementById('montantAvanceGroup');

        if (this.value === 'partiel') {
            montantGroup.classList.remove('d-none');
        } else {
            montantGroup.classList.add('d-none');
        }

    });
</script>

<script>
    function calculerMontant() {
        let poid = parseFloat(document.getElementById("poid").value);
        let montant = 0;
        if (!isNaN(poid)) {
            montant = poid * 9;
        }
        document.getElementById("montant_apercu").innerText = montant.toLocaleString('fr-FR') + " $";
    }
</script>

</html>
