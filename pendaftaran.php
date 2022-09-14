<link rel="stylesheet" href="/css/style.css">
<?php require 'header.php'?>
<h3>Pendaftaran</h3>
<?php 
$email ="";
$nama_lengkap = "";
$sukses = "";
$gagal = "";

if(isset($_POST['simpan'])){
  $email = $_POST['email'];
  $nama_lengkap = $_POST['nama_lengkap'];
  $password = $_POST['password'];
  $konfirmasipass = $_POST['konfirmasi_password'];
  // cek data
  if($email =="" or $nama_lengkap = "" or $password =="" or $konfirmasipass == "") {
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

  // cek password dengan konfirmasi password
  if($password != $konfirmasipass){
    $gagal .= "<li>password tidak sesuai</li>";
  }
  // syarat minimal huruf dalam password
  if(strlen($password) < 8) {
    $gagal .= "<li>panjang karakter minimal 8 huruf</li>";
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
    $queryinsert = "INSERT INTO members(email,nama_lengkap,password,status) values('$email','$nama_lengkap',md5('$password'),'$status')";
    $kiriminsert = mysqli_query($koneksi,$queryinsert);
    if($kiriminsert){
      $sukses = "Proses berhasil,silahkan melakukan verifikasi pada link di bawah ini";
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
      <td class="label">nama Lengkap</td>
      <td>
        <input type="text" name="nama_lengkap" class="input" value="<?php echo $nama_lengkap ?>">
      </td>
    </tr>

    <tr>
      <td class="label">Password</td>
      <td>
        <input type="password" name="password" class="input">
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