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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
                @include('layouts.sidbar')
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Formulaire de dépôt de coli</h4>
						<div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header text-white">
                                    <h4 class="card-title mb-0">Formulaire</h4>
                                </div>
                                <div class="card-body">
                                    <form action="/colis/list_colis" method="POST" id="form-colis">
                                        @csrf
                                        <div class="row">
                                            {{-- COLONNE 1 : Informations du client (expéditeur) --}}
                                            <div class="col-md-6">
                                                <h5 class="text-primary">Informations de l'expéditeur</h5>
                                                    <div class="form-group">
                                                        <label for="client_id">Selectionner un Client <span style="color:red">*</span></label>
                                                        <select name="client_id" class="form-control select2" required>
                                                            <option value="" disabled selected>-- Selectionne --</option>
                                                            @foreach ($clients as $client)
                                                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                                                {{ $client->name }} {{ $client->prenom }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('client_id')
                                                            <div class="d-block text-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="agence_id">Agence de réception <span style="color:red">*</span></label>
                                                        <select name="agence_transfert_id" class="form-control select2" required>
                                                            <option value="" disabled selected>-- Choisir une agence --</option>
                                                            @foreach ($agences as $agence)
                                                            <option value="{{ $agence->id }}" {{ old('agences_transfert_id') == $agence->id ? 'selected' : '' }}>
                                                                {{ $agence->nom }} ({{ $agence->pays }})
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('agence_transfert_id')
                                                            <div class="d-block text-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                            </div>

                                            {{-- COLONNE 2 : Détails du colis --}}
                                            <div class="col-md-6">
                                                <h5 class="text-primary">Détails du colis</h5>

                                                <div class="form-group">
                                                    <label>Prix par Kg ($) <span style="color:red">*</span></label>
                                                    <select name="prix_kilo" id="prix_kilo" class="form-control" onchange="calculerMontant()" required>
                                                        <option value="8">8 $</option>
                                                        <option value="9" selected>9 $</option>
                                                        <option value="10">10 $</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Poids (Kg) <span style="color:red">*</span></label>
                                                    <input type="number"
                                                        step="0.01"
                                                        name="poid"
                                                        id="poid"
                                                        class="form-control"
                                                        oninput="calculerMontant()"
                                                        required>

                                                    <span id="montant_dollar" class="d-block mt-2 font-weight-bold">0 $</span>
                                                </div>

                                                <input type="hidden" name="montant" id="montant">

                                                <div class="form-group">
                                                    <label>Paiement <span style="color:red">*</span></label>
                                                    <select name="paiement" class="form-control" required>
                                                        <option value="" disabled selected>-- Choisir --</option>
                                                        <option value="payé">Payé</option>
                                                        <option value="non_payé">Non payé</option>
                                                    </select>
                                                    @error('paiement')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Type de colis</label>
                                                    <input type="text" name="type" class="form-control" value="{{ old('type') }}" placeholder="ex: Document, Marchandise...">
                                                    @error('type')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Nom <span style="color:red">*</span></label>
                                                    <input type="text" name="destinateur_nom" class="form-control" value="{{ old('destinateur_nom') }}" required>
                                                    @error('destinateur_nom')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                                    <div class="form-group">
                                                    <label>Prénom <span style="color:red"></span></label>
                                                    <input type="text" name="destinateur_prenom" class="form-control" value="{{ old('destinateur_prenom') }}" required>
                                                    @error('destinateur_prenom')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Téléphone <span style="color:red">*</span></label>
                                                    <input type="text" name="destinateur_telephone" class="form-control" value="{{ old('destinateur_telephone') }}" required>
                                                    @error('destinateur_telephone')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="destinateur_email" class="form-control" value="{{ old('destinateur_email') }}">
                                                    @error('destinateur_email')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Photo du colis</label>
                                                    <input type="file" name="photo_colis" id="photo_colis" class="form-control"
                                                        accept="image/*" capture="environment" onchange="previewPhoto(event)" value="{{ old('photo_colis') }}">

                                                    <!-- Zone d’aperçu -->
                                                    <div class="mt-2">
                                                        <img id="photo_preview" src="" alt="Aperçu de la photo" style="max-width: 200px; display: none; border: 1px solid #ccc; padding: 5px; border-radius: 5px;">
                                                    </div>

                                                    @error('photo_colis')

                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                        <div class="mt-4 text-end">
                                            <button type="submit" class="btn btn-success">Valider le dépôt</button>
                                            <button type="reset" class="btn btn-primary">Annuler</button>
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
	</div>
</body>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Sélectionner une option",
            allowClear: true,
            width: '100%'
        });
    });
</script>

<script>
    // Prévisualisation de la photo
    function previewPhoto(event) {
        let reader = new FileReader();
        reader.onload = function(){
            let output = document.getElementById('photo_preview');
            output.src = reader.result;
            output.style.display = "block";
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // function calculerMontant() {
    //     let poid = parseFloat(document.getElementById("poid").value);
    //     let montant = 0;
    //     if (!isNaN(poid)) {
    //         montant = poid * 3000;
    //     }
    //     document.getElementById("montant_apercu").innerText = montant.toLocaleString('fr-FR') + " FCFA";
    // }

    function calculerMontant() {
        let poids = parseFloat(document.getElementById('poid').value) || 0;
        let prixKilo = parseFloat(document.getElementById('prix_kilo').value) || 0;

        let montant = poids * prixKilo;

        document.getElementById('montant_dollar').innerText = montant.toFixed(2) + " $";
        document.getElementById('montant').value = montant.toFixed(2);
    }



</script>

</html>
