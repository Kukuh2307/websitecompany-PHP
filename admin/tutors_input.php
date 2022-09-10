<?php require 'inc_header.php' ?>
<?php 
$nama = "";
$foto = "";
$foto_name = "";
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
  $foto = $tampil['foto'];
  $isi = $tampil["isi"];
  if($isi =="") {
    $gagal = "silahkan memasukkan isi";
  }
}

// mengecek tombol simpan
// menangkap isi nilai yang ada di form dan di sempan ke dalam variable
if(isset($_POST['simpan'])){

  // mengecek foto dan format foto
  if($_FILES['foto']['name']) {
    $foto_name = $_FILES['foto']['name'];
    $foto_file = $_FILES['foto']['tmp_name'];
    $ekstensifile = array("jpg","jpeg","png");

     // memastikan format foto
    $detail_file = pathinfo($foto_name);
    $getekstension = $detail_file['extension'];

    // error
    // Array ( [dirname] => . [basename] => tutors.jpg [extension] => jpg [filename] => tutors )
    // print_r($_FILES);

    if(!in_array($getekstension,$ekstensifile)){
      $gagal = "Ekstensi yang di perbolehkan adalah jpg,jpeg dan png";
    }

    if($foto_name){
      // ambil lokasi file
      $direktori = "../gambar";

      // delete data lama
      @unlink($direktori."/$foto");
      // atur format nama
      $foto_name = "tutors_".time()."_".$foto_name;

      // pindah file
      // format file adalah temporary file,direktori
      move_uploaded_file($foto_file,$direktori."/".$foto_name);
      $foto = $foto_name;
    } else {
      $foto_name = $foto;
    }
  }
  

  // update data
  if($id != ""){
    $nama = $_POST['nama'];
    $isi = $_POST['isi'];
    $foto_name = $foto;
      // updatedata
      $queryupdate = "UPDATE tutors SET nama = '$nama', foto = '$foto_name', isi='$isi',tgl_isi=now() WHERE id = '$id'";
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
      $queryinsert = "INSERT INTO tutors(nama,foto,isi) VALUES ('$nama','$foto_name','$isi')";
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
      <?php 
      if($foto){
        echo "<img src='../gambar/$foto' style='max-height:100px;max-width:100px'/>";
      }
      ?>
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