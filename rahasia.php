<link rel="stylesheet" href="/css/style.css">
<?php require './header.php' ?>
<?php 
// apabila user belum login dan mencoba untuk meredirect ke halaman ini maka akan di arahkan ke halaman login
if(isset($_SESSION['members_email'])  == ''){
  header("location:login.php");
} else {
?>
<div class="warning">
  Selamat Datang <?php echo $_SESSION['nama_lengkap']  ?> di webseite kami.
</div>
<?php
} 
?>



<?php require './footer.php' ?>