<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db"; // Ganti dengan nama database Anda

$koneksi = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil ID quiz dari parameter URL
$kuis_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data judul dan deskripsi quiz
$sql_kuis = "SELECT nama_kuis, deskripsi FROM kuis WHERE id_kuis = ?";
$stmt_kuis = $koneksi->prepare($sql_kuis);
$stmt_kuis->bind_param("i", $kuis_id);
$stmt_kuis->execute();
$result_kuis = $stmt_kuis->get_result();

if ($result_kuis->num_rows > 0) {
    $quiz = $result_kuis->fetch_assoc();
    ?>
    <div class="container mt-4">
        <div class="card shadow-sm rounded"></div>
            <div class="card-header bg-primary text-white rounded-top"></div>
                <h3 class="mb-0">Detail Quiz</h3>
            </div>
            <div class="card-body rounded-bottom"></div>
                <div class="table-wrapper">
                    <table class="table table-bordered table-spacing">
                        <tr>
                            <th class="bg-dark text-white" style="width: 20%;">Judul</th>
                            <td class="text-primary"><?= htmlspecialchars($kuis['nama_kuis']); ?></td>
                        </tr>
                        <tr>
                            <th class="bg-dark text-white">Deskripsi</th>
                            <td class="text-muted"><?= htmlspecialchars($kuis['deskripsi']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table-wrapper {
            margin: 0 auto; /* Pusatkan tabel */
            padding: 20px; /* Tambahkan padding di sekitar tabel */
            max-width: 90%; /* Batasi lebar maksimum tabel */
        }

        .table-spacing {
            margin: 10px 0; /* Tambahkan margin atas dan bawah */
        }
    </style>
    <?php
} else {
    echo "Quiz tidak ditemukan.";
    exit;
}

// Ambil data soal dan pilihan jawaban
$sql_soal = "SELECT id, pertanyaan FROM soal WHERE quiz_id = ?";
$stmt_soal = $koneksi->prepare($sql_soal);
$stmt_soal->bind_param("i", $quiz_id);
$stmt_soal->execute();
$result_soal = $stmt_soal->get_result();

if ($result_soal->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>No</th><th>Pertanyaan</th><th>Pilihan Jawaban</th></tr>";
    $no = 1;
    while ($soal = $result_soal->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . htmlspecialchars($soal['pertanyaan']) . "</td>";
        echo "<td>";

        // Ambil pilihan jawaban untuk soal ini
        $sql_pilihan = "SELECT pilihan, is_benar FROM pilihan_jawaban WHERE soal_id = ?";
        $stmt_pilihan = $koneksi->prepare($sql_pilihan);
        $stmt_pilihan->bind_param("i", $soal['id']);
        $stmt_pilihan->execute();
        $result_pilihan = $stmt_pilihan->get_result();

        if ($result_pilihan->num_rows > 0) {
            echo "<ul>";
            while ($pilihan = $result_pilihan->fetch_assoc()) {
                echo "<li>" . htmlspecialchars($pilihan['pilihan']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "Tidak ada pilihan jawaban.";
        }

        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada soal untuk quiz ini.";
}

// Tutup koneksi
$koneksi->close();
?>