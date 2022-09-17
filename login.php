<link rel="stylesheet" href="./css/style.css">
<?php require './header.php' ?>
<?php 
$email = "";
$password = "";
$gagal = "";

if(isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST ['password'];
  if($email == '' or $password == ''){
    $gagal = "Gagal login";
  } else {
    $queryselect = "select * from members where email = '$email'";
    $kirimselect = mysqli_query($koneksi,$queryselect);
    $tampildata = mysqli_fetch_array($kirimselect);
    $cekdata = mysqli_num_rows($kirimselect);
    // mengecek apabila status member sudah aktif dan sudah terdaftar atau belum
    if(isset($tampildata['status']) != 1 && $cekdata > 0){
      $gagal .= "<li>Akun anda belum aktif</li>";
    }
    // cek apakah password yang di masukkan sama dengan password yang ada di database
    if(isset($tampildata['password']) != md5($password && $cekdata > 0 && isset($tampildata['status']) == '1')){
      $gagal .= "<li>Password salah</li>";
    }
    // apabila akun tidak di temukan maka akan disuruh registrasi terlebih dahulu
    if($cekdata < 1) {
      $link = url_dasar()."/pendaftaran.php";
      $gagal .= "<li>Akun belum terdaftar</li>";
      $gagal .= "<li>Silahkan melakukan registrasi di link berikut</li>";
    }
    // jika tidak terjadi error
    if(empty($gagal)){
      header("location:rahasia.php");
      exit();
    }
  }
}
?>

<form action="" method="POST">
  <?php 
  if($gagal){
    ?>
  <div class="gagal"><?php echo $gagal ?></div>
  <div class="gagal"><a href="<?php echo $link ?>"> >> Klik disini << </a>
  </div>
  <?php
  } 
  ?>
  <table>
    <h3>Login halaman members</h3>
    <tr>
      <td class="label">Email</td>
      <td><input type="text" name="email" class="input" value="<?php echo $email?>" /></td>
    </tr>

    <tr>
      <td class="label">Password</td>
      <td><input type="password" name="password" class="input" /></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" name="login" value="login" class="tombol"></td>
    </tr>
  </table>
</form>

<?php require './footer.php' ?>