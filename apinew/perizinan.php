<?php

// Panggil koneksi database
require_once '../config/database.php';
require_once '../config/module.php';

// Set header JSON
// Header JSON
header('Content-Type: application/json');

$do = isset($_GET['do'])?$_GET['do']:'';
$id = isset($_POST['id'])?$_POST['id']:0;
$nis= isset($_POST['nis_siswa'])?$_POST['nis_siswa']:0;
$namagamb = isset($_POST['nama_gambar'])?$_POST['nama_gambar']:'';
$tanggal = date('Y-m-d');

$connect = konekDB();

$token = tokenRead();
if($token['status']==true) {
    $imagesave = '';
    if(isset($_FILES['gambar_bukti'])) {
        $imagesave = file_get_contents($_FILES['gambar_bukti']['tmp_name']);
        //$imagesave = base64_encode($imagesave);

        // There is an argument that this is unnecessary with base64 encoded data, but
        // better safe than sorry :)
        $imagesave = $connect->real_escape_string($imagesave);
    }
    //echo var_dump($_FILES);
    
    $query = "INSERT INTO `perizinan`(`siswa`,`kerterangan_izin`,`tgl_pengajuan_izin`,`nama_gambar`,`gambar_bukti`,`status`) VALUES ('$nis','Izin','$tanggal','$namagamb','$imagesave','Proses')";
    $result = $connect->query($query);
    
    if($result) {
        responseSuccess('Berhasil melakukan perizinan',[],false);
    } else {
        responseError("Gagal menyimpan data perizinan",[],false);
    }
} else {
    responseError("Memerlukan token pengenal untuk mengakses fitur ini",[],false);
}


?>