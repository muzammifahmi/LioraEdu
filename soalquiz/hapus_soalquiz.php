<?php
include 'koneksi.php';

if (!isset($_GET['id_soal'])) {
    die("ID soal tidak tersedia.");
}

$id_soal = intval($_GET['id_soal']);

// Hapus soal dari database
$query = "DELETE FROM soal WHERE id_soal = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_soal);

if ($stmt->execute()) {
    // Redirect ke halaman daftar soal
    header("Location: ?page=soalquiz&item=daftar_soal&id_kuis=" . $_GET['id_kuis']);
    exit;
} else {
    echo "Gagal menghapus soal: " . $stmt->error;
}

$stmt->close();
$koneksi->close();
