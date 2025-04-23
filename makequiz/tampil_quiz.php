<?php
require_once('koneksi.php');

// Konfigurasi pagination
$limit = 5; // Jumlah data per halaman
$page = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1; // Halaman saat ini
$offset = ($page - 1) * $limit; // Hitung offset

// Hitung total data
$total_sql = "SELECT COUNT(*) AS total FROM kuis";
$stmt = $koneksi->prepare($total_sql);
$stmt->execute();
$total_result = $stmt->get_result();
$total_data = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_data / $limit); // Total halaman

// Ambil data sesuai halaman
$sql = "SELECT k.*, 
               (SELECT COUNT(*) FROM soal s WHERE s.id_kuis = k.id_kuis) AS jumlah_soal 
        FROM kuis k 
        ORDER BY k.id_kuis DESC 
        LIMIT ? OFFSET ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>
<main class="main-wrapper container mt-5">
    <h1 class="text-center mb-4">Daftar Kuis</h1>
    
    <!-- Tambahkan tombol Tambah Kuis -->
    <div class="mb-3 text-end">
        <a href="?page=makequiz&item=tambah_quiz" class="btn btn-success">Tambah Kuis</a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center table-blue" style="border-radius: 10px; overflow: hidden;">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul Kuis</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Soal</th> <!-- Kolom baru -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = $offset + 1; // Penomoran sesuai halaman
                while ($kuis = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($kuis['nama_kuis']); ?></td>
                    <td><?= htmlspecialchars($kuis['deskripsi']); ?></td>
                    <td><?= $kuis['jumlah_soal']; ?></td> <!-- Menampilkan jumlah soal -->
                    <td>
                        <a href="?page=makequiz&item=edit_quiz&id_kuis=<?= htmlspecialchars($kuis['id_kuis']); ?>" class="btn btn-warning">Edit</a>
                        <a href="?page=soalquiz&item=daftar_soal&id_kuis=<?= htmlspecialchars($kuis['id_kuis']); ?>" class="btn btn-primary">Soal</a>
                        <button class="btn btn-danger" onclick="confirmDelete(<?= htmlspecialchars($kuis['id_kuis']); ?>)">Hapus</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Navigasi Pagination -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=makequiz&item=tampil_quiz&page_num=<?= $page - 1; ?>">Previous</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=makequiz&item=tampil_quiz&page_num=<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=makequiz&item=tampil_quiz&page_num=<?= $page + 1; ?>">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</main>

<!-- Include Alertify.js -->
<link rel="stylesheet" href="css/alertify.css">
<link rel="stylesheet" href="css/themes/bootstrap.css">
<script src="alertify.js"></script>
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

// Function to confirm deletion
function confirmDelete(id) {
    alertify.confirm(
        "Konfirmasi Hapus",
        "Apakah Anda yakin ingin menghapus kuis ini?",
        function () {
            // Redirect to delete URL if confirmed
            window.location.href = `index.php?page=makequiz&item=hapus_quiz&id_kuis=${id}`;
        },
        function () {
            // Do nothing if canceled
            alertify.error("Penghapusan dibatalkan");
        }
    );
}
</script>
