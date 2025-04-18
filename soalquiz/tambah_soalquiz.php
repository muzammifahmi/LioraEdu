<?php
$koneksi = new mysqli("localhost", "root", "", "quiz_db");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if (!isset($_GET['id_kuis'])) {
    die("ID kuis tidak tersedia.");
}

$id_kuis = intval($_GET['id_kuis']);

// Tangani form tambah soal
if (isset($_POST['tambah_soal'])) {
    $id_kuis = intval($_POST['id_kuis']);
    $pertanyaan = $_POST['pertanyaan'];
    $pilihan_a = $_POST['pilihan_a'];
    $pilihan_b = $_POST['pilihan_b'];
    $pilihan_c = $_POST['pilihan_c'];
    $pilihan_d = $_POST['pilihan_d'];
    $jawaban_benar = $_POST['jawaban_benar'];

    $query_tambah = "INSERT INTO soal (id_kuis, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_tambah = $koneksi->prepare($query_tambah);
    $stmt_tambah->bind_param("issssss", $id_kuis, $pertanyaan, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $jawaban_benar);

    if ($stmt_tambah->execute()) {
        echo "<script>alert('Soal berhasil ditambahkan!'); window.location.href = '?page=soalquiz&item=tambah_soalquiz&id_kuis=$id_kuis';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan soal: " . $koneksi->error . "');</script>";
    }
}

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
    <h2 class="mt-5">Tambah Soal</h2>
    <form method="POST" action="" class="mb-5">
        <input type="hidden" name="id_kuis" value="<?php echo $id_kuis; ?>">
        <div class="mb-3">
            <label class="form-label">Pertanyaan:</label>
            <textarea name="pertanyaan" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Pilihan A:</label>
            <input type="text" name="pilihan_a" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pilihan B:</label>
            <input type="text" name="pilihan_b" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pilihan C:</label>
            <input type="text" name="pilihan_c" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pilihan D:</label>
            <input type="text" name="pilihan_d" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jawaban Benar (A/B/C/D):</label>
            <select name="jawaban_benar" class="form-select" required>
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
                <option value="d">D</option>
            </select>
        </div>
        <button type="submit" name="tambah_soal" class="btn btn-success">Tambah Soal</button>
    </form>

    <h2 class="mt-5">Daftar Soal</h2>
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