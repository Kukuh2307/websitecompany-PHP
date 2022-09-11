<link rel="stylesheet" href="./css/style.css">
<?php 
include_once("koneksi/connectdatabase.php");
include_once("koneksi/function.php");


$id = getid();
$queryselect = "SELECT * FROM tutors WHERE id='$id'";
$kirimselect = mysqli_query($koneksi,$queryselect);
// cek data apakah ada
$cekdata = mysqli_num_rows($kirimselect);
$tampildata = mysqli_fetch_assoc($kirimselect);

$nama = $tampildata['nama'];
?>
<?php include_once("header.php") ?>

<?php 
if($nama == '') {
  echo "<div><p>Maaf data yang kamu maksud tidak ditemukan :(</p></div>";
} else {
  ?>
<div class="container">
  <div class="foto">
    <img src="<?php echo url_dasar()."/gambar/". foto_tutors($tampildata['id']) ?>" />
  </div>
  <div class="deskripsi-tutors">
    <h1><?php echo $tampildata['nama'] ?></h1>
    <?php echo set_isi($tampildata['isi']) ?>
  </div>
</div>
<?php 
}
?>




<?php include_once("footer.php") ?>