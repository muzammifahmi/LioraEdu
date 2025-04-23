<!-- filepath: c:\xampp\htdocs\quizz\user\manajemen_user.php -->

<?php

// Ambil data pengguna dari database
$query = "SELECT id, username, role FROM users";
$result = $koneksi->query($query);

// Hitung jumlah total user dengan role "user"
$query_total_user = "SELECT COUNT(*) as total_user FROM users WHERE role = 'user'";
$result_total_user = $koneksi->query($query_total_user);
$total_user = $result_total_user->fetch_assoc()['total_user'];
?>

<div class="d-flex flex-column min-vh-100">
    <div class="container mt-5 flex-grow-1">
        <h2 class="mb-4">Manajemen User</h2>

        <!-- Card untuk jumlah total user dengan role "user" -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Total User </h5>
                <p class="card-text">Jumlah: <?= $total_user; ?></p>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['username']); ?></td>
                        <td><?= htmlspecialchars($row['role']); ?></td>
                        <td>
                            <a href="edit_user.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_user.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a href="tambah_user.php" class="btn btn-primary">Tambah User</a>
    </div>
</div>

