<?php
    //panggil koneksi database
    require_once '../config/database.php';
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['siswa'])) {
            $id_siswa = $_GET['siswa'];
            
            // Query untuk menghitung jumlah presensi dengan keterangan "hadir", "izin", "sakit", dan "alpa" dari siswa tertentu
            $query = "SELECT siswa.id_siswa, siswa.nama_siswa,siswa.nis_siswa,
                        SUM(CASE WHEN keterangan = 'Hadir' THEN 1 ELSE 0 END) AS jumlah_hadir,
                        SUM(CASE WHEN keterangan = 'Izin' THEN 1 ELSE 0 END) AS jumlah_izin,
                        SUM(CASE WHEN keterangan = 'Sakit' THEN 1 ELSE 0 END) AS jumlah_sakit,
                        SUM(CASE WHEN keterangan = 'Alpa' THEN 1 ELSE 0 END) AS jumlah_alpa
                      FROM presensi_masuk JOIN siswa ON siswa.id_siswa = presensi_masuk.siswa
                      WHERE siswa.nis_siswa = $id_siswa";
                      
            $result = mysqli_query($connect, $query);
            
            if (mysqli_num_rows($result) > 0) {
                $row = $row = mysqli_fetch_assoc($result);
                $response = array(
                    'id_siswa' => $row['id_siswa'],
                    'nama_siswa' => $row['nama_siswa'],
                    'nis_siswa' => $row['nis_siswa'],
                    'data' =>[
                        'jumlah_hadir' => $row['jumlah_hadir'],
                        'jumlah_izin' => $row['jumlah_izin'],
                        'jumlah_sakit' => $row['jumlah_sakit'],
                        'jumlah_alpa' => $row['jumlah_alpa']
                    ]
                );
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                $response = "Data tidak ditemukan";
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
            echo "ID siswa tidak diberikan.";
        }
    }
?>