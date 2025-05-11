<?php
include 'koneksi.php';

if (!isset($_GET['id_soal'])) {
    die("ID soal tidak tersedia.");
}

$id_soal = intval($_GET['id_soal']);

// Ambil data soal
$query_soal = "SELECT * FROM soal WHERE id_soal = ?";
$stmt = $koneksi->prepare($query_soal);
$stmt->bind_param("i", $id_soal);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Soal tidak ditemukan.");
}

$soal = $result->fetch_assoc();

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pertanyaan = $_POST['pertanyaan'];
    $pilihan_a = $_POST['pilihan_a'];
    $pilihan_b = $_POST['pilihan_b'];
    $pilihan_c = $_POST['pilihan_c'];
    $pilihan_d = $_POST['pilihan_d'];
    $jawaban_benar = $_POST['jawaban_benar'];

    $update_query = "UPDATE soal SET pertanyaan=?, pilihan_a=?, pilihan_b=?, pilihan_c=?, pilihan_d=?, jawaban_benar=? WHERE id_soal=?";
    $update_stmt = $koneksi->prepare($update_query);
    $update_stmt->bind_param("ssssssi", $pertanyaan, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $jawaban_benar, $id_soal);

    if ($update_stmt->execute()) {
        // Redirect ke daftar soal berdasarkan id_kuis
        header("Location: ?page=soalquiz&item=daftar_soal&id_kuis=" . $soal['id_kuis']);
        exit;
    } else {
        echo "Gagal memperbarui soal: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Soal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container mt-5">
    <h1>Edit Soal</h1>
    <form method="POST" action="" class="card p-4 shadow">
        <input type="hidden" name="id_soal" value="<?php echo $soal['id_soal']; ?>">
        <div class="mb-3">
            <label class="form-label">Pertanyaan:</label>
            <textarea name="pertanyaan" class="form-control" required><?php echo htmlspecialchars($soal['pertanyaan']); ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Pilihan A:</label>
            <input type="text" name="pilihan_a" class="form-control" value="<?php echo htmlspecialchars($soal['pilihan_a']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pilihan B:</label>
            <input type="text" name="pilihan_b" class="form-control" value="<?php echo htmlspecialchars($soal['pilihan_b']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pilihan C:</label>
            <input type="text" name="pilihan_c" class="form-control" value="<?php echo htmlspecialchars($soal['pilihan_c']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pilihan D:</label>
            <input type="text" name="pilihan_d" class="form-control" value="<?php echo htmlspecialchars($soal['pilihan_d']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jawaban Benar (A/B/C/D):</label>
            <select name="jawaban_benar" class="form-select" required>
                <option value="a" <?php echo $soal['jawaban_benar'] === 'a' ? 'selected' : ''; ?>>A</option>
                <option value="b" <?php echo $soal['jawaban_benar'] === 'b' ? 'selected' : ''; ?>>B</option>
                <option value="c" <?php echo $soal['jawaban_benar'] === 'c' ? 'selected' : ''; ?>>C</option>
                <option value="d" <?php echo $soal['jawaban_benar'] === 'd' ? 'selected' : ''; ?>>D</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</main>
</body>
</html>
