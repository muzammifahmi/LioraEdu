<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/style.css">
  <link rel="stylesheet" href="../css/alertify.css">

  <!-- include bootstrap theme -->
  <link rel="stylesheet" href="../css/themes/bootstrap.css">

  <!-- include alertify script -->
  <script src="../alertify.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
    rel="stylesheet" />
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet" />
</head>

<body>
  <header class="fixed-top bg-white shadow-sm">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand text-primary" href="#" style="font-family: 'Pacifico';">Zona Fikir</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-dark" href="index.php">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark" href="?page=materi&item=tampil_materi">Materi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark" href="?page=makequiz&item=daftarquiz">Quiz</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark" href="?page=makequiz&item=tampil_quiz">Buat Quiz</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark" href="?page=peringkat&item=peringkat">Peringkat</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark" href="?page=user&item=tampil_user">Profile</a>
            </li>
          </ul>
          <div class="d-flex">
            <a href="?page=auth&item=login" class="btn btn-outline-primary me-2">Masuk</a>
            <a href="?page=auth&item=landingpage" class="btn btn-primary">Logout</a>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <div class="container mt-5"></div>

  <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
    // Override defaults
    alertify.defaults.transition = "slide";
    alertify.defaults.theme.ok = "btn btn-primary";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.defaults.theme.input = "form-control";

    // Add event listener for logout
    document.querySelector('a[href="auth/landingpage.php"]').addEventListener('click', function(e) {
      e.preventDefault(); // Prevent default link behavior
      alertify.confirm(
          'Konfirmasi Logout',
          'Apakah Anda yakin ingin keluar?',
          function() {
            // Redirect to logout URL if confirmed
            window.location.href = 'auth/landingpage.php';
          },
          function() {
            // Do nothing if canceled
            alertify.error('Logout dibatalkan');
          }
        ).set('labels', {
          ok: 'Ya',
          cancel: 'Tidak'
        }) // Set button labels
        .set('closable', false) // Prevent closing without action
        .set('movable', false); // Disable moving the dialog
    });
  </script>
</body>

</html>