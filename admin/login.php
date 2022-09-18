<link rel="stylesheet" href="/css/style.css">
<?php
session_start();
include_once("../koneksi/connectdatabase.php");
include_once("../koneksi/function.php");
$username = "";
$password = "";
$gagal = "";

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username == '' or $password == '') {
    $gagal = "Silahkan memasukkan username dan password";
  } else {
    $queryselect = "SELECT * FROM admin Where username='$username'";
    $kirimselect = mysqli_query($koneksi, $queryselect);
    $tampildata = mysqli_fetch_assoc($kirimselect);
    $cekdata = mysqli_num_rows($kirimselect);

    // jika tidak ada data
    if ($cekdata < 1) {
      $gagal = "Username dan password tidak di temukan";

      // jika password tidak singkron dengan yang ada di database
    } elseif ($tampildata['password'] != md5($password)) {
      $gagal = "password yang anda masukkan salah";
    } else {

      // jika data benar maka username akan di daftarkan sebagai session admin dan di arahkan ke halaman
      $link = url_dasar() . "/index.php";
      $_SESSION['admin'] = $username;
      header("location:$link");
      exit();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">

  <title>Admin</title>
</head>

<body style="width: 100%; max-width: 330px; margin: auto;padding: 15px;">
  <div class="login-admin">
    <h1>Login Admin</h1>
    <?php
    if ($gagal) {
      var_dump($username);
    ?>
    <div class="alert alert-danger"><?php echo $gagal ?></div>
    <?php
    }
    ?>
    <form action="" method="POST">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username"
          value="<?php echo $username ?>">
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
      </div>
      <button type="submit" class="btn btn-primary" name="login" style="margin-top: 15px;">Login</button>
    </form>
  </div>


</body>

</html>