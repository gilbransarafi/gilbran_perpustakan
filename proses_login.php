<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = md5($_POST['password']); // gunakan md5 sesuai dengan database

    // cek user di database
    $query  = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // simpan ke session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama']    = $user['nama'];
        $_SESSION['role']    = $user['role'];

        // jika admin → masuk ke halaman admin
        if ($user['role'] === 'admin') {
            header("Location: riwayat_pemesanan.php");
            exit();
        } else {
            // jika user biasa → masuk ke halaman utama
            header("Location: index.php");
            exit();
        }
    } else {
        echo "<script>alert('Email atau password salah!'); window.location='login.php';</script>";
    }
}
?>