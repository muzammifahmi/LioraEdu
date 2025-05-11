<?php
include 'koneksi.php';
if (!isset($_GET['id_soal'])) {
    die("ID soal; tidak tersedia.");
}

$id_soal = intval($_GET['id_soal']);

// Tangani penghapusan soal
if (isset($_GET['hapus_id'])) {
    $hapus_id = intval($_GET['hapus_id']);
    $query_hapus = "DELETE FROM soal WHERE id_soal = ?";
    $stmt_hapus = $koneksi->prepare($query_hapus);
    $stmt_hapus->bind_param("i", $hapus_id);

    if ($stmt_hapus->execute()) {
        header("Location: ?page=soalquiz&item=daftar_soal&id_soal=" . $id_soal);
        exit;
    } else {
        echo "<script>alert('Gagal menghapus soal: " . $koneksi->error . "');</script>";
    }
}

$query = "SELECT * FROM soal WHERE id_soal = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_soal);
$stmt->execute();
$result = $stmt->get_result();
?>