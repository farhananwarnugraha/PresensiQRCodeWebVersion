<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    parse_str(file_get_contents('php://input'), $delete);

    //menerima input
    $id_orangtua = $delete['id_orangtua'];

    $query = "DELETE FROM orangtua WHERE id_orangtua = '$id_orangtua'";
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