<?php
    //panggil koneksi database
    require_once '../config/database.php';
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['siswa']) && isset($_GET['nama_mapel'])) {
            $siswa = $_GET['siswa'];
            $nama_mapel = $_GET['nama_mapel'];
    
            // Query untuk menghitung jumlah presensi dengan keterangan "hadir", "izin", "sakit", dan "alpa" dari siswa berdasarkan mata pelajaran
            $query = "SELECT 
                        COUNT(CASE WHEN keterangan = 'Hadir' THEN 1 END) AS jumlah_hadir,
                        COUNT(CASE WHEN keterangan = 'Izin' THEN 1 END) AS jumlah_izin,
                        COUNT(CASE WHEN keterangan = 'Sakit' THEN 1 END) AS jumlah_sakit,
                        COUNT(CASE WHEN keterangan = 'Alpa' THEN 1 END) AS jumlah_alpa
                      FROM presensi_mapel
                      WHERE siswa = $siswa
                      AND nama_mapel = '$nama_mapel'";
    
            $result = $connect->query($query);
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $response = array(
                    'siswa' => $siswa,
                    'nama_mapel' => $nama_mapel,
                    'jumlah_hadir' => $row['jumlah_hadir'],
                    'jumlah_izin' => $row['jumlah_izin'],
                    'jumlah_sakit' => $row['jumlah_sakit'],
                    'jumlah_alpa' => $row['jumlah_alpa']
                );
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                echo "Data presensi siswa tidak ditemukan.";
            }
        } else {
            echo "ID siswa atau mata pelajaran tidak diberikan.";
        }
    }
    
    $connect->close();
?>