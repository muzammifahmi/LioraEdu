<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>--edukasi--</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css"> 
    <link rel="stylesheet" href="../css/alertify.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">


    <!-- include bootstrap theme -->
    <link rel="stylesheet" href="../css/themes/bootstrap.css">

    <!-- include alertify script -->
    <script src="../alertify.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-"> 
        <div class="container-fluid">
            <a class="navbar-brand" href="#">LioraEdu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> 
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=materi&item=tampil_materi">Materi</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=makequiz&item=daftarquiz">Quiz</a> 
                    </li>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <li class="nav-item"></li>
                            <a class="nav-link" href="?page=makequiz&item=tampil_quiz">Buat Quiz</a> 
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=peringkat&item=tampil_peringkat">Peringkat</a> 
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="?page=user&item=tampil_user">Profil</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=auth&item=logout">Logout</a>
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