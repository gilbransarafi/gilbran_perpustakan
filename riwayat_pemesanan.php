<?php
session_start();
include "koneksi.php";

// Hanya admin yang bisa masuk
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>
            alert('Akses ditolak! Hanya admin yang bisa masuk.');
            window.location='login.php';
          </script>";
    exit;
}

// Ambil data riwayat pemesanan
$query = mysqli_query($koneksi, "SELECT * FROM riwayat_pemesanan ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pemesanan | Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .top-bar {
            text-align: right;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-success { background: #28a745; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        .btn-edit { background: #17a2b8; color: white; }
        .btn-logout { background: #dc3545; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h2>📚 Riwayat Pemesanan</h2>
        
        <!-- Tombol Logout -->
        <div class="top-bar">
            <a href="logout.php" class="btn btn-logout">Keluar</a>
        </div>

        <!-- Tabel Riwayat -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama User</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['nama_user'] ?></td>
                        <td><?= $row['judul_buku'] ?></td>
                        <td><?= $row['tanggal_pinjam'] ?></td>
                        <td><?= $row['tanggal_kembali'] ?></td>
                        <td>
                            <?php if ($row['status'] == 'Dipinjam') { ?>
                                <span class="btn btn-warning">Dipinjam</span>
                            <?php } else { ?>
                                <span class="btn btn-success">Dikembalikan</span>
                            <?php } ?>
                        </td>
                        <td><?= $row['created_at'] ?></td>
                        <td>
    <a href="edit_riwayat.php?id=<?= $row['id'] ?>" class="btn btn-edit">Edit</a>
   <a href="hapus_riwayat.php?id=<?= $row['id'] ?>" class="btn btn-logout" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
</td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
