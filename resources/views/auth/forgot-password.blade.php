<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Stagiaire MESRS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Favicon-->
  <link rel="icon" href="/Acceuil/images/emblème2.jpg" type="image/x-icon" />
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


              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-2 pb-2">
                    <div class="d-flex justify-content-center">
                        <a href="index.html" class="d-flex align-items-center w-auto">
                            <img src="/Authentification/img/logoMSCJ.jpeg" style="width: 300px; height: 150px;" alt="" class="mx-auto d-block">
                            <span class="d-none d-lg-block"></span>
                        </a>
                    </div><!-- End Logo -->
                    <h5 class="card-title text-center text-success pb-0 fs-5 fw-bold">Mot de passe oublié?</h5>
                  </div>
                    <div class="text-center ">
                        <p>
                         On comprend, il se passe des choses.
                         Entrez simplement votre adresse e-mail ci-dessous et
                         nous vous enverrons un lien pour réinitialiser votre mot de passe !
                        </p>
                      </div>
                      <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                    <div class="col-12">
                      <label for="yourEmail" class="form-label"> Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" placeholder="exemple@email.com" required autofocus>
                      <div class="invalid-feedback">S'il vous plait entrer un mail valide</div>
                      @error('email')
                            <div class="d-block text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if (session('status'))
                        <p class="text-danger">{{session('status')}}</p>
                    @endif
                    <br>
                    <div class="col-12">
                        <button class="btn btn-success w-100" type="submit"> Réinitialiser</button>
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
  <script src="/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/vendor/chart.js/chart.umd.js"></script>
  <script src="/vendor/echarts/echarts.min.js"></script>
  <script src="/vendor/quill/quill.min.js"></script>
  <script src="/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/vendor/tinymce/tinymce.min.js"></script>
  <script src="/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/js/main.js"></script>

</body>

</html>
