<?php

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_presensi";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

//fungsi menjalankan bot telegram
function sendTelegramMessage($chatId, $message) {
    // Ganti "token_bot_anda" dengan token bot Telegram Anda
    $botToken = '6353722362:AAHB1aMjpxN2Z1C_zCEVSfMRHOURH7_IsaU';
    $telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage";

    $data = array(
        'chat_id' => $chatId,
        'text' => $message
    );

    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data)
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($telegramUrl, false, $context);

    if ($result === false) {
        return false;
    }

    return true;
}

// Fungsi untuk memeriksa batas waktu absen
function checkTimeLimit($absenId) {
    // Mengatur zona waktu menjadi 'Asia/Jakarta'
    date_default_timezone_set('Asia/Jakarta');

    global $conn;
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i:s');
    
    $query = "SELECT batas_waktu, batas_tanggal FROM jadwal_masuk WHERE id = '$absenId'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $batasWaktu = $row['batas_waktu'];
        $batasTanggal = $row['batas_tanggal'];

        if ($currentDate == $batasTanggal && $currentTime <= $batasWaktu) {
            return true;
        }
    }

    return false;
}

// Endpoint untuk melakukan absensi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['nama'])) {
    $absenId = $_POST['id'];
    $nama = $_POST['nama'];
    $keterangan = "Hadir";
    $keteranganTelat = "Alpa";

    if (checkTimeLimit($absenId)) {
        $tanggalAbsen = date('Y-m-d');
        $waktuAbsen = date('H:i:s');
        
        $query = "INSERT INTO presensi_masuk (waktu_presensi, tanggal_presensi,keterangan, siswa) VALUES ('$waktuAbsen','$tanggalAbsen' ,'$keterangan', '$nama')";

        if ($conn->query($query) === TRUE) {
            $response = array(
                'status' => 'success',
                'message' => 'Absensi berhasil'
            );
            //mengambil chat id orangtua
           $queryChat = "SELECT no_tlp FROM orangtua WHERE siswa_orangtua = '$nama'";
           $resultChatId = $conn->query($queryChatId);

           if ($resultChatId->num_rows > 0) {
               $rowChatId = $resultChatId->fetch_assoc();
               $chatId = $rowChatId['no_tlp'];

               // Kirim pesan ke Telegram setelah berhasil menginputkan absen
               $messageTelegram = "Putra/Putri anda berhasil melakukan presensi pada :\nTanggal: $tanggalAbsen\nWaktu: $waktuAbsen";
               sendTelegramMessage($chatId, $messageTelegram);
           } else {
               // Jika Chat ID tidak ditemukan dalam database
               $response['message'] = 'Absensi berhasil, tetapi Chat ID tidak ditemukan';
           }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Gagal menyimpan data absensi: ' . $conn->error
            );
        }
    } else {
        $tanggalAbsen = date('Y-m-d');
        $waktuAbsen = date('H:i:s');

        $query = "INSERT INTO presensi_masuk (waktu_presensi, tanggal_presensi,keterangan, siswa) VALUES ('$waktuAbsen','$tanggalAbsen' ,'$keteranganTelat', '$nama')";
        if ($conn->query($query) === TRUE) {
            $response = array(
                'status' => 'terlambat',
                'message' => 'Mohon Maaf, Bukan waktu untuk presensi, Sialhkan hubungi petugas piket'
            );
            $queryChatId = "SELECT no_tlp FROM orangtua WHERE siswa_orangtua = '$nama'";
            $resultChatId = $conn->query($queryChatId);

           if ($resultChatId->num_rows > 0) {
               $rowChatId = $resultChatId->fetch_assoc();
               $chatId = $rowChatId['no_tlp'];

               // Kirim pesan ke Telegram setelah berhasil menginputkan absen
               $messageTelegram = "Putra/Putri anda terlambat datang sekolah, dan datang pada :\nTanggal: $tanggalAbsen\nWaktu: $waktuAbsen";
               sendTelegramMessage($chatId, $messageTelegram);
           } else {
               // Jika Chat ID tidak ditemukan dalam database
               $response['message'] = 'Absensi berhasil, tetapi Chat ID tidak ditemukan';
           }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Gagal menyimpan data absensi: ' . $conn->error
            );
        }
        // $response = array(
        //     'status' => 'error',
        //     'message' => 'Maaf, bukan waktu presensi, Sialhkan hubungi petugas piket'
        // );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
?>
