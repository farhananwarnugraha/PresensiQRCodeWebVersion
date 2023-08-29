<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    $query = $connect->query("SELECT nilai.`id_nilai`, matapelajaran.`nama_mapel`, siswa.`nama_siswa`,kelas.`nama_kelas`,jurusan.`nama_jurusan`,nilai.`semester`, nilai.`nilai_uas`, nilai.`nilai_uas`, 
                                nilai.`total_nilai`, matapelajaran.`id_mapel`, siswa.`id_siswa`, kelas.`id_kelas`, 
                                jurusan.`id_jurusan`
                                FROM nilai
                                JOIN matapelajaran ON matapelajaran.`id_mapel` = nilai.`nilai_mapel`
                                JOIN siswa ON siswa.`id_siswa` = nilai.`nilai_siswa`
                                JOIN kelas ON kelas.`id_kelas` = siswa.`kelas_siswa`
                                JOIN jurusan ON jurusan.`id_jurusan` = siswa.`jurusan_siswa`");            
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