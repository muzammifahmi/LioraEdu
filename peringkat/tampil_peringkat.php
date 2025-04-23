<?php
include 'koneksi.php';
$query = "SELECT u.username, SUM(hk.skor) AS total_skor
          FROM hasil_kuis hk
          JOIN users u ON hk.id_user = u.id
          WHERE u.role = 'user' -- Hanya mengambil data dari pengguna dengan role 'user'
          GROUP BY hk.id_user
          ORDER BY total_skor DESC
          LIMIT 10";
$result = mysqli_query($koneksi, $query);
?>

<main class="main-wrapper container mt-5">
  <div class="container mt-5">
    <h2 class="text-center mb-4">🏆 Leaderboard Peringkat</h2>
    <div class="card shadow rounded">
      <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
          <thead class="table-primary">
            <tr>
              <th scope="col">Peringkat</th>
              <th scope="col">Username</th>
              <th scope="col">Total Skor</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>
                  <th scope='row'>{$no}</th>
                  <td>{$row['username']}</td>
                  <td>{$row['total_skor']}</td>
                </tr>";
              $no++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<style>
  .main-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 76vh;
  }

  .table-primary {
    background-color: #007bff !important;
    color: white;
  }

  .table-striped tbody tr:nth-of-type(odd) {
    background-color: #cce5ff;
  }
</style>