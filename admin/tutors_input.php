<?php require 'inc_header.php' ?>
<?php 
$nama = "";
$foto = "";
$isi = "";
$gagal = "";
$sukses ="";

if(isset($_GET['id'])){
  $id = $_GET['id'];
}else{
  $id = "";
}
if($id != ""){
  $queryedit = "SELECT * FROM tutors WHERE id='$id'";
  $kirimedit = mysqli_query($koneksi,$queryedit);
  $tampil = mysqli_fetch_array($kirimedit);
  $nama = $tampil["nama"];
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
    $nama = $_POST['nama'];
    $isi = $_POST['isi'];
      // updatedata
      $queryupdate = "UPDATE tutors SET nama = '$nama',isi='$isi',tgl_isi=now() WHERE id = '$id'";
      $kirimupdate = mysqli_query($koneksi,$queryupdate);
      if(isset($kirimupdate)) {
        $sukses = "data berhasil di update";
      } else {
        $gagal ="data gagal di update";
      }
  } else {
    // insert data
    $nama = $_POST['nama'];
    $isi = $_POST['isi'];
    // menegecek apakah data terisi semua
      if($nama == "  "  || $isi == "  ") {
        $gagal = "silahkan memasukkan semua data";
      } else {
      $queryinsert = "INSERT INTO tutors(nama,isi) VALUES ('$nama','$isi')";
      $kiriminsert = mysqli_query($koneksi,$queryinsert);
      if(isset($kiriminsert)) {
        $sukses = "data berhasil di inputkan";
      } else {
        $gagal = "data gagal di inputkan";
      }
      }
  }
  // mengecek foto dan format foto
  if($_FILES['foto']['name']) {
    $foto_name = $_FILES['foto']['name'];
    $foto_file = $_FILES['foto']['tmp_name'];

    $detail_file = pathinfo($foto_name);
    print_r($detail_file);
  }
}
?>
<h1>Halaman Admin Input Data Tutors</h1>
<div class="mb-3 row">
  <a href="tutors.php">
    << Kembali ke Halaman Admin Tutors</a>
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
  <!-- nama -->
  <div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">nama</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nama" value=" <?php echo $nama ?> " name="nama">
    </div>
  </div>

  <!-- foto -->
  <div class="mb-3 row">
    <label for="foto" class="col-sm-2 col-form-label">foto</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" id="foto" name="foto">
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