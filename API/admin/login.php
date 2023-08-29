<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    $salt = bin2hex(random_bytes(32));
    //menerima input
    $username = $_POST['username_admin'];
    $password = MD5($_POST['pass_admin']);
    //validasi data
    $query = "SELECT * FROM admin WHERE username_admin ='$username' AND pass_admin = '$password'";
    mysqli_query($connect, $query);

    if ($query){
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