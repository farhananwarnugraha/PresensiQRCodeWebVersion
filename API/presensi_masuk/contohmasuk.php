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
    $data = json_decode(file_get_contents('php://input'), true);

    // Validasi data yang diterima (opsional)
    // ...

    // Mendapatkan waktu saat ini
    $currentDate = $date;
    $currenTime = $time;
    $siswa = $_POST['siswa']; 
    $id_bataswaktu = $_POST['id_bataswaktu'];

    // Memeriksa batasan waktu
    $sql = "SELECT tgl, waktu_masuk, waktu_akhir FROM jadwal_masuk WHERE id_jadwal = '$id_bataswaktu'";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $data['date']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tanggal = $row['tgl'];
        $startTime = $row['waktu_masuk'];
        $endTime = $row['waktu_akhir'];

        // Memeriksa apakah waktu saat ini berada dalam batasan waktu yang ditentukan
        if ($currentDate == $data['date'] . ' ' . $startTime && $currentDateTime <= $data['date'] . ' ' . $endTime) {
            // Simpan data absensi ke dalam database
            $sql = "INSERT INTO absensi (nama, tanggal, jam_masuk) VALUES (?, ?, ?)";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("sss", $data['nama'], $data['date'], $currentDateTime);

            if ($stmt->execute()) {
                $response = [
                    'status' => 'success',
                    'message' => 'Absensi berhasil disimpan.'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat menyimpan absensi.'
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Waktu absensi diluar batasan waktu yang ditentukan.'
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Batas waktu tidak ditemukan.'
        ];
    }

    $connect->close();

    header('Content-Type: application/json');
    echo json_encode($response);
?>