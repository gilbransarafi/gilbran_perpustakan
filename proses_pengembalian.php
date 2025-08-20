<?php
include 'koneksi.php';

// Pastikan hanya menerima POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>alert('Akses tidak valid.'); window.location.href='pengembalian.php';</script>";
    exit;
}

// Ambil & validasi input
$id_peminjaman         = isset($_POST['id_peminjaman']) ? (int)$_POST['id_peminjaman'] : 0;
$nama_pengembalian     = $_POST['nama_pengembalian']     ?? '';
$email_pengembalian    = $_POST['email_pengembalian']    ?? '';
$tanggal_pengembalian  = $_POST['tanggal_pengembalian']  ?? '';
$tanggal_kembali_input = $_POST['tanggal_kembali']       ?? '';

if (!$id_peminjaman || $nama_pengembalian === '' || $email_pengembalian === '' || 
    $tanggal_pengembalian === '' || $tanggal_kembali_input === '') {
    echo "<script>alert('Semua field harus diisi.'); window.history.back();</script>";
    exit;
}

// Ambil detail peminjaman berdasarkan ID (pakai prepared statement)
$sql = "SELECT p.*, b.judul 
        FROM peminjaman p 
        JOIN buku b ON p.id_buku = b.id_buku 
        WHERE p.id_peminjaman = ?";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_peminjaman);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('Data peminjaman tidak ditemukan!'); window.history.back();</script>";
    exit;
}

$judul_buku      = $data['judul'];
$nama_peminjam   = $data['nama_peminjam'];
$email_peminjam  = $data['email'];
$tanggal_pinjam  = $data['tanggal_pinjam'];
$id_buku         = (int)$data['id_buku'];

// Update status di tabel riwayat_pemesanan (ubah jadi Dikembalikan)
$update = "UPDATE riwayat_pemesanan
           SET tanggal_kembali = ?, status = 'Dikembalikan'
           WHERE nama_user = ? AND id_buku = ? AND status = 'Dipinjam'
           LIMIT 1";
$u = mysqli_prepare($koneksi, $update);
mysqli_stmt_bind_param($u, "ssi", $tanggal_pengembalian, $nama_peminjam, $id_buku);
mysqli_stmt_execute($u);

// (Opsional) Jika tidak ada baris yang ter-update, bisa insert baru sebagai fallback
/*
if (mysqli_stmt_affected_rows($u) === 0) {
    $ins = "INSERT INTO riwayat_pemesanan (id_user, nama_user, id_buku, judul_buku, tanggal_pinjam, tanggal_kembali, status)
            VALUES (NULL, ?, ?, ?, ?, ?, 'Dikembalikan')";
    $i = mysqli_prepare($koneksi, $ins);
    mysqli_stmt_bind_param($i, "sisss", $nama_peminjam, $id_buku, $judul_buku, $tanggal_pinjam, $tanggal_pengembalian);
    mysqli_stmt_execute($i);
}
*/

// === Kirim Email Notifikasi Pengembalian ===
require 'vendor/autoload.php';
$mail = new PHPMailer\PHPMailer\PHPMailer();

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'merdekaperpustakaan3@gmail.com';
    $mail->Password   = 'ribslvdotvenptun'; // App Password Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('merdekaperpustakaan3@gmail.com', 'Perpustakaan');
    $mail->addReplyTo('merdekaperpustakaan3@gmail.com', 'Perpustakaan');
    $mail->addAddress($email_pengembalian, $nama_pengembalian);

    $mail->isHTML(true);
    $mail->Subject = 'Konfirmasi Pengembalian Buku';
    $mail->Body    = "Halo $nama_pengembalian,<br><br>
        Terima kasih telah mengembalikan buku <b>$judul_buku</b>.<br>
        Berikut detail peminjaman Anda:<br><br>
        - Nama Peminjam: $nama_peminjam<br>
        - Judul Buku: $judul_buku<br>
        - Tanggal Pinjam: $tanggal_pinjam<br>
        - Tanggal Kembali (seharusnya): $tanggal_kembali_input<br>
        - Tanggal Pengembalian: $tanggal_pengembalian<br><br>
        Jika ada keterlambatan, mohon hubungi pustakawan.<br><br>
        Salam,<br>Admin Perpustakaan";

    $mail->send();

    // Sukses → kembali ke halaman riwayat pengembalian (atau yang kamu mau)
    echo "<script>
            alert('Pengembalian berhasil. Status diupdate dan email terkirim.');
            window.location.href='riwayat_pengembalian.php';
          </script>";
} catch (Exception $e) {
    echo "<script>alert('Email gagal dikirim: ".htmlspecialchars($mail->ErrorInfo, ENT_QUOTES)."'); window.history.back();</script>";
}
