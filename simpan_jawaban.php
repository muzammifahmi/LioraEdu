<?php
require_once('koneksi.php');
//session_start(); // Pastikan sesi login aktif

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kuis = $_POST['id_kuis'];
    $jawaban = $_POST['jawaban'];
    $id_user = $_SESSION['id']; // Ambil ID pengguna dari sesi

    $benar = 0;
    $jumlah = count($jawaban);

    // Hitung jumlah jawaban benar
    foreach ($jawaban as $id_soal => $jawab) {
        $query = "SELECT jawaban_benar FROM soal WHERE id_soal = $id_soal";
        $result = $koneksi->query($query);
        $data = $result->fetch_assoc();

        if ($data['jawaban_benar'] == $jawab) {
            $benar++;
        }
    }

    // Hitung skor
    $skor = ($jumlah > 0) ? round(($benar / $jumlah) * 100, 2) : 0;

    // Simpan hasil ke tabel hasil_kuis
    $cek = "SELECT * FROM hasil_kuis WHERE id_user = $id_user AND id_kuis = $id_kuis";
    $result = $koneksi->query($cek);

    if ($result->num_rows > 0) {
        // Update skor jika sudah ada data untuk kuis ini
        $update = "UPDATE hasil_kuis 
                   SET skor = $skor, tanggal = NOW() 
                   WHERE id_user = $id_user AND id_kuis = $id_kuis";
        $koneksi->query($update);
    } else {
        // Insert skor baru jika belum ada data untuk kuis ini
        $insert = "INSERT INTO hasil_kuis (id_user, id_kuis, skor, tanggal) 
                   VALUES ($id_user, $id_kuis, $skor, NOW())";
        $koneksi->query($insert);
    }
?>
    <main class="container mt-5 text-center">
        <h2>Hasil Kuis</h2>
        <p>Jawaban Benar: <strong><?php echo $benar; ?></strong> dari <strong><?php echo $jumlah; ?></strong> soal</p>
        <h3>Skor: <strong><?php echo $skor; ?></strong></h3>
        <a href="index.php" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php
}
?>
