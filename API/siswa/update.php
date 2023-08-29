<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    parse_str(file_get_contents('php://input'), $put);

    //menerima input
    $id_siswa = $put['id_siswa'];
    $nis_siswa = $put['nis_siswa'];
    $nama_siswa = $put['nama_siswa'];
    $alamat_siswa = $put['alamat_siswa'];
    $kota_siswa = $put['kota_siswa'];
    $tgl_lahir = $put['tgl_lahir'];
    $no_tlp = $put['no_tlp'];
    $kelas_siswa = $put['kelas_siswa'];
    $jurusan_siswa = $put['jurusan_siswa'];
    $pass_siswa = MD5($put['pass_siswa']);
    //validasi data
    // if($username == null && $nama == null){
    //     echo json_encode(
    //         [
    //             'message' => 'Username dan Nama tidak boleh kosong'
    //         ]
    //         );
    //         exit;
    // }

    $query = "UPDATE siswa SET nis_siswa = '$nis_siswa', nama_siswa = '$nama_siswa',alamat_siswa ='$alamat_siswa',
                kota_siswa = '$kota_siswa', tgl_lahir ='$tgl_lahir', no_tlp = '$no_tlp', kelas_siswa = '$kelas_siswa',
                jurusan_siswa = '$jurusan_siswa',pass_siswa = '$pass_siswa' 
                WHERE id_siswa = '$id_siswa'";
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