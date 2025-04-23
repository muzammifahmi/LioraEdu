<?php
include 'koneksi.php';
$search = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT * FROM materi";
if (!empty($search)) {
    $query .= " WHERE judul LIKE '%$search%'";
}
$result = $koneksi->query($query);
$materiList = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Katalog Materi ZonaFikr</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f0f8ff;
    }
    .zonafikr-title {
      color: #0056b3;
    }
    .sidebar-link {
      color: #007bff;
      cursor: pointer;
    }
    .sidebar-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row min-vh-100">
      <!-- Sidebar -->
      <div class="col-md-3 bg-white border-end p-4">
        <h2 class="zonafikr-title mb-4">ZonaFikr</h2>
        <form method="get" class="mb-4">
          <input type="text" name="search" class="form-control" placeholder="Cari materi..." value="<?= htmlspecialchars($search) ?>">
        </form>
        <div style="max-height: 70vh; overflow-y: auto;">
          <ul class="list-unstyled">
            <?php foreach ($materiList as $materi): ?>
              <li class="sidebar-link mb-2"><?= htmlspecialchars($materi['judul']) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <!-- Content -->
      <div class="col-md-9 p-4">
        <h1 class="zonafikr-title mb-4">Daftar Materi</h1>
        <div class="row row-cols-1 row-cols-md-2 g-4">
          <?php foreach ($materiList as $materi): ?>
            <div class="col">
              <div class="card h-100 shadow-sm">
                <div class="card-body">
                  <h5 class="card-title text-primary"><?= htmlspecialchars($materi['judul']) ?></h5>
                  <p class="card-text">Materi ini membahas tentang <strong><?= htmlspecialchars($materi['judul']) ?></strong> secara mendalam.</p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
