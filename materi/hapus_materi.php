<?php
// Pastikan koneksi ke database sudah tersedia
include 'koneksi.php';

// Ambil ID materi dari parameter URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Jika ID valid, lakukan penghapusan
if ($id > 0) {
    $query = "DELETE FROM materi WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Tutup statement
    $stmt->close();
}

// Tutup koneksi
$koneksi->close();

// Redirect kembali ke halaman daftar materi
header("Location: ?page=materi&item=tampil_materi");
exit;