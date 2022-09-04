<?php require 'inc_header.php' ?>
<?php 
$judul = "";
$isi = "";
$kutipan = "";
$gagal = "";
$sukses ="";

if(isset($_GET['id'])){
  $id = $_GET['id'];
}else{
  $id = "";
}

// mengecek tombol simpan
// menangkap isi nilai yang ada di form dan di sempan ke dalam variable
if(isset($_POST['simpan'])){
  $judul = $_POST['judul'];
  $isi = $_POST['isi'];
  $kutipan = $_POST['kutipan'];

// menegecek apakah data terisi semua
  if($judul == "" && $isi =="" && $kutipan == "") {
    $gagal = "silahkan memasukkan semua data";
  } else {
    $sukses = "data berhasil di simpan";
  }

  if(empty($gagal)){
    if($id !="") {
      $queryupdate = "update halaman set judul = '$judul',kutipan='$kutipan',isi='$isi',tgl_isi=now() where id = '$id'";
      $kirimiupdate = mysqli_query($koneksi,$queryupdate);
    } else {
      $queryinsert = "insert into halaman(judul,kutipan,isi) values ('$judul','$kutipan','$isi')";
      $kiriminsert = mysqli_query($koneksi,$queryinsert);
    }
    if($kiriminsert) {
      $sukses = "data berhasil di inputkan";
    } else {
      $gagal = "gagal memasukkan data";
    }
  }
}
?>
<h1>Halaman Admin Input Data</h1>
<div class="mb-3 row">
  <a href="halaman.php">
    << Kembali ke Halaman Admin</a>
</div>
<!-- alert sukses input data -->
<?php 
if($sukses) {
  ?>
<div class="alert alert-primary" role="alert">
  <?php echo $sukses ?>
</div>
<?php
}
?>
<!-- alert gagal input data -->
<?php 
if($gagal) {
  ?>
<div class="alert alert-danger" role="alert">
  <?php echo $gagal ?>
</div>
<?php
}
?>
<form action="" method="POST">
  <!-- judul -->
  <div class="mb-3 row">
    <label for="judul" class="col-sm-2 col-form-label">judul</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="judul" value=" <?php echo $judul ?> " name="judul">
    </div>
  </div>

  <!-- kutipan -->
  <div class="mb-3 row">
    <label for="kutipan" class="col-sm-2 col-form-label">kutipan</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="kutipan" value=" <?php echo $kutipan ?> " name="kutipan">
    </div>
  </div>

  <!-- isi -->
  <div class="mb-3 row">
    <label for="isi" class="col-sm-2 col-form-label">isi</label>
    <div class="col-sm-10">
      <textarea name="isi" class="form-control" id="summernote"> <?php echo $isi ?></textarea>
    </div>
  </div>

  <div class="mb-3 row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
      <input type="submit" name="simpan" id="simpan" value="Simpan Data" class="btn btn-primary">
    </div>
  </div>
</form>
<?php require 'inc_footer.php' ?>