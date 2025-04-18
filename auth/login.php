<?php
session_start();
include "../koneksi.php"; // karena login.php ada di folder /auth

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['username'])));
    $password = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['password'])));

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    $data = mysqli_fetch_array($query);

    // Mengganti password_verify dengan perbandingan langsung
    if ($data && $password === $data['password']) {
        $_SESSION['username'] = $data['username'];
        $_SESSION['id'] = $data['id'];
        header("Location: ../index.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Quiz</title>
    <!-- Bootstrap CSS -->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Remix Icon -->
    <!-- <link href="../assets/bootstrap-icons.min.css" rel="stylesheet"> -->
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
    </style>
</head>

<body class="min-vh-100 d-flex flex-column bg-light">
    <main class="flex-grow-1 d-flex align-items-center justify-content-center p-4">
        <div class="bg-white rounded shadow p-4 p-md-5" style="max-width: 450px;">
            <div class="text-center mb-4">
                <h1 class="fs-2 text-primary">Zona Fikir</h1>
                <hr>
                <p class="text-secondary">Masuk ke akun Anda</p>
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
                <div class="mb-4">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="ri-lock-line"></i>
                        </span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="ri-eye-off-line" id="passwordIcon"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">Masuk</button>
            </form>
            <div class="mt-4 pt-4 border-top">
                <p class="text-center text-secondary">
                    Belum memiliki akun?
                    <a href="#" class="text-primary text-decoration-none fw-medium">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.getElementById("togglePassword");
            const passwordInput = document.getElementById("password");
            const passwordIcon = document.getElementById("passwordIcon");
            togglePassword.addEventListener("click", function() {
                const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                passwordInput.setAttribute("type", type);
                passwordIcon.classList.toggle("ri-eye-line");
                passwordIcon.classList.toggle("ri-eye-off-line");
            });
        });
    </script>
</body>

</html>
