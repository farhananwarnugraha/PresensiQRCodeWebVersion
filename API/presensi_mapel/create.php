<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');

    //menerima input
    $id_presensi = mt_rand(1000, 9999);
    $nama_mapel = $_POST['nama_mapel']; 
    $waktu_presensi = $_POST['waktu_presensi']; 
    $keterangan = $_POST['keterangan']; 
    $siswa = $_POST['siswa']; 

    $query = "INSERT INTO presensi_mapel VALUE ('$id_presensi', '$nama_mapel','$waktu_presensi','$keterangan','$siswa')";
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