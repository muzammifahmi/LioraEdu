<?php
$koneksi = new mysqli("localhost", "root", "", "quiz_db");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if (!isset($_GET['id_kuis'])) {
    die("ID kuis tidak tersedia.");
}

$id_kuis = intval($_GET['id_kuis']);

$query = "SELECT * FROM soal WHERE id_kuis = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_kuis);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Soal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container mt-5">
    <?php
    $query_kuis = "SELECT nama_kuis, deskripsi FROM kuis WHERE id_kuis = ?";
    $stmt_kuis = $koneksi->prepare($query_kuis);
    $stmt_kuis->bind_param("i", $id_kuis);
    $stmt_kuis->execute();
    $result_kuis = $stmt_kuis->get_result();
    $kuis = $result_kuis->fetch_assoc();
    ?>

    <h1 class="mb-4">Detail Kuis</h1>
    <table class="table table-bordered w-50">
        <tr>
            <th>Nama Kuis</th>
            <td><?php echo htmlspecialchars($kuis['nama_kuis']); ?></td>
        </tr>
        <tr>
            <th>Deskripsi</th>
            <td><?php echo htmlspecialchars($kuis['deskripsi']); ?></td>
        </tr>
    </table>

    <!-- Tombol Tambah Soal -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Soal</h2>
        <a href="?page=soalquiz&item=tambah_soalquiz&id_kuis=<?php echo $id_kuis; ?>" class="btn btn-success">Tambah Soal</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NO</th>
                <th>Pertanyaan</th>
                <th>Pilihan A</th>
                <th>Pilihan B</th>
                <th>Pilihan C</th>
                <th>Pilihan D</th>
                <th>Jawaban Benar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php static $no = 1; echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['pertanyaan']); ?></td>
                <td><?php echo htmlspecialchars($row['pilihan_a']); ?></td>
                <td><?php echo htmlspecialchars($row['pilihan_b']); ?></td>
                <td><?php echo htmlspecialchars($row['pilihan_c']); ?></td>
                <td><?php echo htmlspecialchars($row['pilihan_d']); ?></td>
                <td><?php echo strtoupper($row['jawaban_benar']); ?></td>
                <td>
                    <a href="?page=soalquiz&item=edit_soalquiz&id_soal=<?php echo $row['id_soal']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?id_kuis=<?php echo $id_kuis; ?>&hapus_id=<?php echo $row['id_soal']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus soal ini?');">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>
</body>
</html>
