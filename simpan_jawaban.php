<?php
require_once('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kuis = $_POST['id_kuis'];
    $jawaban = $_POST['jawaban'];

    $benar = 0;
    $jumlah = count($jawaban);

    foreach ($jawaban as $id_soal => $jawab) {
        $query = "SELECT jawaban_benar FROM soal WHERE id_soal = $id_soal";
        $result = $koneksi->query($query);
        $data = $result->fetch_assoc();

        if ($data['jawaban_benar'] == $jawab) {
            $benar++;
        }
    }

    $nilai = ($jumlah > 0) ? round(($benar / $jumlah) * 100, 2) : 0;
    
    ?>

        <main class="container mt-5 text-center">
            <h2>Hasil Kuis</h2>
            <p>Jawaban Benar: <strong><?php echo $benar; ?></strong> dari <strong><?php echo $jumlah; ?></strong> soal</p>
            <h3>Nilai: <strong><?php echo $nilai; ?></strong></h3>
            <a href="index.php" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <?php
}
?>
