<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');

    //menerima input
    $id_kelas = mt_rand(1000, 9999);
    $nama_kelas = $_POST['nama_kelas'];
    $jurusan = $_POST['jurusan'];
   
    //validasi data

    $query = "INSERT INTO kelas VALUE ('$id_kelas', '$nama_kelas', '$jurusan')";
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