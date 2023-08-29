<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    parse_str(file_get_contents('php://input'), $put);

    //menerima input
    $id_guru = $put['id_guru'];
    $nip_guru = $put['nip_guru'];
    $nama_guru = $put['nama_guru'];
    $alamat_guru = $put['alamat_guru'];
    $kota_guru = $put['kota_guru'];
    $jenis_kelamin = $put['jenis_kelamin'];
    $no_tlp = $put['no_tlp'];
    $pass_guru =MD5($put['pass_guru']);
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

    $query = "UPDATE guru SET nip_guru = '$nip_guru', nama_guru = '$nama_guru',alamat_guru = '$alamat_guru', 
                kota_guru = '$kota_guru', jenis_kelamin = '$jenis_kelamin',no_tlp = '$no_tlp', pass_guru = '$pass_guru'
                WHERE id_guru = '$id_guru'";
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