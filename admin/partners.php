<?php include_once("inc_header.php") ?>
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
      // membuat query delete foto
      $querydelete = "SELECT foto FROM partners WHERE id='$id'";
      $kirimdelete = mysqli_query($koneksi,$querydelete);
      $gambar = mysqli_fetch_assoc($kirimdelete);
      @unlink("../gambar".$gambar['foto']);
      
      $querydelete = "DELETE FROM partners WHERE id ='$id'";
      $kirimdelete = mysqli_query($koneksi,$querydelete);
      // apabila data berhasil di hapus maka tampilkan pesan
      if($kirimdelete){
        $sukses = "data berhasil di hapus";
      } else {
        $gagal = "data gagal di hapus";
      }
    }
    ?>
<h1>Halaman Admin Partners</h1>
<p>
  <a href="partners_input.php">
    <input type="button" class="btn btn-primary" value="Buat partners baru">
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
      <th class="col-2">foto</th>
      <th>nama</th>
      <th class="col-2">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sqltambahan = "";
    $batashalaman = 3;
    if($katakunci != ""){
      $array_katakunci = explode(" ",$katakunci);
      for($x=0;$x < count($array_katakunci);$x++) {
        $sqlcari[] = "(nama like '%" . $array_katakunci[$x] . "%' or isi like '%" . $array_katakunci[$x] . "%')";
      }
      $sqltambahan = "WHERE".implode(" or ",$sqlcari);
    }  
    $queryread = "SELECT * FROM partners $sqltambahan";

    // membuat pagination
    $page = isset($_GET["page"])?(int)$_GET["page"]:1;
    $start = ($page > 1) ? ($page * $batashalaman) - $batashalaman:0;
    $kirimread = mysqli_query($koneksi,$queryread);
    $total = mysqli_num_rows($kirimread);
    $pages = ceil($total/$batashalaman);
    $nomor = $start + 1;
    $queryread = $queryread."order by id asc limit $start,$batashalaman";
    $kirimread = mysqli_query($koneksi,$queryread);

    // looping
    while($looping = mysqli_fetch_assoc($kirimread)) {
    ?>
    <tr>
      <td><?php echo $nomor++ ?></td>
      <td><img src="../gambar/<?php echo foto_partners($looping['id']) ?>" style="max-height: 100px;max-width: 100px;"
          alt=""></td>
      <td><?php echo $looping['nama'] ?></td>
      <td>
        <a href="partners_input.php?id=<?php echo $looping["id"]?>">
          <span class="badge bg-warning text-dark">edit</span>
        </a>

        <a href="partners.php?op=delete&id=<?php echo $looping['id'] ?>"
          onclick="return confirm('Yakin ingin menhapus data??')">
          <span class="badge bg-danger">hapus</span>
        </a>

      </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php 
        $cari = isset($_GET['cari'])? $_GET['cari'] : "";

        for($i=1; $i <= $pages; $i++){
            ?>
    <li class="page-item">
      <a class="page-link"
        href="partners.php?katakunci=<?php echo $katakunci?>&cari=<?php echo $cari?>&page=<?php echo $i ?>"><?php echo $i ?></a>
    </li>
    <?php
        }
        ?>
  </ul>
</nav>
<?php require 'inc_footer.php' ?>