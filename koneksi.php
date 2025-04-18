<?php

$koneksi = new mysqli("localhost","root","","quiz_db");

// Check connection
if ($koneksi -> connect_errno) {
  echo "Failed to connect to MySQL: " . $koneksi -> connect_error;
  exit();
}