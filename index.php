<?php include_once("header.php") ?>
<!-- untuk home -->
<section id="home">
  <img src="<?php  echo ambil_gambar("51") ?>" />
  <div class="kolom">
    <p class="deskripsi"><?php echo ambil_kutipan("51") ?></p>
    <h2><?php echo ambil_judul('51') ?></h2>
    <p><?php echo max_kata(ambil_isi('51'),15)  ?></p>
    <p><a href="<?php echo buat_link_halaman('51') ?>" class="tbl-pink">Pelajari Lebih Lanjut</a></p>
  </div>
</section>

<!-- untuk courses -->
<section id="courses">
  <div class="kolom">
    <p class="deskripsi"><?php echo ambil_kutipan('52') ?></p>
    <h2><?php echo ambil_judul('52') ?></h2>
    <p><?php echo max_kata(ambil_isi('52'),30) ?></p>
    <p><a href="<?php echo buat_link_halaman('52') ?>" class="tbl-biru">Pelajari Lebih Lanjut</a></p>
  </div>
  <img
    src="https://img.freepik.com/free-vector/online-learning-isometric-concept_1284-17947.jpg?size=626&ext=jpg&ga=GA1.2.1769275626.1605867161" />
</section>

<!-- untuk tutors -->
<section id="tutors">
  <div class="tengah">
    <div class="kolom">
      <p class="deskripsi">Our Top Tutors</p>
      <h2>Tutors</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, optio!</p>
    </div>

    <div class="tutor-list">
      <?php 
      $queryselect = "SELECT * FROM tutors ORDER BY id ASC";
      $kirimselect = mysqli_query($koneksi,$queryselect);
      while($looping = mysqli_fetch_assoc($kirimselect)){
      ?>
      <div class="kartu-tutor">
        <a href="<?php echo buat_link_tutors($looping['id'])?>">
          <img src="<?php echo url_dasar()."/gambar/". foto_tutors($looping['id']) ?>" />
          <p><?php echo $looping['nama'] ?></p>
        </a>

      </div>
      <?php

      }
      ?>
    </div>
  </div>
</section>

<!-- untuk partners -->
<section id="partners">
  <div class="tengah">
    <div class="kolom">
      <p class="deskripsi">Our Top Partners</p>
      <h2>Partners</h2>
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi magni tempore expedita sequi. Similique
        rerum doloremque impedit saepe atque maxime.</p>
    </div>

    <div class="partner-list">
      <div class="kartu-partner">
        <img src="https://www.designevo.com/res/templates/thumb_small/black-wheat-and-mortarboard.png" />
      </div>
      <div class="kartu-partner">
        <img
          src="https://image.freepik.com/free-vector/campus-collage-university-education-logo-design-template_7492-63.jpg" />
      </div>
      <div class="kartu-partner">
        <img
          src="https://image.freepik.com/free-vector/campus-collage-university-education-logo-design-template_7492-62.jpg" />
      </div>
      <div class="kartu-partner">
        <img src="https://www.designevo.com/res/templates/thumb_small/encircled-branches-and-book.png" />
      </div>
      <div class="kartu-partner">
        <img
          src="https://image.freepik.com/free-vector/campus-collage-university-education-logo-design-template_7492-64.jpg" />
      </div>
    </div>
  </div>
</section>

<?php include_once("footer.php") ?>