<?php
session_start();
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['username'])));
    $password = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['password'])));
    $confirm_password = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['confirm_password'])));

    // Cek apakah username sudah digunakan
    $check_username_query = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($check_username_query) > 0) {
        $error = "Username telah digunakan. Silakan pilih username lain.";
    } else {
        if ($password === $confirm_password) {
            // Simpan username dan password ke database
            $query = mysqli_query($koneksi, "INSERT INTO users (username, password) VALUES ('$username', '$password')");

            if ($query) {
                // Set flash message untuk registrasi berhasil
                $_SESSION['success'] = "Registrasi berhasil! Silakan login untuk melanjutkan.";
                header("Location: login.php");
                exit();
            } else {
                $error = "Terjadi kesalahan saat mendaftar. Silakan coba lagi.";
            }
        } else {
            $error = "Kata sandi dan konfirmasi kata sandi tidak cocok!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Quiz</title>
    <!-- Bootstrap CSS -->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Remix Icon -->
    <link href="../node_modules/remixicon/fonts/remixicon.css" rel="stylesheet">
    <style>
        .btn-primary {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.25);
        }

        body {
            font-family: "Inter", sans-serif;
        }

        .link-animated {
            position: relative;
            transition: color 0.3s ease;
        }

        .link-animated::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 0;
            height: 2px;
            background-color: #2563eb;
            transition: width 0.3s ease;
        }

        .link-animated:hover::after {
            width: 100%;
        }

        /* Animasi Fade-In */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.8s ease-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script>
        function togglePasswordVisibility(id, iconId) {
            const passwordField = document.getElementById(id);
            const icon = document.getElementById(iconId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("ri-eye-off-line");
                icon.classList.add("ri-eye-line");
            } else {
                passwordField.type = "password";
                icon.classList.remove("ri-eye-line");
                icon.classList.add("ri-eye-off-line");
            }
        }
    </script>
</head>

<body class="min-vh-100 d-flex flex-column bg-light">
    <main class="flex-grow-1 d-flex align-items-center justify-content-center p-4">
        <div class="bg-white rounded shadow p-4 p-md-5 fade-in" style="max-width: 450px;">
            <div class="text-center mb-4">
                <h1 class="fs-2 text-primary">LioraEdu</h1>
                <hr>
                <p class="text-secondary">Buat akun baru Anda</p>
            </div>
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="ri-user-line"></i>
                        </span>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="ri-lock-line"></i>
                        </span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('password', 'passwordIcon')">
                            <i id="passwordIcon" class="ri-eye-off-line"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="form-label">Konfirmasi Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="ri-lock-line"></i>
                        </span>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Konfirmasi password" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('confirm_password', 'confirmPasswordIcon')">
                            <i id="confirmPasswordIcon" class="ri-eye-off-line"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">Daftar</button>
            </form>
            <div class="mt-4 pt-4 border-top">
                <p class="text-center text-secondary">
                    Sudah memiliki akun?
                    <a href="login.php" class="text-primary text-decoration-none fw-medium">Masuk sekarang</a>
                </p>
            </div>
        </div>
    </main>
</body>

</html>