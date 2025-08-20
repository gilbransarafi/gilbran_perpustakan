<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "perpustakaan");

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil data kategori
$result = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kategori Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Kategori Buku</h1>
    
    <div class="kategori-container">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="kategori-card">
                <h2><?= $row['nama_kategori']; ?></h2>
                <p><?= $row['deskripsi']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>

    <a href="index.php" class="kembali">Kembali ke Menu</a>
</body>
</html>
