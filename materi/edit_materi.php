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

// Tutup statement
$stmt->close();

// Proses update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul']);
    $deskripsi = trim($_POST['deskripsi']);
    $isi = trim($_POST['isi']); // Tambahkan pengambilan data isi

    // Validasi input
    if (!empty($judul) && !empty($deskripsi) && !empty($isi)) {
        $updateQuery = "UPDATE materi SET judul = ?, deskripsi = ?, isi = ? WHERE id = ?";
        $updateStmt = $koneksi->prepare($updateQuery);
        $updateStmt->bind_param("sssi", $judul, $deskripsi, $isi, $id);
        $updateStmt->execute();

        // Redirect ke halaman daftar materi setelah update
        header("Location: ?page=materi&item=tampil_materi");
        exit;
    } else {
        $error = "Judul, deskripsi, dan isi tidak boleh kosong.";
    }
}

// Tutup koneksi
$koneksi->close();
?>

<main class="container mt-5">
    <div class="row min-vh-100 gx-0">
        <div class="col-md-6 offset-md-3">
            <h1 class="zonafikr-title mb-4">Edit Materi</h1>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="<?= htmlspecialchars($materi['judul']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required><?= htmlspecialchars($materi['deskripsi']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="isi" class="form-label">Isi Materi</label>
                    <textarea name="isi" id="isi" class="form-control" rows="10" required><?= htmlspecialchars($materi['isi']); ?></textarea>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="?page=materi&item=tampil_materi" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</main>