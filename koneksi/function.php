<?php
function url_dasar()
{
    // alamat url website dan direktori website
    $url_dasar =  "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']);

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

function link_halaman($id)
{
    global $koneksi;
    // ambil judul
    $queryselect = "SELECT * FROM halaman WHERE id='$id'";
    $kirimselect = mysqli_query($koneksi, $queryselect);
    $dataisi = mysqli_fetch_assoc($kirimselect);
    $judul = $dataisi['judul'];

    return url_dasar()."/halaman.php/$id/$judul";
}

function bersihkan_judul($judul)
{
    $judul_baru = strtolower($judul);
    $judul_baru = preg_replace("/[^a-zA-Z0-9\s]/", "", $judul_baru);
    $judul_baru = str_replace(" ", "-", $judul_baru);
    return $judul_baru;
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
$ambil_id = getid();