</div>
<?php 
include_once("koneksi/connectdatabase.php");
include_once("koneksi/function.php");
?>

<div id="contact">
  <div class="wrapper">
    <div class="footer">
      <div class="footer-section">
        <h3><?php echo footer('1','judul') ?></h3>
        <p><?php echo footer('1','isi') ?></p>
      </div>
      <div class="footer-section">
        <h3><?php echo footer('3','judul') ?></h3>
        <p><?php echo footer('3','isi') ?> </p>
        <p><?php echo footer('4','isi') ?> </p>
      </div>
      <div class="footer-section">
        <h3><?php echo footer('2','judul') ?></h3>
        <p><?php echo footer('2','isi') ?> </p>
      </div>
      <div class="footer-section">
        <h3>Navigasi</h3>
        <div class="link">
          <a href="<?php echo url_dasar()?>#home">Home</a>
          <a href="<?php echo url_dasar()?>#courses">Courses</a>
          <a href="<?php echo url_dasar()?>#tutors">Tutors</a>
          <a href="<?php echo url_dasar()?>#partners">Partners</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="copyright">
  <div class="wrapper">
    &copy; 2022. <b>Kisawa16</b> All Rights Reserved.
  </div>
</div>

</body>

</html>