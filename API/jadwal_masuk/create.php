<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');

    //menerima input
    $id_jadwal = mt_rand(1000, 9999);
    $tgl = $_POST['tgl'];
    $waktu_masuk = $_POST['waktu_masuk'];
    $waktu_akhir = $_POST['waktu_akhir'];
    

    $query = "INSERT INTO jadwal_masuk VALUE ('$id_jadwal', '$tgl', '$waktu_masuk','$waktu_akhir')";
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