<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    $query = $connect->query("SELECT matapelajaran.id_mapel, matapelajaran.nama_mapel, guru.nama_guru, matapelajaran.guru_mapel
                             FROM matapelajaran
                             JOIN guru ON matapelajaran.guru_mapel = guru.id_guru ORDER BY nama_mapel ASC");            
        while($row=mysqli_fetch_object($query))
        {
            $data[] =$row;
        }
    $response=array(
        'status' => 1,
        'message' =>'Success',
        'data' => $data
    );    
    echo json_encode($response);
?>