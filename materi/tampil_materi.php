<?php
include 'koneksi.php';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$query = "SELECT * FROM materi";
if (!empty($search)) {
    $query .= " WHERE judul LIKE ?";
}
$stmt = $koneksi->prepare($query);
if (!empty($search)) {
    $searchParam = "%$search%";
    $stmt->bind_param("s", $searchParam);
}
$stmt->execute();
$result = $stmt->get_result();
$materi = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$koneksi->close();
?>
<main class="container mt-5">
    <div class="row min-vh-100 gx-0">
        <!-- Sidebar -->
        <div class="col-md-3 bg-white border-end p-4">
            <h2 class="zonafikr-title mb-4">LioraEdu</h2>
            <form method="get" class="mb-4">
                <input type="text" name="search" class="form-control" placeholder="Cari materi..." value="<?= htmlspecialchars($search) ?>">
            </form>
            <div class="overflow-auto" style="max-height: 70vh;">
                <ul class="list-unstyled">
                    <?php if (!empty($materi)): ?>
                        <?php foreach ($materi as $item): ?>
                            <li class="mb-2"><?= htmlspecialchars($item['judul']) ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="text-muted">Tidak ada materi ditemukan.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <!-- Content -->
        <div class="col-md-9 p-4">
            <h1 class="zonafikr-title mb-4">Daftar Materi</h1>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <div class="text-end mb-4">
                    <a href="?page=materi&item=tambah_materi" class="btn btn-success text-decoration-none">Tambah Materi</a>
                </div>
            <?php endif; ?>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php if (!empty($materi)): ?>
                    <?php foreach ($materi as $item): ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title text-primary"><?= htmlspecialchars($item['judul']); ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($item['deskripsi']); ?></p>
                                    <a href="?page=materi&item=tampil_isi_materi&id=<?= $item['id']; ?>" class="btn btn-primary btn-sm text-decoration-none">Lihat</a>
                                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                        <a href="?page=materi&item=edit_materi&id=<?= $item['id']; ?>" class="btn btn-warning btn-sm text-decoration-none">Edit</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-danger btn-sm text-decoration-none"
                                            onclick="confirmDelete('?page=materi&item=hapus_materi&id=<?= $item['id']; ?>')">Hapus</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-warning text-center" role="alert">
                            Tidak ada materi yang tersedia.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<link rel="stylesheet" href="css/alertify.css">
<link rel="stylesheet" href="css/themes/bootstrap.css">
<script src="alertify.js"></script>
<script type="text/javascript">
    alertify.defaults.transition = "slide";
    alertify.defaults.theme.ok = "btn btn-primary";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.defaults.theme.input = "form-control";
    function confirmDelete(url) {
        alertify.confirm(
            "Konfirmasi Hapus",
            "Yakin ingin menghapus materi ini?",
            function() {
                window.location.href = url;
            },
            function() {
                alertify.error("Penghapusan dibatalkan");
            }
        );
    }
</script>