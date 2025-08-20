<?php
session_start();
include "koneksi.php";

// Cek hanya admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='login.php';</script>";
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM riwayat_pemesanan WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $status = $_POST['status'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    mysqli_query($koneksi, "UPDATE riwayat_pemesanan SET status='$status', tanggal_kembali='$tanggal_kembali' WHERE id=$id");

    echo "<script>alert('Data berhasil diperbarui!'); window.location='riwayat_pemesanan.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Riwayat</title>
    <style>
        body {font-family: Arial, sans-serif; background: #f5f5f5;}
        .container {max-width: 600px; margin: 50px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
        h2 {text-align: center;}
        form {display: flex; flex-direction: column;}
        label {margin: 10px 0 5px;}
        input, select, button {padding: 10px; border: 1px solid #ccc; border-radius: 4px;}
        button {margin-top: 15px; background: #007bff; color: white; cursor: pointer;}
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Riwayat Pemesanan</h2>
        <form method="POST">
            <label>Status:</label>
            <select name="status">
                <option value="Dipinjam" <?= $data['status'] == 'Dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
                <option value="Dikembalikan" <?= $data['status'] == 'Dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
            </select>

            <label>Tanggal Kembali:</label>
            <input type="date" name="tanggal_kembali" value="<?= $data['tanggal_kembali'] ?>">

            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>
