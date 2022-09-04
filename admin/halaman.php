<?php require 'inc_header.php' ?>
<?php 
    $katakunci = (isset($_POST["katakunci"]))?$_POST["katakunci"]:"";
    ?>
<h1>Halaman Admin</h1>
<p>
  <a href="halaman_input.php">
    <input type="button" class="btn btn-primary" value="Buat halaman baru">
  </a>
</p>

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
    $queryread = "SELECT * FROM halaman ORDER BY id ASC";
    $kirimread = mysqli_query($koneksi,$queryread);
    $nomor = "";

    // looping
    while($looping = mysqli_fetch_assoc($kirimread)) {
    ?>
    <tr>
      <td><?php echo $nomor++ ?></td>
      <td><?php echo $looping['judul'] ?></td>
      <td><?php echo $looping['kutipan'] ?></td>
      <td>
        <span class="badge bg-danger">hapus</span>
        <span class="badge bg-warning text-dark">edit</span>
      </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<?php require 'inc_footer.php' ?>