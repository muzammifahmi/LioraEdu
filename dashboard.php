<?php
require_once('koneksi.php');

// Ambil username dari sesi (pastikan sesi sudah dimulai sebelumnya)
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Pengguna';

// Tambahkan fitur baru
$features = [
    ['icon' => 'bi bi-pencil-square', 'title' => 'Kerjakan Kuis', 'description' => 'Mulai mengerjakan kuis yang tersedia.', 'link' => '?page=makequiz&item=daftarquiz'],
    ['icon' => 'bi bi-book', 'title' => 'Materi', 'description' => 'Pelajari materi yang tersedia.', 'link' => '?page=materi&item=tampil_materi'],
    ['icon' => 'bi bi-trophy', 'title' => 'Peringkat', 'description' => 'Lihat peringkat Anda di leaderboard.', 'link' => '?page=peringkat&item=tampil_peringkat'],
];
?>

<main class="main-wrapper container mt-5">
    <div class="container content row align-items-stretch">
        <!-- Selamat Datang dan Username -->
        <div class="col-md-4">
            <div class="p-4 bg-light shadow-sm rounded h-100 d-flex flex-column justify-content-center animate__animated animate__fadeInLeft">
                <h2 class="mb-3">Selamat Datang</h2>
                <p class="text-muted">Halo, <strong><?= htmlspecialchars($username); ?></strong>!</p>
                <p>Selamat datang di platform kuis kami. Jelajahi fitur-fitur menarik yang telah kami sediakan untuk Anda.</p>
            </div>
        </div>

        <!-- Dashboard -->
        <div class="col-md-8">
            <div class="row g-4">
                <?php foreach ($features as $feature): ?>
                    <div class="col-md-6">
                        <div class="card shadow-sm h-100 animate__animated animate__fadeInUp">
                            <div class="card-body text-center d-flex flex-column justify-content-between">
                                <i class="<?= $feature['icon']; ?> mb-3" style="font-size: 2rem;"></i>
                                <h5 class="card-title"><?= htmlspecialchars($feature['title']); ?></h5>
                                <p class="card-text"><?= htmlspecialchars($feature['description']); ?></p>
                                <a href="<?= $feature['link']; ?>" class="btn btn-primary mt-3">Lihat</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<!-- Tambahkan animasi CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<style>
    /* Gaya untuk latar belakang halaman */
    body {
        background-color: #f8f9fa;
    }

    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .h-100 {
        height: 100%;
    }

    .main-wrapper {
      display: flex;
      flex-direction: column;
      min-height: 76vh;
    }
</style>
