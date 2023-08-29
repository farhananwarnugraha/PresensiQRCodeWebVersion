<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    //setting default time zone
    date_default_timezone_set('Asia/Jakarta');
    //dekalarasi tanggal sekarang
    $date = date('Y-m-d');
    //deklarasi waktu sekarang
    $time = date('H:i:s');

    //menerima input
    $id_presensi = mt_rand(1000, 9999);
    $tgl_presensi = $date; 
    $waktu_presensi = $time; 
    $keterangan = "Hadir"; 
    $siswa = $_POST['siswa']; 
    $id_bataswaktu = $_POST['id_bataswaktu'];
    // batas_tanggal 
    $batasTanggal = "SELECT tgl FROM jadwal_masuk WHERE '$id_bataswaktu'";
    $waktu_awal = "SELECT waktu_masuk FROM jadwal_masuk WHERE '$id_bataswaktu'";
    $waktu_akhir = "SELECT waktu_akhir FROM jadwal_masuk WHERE '$id_bataswaktu'";

    if ($tgl_presensi = $batasTanggal) {
        # code...
        $query = "INSERT INTO presensi_masuk VALUE ('$id_presensi', '$tgl_presensi','$waktu_presensi','$keterangan','$siswa')";
        mysqli_query($connect, $query);

        if ($query){
            $response=array(
                'status' => 1,
                'message' =>'Berhasil Melakukan Presensi'
            );
        }
        else {
            $response=array(
                'status' => 0,
                'message' =>'Insert Failed.'
            );
        }
    } else {
        $response=array(
            'status' => 'error',
            'message' =>'Bukan Waktu presensi.'
         );
    }
    echo json_encode($response);
    

    // $query = "INSERT INTO presensi_masuk VALUE ('$id_presensi', '$tgl_presensi','$waktu_presensi','$keterangan','$siswa')";
    // mysqli_query($connect, $query);

    // if ($query){
    //     $response=array(
    //         'status' => 1,
    //         'message' =>'Berhasil Melakukan Presensi'
    //      );
    // }
    // else {
    //     $response=array(
    //         'status' => 0,
    //         'message' =>'Insert Failed.'
    //      );
    // }
    // echo json_encode($response);
?>