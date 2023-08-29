<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    parse_str(file_get_contents('php://input'), $delete);

    //menerima input
    $id_admin = $delete['id_admin'];

    $query = "DELETE FROM admin WHERE id_admin = '$id_admin'";
    mysqli_query($connect, $query);

    if ($query){
        $response=array(
            'status' => 1,
            'message' =>'Delete Success'
         );
    }
    else {
        $response=array(
            'status' => 0,
            'message' =>'Delete Failed.'
         );
    }
    echo json_encode($response);
?>