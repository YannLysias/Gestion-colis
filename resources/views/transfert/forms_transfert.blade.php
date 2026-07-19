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
						<h4 class="page-title">Forms</h4>
						<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header text-white">
                                        <h4 class="card-title mb-0">Formulaire de transfert d'argent</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="/transfert/list_transfert" method="POST" id="transfert-form">
                                        @csrf
                                        <div class="row">
                                            {{-- COLONNE 1 : Expéditeur --}}
                                            <div class="col-md-4">
                                                <h5 class="text-primary">Informations (expéditeur)</h5>

                                                <div class="form-group">
                                                    <label for="agence_transfert_id">Agence de réception</label>
                                                    <select name="agence_transfert_id" class="form-control" required>
                                                        <option value="" disabled selected>-- Choisir une agence --</option>
                                                        @foreach ($agences as $agence)
                                                        <option value="{{ $agence->id }}" {{ old('agence_transfert_id') == $agence->id ? 'selected' : '' }}>
                                                            {{ $agence->nom }} ({{ $agence->pays }})
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('agence_transfert_id')
                                                        <div class="d-block text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="client_id">Sélectionner un client</label>
                                                    <select name="client_id" class="form-control" required>
                                                        <option value="" disabled selected>-- Sélectionner --</option>
                                                        @foreach ($clients as $client)
                                                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                                            {{ $client->name }} {{ $client->prenom }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('client_id')
                                                        <div class="d-block text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- COLONNE 2 : Détails du transfert --}}
                                            <div class="col-md-4">
                                                <h5 class="text-primary">Montant & Détails</h5>
                                                <div class="form-group">
                                                    <label>Montant à envoyer</label>
                                                    <div class="input-group">
                                                        <input type="number" step="0.01" name="montant_a_envoyer" id="montant_a_envoyer" class="form-control" required>
                                                        <select name="devise_envoi" class="form-select" required>
                                                            {{-- <option value="USD">FCFA</option>
                                                            <option value="CDF">Franc Congolais</option> --}}
                                                            <option value="XOF">Dollar USA</option>
                                                        </select>
                                                        @error('montant_a_envoyer')
                                                            <div class="d-block text-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Taux de change</label>
                                                    <input type="number" step="0.01" value="1" name="taux_de_change" id="taux_de_change" class="form-control" readonly>
                                                    @error('taux_de_change')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>frais de livraison (8%)</label>
                                                    <input type="number" step="0.01" name="taxe" id="taxe" class="form-control" readonly>
                                                    @error('taxe')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Montant à recevoir</label>
                                                    <div class="input-group">
                                                        <input type="number" step="0.01" name="montant_a_recevoir" id="montant_a_recevoir" class="form-control" readonly>
                                                        {{-- <select name="devise_reception" class="form-select" required>
                                                            <option value="USD">FCFA</option>
                                                            <option value="CDF">Franc Congolais</option>
                                                            <option value="XOF">Dollar USA</option>
                                                        </select> --}}
                                                        @error('montant_a_recevoir')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Motif du transfert</label>
                                                    <select name="motif_du_transfert" class="form-control" required>
                                                        <option value="">-- Choisir un motif --</option>
                                                        <option value="ASSISTANCE FAMILIALE">ASSISTANCE FAMILIALE</option>
                                                        <option value="IMMOBILIER">IMMOBILIER</option>
                                                        <option value="ACHAT MARCHANDISE">ACHAT MARCHANDISE</option>
                                                        <option value="ASSISTANCE SCOLAIRE">ASSISTANCE SCOLAIRE</option>
                                                        <option value="AUTRES">AUTRES</option>
                                                    </select>
                                                    @error('motif_du_transfert')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Numéro de contrôle</label>
                                                    <input type="text" name="numero_de_controle" class="form-control" readonly value="{{ $numeroDeControle }}">
                                                    @error('numero_de_controle')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- COLONNE 3 : Destinataire --}}
                                            <div class="col-md-4">
                                                <h5 class="text-primary">Informations destinataire</h5>

                                                <div class="form-group">
                                                    <label>Nom</label>
                                                    <input type="text" name="destinateur_nom" class="form-control" required>
                                                    @error('destinateur_nom')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Prénom</label>
                                                    <input type="text" name="destinateur_prenom" class="form-control" required>
                                                    @error('destinateur_prenom')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Téléphone</label>
                                                    <input type="text" name="destinateur_telephone" class="form-control" required>
                                                    @error('destinateur_telephone')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="destinateur_email" class="form-control">
                                                    @error('destinateur_email')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Type de pièce d'identité</label>
                                                    <select name="type_piece_identite" class="form-control" required>
                                                        <option value="">-- Choisir une pièce --</option>
                                                        <option value="Passport">Passport</option>
                                                        <option value="Carte consulaire">Carte consulaire</option>
                                                        <option value="Carte nationale">Carte nationale</option>
                                                        <option value="Carte électorale">Carte électorale</option>
                                                    </select>
                                                    @error('type_piece_identite')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Numéro de pièce</label>
                                                    <input type="text" name="numero_piece_identite" class="form-control">
                                                    @error('numero_piece_identite')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4 text-end">
                                            <button type="submit" class="btn btn-success">Valider le transfert</button>
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
			</div>
		</div>
	</div>
</body>

<!-- SCRIPT CALCUL TAXE ET MONTANT À RECEVOIR -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const montantEnvoyer = document.getElementById('montant_a_envoyer');
        const taux = document.getElementById('taux_de_change');
        const taxe = document.getElementById('taxe');
        const montantRecevoir = document.getElementById('montant_a_recevoir');

        function updateFields() {
            const m = parseFloat(montantEnvoyer.value) || 0;
            const t = parseFloat(taux.value) || 1;
            const tx = m * 0.08;
            taxe.value = tx.toFixed(2);
            montantRecevoir.value = ((m - tx) * t).toFixed(2);
        }

        [montantEnvoyer, taux].forEach(input => {
            input.addEventListener('input', updateFields);
        });
    });
</script>

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
</html>
