<?php 
$koneksi = mysqli_connect("localhost","root","","websitecompany");

// cek koneksi dengan database
if($koneksi){
  $sukses = "koneksi berhasil";
} else {
  die("tidak terkoneksi dengan database");
}
?>