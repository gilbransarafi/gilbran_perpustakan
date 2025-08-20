<?php 
include 'koneksi.php';

// Ambil data buku
$buku = mysqli_query($koneksi, "SELECT * FROM buku");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Peminjaman Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>📚 Form Peminjaman Buku</h2>
    <form method="POST" action="proses_peminjaman.php" class="form-box">
        
        <label>Nama Peminjam:</label>
        <input type="text" name="nama_peminjam" required>

        <label>Email Peminjam:</label>
        <input type="email" name="email_peminjam" required>

        <label>Pilih Buku:</label>
        <select name="id_buku" required>
            <?php while($row = mysqli_fetch_assoc($buku)) { ?>
                <option value="<?= $row['id_buku'] ?>"><?= $row['judul'] ?></option>
            <?php } ?>
        </select>

        <label>Tanggal Pinjam:</label>
        <input type="date" name="tanggal_pinjam" required>

        <label>Tanggal Kembali:</label>
        <input type="date" name="tanggal_kembali" required>

        <div class="btn-group">
            <input type="submit" value="📖 Pinjam Buku" class="btn-submit">
            <a href="index.php" class="btn-exit">🚪 Keluar</a>
        </div>
    </form>
</div>

</body>
</html>
