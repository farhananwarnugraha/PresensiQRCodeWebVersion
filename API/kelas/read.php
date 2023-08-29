<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    $query = $connect->query("SELECT kelas.id_kelas, kelas.nama_kelas, jurusan.nama_jurusan 
                                FROM kelas 
                                JOIN jurusan ON kelas.jurusan = jurusan.id_jurusan 
                                ORDER BY kelas.nama_kelas ASC");            
        while($row=mysqli_fetch_object($query))
        {
            $data[] = $row;
        }
    $response=array(
        'status' => 1,
        'message' =>'Success',
        'data' => $data
    );    
    echo json_encode($response);
?>