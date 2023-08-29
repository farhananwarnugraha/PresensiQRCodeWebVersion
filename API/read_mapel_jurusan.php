<?php
    //panggil koneksi database
    require_once '../config/database.php';
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['nis_siswa'])) {
        $nis_siswa = $_GET['nis_siswa'];
    
        // Mengeksekusi query untuk mendapatkan mata pelajaran berdasarkan jurusan
        $query = "SELECT matapelajaran.id_mapel, matapelajaran.nama_mapel, siswa.id_siswa,siswa.nis_siswa,matapelajaran.kategori_mapel, jurusan.id_jurusan FROM matapelajaran
        JOIN jurusan ON jurusan.id_jurusan = matapelajaran.kategori_mapel
        JOIN siswa ON siswa.jurusan_siswa = jurusan.id_jurusan
        WHERE siswa.nis_siswa = '$nis_siswa'";
        $result = $connect->query($query);
    
        if ($result->num_rows > 0) {
            $mataPelajaran = array();
            while ($row = $result->fetch_assoc()) {
                $mataPelajaran[] = array(
                    'id_mapel' => $row['id_mapel'],
                    'nama_mapel' => $row['nama_mapel']
                );
            }
    
            $response = array(
                'status' => 'success',
                'data' => $mataPelajaran
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Mata pelajaran tidak ditemukan untuk jurusan tersebut'
            );
        }
    
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    $connect->close();
?>