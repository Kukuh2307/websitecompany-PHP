<?php require 'inc_header.php' ?>
<?php 
$judul = "";
$isi = "";
$gagal = "";
$sukses ="";

if(isset($_GET['id'])){
  $id = $_GET['id'];
}else{
  $id = "";
}
if($id != ""){
  $queryedit = "SELECT * FROM footer WHERE id='$id'";
  $kirimedit = mysqli_query($koneksi,$queryedit);
  $tampil = mysqli_fetch_array($kirimedit);
  $judul = $tampil["judul"];
  $isi = $tampil["isi"];
  if($isi =="") {
    $gagal = "silahkan memasukkan isi";
  }
}

// mengecek tombol simpan
// menangkap isi nilai yang ada di form dan di sempan ke dalam variable
if(isset($_POST['simpan'])){
  
  // update data
  if($id != ""){
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
      // updatedata
      $queryupdate = "UPDATE footer SET judul = '$judul', isi='$isi',tgl_isi=now() WHERE id = '$id'";
      $kirimupdate = mysqli_query($koneksi,$queryupdate);
      if(isset($kirimupdate)) {
        $sukses = "data berhasil di update";
      } else {
        $gagal ="data gagal di update";
      }
  } else {
    // insert data
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    // menegecek apakah data terisi semua
      if($judul == "  "  || $isi == "  ") {
        $gagal = "silahkan memasukkan semua data";
      } else {
      $queryinsert = "INSERT INTO footer(judul,isi) VALUES ('$judul','$isi')";
      $kiriminsert = mysqli_query($koneksi,$queryinsert);
      if(isset($kiriminsert)) {
        $sukses = "data berhasil di inputkan";
      } else {
        $gagal = "data gagal di inputkan";
      }
      }
  }
}
?>
<h1>Halaman Admin Input Data Footer</h1>
<div class="mb-3 row">
  <a href="footer.php">
    << Kembali ke Halaman Admin Footer</a>
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
<form action="" method="POST" enctype="multipart/form-data">
  <!-- judul -->
  <div class="mb-3 row">
    <label for="judul" class="col-sm-2 col-form-label">judul</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="judul" value=" <?php echo $judul ?> " name="judul">
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