<link rel="stylesheet" href="/css/style.css">
<?php require 'header.php' ?>

<?php 
$gagal = "";
$sukses = "";
// apabila di dalam url email dan kode tidak ada maka
if(!isset($_GET['email']) or !isset($_GET['kode'])) {
  $gagal = "Data yang diperlukan untuk verifikasi tidak tersedia";
} else {
  // ambil element url email dan kode
  $email = $_GET['email'];
  $kode = $_GET['kode'];
  // kirim ke database
  $queryselect = "SELECT * FROM members WHERE email='$email'";
  $kirimselect = mysqli_query($koneksi,$queryselect);
  $tampildata = mysqli_fetch_assoc($kirimselect);

  // apabila status di database sama dengan kode yang di dapat dari url
  if($tampildata['status'] == $kode) {
    // maka lakukan update data
    $queryupdate = "UPDATE members set status='1' where email='$email'";
    $kirimselect;
    $sukses = "Akun anda telah berhasil di buat,silahkan login untuk masuk";
  } else {
    $gagal = "kode tidak terverifikasi,akun gagal untuk di buat";
  }
}

?>

<h3>Halaman verifikasi Akun</h3>
<?php 
if($gagal){
  ?>
<div class="gagal"><?php echo $gagal ?></div>
<?php
} 
if($sukses){
  ?>
<div class="sukses"><?php echo $sukses ?></div>
<?php
} 
?>

<?php require 'footer.php' ?>