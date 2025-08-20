<?php 
include 'koneksi.php';

// Ambil data buku
$buku = mysqli_query($koneksi, "SELECT * FROM buku");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pengembalian Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>📖 Form Pengembalian Buku</h2>
    <form method="POST" action="proses_pengembalian.php" class="form-box">
        
        <!-- Hidden ID Peminjaman (bisa diisi via query string atau JavaScript) -->
        <input type="hidden" name="id_peminjaman" value="<?= $_GET['id_peminjaman'] ?? '0' ?>">

        <label>Nama Peminjam:</label>
        <input type="text" name="nama_pengembalian" required>

        <label>Email Peminjam:</label>
        <input type="email" name="email_pengembalian" required>

        <label>Pilih Buku:</label>
        <select name="id_buku" required>
            <?php while($row = mysqli_fetch_assoc($buku)) { ?>
                <option value="<?= $row['id_buku'] ?>"><?= $row['judul'] ?></option>
            <?php } ?>
        </select>

        <label>Tanggal Pinjam:</label>
        <input type="date" name="tanggal_pinjam" required>

        <label>Tanggal Kembali (seharusnya):</label>
        <input type="date" name="tanggal_kembali" required>

        <label>Tanggal Pengembalian (hari ini):</label>
        <input type="date" name="tanggal_pengembalian" value="<?= date('Y-m-d') ?>" required>

        <div class="btn-group">
            <input type="submit" value="✅ Kembalikan Buku" class="btn-submit">
            <a href="index.php" class="btn-exit">🚪 Keluar</a>
        </div>
    </form>
</div>

</body>
</html>
