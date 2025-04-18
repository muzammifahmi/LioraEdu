<?php include 'include/header.php'; ?>

<?php
include "koneksi.php";

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}

// Routing berdasarkan parameter page
$page = isset($_GET['page']) ? $_GET['page'] : "home";

if ($page == "home") {
    include "dashboard.php";
//makequiz
} elseif ($_GET['page'] == "makequiz" && $_GET['item'] == "tampil_quiz") {
    include "makequiz/tampil_quiz.php";
} elseif ($_GET['page'] == "makequiz" && $_GET['item'] == "edit_quiz") {
    include "makequiz/edit_quiz.php";
} elseif ($_GET['page'] == "makequiz" && $_GET['item'] == "tambah_quiz") {
    include "makequiz/tambah_quiz.php";
} elseif ($_GET['page'] == "makequiz" && $_GET['item'] == "hapus_quiz") {
    include "makequiz/hapus_quiz.php";
//soalquiz
} elseif ($_GET['page'] == "soalquiz" && $_GET['item'] == "tampil_soalquiz") {
    include "soalquiz/tampil_soalquiz.php";
} elseif ($_GET['page'] == "soalquiz" && $_GET['item'] == "edit_soalquiz") {
    include "soalquiz/edit_soalquiz.php";
} elseif ($_GET['page'] == "soalquiz" && $_GET['item'] == "tambah_soalquiz") {
    include "soalquiz/tambah_soalquiz.php";
} elseif ($_GET['page'] == "soalquiz" && $_GET['item'] == "hapus_soalquiz") {
    include "soalquiz/hapus_soalquiz.php";
} elseif ($_GET['page'] == "soalquiz" && $_GET['item'] == "daftar_soal") {
    include "soalquiz/daftar_soal.php";
} elseif ($_GET['page'] == "jawab_soal") {
    include "jawab_soal.php";
} elseif ($_GET['page'] == "simpan_jawaban") {
    include "simpan_jawaban.php";


} else {
    echo "<h2>Page not found</h2>";
}
?>

<?php include 'include/footer.php'; ?>
