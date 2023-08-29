<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    parse_str(file_get_contents('php://input'), $put);

    //menerima input
    $id_presensi = $put['id_presensi'];
    $nama_mapel = $put['nama_mapel']; 
    $waktu_presensi = $put['waktu_presensi']; 
    $keterangan = $put['keterangan']; 
    $siswa = $put['siswa']; 
    //query update
    $query = "UPDATE presensi_mapel SET nama_mapel = '$nama_mapel', waktu_presensi ='$waktu_presensi', keterangan ='$keterangan',
                siswa = '$siswa'
                WHERE id_presensi = '$id_presensi'";
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