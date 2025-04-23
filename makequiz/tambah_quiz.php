<?php
require_once('koneksi.php');

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kuis = $_POST['nama_kuis'];
    $deskripsi = $_POST['deskripsi'];

    // Validasi sederhana
    if (!empty($nama_kuis)) {
        $stmt = $koneksi->prepare("INSERT INTO kuis (nama_kuis, deskripsi) VALUES (?, ?)");
        $stmt->bind_param("ss", $nama_kuis, $deskripsi);

        if ($stmt->execute()) {
            // Redirect ke daftar kuis jika berhasil
            header("Location: index.php?page=makequiz&item=tampil_quiz&msg=added");
            exit;
        } else {
            $error = "Gagal menyimpan data: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Judul kuis tidak boleh kosong!";
    }
}
?>

<main class="main-wrapper container mt-5">
    <h2 class="mb-4 text-center">Tambah Kuis Baru</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="" onsubmit="return confirmAddQuiz();">
        <div class="mb-3">
            <label for="nama_kuis" class="form-label">Judul Kuis</label>
            <input type="text" class="form-control" id="nama_kuis" name="nama_kuis" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
        </div>
        <div class="d-flex justify-content-end gap-2">
            <a href="index.php?page=makequiz&item=tampil_quiz" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">Tambah</button>
        </div>
    </form>
</main>

<!-- Include Alertify.js -->
<link rel="stylesheet" href="../alertify.css">
<link rel="stylesheet" href="../css/themes/bootstrap.css">
<script src="../alertify.js"></script>
<style>
        .main-wrapper {
      display: flex;
      flex-direction: column;
      min-height: 76vh;
    }
</style>

<script type="text/javascript">
// Override defaults
alertify.defaults.transition = "slide";
alertify.defaults.theme.ok = "btn btn-primary";
alertify.defaults.theme.cancel = "btn btn-danger";
alertify.defaults.theme.input = "form-control";

// Konfirmasi sebelum menambah kuis
function confirmAddQuiz() {
    return alertify.confirm(
        'Konfirmasi',
        'Apakah Anda yakin ingin menambah kuis ini?',
        function() {
            alertify.success('Kuis ditambahkan');
            document.querySelector('form').submit(); // Lanjutkan submit form
        },
        function() {
            alertify.error('Penambahan kuis dibatalkan');
        }
    ), false; // Batalkan submit form secara default
}
</script>
