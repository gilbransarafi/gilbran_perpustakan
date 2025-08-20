<?php
session_start();
include "koneksi.php";

// Hanya admin yang bisa mengakses
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>
            alert('Akses ditolak! Hanya admin yang bisa masuk.');
            window.location='login.php';
          </script>";
    exit;
}

// Ambil data pengembalian + judul buku
$query = mysqli_query($koneksi, "
    SELECT p.id_pengembalian, p.nama_pengembalian, 
           b.judul AS judul_buku,
           p.tanggal_pinjam, p.tanggal_kembali, p.tanggal_pengembalian,
           p.status, p.created_at
    FROM pengembalian p
    JOIN buku b ON p.id_buku = b.id_buku
    ORDER BY p.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pengembalian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1100px;
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
        .btn-delete { background: #dc3545; color: white; }
        .btn-logout { background: #dc3545; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h2>📘 Riwayat Pengembalian</h2>
        
        <!-- Tombol Keluar -->
        <div class="top-bar">
            <a href="logout.php" class="btn btn-logout">Keluar</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama User</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Tanggal Dikembalikan</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td><?= $row['id_pengembalian'] ?></td>
                        <td><?= $row['nama_pengembalian'] ?></td>
                        <td><?= $row['judul_buku'] ?></td>
                        <td><?= $row['tanggal_pinjam'] ?></td>
                        <td><?= $row['tanggal_kembali'] ?></td>
                        <td><?= $row['tanggal_pengembalian'] ?></td>
                        <td>
                            <?php if ($row['status'] == 'Dikembalikan') { ?>
                                <span class="btn btn-success">Dikembalikan</span>
                            <?php } else { ?>
                                <span class="btn btn-warning">Terlambat</span>
                            <?php } ?>
                        </td>
                        <td><?= $row['created_at'] ?></td>
                        <td>
                            <a href="edit_pengembalian.php?id=<?= $row['id_pengembalian'] ?>" class="btn btn-edit">Edit</a>
                            <a href="hapus_pengembalian.php?id=<?= $row['id_pengembalian'] ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
