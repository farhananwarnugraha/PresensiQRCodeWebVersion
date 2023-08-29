<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    parse_str(file_get_contents('php://input'), $put);

    //menerima input
    $id_jadwal = $put['id_jadwal'];
    $tgl = $put['tgl'];
    $waktu_masuk = $put['waktu_masuk'];
    $waktu_akhir = $put['waktu_akhir'];
    //query update
    $query = "UPDATE jadwal_masuk SET tgl = '$tgl', waktu_masuk = '$waktu_masuk', waktu_akhir = '$waktu_akhir'
                WHERE id_jadwal = '$id_jadwal'";
    mysqli_query($connect, $query);

    if ($query){
        $response=array(
            'status' => 1,
            'message' =>'Update Success'
         );
    }
    else {
        $response=array(
            'status' => 0,
            'message' =>'Update Failed.'
         );
    }
    echo json_encode($response);
?>