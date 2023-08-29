<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    parse_str(file_get_contents('php://input'), $put);

    //menerima input
    $id_nilai = $put['id_nilai'];
    $nilai_mapel = $put['nilai_mapel'];
    $nilai_siswa = $put['nilai_siswa'];
    $nilai_uts = $put['nilai_uts'];
    $nilai_uas = $put['nilai_uas'];
    $total_nilai = ($nilai_uts + $nilai_uas)/2; 
    $semester = $put['semester'];
   
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

    $query = "UPDATE nilai SET nilai_mapel = '$nilai_mapel', nilai_siswa = '$nilai_siswa', nilai_uts = '$nilai_uts',
                nilai_uas = '$nilai_uas', total_nilai = '$total_nilai', semester = '$semester'
                WHERE id_nilai = '$id_nilai'";
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