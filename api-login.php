<?php
    //panggil koneksi database
    include 'connection.php';
    //header json
    header('Content-Type: application/json');

    //menerima input
    $username = $_POST['username_admin'];
    $password = $_POST['pwd_admin'];
    //validasi data
    $data = mysqli_query ($connect, "SELECT * FROM siamad_admin WHERE username_admin ='$username' AND pwd_admin = '$password'");
    $cek = mysqli_fetch_assoc($data);

    if ($data > 0){
        $response=array(
            'status' => 1,
            'message' =>'Login Success'
         );
    }
    else {
        $response=array(
            'status' => 0,
            'message' =>'Login Failed.'
         );
    }
    echo json_encode($response);
?>