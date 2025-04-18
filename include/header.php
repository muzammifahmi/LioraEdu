<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css"> <!-- Tambahkan file CSS eksternal -->
    <link rel="stylesheet" href="../css/alertify.css">

    <!-- include bootstrap theme -->
    <link rel="stylesheet" href="../css/themes/bootstrap.css">

    <!-- include alertify script -->
    <script src="../alertify.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light"> <!-- Ubah tema menjadi cerah -->
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Zona Fikir</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- Tambahkan ms-auto untuk memindahkan menu ke kanan -->
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=makequiz&item=tampil_quiz">Buat Quiz</a> <!-- Tambahkan menu Buat Quiz -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="auth/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4"></div>

    <script type="text/javascript">
        // Override defaults
        alertify.defaults.transition = "slide";
        alertify.defaults.theme.ok = "btn btn-primary";
        alertify.defaults.theme.cancel = "btn btn-danger";
        alertify.defaults.theme.input = "form-control";

        // Add event listener for logout
        document.querySelector('a[href="auth/logout.php"]').addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default link behavior
            alertify.confirm(
                'Konfirmasi Logout',
                'Apakah Anda yakin ingin keluar?',
                function () {
                    // Redirect to logout URL if confirmed
                    window.location.href = 'auth/logout.php';
                },
                function () {
                    // Do nothing if canceled
                    alertify.error('Logout dibatalkan');
                }
            ).set('labels', { ok: 'Ya', cancel: 'Tidak' }) // Set button labels
             .set('closable', false) // Prevent closing without action
             .set('movable', false); // Disable moving the dialog
        });
    </script>
</body>

</html>