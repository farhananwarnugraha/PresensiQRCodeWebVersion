<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');

    //menerima input
    $id_mapel = mt_rand(1000, 9999);
    $nama_mapel = $_POST['nama_mapel'];
    $guru_mapel = $_POST['guru_mapel'];
    //validasi data

    $query = "INSERT INTO matapelajaran VALUE ('$id_mapel', '$nama_mapel', '$guru_mapel')";
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