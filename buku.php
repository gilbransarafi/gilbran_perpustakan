<?php
include 'koneksi.php'; // koneksi ke database

$query = "
SELECT buku.id_buku, buku.judul, buku.pengarang, buku.tahun_terbit, buku.jumlah,
       kategori.nama_kategori,
       penerbit.nama_penerbit
FROM buku
JOIN kategori ON buku.id_kategori = kategori.id_kategori
JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f8f9fa;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #e74c3c;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .back {
            margin-top: 20px;
            text-align: center;
        }

        .back a {
            background-color: #c0392b;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
        }

        .back a:hover {
            background-color: #a93226;
        }
    </style>
</head>
<body>

<h2>Daftar Buku di Perpustakaan</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Pengarang</th>
            <th>Tahun Terbit</th>
            <th>Kategori</th>
            <th>Penerbit</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; while($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['pengarang'] ?></td>
            <td><?= $row['tahun_terbit'] ?></td>
            <td><?= $row['nama_kategori'] ?></td>
            <td><?= $row['nama_penerbit'] ?></td>
            <td><?= $row['jumlah'] ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<div class="back">
    <a href="index.php">Kembali ke Menu</a>
</div>

</body>
</html>
