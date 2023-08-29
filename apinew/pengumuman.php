<?php
//panggil koneksi database
require_once '../config/database.php';
require_once '../config/module.php';
//header json
header('Content-Type: application/json');
$connect = konekDB();
$do = isset($_GET['do'])?$_GET['do']:'';
$isi = isset($_POST['isi_pengumuman'])?$_POST['isi_pengumuman']:'';
$tgl = isset($_POST['tgl_pengumuman'])?$_POST['tgl_pengumuman']:0000-00-00;
// cek token
$token = tokenRead();
if($token['status']==true) {
switch($do) {
    case 'add' :
        $id_pengumuman = mt_rand(1000, 9999);
        $tgl_pengumuman = $_POST['tgl_pengumuman'];
        $isi_pengumuman = $_POST['isi_pengumuman'];

        $query = "INSERT INTO pengumuman VALUES ('$id_pengumuman','$tgl','$isi')";
        $result = $connect->query($query);
        if($result) {
            responseSuccess("Berhasil menambahkan data",[],false);
        } else {
            responseError("Gagal menambahkan data",[],false);
        }
        break;
    default :
        $data = [];
        $query = $connect->query("SELECT * FROM pengumuman");            
        while($row=mysqli_fetch_object($query))
        {
            $data[] =$row;  
        }
        responseSuccess("Data Loaded",$data);
}
} else {
    responseError("Memerlukan token pengenal untuk mengakses fitur ini");
}
?>