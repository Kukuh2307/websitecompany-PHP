<?php 
// menghapus semua session dan me redirect ke halaman awal
session_start();
unset($_SESSION['members_email']);
unset($_SESSION['nama_lengkap']);
session_destroy();
header("location:index.php"); 
?>