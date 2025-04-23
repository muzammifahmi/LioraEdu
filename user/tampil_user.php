<?php

// Pastikan $user_id diambil dari sesi login
if (!isset($_SESSION['id'])) {
    die("Error: User ID tidak ditemukan. Pastikan Anda sudah login.");
}
$user_id = $_SESSION['id'];

// Ambil data pengguna dari tabel users
$query_user = "SELECT username FROM users WHERE id = ?";
$stmt_user = $koneksi->prepare($query_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$stmt_user->close();

if (!$user) {
    die("Error: Data pengguna tidak ditemukan di database.");
}

// Data dummy untuk statistik
$dummy_data = [
    'kuis_selesai' => 12,
    'rata_rata_skor' => '87%',
    'streak_aktif' => '7 Hari',
];
?>
<style>
    body {
        background-color: #f8f9fa;
    }

    .profile-card {
        max-width: 768px;
        margin: auto;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
    }

    .stat-box {
        background: #e3f2fd;
        border-radius: 10px;
        padding: 15px;
        text-align: center;
    }

    .stat-box h4 {
        margin: 0;
        color: #0d47a1;
    }

    .stat-box p {
        margin: 0;
        color: #6c757d;
    }

    .stat-icon {
        font-size: 2rem;
        color: #0d47a1;
        margin-bottom: 10px;
    }

    .main-wrapper {
        display: flex;
        flex-direction: column;
        min-height: 76vh;
    }
</style>
</head>
<main class="main-wrrapper container py-5">
    <!-- Profile Section -->

    <div class="profile-card text-center">
        <i class="bi bi-person-circle profile-avatar" style="font-size: 120px; color: #6c757d;"></i>
        <h2 class="h5 fw-bold text-dark">
            <?= htmlspecialchars($user['username'] ?? 'Pengguna Tidak Ditemukan'); ?>
        </h2>
        <p class="text-muted mb-3">Selamat datang di profil Anda!</p>
        <hr>
        <div class="row mt-4 g-3">
            <div class="col-md-6">
                <?php
                // Hitung jumlah kuis yang telah dikerjakan oleh pengguna
                $query_kuis = "SELECT COUNT(*) AS total_kuis FROM hasil_kuis WHERE id_user = ?";
                $stmt_kuis = $koneksi->prepare($query_kuis);
                $stmt_kuis->bind_param("i", $user_id);
                $stmt_kuis->execute();
                $result_kuis = $stmt_kuis->get_result();
                $data_kuis = $result_kuis->fetch_assoc();
                $stmt_kuis->close();
                ?>
                <div class="stat-box">
                    <i class="bi bi-check-circle stat-icon"></i>
                    <h4><?= $data_kuis['total_kuis']; ?></h4>
                    <p>Kuis Selesai</p>
                </div>
            </div>
            <div class="col-md-6">
                <?php
                // Hitung rata-rata skor dari tabel hasil_kuis untuk pengguna
                $query_rata_rata = "SELECT AVG(skor) AS rata_rata_skor FROM hasil_kuis WHERE id_user = ?";
                $stmt_rata_rata = $koneksi->prepare($query_rata_rata);
                $stmt_rata_rata->bind_param("i", $user_id);
                $stmt_rata_rata->execute();
                $result_rata_rata = $stmt_rata_rata->get_result();
                $data_rata_rata = $result_rata_rata->fetch_assoc();
                $stmt_rata_rata->close();
                $rata_rata_skor = $data_rata_rata['rata_rata_skor'] ? round($data_rata_rata['rata_rata_skor'], 2) . '%' : '0%';
                ?>
                <div class="stat-box">
                    <i class="bi bi-bar-chart stat-icon"></i>
                    <h4><?= $rata_rata_skor; ?></h4>
                    <p>Rata-rata Skor</p>
                </div>
            </div>
            <div class="col-md-6">
                <?php
                // Hitung rekor streak aktif berdasarkan tanggal di tabel hasil_kuis
                $query_streak = "SELECT MAX(streak) AS streak_aktif FROM (
                        SELECT id_user, COUNT(*) AS streak 
                        FROM (
                        SELECT id_user, DATE(tanggal) AS tanggal, 
                               DATEDIFF(DATE(tanggal), 
                               @prev_date := IF(@prev_user = id_user, @prev_date, NULL)) = 1 AS is_consecutive,
                               @prev_user := id_user 
                        FROM hasil_kuis, (SELECT @prev_user := NULL, @prev_date := NULL) AS vars
                        WHERE id_user = ?
                        ORDER BY id_user, tanggal
                        ) AS subquery
                        WHERE is_consecutive = 1
                        GROUP BY id_user
                    ) AS streak_data";
                $stmt_streak = $koneksi->prepare($query_streak);
                $stmt_streak->bind_param("i", $user_id);
                $stmt_streak->execute();
                $result_streak = $stmt_streak->get_result();
                $data_streak = $result_streak->fetch_assoc();
                $stmt_streak->close();
                $streak_aktif = $data_streak['streak_aktif'] ? $data_streak['streak_aktif'] . ' Hari' : '0 Hari';
                ?>
                <div class="stat-box">
                    <i class="bi bi-fire stat-icon"></i>
                    <h4><?= $streak_aktif; ?></h4>
                    <p>Streak Aktif</p>
                </div>
            </div>
            <div class="col-md-6">
                <?php
                // Hitung peringkat pengguna berdasarkan skor tertinggi
                $query_rank = "SELECT rank FROM (
                    SELECT id_user, skor, RANK() OVER (ORDER BY skor DESC) AS rank
                    FROM hasil_kuis
                ) AS ranked_users
                WHERE id_user = ?";
                $stmt_rank = $koneksi->prepare($query_rank);
                $stmt_rank->bind_param("i", $user_id);
                $stmt_rank->execute();
                $result_rank = $stmt_rank->get_result();
                $data_rank = $result_rank->fetch_assoc();
                $stmt_rank->close();
                $rank = $data_rank['rank'] ? $data_rank['rank'] : 'N/A';
                ?>
                <div class="stat-box">
                    <i class="bi bi-trophy stat-icon"></i>
                    <h4>#<?= $rank; ?></h4>
                    <p>Peringkat Anda</p>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <?php
                // Periksa apakah pengguna memiliki role admin
                $query_role = "SELECT role FROM users WHERE id = ?";
                $stmt_role = $koneksi->prepare($query_role);
                $stmt_role->bind_param("i", $user_id);
                $stmt_role->execute();
                $result_role = $stmt_role->get_result();
                $data_role = $result_role->fetch_assoc();
                $stmt_role->close();

                if ($data_role['role'] === 'admin') {
                ?>
                    <a href="?page=user&item=manajemen_user" class="btn btn-primary me-2">Manajemen User</a>
                <?php
                }
                ?>
                <a href="?page=user&item=edit_profil&id=<?= $user_id ?>" class="btn btn-secondary">Edit Profil</a>
            </div>
        </div>
    </div>
    </div>
</main>