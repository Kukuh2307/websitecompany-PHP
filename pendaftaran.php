<link rel="stylesheet" href="/css/style.css">
<?php require 'header.php'?>
<h3>Pendaftaran</h3>
<?php 
$email ="";
$nama = "";
$pswd = "";
$sukses = "";
$gagal = "";

if(isset($_POST['simpan'])){
  $email = $_POST['email'];
  $nama = $_POST['username'];
  $pswd = $_POST['pswd'];
  $konfirmasipass = $_POST['konfirmasi_password'];
  // cek data
  if($email =="" or $nama == "" or $pswd =="" or $konfirmasipass == "") {
    $gagal.= "<li>silahkan memasukkan semua data</li>";
  }
  // cek email tidak sama dengan yang ada
  if($email != ''){
    $queryselect = "SELECT email FROM members WHERE email='$email'";
    $kirimselect = mysqli_query($koneksi,$queryselect);
    $cekemail = mysqli_num_rows($kirimselect);
    // menampilkan error
    if($cekemail > 0){
      $gagal .="<li>email sudah terdaftar</li>";
    }
    // vallidasi email apabila tidak valid
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $gagal .= "<li>email yang dimasukkan tidak valid</li>";
    }
  }

  // cek pswd dengan konfirmasi pswd
  if($pswd != $konfirmasipass){
    $gagal .= "<li>password tidak sesuai</li>";
  }
  // syarat minimal huruf dalam pswd
  if(strlen($pswd) < 8) {
    $gagal .= "<li>panjang karakter minimal 8 huruf</li>";
  }
  if($nama == "") {
    $gagal = "Silahkan memasukkan nama lengkap anda";
  }

  // apabila tidak terjadi kesalahan maka akan mengirimkan email untuk aktifasi account
  if(empty($gagal)){
    $status = md5(rand(0,1000));
    $judul_email = "Halaman konfirmasi pendaftaran";
    // $isi_email = "akun anda dengan email <b>$email<b> telah siap untuk di gunakan.<br/>>";
    // $isi_email .="silahkan melakukan aktifasi email pada link di bawah ini<br/>";
    $isi_email = url_dasar()."/verifikasi.php?email=$email&kode=$status";

    // kirim_email($email,$nama_lengkap,$judul_email,$isi_email);
    
    $sukses = "berhasil mendaftarkan account";

    // kirim data ke database
    $queryinsert = "insert into members(email,nama_lengkap,password,status) values ('$email','$nama',md5('$pswd'),'$status')";
    $kiriminsert = mysqli_query($koneksi,$queryinsert);
    if($kiriminsert){
      $sukses = "Proses berhasil,silahkan melakukan verifikasi pada link di bawah ini";
    } else{
      $gagal = "Gagal melakukan pendaftaran account";
    }
  }
}
?>

<?php 
if($gagal){
  ?>
<div class="gagal"><?php echo $gagal ?></div>
<?php
} 

if($sukses) {
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
        <input type="text" name="email" class="input" value="<?php echo $email ?>">
      </td>
    </tr>

    <tr>
      <td class="label">Nama Lengkap</td>
      <td>
        <input type="text" name="username" class="input" value="<?php echo $nama ?>">
      </td>
    </tr>

    <tr>
      <td class="label">Password</td>
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