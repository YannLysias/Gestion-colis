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
						<h4 class="page-title">Formulaire de Groupage</h4>
						<div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header text-white">
                                    <h4 class="card-title mb-0">Formulaire</h4>
                                </div>
                                <div class="card-body">
                                    <form action="/groupage" method="POST" id="form-groupage" enctype="multipart/form-data">
                                        @csrf
                                        <h5 class="text-primary">Informations générales</h5> 
                                        <div class="row">
                                            {{-- COLONNE 1 : Informations générales --}}
                                            <div class="col-md-6 mb-6">
                                                   
                                                <div class="form-group">
                                                    <label>Agence de reception<span style="color:red">*</span></label>
                                                    <select name="agence_id" class="form-control" required>
                                                        <option value="">Sélectionner une agence</option>
                                                        @foreach($agences as $agence)
                                                            <option value="{{ $agence->id }}">{{ $agence->nom }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                    @error('agence_id')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-6">   
                                                    <div class="form-group">
                                                        <label>Douanier<span></span></label>
                                                        <input type="text" name="douanier" class="form-control" placeholder="Nom du douanier">
                                                    </div>
                                                        @error('douanier')
                                                            <div class="d-block text-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            {{-- COLONNE 2 : Colis à grouper --}}
                                            <div class="col-md-12">
                                                <h5 class="text-primary">Colis à grouper</h5>
                                                <div class="form-group">
                                                    <label>Colis <span style="color:red">*</span></label>
                                                    <select name="colis_ids[]" class="form-control select2" multiple required>
                                                        @foreach($colis as $c)
                                                            <option value="{{ $c->code_colis }}">{{ $c->code_colis }} | {{ $c->poid }}kg | {{ $c->destinateur_nom }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4 ml-4">
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
