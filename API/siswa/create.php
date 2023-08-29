<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');

    //menerima input
    $id_siswa = mt_rand(1000, 9999);
    $nis_siswa = $_POST['nis_siswa'];
    $nama_siswa = $_POST['nama_siswa'];
    $alamat_siswa = $_POST['alamat_siswa'];
    $kota_siswa = $_POST['kota_siswa'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $no_tlp = $_POST['no_tlp'];
    $kelas_siswa = $_POST['kelas_siswa'];
    $jurusan_siswa = $_POST['jurusan_siswa'];
    $pass_siswa = md5($nis_siswa);

    //validasi data

    $query = "INSERT INTO siswa VALUE ('$id_siswa', '$nis_siswa', '$nama_siswa','$alamat_siswa','$kota_siswa','$tgl_lahir',
                                        '$no_tlp','$kelas_siswa','$jurusan_siswa', '$pass_siswa')";
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