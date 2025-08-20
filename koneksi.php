<?php
// Konfigurasi koneksi database
$host = "localhost";     // Host server
$user = "root";          // Username MySQL default Laragon
$pass = "";              // Password MySQL default Laragon biasanya kosong
$db   = "perpustakaan";  // Nama database kamu

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
} else {
    // echo "Koneksi database berhasil"; // Bisa diaktifkan untuk tes
}
?>
