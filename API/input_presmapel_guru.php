<?php
    //panggil koneksi database
    require_once '../config/database.php';
    //header json
    header('Content-Type: application/json');

    date_default_timezone_set('Asia/Jakarta');
    $currentDateTime = date('Y-m-d H:i:s');

    //menerima input
    $id_presensi = mt_rand(1000, 9999);
    $nama_mapel = $_POST['nama_mapel']; 
    $waktu_presensi = $currentDateTime;
    $keterangan = $_POST['keterangan']; 
    $siswa = $_POST['siswa']; 

    $query = "INSERT INTO presensi_mapel VALUE ('$id_presensi', '$nama_mapel','$waktu_presensi','$keterangan','$siswa')";
    mysqli_query($connect, $query);

    if ($query){
        $response=array(
            'status' => 1,
            'message' =>'Berhasil Menginputkan data'
         );
    }
    else {
        $response=array(
            'status' => 0,
            'message' =>'Gagal Menginputkan data'
         );
    }
    echo json_encode($response);
?>