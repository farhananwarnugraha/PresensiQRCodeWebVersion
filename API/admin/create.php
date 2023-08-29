<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');

    $salt = bin2hex(random_bytes(32));
    //menerima input
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $password = MD5($username);
    //validasi data
    if($username == null && $nama == null){
        echo json_encode(
            [
                'message' => 'Username dan Nama tidak boleh kosong'
            ]
            );
            exit;
    }

    $query = "INSERT INTO admin VALUE ('', '$username', '$nama','$password')";
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