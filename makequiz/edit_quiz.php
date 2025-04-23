<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$koneksi = new mysqli("localhost", "root", "", "quiz_db");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Perbaiki nama variabel sesuai form
    $id_kuis = $_POST['id'];
    $nama_kuis = $_POST['title'];
    $deskripsi = $_POST['description'];

    $sql = "UPDATE kuis SET nama_kuis = '$nama_kuis', deskripsi = '$deskripsi' WHERE id_kuis = $id_kuis";
    if ($koneksi->query($sql) === TRUE) {
        header("Location: ?page=makequiz&item=tampil_quiz&id=$id_kuis");
        exit;
    } else {
        echo "Error: " . $koneksi->error;
    }
} else {
    // Cegah error jika $_GET['id_kuis'] tidak ada
    if (!isset($_GET['id_kuis'])) {
        die("ID kuis tidak tersedia.");
    }

    $id_kuis = $_GET['id_kuis'];

    $sql = "SELECT * FROM kuis WHERE id_kuis = $id_kuis";
    $result = $koneksi->query($sql);

    if (!$result || $result->num_rows === 0) {
        die("Kuis tidak ditemukan.");
    }

    $kuis = $result->fetch_assoc();
}
?>

<main class="main-wrapper container mt-5">
    <h1 class="mb-4">Edit Quiz</h1>
    <form method="POST" action="" class="card p-4 shadow-sm">
        <input type="hidden" name="id" value="<?php echo $kuis['id_kuis']; ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Judul Kuis:</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo $kuis['nama_kuis']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi:</label>
            <textarea id="description" name="description" class="form-control" rows="5" required><?php echo $kuis['deskripsi']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</main>

<style>
        .main-wrapper {
      display: flex;
      flex-direction: column;
      min-height: 76vh;
    }
</style>
