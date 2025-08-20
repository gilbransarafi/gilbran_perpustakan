<?php
session_start();

// Cek apakah user sudah login
if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Jika sudah login, kembali ke halaman utama
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login | Perpus</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 0;}
        .container {max-width: 400px; margin: 60px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
        h2 {text-align: center; margin-bottom: 20px;}
        label {display: block; margin-top: 10px; font-weight: bold;}
        input {width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;}
        button {width: 100%; padding: 10px; margin-top: 15px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;}
        button:hover {background: #0056b3;}
        .tab {display: flex; border-bottom: 1px solid #ddd; margin-bottom: 15px;}
        .tab button {flex: 1; background: none; border: none; padding: 10px; cursor: pointer; font-size: 16px;}
        .tab button.active {border-bottom: 3px solid #007bff; font-weight: bold;}
        .tabcontent {display: none;}
        .social-login {margin-top: 15px; text-align: center;}
        .social-login button {width: auto; margin: 5px; padding: 8px 15px; border-radius: 5px; border: none; cursor: pointer;}
        .google {background: #db4437; color: white;}
        .whatsapp {background: #25d366; color: white;}
    </style>
</head>
<body>

<div class="container">
    <h2>Selamat Datang</h2>

    <!-- Tab Menu -->
    <div class="tab">
        <button class="tablinks active" onclick="openTab(event, 'Login')">Login</button>
        <button class="tablinks" onclick="openTab(event, 'Daftar')">Daftar</button>
    </div>

    <!-- Form Login -->
    <div id="Login" class="tabcontent" style="display:block;">
        <form method="POST" action="proses_login.php">
            <label>Email</label>
            <input type="email" name="email" required>
            
            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit" name="login">LOGIN SEKARANG</button>
        </form>
        <div class="social-login">
            <button class="google">Login via Google</button>
            <button class="whatsapp">Login via WhatsApp</button>
        </div>
    </div>

    <!-- Tombol Keluar -->
<div style="text-align:center; margin-top:10px;">
    <a href="index.php">
        <button type="button" class="btn btn-danger">KELUAR</button>
    </a>
</div>

    <!-- Form Daftar -->
    <div id="Daftar" class="tabcontent">
        <form method="POST" action="proses_daftar.php">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" required>

            <label>Nomor HP</label>
            <input type="text" name="nohp" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit" name="daftar">DAFTAR SEKARANG</button>
        </form>
        <div class="social-login">
            <button class="whatsapp">Login via WhatsApp</button>
        </div>
    </div>
</div>

<script>
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>

</body>
</html>
