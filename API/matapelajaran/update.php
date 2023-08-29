<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    parse_str(file_get_contents('php://input'), $put);

    //menerima input
    $id_mapel = $put['id_mapel'];
    $nama_mapel = $put['nama_mapel'];
    $guru_mapel = $put['guru_mapel'];
   
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

    $query = "UPDATE matapelajaran SET nama_mapel = '$nama_mapel', guru_mapel = '$guru_mapel' WHERE id_mapel = '$id_mapel'";
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