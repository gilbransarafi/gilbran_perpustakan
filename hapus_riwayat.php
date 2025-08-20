<?php
session_start();
include "koneksi.php";

// Hanya admin yang bisa menghapus
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>
            alert('Akses ditolak! Hanya admin yang bisa menghapus.');
            window.location='login.php';
          </script>";
    exit;
}

// Cek apakah ada parameter id
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $hapus = mysqli_query($koneksi, "DELETE FROM riwayat_pemesanan WHERE id = $id");
    
    if ($hapus) {
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location='riwayat_pemesanan.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data!');
                window.location='riwayat_pemesanan.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location='riwayat_pemesanan.php';
          </script>";
}
?>
