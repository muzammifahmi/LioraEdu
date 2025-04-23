<?php
require_once('koneksi.php');

// Ambil semua kuis
$sql = "SELECT id_kuis, nama_kuis, deskripsi FROM kuis ORDER BY id_kuis DESC";
$result = $koneksi->query($sql);
?>

<main class="main-wrapper container mt-5">
    <h2 class="text-center mb-4">Pilih Kuis untuk Dikerjakan</h2>

    <div class="row g-4">
        <?php while ($kuis = $result->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($kuis['nama_kuis']); ?></h5>
                        <p class="card-text"><?= htmlspecialchars($kuis['deskripsi']); ?></p>
                        <a href="?page=jawab_soal&id_kuis=<?= $kuis['id_kuis']; ?>" 
                           class="btn btn-primary" 
                           onclick="return confirmStartQuiz('<?= htmlspecialchars($kuis['nama_kuis']); ?>', this.href);">
                           Kerjakan
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<style>
        .main-wrapper {
      display: flex;
      flex-direction: column;
      min-height: 76vh;
    }
</style>

<script type="text/javascript">
// Atur tema tombol Alertify.js
alertify.defaults.theme.ok = "btn btn-primary"; // Tombol OK berwarna biru
alertify.defaults.theme.cancel = "btn btn-danger"; // Tombol Cancel berwarna merah

function confirmStartQuiz(quizName, url) {
    alertify.confirm(
        'Konfirmasi',
        'Apakah Anda yakin ingin memulai kuis "' + quizName + '"?',
        function() {
            window.location.href = url;
        },
        function() {
            alertify.error('Kuis dibatalkan');
        }
    );
    return false; // Mencegah link langsung diakses
}
</script>
