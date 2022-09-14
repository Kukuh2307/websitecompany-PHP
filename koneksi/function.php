<?php
function url_dasar(){
    //$_SERVER['SERVER_NAME'] : alamat website, misalkan websitemu.com
    // $_SERVER['SCRIPT_NAME'] : directory website, websitemu.com/blog/ $_SERVER['SCRIPT_NAME'] : blog
    $url_dasar  = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']);
    return $url_dasar;
}

function ambil_gambar($id_tulisan)
{
    global $koneksi;

    $queryselect = "SELECT * FROM halaman WHERE id ='$id_tulisan'";
    $kirimselect = mysqli_query($koneksi, $queryselect);
    $tampildata = mysqli_fetch_assoc($kirimselect);
    $text = $tampildata['isi'];

    // function ambil gambar
    preg_match('/\< *[img][^\>]*[src] *= *[\"\']{0,1}([^\"\']*)/i', $text, $img);
    $gambar = $img[1];
    $gambar = str_replace("../gambar/",url_dasar()."/gambar/", $gambar);
    return $gambar;
}

function ambil_kutipan($id_tulisan)
{
    global $koneksi;
    $queryselect = "SELECT * FROM halaman WHERE id='$id_tulisan'";
    $kirimselect = mysqli_query($koneksi, $queryselect);
    // ambil data kutipan
    $datakutipan = mysqli_fetch_assoc($kirimselect);
    $kutipan = $datakutipan['kutipan'];
    return $kutipan;
}

function ambil_judul($id_tulisan)
{
    global $koneksi;
    $queryselect = "SELECT * FROM halaman WHERE id='$id_tulisan'";
    $kirimselect = mysqli_query($koneksi, $queryselect);
    // ambil data judul
    $datajudul = mysqli_fetch_assoc($kirimselect);
    $judul = $datajudul['judul'];
    return $judul;
}

function ambil_isi($id_tulisan)
{
    global $koneksi;
    $queryselect = "SELECT * FROM halaman WHERE id='$id_tulisan'";
    $kirimselect = mysqli_query($koneksi, $queryselect);
    // ambil data isi
    $dataisi = mysqli_fetch_assoc($kirimselect);
    // strip_tags untuk mengambil tulisan saja pada table isi meskipun ada gambar di dalammnya
    $isi = strip_tags($dataisi['isi']);
    return $isi;
}

function bersihkan_judul($judul){
    $judul_baru     = strtolower($judul);
    $judul_baru     = preg_replace("/[^a-zA-Z0-9\s]/","",$judul_baru);
    $judul_baru     = str_replace("     ","-",$judul_baru);
    return $judul_baru;
}

function buat_link_halaman($id){
    global $koneksi;
    $sql1    = "select * from halaman where id = '$id'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $judul  = bersihkan_judul($r1['judul']);
    // http://localhost/website-company-profile/halaman.php/8/judul
    return url_dasar()."/halaman.php/$id/$judul";
}

function getid()
{
    $id     = "";
    if (isset($_SERVER['PATH_INFO'])) {
        $id = dirname($_SERVER['PATH_INFO']);
        $id = preg_replace("/[^0-9]/", "", $id);
    }
    return $id;
}

function set_isi($isi){
    $isi = str_replace("../gambar/",url_dasar()."/gambar/",$isi);
    return $isi;
}

function max_kata($isi,$maxkata) {
    $array_isi = explode(" ",$isi);
    $array_isi = array_slice($array_isi,0,$maxkata);
    $isi = implode(" ",$array_isi);
    return $isi;
}

function foto_tutors($id){
    global $koneksi;
    $queryselect = "SELECT * FROM tutors WHERE id='$id'";
    $kirimselect = mysqli_query($koneksi,$queryselect);
    $tampildata = mysqli_fetch_assoc($kirimselect);
    $foto = $tampildata['foto'];

    if($foto){
        return $foto;
    } else {
        return 'tutors_default_picture.png';
    }
}

function buat_link_tutors($id){
    global $koneksi;
    $sql1    = "select * from tutors where id = '$id'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $nama  = bersihkan_judul($r1['nama']);
    $nama = str_replace(" ","",$nama);
    return url_dasar()."/detail_tutors.php/$id/$nama";
}

function foto_partners($id){
    global $koneksi;
    $queryselect = "SELECT * FROM partners WHERE id='$id'";
    $kirimselect = mysqli_query($koneksi,$queryselect);
    $tampildata = mysqli_fetch_assoc($kirimselect);
    $foto = $tampildata['foto'];

    if($foto){
        return $foto;
    } else {
        return 'tutors_default_picture.png';
    }
}

function buat_link_partners($id){
    global $koneksi;
    $sql1    = "SELECT * FROM partners where id = '$id'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $nama  = bersihkan_judul($r1['nama']);
    $nama = str_replace(" ","",$nama);
    return url_dasar()."/detail_partners.php/$id/$nama";
}

function footer($id,$table) {
    global $koneksi;
    $queryselect = "SELECT $table FROM footer WHERE id='$id'";
    $kirimselect = mysqli_query($koneksi,$queryselect);
    $tampildata = mysqli_fetch_assoc($kirimselect);
    $select = $tampildata[$table];
    return $select;
}

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// function kirim_email($email_penerima, $nama_penerima,$judul_email,$isi_email){
    
//     $email_pengirim     = "OnlineCouse@gmail.com";
//     $nama_pengirim      = "noreply";

//     //Load Composer's autoloader
//     require getcwd().'/vendor/autoload.php';

//     //Instantiation and passing `true` enables exceptions
//     $mail = new PHPMailer(true);

//     try {
//         //Server settings
//         $mail->SMTPDebug = 0;                      //Enable verbose debug output
//         $mail->isSMTP();                                            //Send using SMTP
//         $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
//         $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//         $mail->Username   = $email_pengirim;                     //SMTP username
//         $mail->Password   = 'passwordmu';                               //SMTP password
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//         $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//         //Recipients
//         $mail->setFrom($email_pengirim, $nama_pengirim);
//         $mail->addAddress($email_penerima,$nama_penerima);     //Add a recipient

        

//         //Content
//         $mail->isHTML(true);                                  //Set email format to HTML
//         $mail->Subject = $judul_email;
//         $mail->Body    = $isi_email;
        

//         $mail->send();
//         return "sukses";
//     } catch (Exception $e) {
//         return "gagal: {$mail->ErrorInfo}";
//     }
// }


?>