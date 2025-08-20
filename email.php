<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

function kirimEmail($emailTujuan, $nama, $judulBuku) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'merdekaperpustakaan3@gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'merdekaperpustakaan3@gmail.com';       // GANTI
        $mail->Password = 'wcka wqvz prlw apua';   // GANTI
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('merdekaperpustakaan3@gmail.com', 'Perpustakaan Digital'); // GANTI
        $mail->addAddress($emailTujuan, $nama);

        $mail->isHTML(true);
        $mail->Subject = 'Konfirmasi Peminjaman Buku';
        $mail->Body = "Halo <b>$nama</b>,<br><br>
                       Anda telah meminjam buku: <b>$judulBuku</b>.<br>
                       Tanggal Pinjam: <b>" . date('Y-m-d') . "</b><br>
                       Tanggal Kembali: <b>" . date('Y-m-d', strtotime('+7 days')) . "</b><br><br>
                       Terima kasih sudah menggunakan layanan perpustakaan kami.";

        $mail->send();
    } catch (Exception $e) {
        echo "Email gagal dikirim. Error: {$mail->ErrorInfo}";
    }
}
?>

