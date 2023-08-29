<?php
    //panggil koneksi database
    require_once '../config/database.php';
    //header json
    header('Content-Type: application/json');
    $query = $connect->query("SELECT matapelajaran.`id_mapel`,matapelajaran.`nama_mapel`,matapelajaran.guru_mapel, guru.`id_guru`, guru.`nama_guru`, matapelajaran.`kategori_mapel`, jurusan.`id_jurusan`, jurusan.`nama_jurusan`
                                FROM matapelajaran 
                                JOIN guru ON matapelajaran.`guru_mapel` = guru.`id_guru`
                                JOIN jurusan ON matapelajaran.`kategori_mapel` = jurusan.`id_jurusan`
                                WHERE matapelajaran.`kategori_mapel` = 9145");            
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