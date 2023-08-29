<?php
// Panggil koneksi database
require_once '../config/database.php';
require_once '../config/module.php';

// Set header JSON
// Header JSON
header('Content-Type: application/json');

$do = isset($_GET['do'])?$_GET['do']:'';
$id = isset($_GET['id'])?$_GET['id']:0;
$poid = isset($_POST['id'])?$_POST['id']:0;
$connect = konekDB();

$token = tokenRead();
if($token['status']==true) {
switch($do) {
    case 'edit' :
        $nama = isset($_POST['nama_guru'])?$_POST['nama_guru']:'';
        $alamat = isset($_POST['alamat_guru'])?$_POST['alamat_guru']:'';
        $kota = isset($_POST['kota_guru'])?$_POST['kota_guru']:'';
        $jenis_kelamin = isset($_POST ['jenis_kelamin'])?$_POST ['jenis_kelamin']:'';
        $tlp =    isset($_POST ['no_tlp'])?$_POST ['no_tlp']:'';
        $pass =   isset($_POST['pass_guru'])?md5($_POST['pass_guru']):md5('123456');
        
        $update= "UPDATE guru SET 
                        nama_guru = '$nama', 
                        alamat_guru = '$alamat', 
                        kota_guru = '$kota',
                        jenis_kelamin = '$jenis_kelamin', 
                        no_tlp = '$tlp', 
                        pass_guru = '$pass'
                        WHERE nip_guru = '$id' ";
        //echo var_dump($update);
        $result = $connect->query($update);
        
        if($result) {
            responseSuccess("Berhasil diperbaharui");
        } else {
            responseError("Gagal memperbaharui");
        }
        break;
    case 'mapel' :
        // Query untuk mendapatkan daftar mata pelajaran yang diampu
        //echo var_dump($token);
        $queryMapel = "SELECT * FROM matapelajaran WHERE guru_mapel = '{$token['data']['guru']}'";//echo $queryMapel;
        $result = $connect->query($queryMapel);
        
        if (mysqli_num_rows($result) > 0) {
            $return = [];
            while($row= mysqli_fetch_assoc($result)) {
                $return[] =["id_mapel"=>$row['id_mapel'],"nama_mapel"=>$row['nama_mapel']];  
            }
            responseSuccess("Data mapel ditampilkan",$return);
            
        } else {
            responseError("Data mapel kosong",[]);
        }
        break;
    default :
        $query = "SELECT * FROM guru WHERE nip_guru = '$poid'";//echo var_dump($query);
        $result = $connect->query($query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $guruId = $row['id_guru'];
            
            $datareturn = [
                'nama_guru' => $row['nama_guru'],
                'nip_guru' => $row['nip_guru'],
                'alamat_guru' => $row['alamat_guru'],
                'kota_guru' => $row['kota_guru'],
                'jenis_kelamin'=>$row['jenis_kelamin'],
                'no_tlp'=>$row['no_tlp'],
                'pass_guru' => $row['pass_guru'],
            ];
            responseSuccess("Data Loaded", $datareturn);
        } else {
            responseError("Data guru kosong");
        }
}
} else {
    responseError("Memerlukan token pengenal untuk mengakses fitur ini");
}


?>