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
                    <h4>Détails du user N° : {{ $user->code_user }}</h4>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                        </div>
                    @endif

                    <div class="container">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Nom :</strong> {{ $user->name }}</li>
                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Prénoms :</strong> {{ $user->prenom }}</li>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Sexe :</strong> {{ ($user->sexe) }}</li>
                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Profession :</strong> {{ $user->profession }}</li>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">

                                <li class="list-group-item"><strong>Email :</strong> {{ $user->email }}</li>

                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Téléphone :</strong> {{ $user->telephone }}</li>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Rôle :</strong> {{ ucfirst(str_replace('_', ' ', $user->role)) }}</li>

                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Date enregistrement:</strong> {{ $user->created_at }}</li>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Adresse :</strong> {{ $user->adresse }}</li>
                            </div>
                            @foreach ($user->agences as $agence)
                            <div class="col-md-6">
                                <li class="list-group-item"><strong>Agence :</strong> {{ $agence->nom }} ({{ $agence->pays }})</li>
                            </div>
                            @endforeach
                           
                        </div>
                    </div>
                    <!-- Bouton pour ouvrir le modal -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edituserModal">
                        Modifier
                    </button>
                    {{-- <a href="{{ route('user.imprimer', $user->id) }}" target="_blank" class="btn btn-success">
                        Imprimer
                    </a> --}}

                    <!-- Modal -->
                        <!-- Modal de modification -->
                        <div class="modal fade" id="edituserModal" tabindex="-1" aria-labelledby="edituserModalLabel" aria-hidden="true">
                       <div class="modal-dialog modal-lg">
                            <form method="POST" action="{{ route('user.user.update', $user->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modifier les informations {{$user->role}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>

                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <!-- Poids -->
                                            <div class="col-md-6">
                                                <label class="form-label">Nom</label>
                                                <input type="text" step="0.01" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                                                @error('name')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <!-- Type -->
                                            <div class="col-md-6">
                                                <label class="form-label">Prenoms</label>
                                                <input type="text" class="form-control" name="prenom" value="{{ old('prenom', $user->prenom) }}" required>
                                                @error('prenom')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <!-- Paiement -->
                                            <div class="col-md-6">
                                                <label class="form-label">Sexe</label>
                                                <select class="form-control" name="sexe" required>
                                                    <option value="Masculin" @selected($user->sexe == 'Masculin')>Masculin</option>
                                                    <option value="Feminin" @selected($user->sexe == 'Feminin')>Feminin</option>
                                                </select>
                                                @error('sexe')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <!-- Statut -->
                                            <div class="col-md-6">
                                                <label class="form-label">Agence</label>
                                                <select name="agences_transfert_id" class="form-control" required>
                                                    <option value="" disabled>-- Choisir une agence --</option>
                                                    @foreach($agences as $agence)
                                                        <option value="{{ $agence->id }}"
                                                            {{ old('agences_transfert_id', $user->agences_transfert_id) == $agence->id ? 'selected' : '' }}>
                                                            {{ $agence->nom }} ({{ $agence->pays }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Destinateur -->
                                            <div class="col-md-6">
                                                <label class="form-label">Profession</label>
                                                <input type="text" class="form-control" name="profession" value="{{ old('profession', $user->profession) }}">
                                                @error('profession')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Adresse</label>
                                                <input type="text" class="form-control" name="adresse" value="{{ old('adresse', $user->adresse) }}">
                                                @error('adresse')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                                                @error('email')
                                                    <div class="d-block text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Téléphone</label>
                                                <input type="text" class="form-control" name="telephone" value="{{ old('telephone', $user->telephone) }}">
                                                @error('telephone')
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
