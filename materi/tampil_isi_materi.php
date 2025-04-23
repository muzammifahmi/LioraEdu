<?php
// Pastikan koneksi ke database sudah tersedia
include 'koneksi.php';

// Ambil ID materi dari parameter URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data materi berdasarkan ID
$query = "SELECT * FROM materi WHERE id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$materi = $result->fetch_assoc();

// Jika data tidak ditemukan, redirect ke halaman daftar materi
if (!$materi) {
    header("Location: tampil_materi.php");
    exit;
}

// Tutup statement dan koneksi
$stmt->close();
$koneksi->close();
?>

<main class="container mt-5">
    <div class="row min-vh-100 gx-0">
        <div class="col-md-8 offset-md-2">
            <h1 class="zonafikr-title mb-4"><?= htmlspecialchars($materi['judul']); ?></h1>
            <p class="text-muted">Deskripsi:</p>
            <p><?= nl2br(htmlspecialchars($materi['deskripsi'])); ?></p>
            <hr>
            <p class="text-muted">Isi Materi:</p>
            <div class="content">
                <?= nl2br(htmlspecialchars($materi['isi'])); ?>
            </div>
            <div class="text-end mt-4">
                <a href="?page=materi&item=tampil_materi" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</main>