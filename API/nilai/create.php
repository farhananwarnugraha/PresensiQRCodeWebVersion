<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');

    //menerima input
    $id_nilai = mt_rand(1000, 9999);
    $nilai_mapel = $_POST['nilai_mapel'];
    $nilai_siswa = $_POST['nilai_siswa'];
    $nilai_uts = $_POST['nilai_uts'];
    $nilai_uas = $_POST['nilai_uas'];
    $total_nilai = ($nilai_uts + $nilai_uas)/2;
    $semester = $_POST['semester'];
    //validasi data

    $query = "INSERT INTO nilai VALUE ('$id_nilai', '$nilai_mapel', '$nilai_siswa','$nilai_uts','$nilai_uas','$total_nilai',
                                        '$semester')";
    mysqli_query($connect, $query);

    if ($query){
        $response=array(
            'status' => 1,
            'message' =>'Insert Success'
         );
    }
    else {
        $response=array(
            'status' => 0,
            'message' =>'Insert Failed.'
         );
    }
    echo json_encode($response);
?>