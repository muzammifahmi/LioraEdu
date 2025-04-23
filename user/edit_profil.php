<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
  die("ID user tidak ditemukan.");
}

$id = intval($_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id = $id");
if (!$query || mysqli_num_rows($query) == 0) {
  die("Data user tidak ditemukan.");
}
$data = mysqli_fetch_assoc($query);

// Proses simpan data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  mysqli_query($koneksi, "UPDATE users SET username='$username', password='$password' WHERE id = $id");

  echo "<div class='alert alert-success text-center'>Profil berhasil diperbarui!</div>";

  // Refresh data setelah update
  $query = mysqli_query($koneksi, "SELECT * FROM users WHERE id = $id");
  $data = mysqli_fetch_assoc($query);
}
?>

<style>
  .main-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 76vh;
    justify-content: center;
    align-items: center;
    background-color: #f8f9fa;
  }

  .form-container {
    background: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
  }

  .form-container h3 {
    text-align: center;
    margin-bottom: 20px;
    color: #343a40;
  }

  .btn-primary {
    width: 100%;
    padding: 10px;
    font-size: 16px;
  }

  .password-wrapper {
    position: relative;
  }

  .password-toggle {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: gray;
  }
</style>
</head>
<body>
  <div class="main-wrapper">
    <div class="form-container">
      <h3>Edit Profil</h3>
      <form method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($data['username']) ?>" required>
        </div>

        <div class="mb-3 password-wrapper">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" value="<?= htmlspecialchars($data['password']) ?>" required>
          <i class="bi bi-eye password-toggle" id="togglePassword" onclick="togglePassword()"></i>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </form>
    </div>
  </div>

  <script>
    function togglePassword() {
      const password = document.getElementById("password");
      const toggle = document.getElementById("togglePassword");

      if (password.type === "password") {
        password.type = "text";
        toggle.classList.remove("bi-eye");
        toggle.classList.add("bi-eye-slash");
      } else {
        password.type = "password";
        toggle.classList.remove("bi-eye-slash");
        toggle.classList.add("bi-eye");
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>