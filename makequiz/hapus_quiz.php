<?php
require_once('koneksi.php');

if (!isset($_GET['id_kuis'])) {
    die("ID kuis tidak tersedia.");
}

$id_kuis = intval($_GET['id_kuis']);

// Hapus semua soal yang berkaitan dengan kuis ini terlebih dahulu (jika perlu)
$hapus_soal = $koneksi->prepare("DELETE FROM soal WHERE id_kuis = ?");
$hapus_soal->bind_param("i", $id_kuis);
$hapus_soal->execute();
$hapus_soal->close();

// Hapus data kuis
$hapus_kuis = $koneksi->prepare("DELETE FROM kuis WHERE id_kuis = ?");
$hapus_kuis->bind_param("i", $id_kuis);

if ($hapus_kuis->execute()) {
    // Redirect ke halaman tampil kuis dengan notifikasi jika berhasil
    header("Location: index.php?page=makequiz&item=tampil_quiz&msg=deleted");
} else {
    echo "Gagal menghapus kuis: " . $hapus_kuis->error;
}

$hapus_kuis->close();
$koneksi->close();
?>
