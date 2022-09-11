<?php 
// detail halaman home ketika di klik
include_once("koneksi/connectdatabase.php");
include_once("koneksi/function.php");


$queryselect = "SELECT * FROM halaman WHERE id='$id'";
$kirimselect = mysqli_query($koneksi,$queryselect);
// cek data apakah ada
$cekdata = mysqli_num_rows($kirimselect);
$tampildata = mysqli_fetch_assoc($kirimselect);

$judul = $tampildata['judul'];
?>
<?php include_once("header.php") ?>

<?php 
if($judul == '') {
  echo "<div><p>Maaf data yang kamu maksud tidak ditemukan :(</p></div>";
} else {
  ?>
<p class="deskripsi"><?php echo $tampildata['kutipan'] ?></p>
<h1><?php echo $tampildata['judul'] ?></h1>
<?php echo set_isi($tampildata['isi']) ?>
<?php 
}
?>




<?php include_once("footer.php") ?>