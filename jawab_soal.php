<?php
require_once('koneksi.php');

$id_kuis = isset($_GET['id_kuis']) ? (int)$_GET['id_kuis'] : 0;

// Ambil informasi kuis
$kuis_sql = "SELECT * FROM kuis WHERE id_kuis = $id_kuis";
$kuis_result = $koneksi->query($kuis_sql);
$kuis = $kuis_result->fetch_assoc();

// Ambil soal-soal kuis
$soal_sql = "SELECT * FROM soal WHERE id_kuis = $id_kuis ORDER BY id_soal ASC";
$soal_result = $koneksi->query($soal_sql);
?>

<main class="container mt-5">
    <h2 class="text-center mb-4">Kuis: <?= htmlspecialchars($kuis['nama_kuis']); ?></h2>

    <form action="index.php?page=simpan_jawaban" method="POST">
        <input type="hidden" name="id_kuis" value="<?= $id_kuis; ?>">

        <?php
        $nomor = 1;
        while ($soal = $soal_result->fetch_assoc()):
        ?>
        <div class="mb-4 p-4 border rounded shadow-sm">
            <p><strong>Soal <?= $nomor++; ?>:</strong> <?= htmlspecialchars($soal['pertanyaan']); ?></p>

            <?php
            $opsi = ['a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D'];
            foreach ($opsi as $key => $label):
                $pilihan_text = htmlspecialchars($soal['pilihan_' . $key]);
            ?>
            <div class="form-check">
                <input class="form-check-input" type="radio"
                       name="jawaban[<?= $soal['id_soal']; ?>]" 
                       id="<?= $soal['id_soal'] . $key; ?>" 
                       value="<?= $key; ?>" required>
                <label class="form-check-label" for="<?= $soal['id_soal'] . $key; ?>">
                    <?= $label; ?>. <?= $pilihan_text; ?>
                </label>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endwhile; ?>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Kirim Jawaban</button>
        </div>
    </form>
</main>
