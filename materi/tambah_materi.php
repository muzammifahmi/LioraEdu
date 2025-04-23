<?php
include 'koneksi.php';

// filepath: c:\xampp\htdocs\quiz\materi\tambah_materi.php

// Inisialisasi variabel untuk status
$status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $judul = isset($_POST['judul']) ? trim($_POST['judul']) : '';
    $deskripsi = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : '';

    // Simpan data ke sesi untuk diisi ulang di form
    $_SESSION['form_data'] = [
        'judul' => $judul,
        'deskripsi' => $deskripsi,
    ];

    // Validasi data
    if (!empty($judul) && !empty($deskripsi)) {
        // Siapkan query untuk menambahkan data ke tabel 'materi'
        $stmt = $koneksi->prepare("INSERT INTO materi (judul, deskripsi) VALUES (?, ?)");
        $stmt->bind_param("ss", $judul, $deskripsi);

        // Eksekusi query
        if ($stmt->execute()) {
            $status = 'sukses'; // Berhasil menambahkan data

            // Hapus data sesi jika berhasil
            unset($_SESSION['form_data']);

            // Redirect ke halaman tambah_isi_materi
            header("Location: ?page=materi&item=tambah_isi_materi&id=" . $koneksi->insert_id);
            exit();
        } else {
            $status = 'error'; // Gagal menambahkan data
        }

        // Tutup statement
        $stmt->close();
    } else {
        $status = 'invalid'; // Data tidak valid
    }
}

// Tutup koneksi
$koneksi->close();

// Ambil data dari sesi jika ada
$judul = isset($_SESSION['form_data']['judul']) ? $_SESSION['form_data']['judul'] : '';
$deskripsi = isset($_SESSION['form_data']['deskripsi']) ? $_SESSION['form_data']['deskripsi'] : '';
?>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Materi</h1>

        <!-- Tampilkan pesan status -->
        <?php if ($status === 'sukses'): ?>
            <div class="alert alert-success" role="alert">
                Materi berhasil ditambahkan!
            </div>
        <?php elseif ($status === 'error'): ?>
            <div class="alert alert-danger" role="alert">
                Terjadi kesalahan saat menambahkan materi.
            </div>
        <?php elseif ($status === 'invalid'): ?>
            <div class="alert alert-warning" role="alert">
                Harap isi semua data dengan benar.
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Materi</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul materi" value="<?php echo htmlspecialchars($judul); ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Materi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" placeholder="Masukkan deskripsi materi" required><?php echo htmlspecialchars($deskripsi); ?></textarea>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="?page=materi&item=tampil_materi" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <!-- Tambahkan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>