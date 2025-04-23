<?php include 'include/header.php'; ?>

<?php
include "koneksi.php";  

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: auth/landingpage.php");
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
} elseif ($_GET['page'] == "makequiz" && $_GET['item'] == "daftarquiz") {
    include "makequiz/daftarquiz.php";
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
} elseif ($_GET['page'] == "auth" && $_GET['item'] == "logout") {
    include "auth/logout.php";
//user
} elseif ($_GET['page'] == "user" && $_GET['item'] == "tampil_user") {
    include "user/tampil_user.php";
} elseif ($_GET['page'] == "user" && $_GET['item'] == "manajemen_user") {
    include "user/manajemen_user.php";
} elseif ($_GET['page'] == "user" && $_GET['item'] == "edit_profil") {
    include "user/edit_profil.php";
} elseif ($_GET['page'] == "auth" && $_GET['item'] == "logout") {
    include "auth/logout.php";
} elseif ($_GET['page'] == "auth" && $_GET['item'] == "register") {
    include "auth/register.php";
//materi
} elseif ($_GET['page'] == "materi" && $_GET['item'] == "tampil_materi") {
    include "materi/tampil_materi.php";
} elseif ($_GET['page'] == "materi" && $_GET['item'] == "tambah_materi") {
    include "materi/tambah_materi.php";
} elseif ($_GET['page'] == "materi" && $_GET['item'] == "edit_materi") {
    include "materi/edit_materi.php";
} elseif ($_GET['page'] == "materi" && $_GET['item'] == "hapus_materi") {
    include "materi/hapus_materi.php";
} elseif ($_GET['page'] == "materi" && $_GET['item'] == "tambah_isi_materi") {
    include "materi/tambah_isi_materi.php";
} elseif ($_GET['page'] == "materi" && $_GET['item'] == "tampil_isi_materi") {
    include "materi/tampil_isi_materi.php";
//peringkat
} elseif ($_GET['page'] == "peringkat" && $_GET['item'] == "tampil_peringkat") {
    include "peringkat/tampil_peringkat.php";


} else {
    echo "<h2>Page not found</h2>";
}
?>

<?php include 'include/footer.php'; ?>
