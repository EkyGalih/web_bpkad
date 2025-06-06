<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Opss.. 404</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('layouts.admin.css')

</head>

<body>

  <main>
    <div class="container">

      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>404</h1>
        <h2>Opps...!! Halaman yang anda tuju tidak ditemukan</h2>
        <a class="btn" href="{{ route('admin') }}">Kembali Ke Halaman Utama</a>
        <img src="{{ asset('server/img/not-found.svg') }}" class="img-fluid py-5" alt="Page Not Found">
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
          Designed by <a href="https://instagram.com/EkyGalih_" target="_blank">ITeam BPKAD</a>
        </div>
      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

@include('layouts.admin.js')

</body>

</html>
