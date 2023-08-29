<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');

    //menerima input
    $id_guru = mt_rand(1000, 9999);
    $nip_guru = $_POST['nip_guru'];
    $nama_guru = $_POST['nama_guru'];
    $alamat_guru = $_POST['alamat_guru'];
    $kota_guru = $_POST['kota_guru'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_tlp = $_POST['no_tlp'];
    $pass_guru = md5($nip_guru);
    //validasi data

    $query = "INSERT INTO guru VALUE ('$id_guru', '$nip_guru', '$nama_guru','$alamat_guru','$kota_guru','$jenis_kelamin',
                                        '$no_tlp', '$pass_guru')";
    mysqli_query($connect, $query);

    if ($query){
        $response=array(
            'status' => 1,
            'message' =>'Insert Success'
         );
    }
    else {
        $response=array(
            'status' => 0,
            'message' =>'Insert Failed.'
         );
    }
    echo json_encode($response);
?>