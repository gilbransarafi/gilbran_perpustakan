<?php
session_start();
session_unset(); // hapus semua session
session_destroy(); // destroy session

header("Location: login.php");
exit();
?>
