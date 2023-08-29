<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');

    //menerima input
    $id_orangtua = mt_rand(1000, 9999);
    $nama_orangtua = $_POST['nama_orangtua'];
    $siswa_orangtua = $_POST['siswa_orangtua'];
    $no_tlp = $_POST['no_tlp'];
    // $kota_siswa = $_POST['kota_siswa'];
    // $tgl_lahir = $_POST['tgl_lahir'];
    // $no_tlp = $_POST['no_tlp'];
    // $kelas_siswa = $_POST['kelas_siswa'];
    // $jurusan_siswa = $_POST['jurusan_siswa'];
    // $pass_siswa = MD5($nis_siswa);
    //validasi data

    $query = "INSERT INTO orangtua VALUE ('$id_orangtua', '$nama_orangtua', '$siswa_orangtua','$no_tlp')";
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