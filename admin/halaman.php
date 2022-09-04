<?php require 'inc_header.php' ?>
<?php 
    $katakunci = (isset($_POST["katakunci"]))?$_POST["katakunci"]:"";
    // untuk menhapus data
    // apabila op ada nilainya berupa id maka ambil dan jadikan sebagai variable dengan nama op
    if(isset($_GET["op"])){
      $op = $_GET["op"];
    } else {
      $op = "";
    }
    $sukses = "";
    $gagal = "";
    if($op == "delete") {
      // menangkap id dari op dan di kirimkan ke database
      $id = $_GET["id"];
      $querydelete = "DELETE FROM halaman WHERE id ='$id'";
      $kirimdelete = mysqli_query($koneksi,$querydelete);
      // apabila data berhasil di hapus maka tampilkan pesan
      if($kirimdelete){
        $sukses = "data berhasil di hapus";
      } else {
        $gagal = "data gagal di hapus";
      }
    }
    ?>
<h1>Halaman Admin</h1>
<p>
  <a href="halaman_input.php">
    <input type="button" class="btn btn-primary" value="Buat halaman baru">
  </a>
</p>
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

<form action="" method="POST" class="row g-3">
  <div class="col-auto">
    <input type="text" class="form-control" placeholder="Masukkan kata kunci" name="katakunci"
      value="<?php echo $katakunci; ?>" />
  </div>
  <div class="col-auto">
    <input type="submit" value="Cari Tulisan" name="cari" class="btn btn-secondary">
  </div>
</form>

<table class="table table-striped">
  <thead>
    <tr>
      <th class="col-1">#</th>
      <th>Judul</th>
      <th>Kutipan</th>
      <th class="col-2">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sqltambahan = "";
    if($katakunci != ""){
      $array_katakunci = explode(" ",$katakunci);
      for($x=0;$x < count($array_katakunci);$x++) {
        $sqlcari[] = "(judul like '%" . $array_katakunci[$x] . "%' or kutipan like '%" . $array_katakunci[$x] . "%' or isi like '%" . $array_katakunci[$x] . "%')";
      }
      $sqltambahan = "WHERE".implode(" or ",$sqlcari);
    }  
    $queryread = "SELECT * FROM halaman $sqltambahan ORDER BY id ASC";
    $kirimread = mysqli_query($koneksi,$queryread);
    $nomor = "1";

    // looping
    while($looping = mysqli_fetch_assoc($kirimread)) {
    ?>
    <tr>
      <td><?php echo $nomor++ ?></td>
      <td><?php echo $looping['judul'] ?></td>
      <td><?php echo $looping['kutipan'] ?></td>
      <td>
        <a href="halaman.php?op=delete&id=<?php echo $looping['id'] ?>"
          onclick="return confirm('Yakin ingin menhapus data??')"><span class="badge bg-danger">hapus</span></a>

        <span class="badge bg-warning text-dark">edit</span>
      </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<?php require 'inc_footer.php' ?>