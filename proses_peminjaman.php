<?php
include 'koneksi.php';
require 'vendor/autoload.php'; // autoload dari composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$nama = $_POST['nama_peminjam'];
$email = $_POST['email_peminjam'];
$id_buku = $_POST['id_buku'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$tanggal_kembali = $_POST['tanggal_kembali'];

// Simpan ke database peminjaman
$query = "INSERT INTO peminjaman (id_buku, nama_peminjam, tanggal_pinjam, tanggal_kembali)
          VALUES ('$id_buku', '$nama', '$tanggal_pinjam', '$tanggal_kembali')";

if (mysqli_query($koneksi, $query)) {

    // ✅ ambil judul buku berdasarkan id_buku
    $result_buku = mysqli_query($koneksi, "SELECT judul FROM buku WHERE id_buku = '$id_buku'");
    $buku = mysqli_fetch_assoc($result_buku);
    $judul_buku = $buku['judul'];

    // ✅ simpan juga ke tabel riwayat_pemesanan
    mysqli_query($koneksi, "INSERT INTO riwayat_pemesanan (nama_user, id_buku, judul_buku, tanggal_pinjam, tanggal_kembali, status) 
                            VALUES ('$nama', '$id_buku', '$judul_buku', '$tanggal_pinjam', '$tanggal_kembali', 'Dipinjam')");

    // === Kalau masih mau pakai email (bisa dihapus kalau tidak perlu) ===
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'merdekaperpustakaan3@gmail.com';
        $mail->Password = 'ribslvdotvenptun';   // app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('merdekaperpustakaan3@gmail.com', 'Perpustakaan');
        $mail->addAddress($email, $nama);
        $mail->Subject = 'Peminjaman Buku Berhasil';
        $mail->Body    = "Halo $nama,\n\nBuku berhasil dipinjam dari perpustakaan.\n\nTanggal Pinjam: $tanggal_pinjam\nTanggal Kembali: $tanggal_kembali\n\nTerima kasih.";

        $mail->send();

        echo "<script>
            alert('Peminjaman berhasil disimpan, tercatat di riwayat, dan email dikirim!');
            window.location.href = 'index.php';
        </script>";
    } catch (Exception $e) {
        echo "Gagal mengirim email. Error: {$mail->ErrorInfo}";
    }

} else {
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);
}
?>
