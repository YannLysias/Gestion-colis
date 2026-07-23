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
						<h4 class="page-title">Formulaire d'ajout</h4>
						<div class="row">
							<div class="col-md-12">
                                <div class="card">
                                    <div class="card-header text-white">
                                        <h4 class="card-title mb-0">Formulaire d'ajout d'un Client</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="/user/user" method="POST">
                                            @csrf

                                            <div class="row">
                                                {{-- NOM --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nom">Nom <span style="color:red">*</span></label>
                                                        <input type="text" name="name" class="form-control" required>
                                                    </div>
                                                    @error('name')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                {{-- PRÉNOM --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="prenom">Prénoms <span style="color:red">*</span></label>
                                                        <input type="text" name="prenom" class="form-control" required>
                                                    </div>
                                                     @error('prenom')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                {{-- SEXE --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="sexe">Sexe <span style="color:red">*</span></label>
                                                        <select name="sexe" class="form-control" required>
                                                            <option value="">-- Choisir --</option>
                                                            <option value="Masculin">Masculin</option>
                                                            <option value="Feminin">Feminin</option>
                                                        </select>
                                                    </div>
                                                     @error('sexe')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                {{-- TÉLÉPHONE --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="telephone">Téléphone <span style="color:red">*</span></label>
                                                        <input type="text" name="telephone" class="form-control" required>
                                                    </div>
                                                     @error('telephone')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                {{-- EMAIL --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" name="email" class="form-control">
                                                    </div>
                                                     @error('email')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>



                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="adresse">Adresse</label>
                                                        <input type="text" name="adresse" class="form-control">
                                                    </div>
                                                    @error('adresse')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                {{-- MOT DE PASSE --}}
                                                <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="profession">Profession <span style="color:red">*</span></label>
                                                        <select name="profession" class="form-control" required>
                                                            <option value="">-- Choisir --</option>
                                                            <option value="Commerçant">Commerçant</option>
                                                            <option value="Entrepreneur">Entrepreneur</option>
                                                            <option value="Etudiant">Etudiant</option>
                                                            <option value="Ingenieur">Ingenieur</option>
                                                            <option value="Couturier">Couturier</option>
                                                            <option value="Medecin">Medecin</option>
                                                            <option value="Chaufeur">Chaufeur</option>
                                                            <option value="Fonctionnaire">Fonctionnaire</option>
                                                            <option value="Aucune">Aucune</option>
                                                        </select>
                                                    </div>
                                                     @error('profession')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="agence_id">Agence <span style="color:red">*</span></label>
                                                        <select name="agences_transfert_id" class="form-control" required>
                                                            <option value="" disabled selected>-- Choisir une agence --</option>
                                                            @foreach ($agences as $agence)
                                                            <option value="{{ $agence->id }}" {{ old('agences_transfert_id') == $agence->id ? 'selected' : '' }}>
                                                                {{ $agence->nom }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                     @error('agences_transfert_id')
                                                        <div class="d-block text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                            <div class="text-end mt-3">
                                                <button type="submit" class="btn btn-success">Enregistrer</button>
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
</html>
