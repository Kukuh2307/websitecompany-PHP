<link rel="stylesheet" href="/css/style.css">
<?php require 'header.php' ?>

<?php
// digunakan untuk mengganti nama dan password user
// ketika user belum login maka akan di arahkan ke bagian halaman login
if (isset($_SESSION['members_email']) == '') {
  header("location:login.php");
  exit();
}

?>
<h3>Ganti Profile Acount</h3>
<?php
$nama = "";
$pswd = "";
$sukses = "";
$gagal = "";

if ($_SESSION['members_email'] != '') {
  // apabila members sudah login

  // ketika members mengeklik tombol simpan maka
  if (isset($_POST['simpan'])) {
    $nama = $_POST['username'];
    $password_lama = $_POST['pswdLama'];
    $pswd = $_POST['pswd'];
    $konfirmasipass = $_POST['konfirmasi_password'];

    // cek data
    if ($nama == '') {
      $gagal .= "<li>Silahkan memasukkan nama lengkap</li>";
    }

    // jika akan melakukan ganti password 
    if ($paswd != '') {
      $queryselect =
        "SELECT * FROM members WHERE email = '" . $_SESSION['members_email'] . "'";
      $kirimselect = mysqli_query($koneksi, $queryselect);
      $cekpassword = mysqli_fetch_assoc($kirimselect);

      // apabila password yang ada di database tidak sama dengan password lama yang di masukkan oleh user
      if (md5($password_lama) != $cekpassword['password']) {
        $gagal .= "<li>Password tidak cocok dengan password yang di database</li>";
      }

      // apabila user tidak memasukkan password lama,password baru dan konfirmasi password maka
      if ($password_lama == '' or $paswd == '' or $konfirmasipass == '') {
        $gagal .= "<li>Silahkan memasukkan password lama,password baru dan konfirmasi password baru anda</li>";
      }

      // apabila password baru tidak sama dengan konfirmasi password maka
      if ($paswd != $konfirmasipass) {
        $gagal .= "<li>Password baru dan konfirmasi password tidak sama</li>";
      }

      // apabila password baru panjangnya kurang dari 8 karakter maka
      if (strlen($pswd) < 8) {
        $gagal .= "<li>Panjang password baru minimal 8 karakter</li>";
      }
    }
    // apabila tidak ada kesalahan input maka
    if (empty($gagal)) {
      $queryupdate =
        "UPDATE members SET nama_lengkap = '" . $nama . "' WHERE email = '" . $_SESSION['members_email'] . "'";
      $kirimupdate = mysqli_query($koneksi, $queryupdate);
      $_SESSION['members_nama_lengkap'] = $nama;

      // update password di database
      if ($pswd) {
        $queryupdate =
          "UPDATE members SET password = md5($pswd) where email = '" . $_SESSION['members_email'] . "'";
        $kirimupdate = mysqli_query($koneksi, $queryupdate);
      }
      $sukses = "Data berhasil di ubah";
    }
  }
}
?>

<?php
if ($gagal) {
?>
<div class="gagal"><?php echo $gagal ?></div>
<?php
}

if ($sukses) {
?>
<div class="sukses"><?php echo $sukses ?></div>
<div class="sukses"><a href="<?php echo $isi_email ?>"> >> Klik di sini << </a>
</div>
<?php
}
?>
<form action="" method="POST">
  <table>
    <tr>
      <td class="label">Email</td>
      <td>
        <?php echo $_SESSION['members_email'] ?>
      </td>
    </tr>

    <tr>
      <td class="label">Nama Lengkap</td>
      <td>
        <input type="text" name="username" class="input" value="<?php echo $_SESSION['nama_lengkap'] ?>">
      </td>
    </tr>
    <tr>
      <td class="label">Password lama</td>
      <td>
        <input type="password" name="pswdLama" class="input">
      </td>
    </tr>
    <tr>
      <td class="label">Password baru</td>
      <td>
        <input type="password" name="pswd" class="input">
      </td>
    </tr>

    <tr>
      <td class="label">Konfirmasi Password</td>
      <td>
        <input type="password" name="konfirmasi_password" class="input">
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <input type="submit" name="simpan" value="simpan" class="tombol">
      </td>
    </tr>
  </table>

</form>

<?php require 'footer.php' ?>