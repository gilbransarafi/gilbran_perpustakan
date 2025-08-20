<?php
// koneksi
$conn = mysqli_connect("localhost", "root", "", "perpustakaan");
if (!$conn) { die("Koneksi gagal: " . mysqli_connect_error()); }

$id = $_GET['id'] ?? 0;
$id = intval($id); // amankan

// ambil data penerbit
$result = mysqli_query($conn, "SELECT * FROM penerbit WHERE id_penerbit = $id");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data penerbit tidak ditemukan!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Penerbit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1><?= htmlspecialchars($data['nama_penerbit']); ?></h1>
    <p><strong>Alamat:</strong> <?= htmlspecialchars($data['alamat']); ?></p>
    <p><strong>Telepon:</strong> <?= htmlspecialchars($data['telp']); ?></p>
    <a href="index.php">Kembali ke Beranda</a>
</body>
</html>
