<?php
// Pastikan koneksi ke database sudah tersedia
include 'koneksi.php';

// Ambil ID materi dari URL
$id_materi = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Inisialisasi variabel untuk status
$status = '';

// Ambil data materi berdasarkan ID
$materi = null;
if ($id_materi > 0) {
    $stmt = $koneksi->prepare("SELECT judul, deskripsi FROM materi WHERE id = ?");
    $stmt->bind_param("i", $id_materi);
    $stmt->execute();
    $result = $stmt->get_result();
    $materi = $result->fetch_assoc();
    $stmt->close();
}

// Proses form untuk menambahkan isi materi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isi_materi = isset($_POST['isi_materi']) ? trim($_POST['isi_materi']) : '';

    if (!empty($isi_materi)) {
        $stmt = $koneksi->prepare("INSERT INTO isi_materi (id_materi, isi) VALUES (?, ?)");
        $stmt->bind_param("is", $id_materi, $isi_materi);

        if ($stmt->execute()) {
            $status = 'sukses';
        } else {
            $status = 'error';
        }

        $stmt->close();
    } else {
        $status = 'invalid';
    }
}

// Tutup koneksi
$koneksi->close();
?>

<main class="container mt-5">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Isi Materi</h1>

        <!-- Tampilkan data judul dan deskripsi dalam bentuk tabel -->
        <?php if ($materi): ?>
            <table class="table table-bordered mb-4">
                <tr>
                    <th>Judul</th>
                    <td><?= htmlspecialchars($materi['judul']) ?></td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td><?= nl2br(htmlspecialchars($materi['deskripsi'])) ?></td>
                </tr>
            </table>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                Materi tidak ditemukan.
            </div>
        <?php endif; ?>

        <!-- Tampilkan pesan status -->
        <?php if ($status === 'sukses'): ?>
            <div class="alert alert-success" role="alert">
                Isi materi berhasil ditambahkan!
            </div>
        <?php elseif ($status === 'error'): ?>
            <div class="alert alert-danger" role="alert">
                Terjadi kesalahan saat menambahkan isi materi.
            </div>
        <?php elseif ($status === 'invalid'): ?>
            <div class="alert alert-warning" role="alert">
                Harap isi data dengan benar.
            </div>
        <?php endif; ?>

        <!-- Form untuk menambahkan isi materi -->
        <form action="" method="POST">
            <div class="mb-3">
                <label for="isi_materi" class="form-label">Isi Materi</label>
                <textarea class="form-control" id="isi_materi" name="isi_materi" rows="8" placeholder="Masukkan isi materi" required></textarea>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="?page=materi&item=tambah_materi&id" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

    <!-- Tambahkan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</main>