<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');

    //menerima input
    $id_jurusan = mt_rand(1000, 9999);
    $nama_jurusan = $_POST['nama_jurusan'];
   
    //validasi data

    $query = "INSERT INTO jurusan VALUE ('$id_jurusan', '$nama_jurusan')";
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