<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    parse_str(file_get_contents('php://input'), $put);

    //menerima input
    $id_orangtua = $put['id_orangtua'];
    $nama_orangtua = $put['nama_orangtua'];
    $siswa_orangtua = $put['siswa_orangtua'];
    $no_tlp = $put['no_tlp'];
    // $kota_siswa = $put['kota_siswa'];
    // $tgl_lahir = $put['tgl_lahir'];
    // $no_tlp = $put['no_tlp'];
    // $kelas_siswa = $put['kelas_siswa'];
    // $jurusan_siswa = $put['jurusan_siswa'];
    // $pass_siswa = MD5($put['pass_siswa']);
    //validasi data
    // if($username == null && $nama == null){
    //     echo json_encode(
    //         [
    //             'message' => 'Username dan Nama tidak boleh kosong'
    //         ]
    //         );
    //         exit;
    // }

    $query = "UPDATE orangtua SET nama_orangtua = '$nama_orangtua', siswa_orangtua = '$siswa_orangtua',no_tlp = '$no_tlp'
                WHERE id_orangtua = '$id_orangtua'";
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