<?php
session_start();
include_once("koneksi/connectdatabase.php");
include_once("koneksi/function.php");
$signup = url_dasar() . "/pendaftaran.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Course</title>
  <link rel="stylesheet" href="<?php echo url_dasar() ?>/css/style.css">
</head>

<body>
  <nav>
    <div class="wrapper">
      <div class="logo"><a href='<?php echo url_dasar()  ?>'>Online Courses</a></div>
      <div class="menu">
        <ul>
          <li><a href="<?php echo url_dasar() ?>#home">Home</a></li>
          <li><a href="<?php echo url_dasar() ?>#courses">Courses</a></li>
          <li><a href="<?php echo url_dasar() ?>#tutors">Tutors</a></li>
          <li><a href="<?php echo url_dasar() ?>#partners">Partners</a></li>
          <!-- <li><a href="<?php echo url_dasar() ?>#contact">Contact</a></li> -->

          <!-- mengatur tampilan tombol sign up apabila sudah login akan di ganti dengan nama user dan tombol logout dihubungkan dengan login.php-->
          <li>
            <?php if (isset($_SESSION['nama_lengkap'])) {
              echo "<a href='" . url_dasar() . "/ganti_profile.php'>" . $_SESSION['nama_lengkap'] . "</a> | <a href='" . url_dasar() . "/logout.php'>Logout</a>";
            } else { ?>
            <a href="pendaftaran.php" class="tbl-biru">Sign Up</a>
            <?php } ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="wrapper">