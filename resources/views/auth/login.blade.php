<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>Rapide Service</title>
<link rel="icon" href="/Authentification/img/logoMSCJ.jpeg">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/Authentification/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/Authentification/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/Authentification/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/Authentification/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/Authentification/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/Authentification/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/Authentification/vendor/simple-datatables/style.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


  <!-- Template Main CSS File -->
  <link href="/Authentification/css/style.css" rel="stylesheet">
  <link href="/Authentification/css/authentication.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 col-14 mx-auto">



              <div class="card mb-3" >

                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <a href="index.html" class="d-flex align-items-center w-auto">
                            <img src="/Authentification/img/logoMSCJ.jpeg" style="width: 150px; height: 150px; object-fit:contain" alt="" class="mx-auto d-block">
                          <span style="color: white;"></span>
                          <span class="d-none d-lg-block"></span>
                        </a>
                      </div><!-- End Logo -->
                  <div class="pb-2">
                    <h5 class="card-title text-center text-success pb-0 fs-5 fw-bold">Connexion</h5>
                    <p class="text-center small"></p>
                  </div>

                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="col-12 mb-3">
                        <label for="yourUsername" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" name="email" :value="old('email')" class="form-control" placeholder="exemple@email.com" required autofocus autocomplete="username">
                        </div>
                        @error('email')
                        <div class="d-block text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="yourPassword" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="password" id="yourPassword" required>
                            <span class="input-group-text" >
                                <i class="fa fa-eye-slash" id="passwordVisibility" style="cursor: pointer;"></i>
                            </span>
                        </div>
                        @error('password')
                        <div class="d-block text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember"  value="true" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Souvenez-vous de moi</label>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <button class="btn btn-success w-100"  type="submit">Se connecter</button>
                    </div>

                    <div class="col-12">
                        <p class="small mb-0 text-center">
                            <a href="{{ route('password.request') }}" class="text-success">Mot de passe oublié ?</a>
                        </p>
                    </div>
                </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/Authentification/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/Authentification/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/Authentification/vendor/chart.js/chart.umd.js"></script>
  <script src="/Authentification/vendor/echarts/echarts.min.js"></script>
  <script src="/Authentification/vendor/quill/quill.min.js"></script>
  <script src="/Authentification/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/Authentification/vendor/tinymce/tinymce.min.js"></script>
  <script src="/Authentification/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/Authentification/js/main.js"></script>
  <script src="/Authentification/js/passwordVisibility.js"></script>

</body>

</html>
