<?php

$koneksi = new mysqli("localhost","uphgmimc_admin","PGpzWiX{N&j,","uphgmimc_lioraedu");

// Check connection
if ($koneksi -> connect_errno) {
  echo "Failed to connect to MySQL: " . $koneksi -> connect_error;
  exit();
}