<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    parse_str(file_get_contents('php://input'), $put);

    //menerima input
    $id_kelas = $put['id_kelas'];
    $nama_kelas = $put['nama_kelas'];
    $jurusan = $put['jurusan'];
    //validasi data
    // if($username == null && $nama == null){
    //     echo json_encode(
    //         [
    //             'message' => 'Username dan Nama tidak boleh kosong'
    //         ]
    //         );
    //         exit;
    // }

    $query = "UPDATE kelas SET nama_kelas = '$nama_kelas', jurusan = '$jurusan'
                WHERE id_kelas = '$id_kelas'";
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