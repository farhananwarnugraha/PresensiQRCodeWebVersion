<?php

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contoh_uploadfile";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk memeriksa batas waktu absen
function checkTimeLimit($absenId) {
    // Mengatur zona waktu menjadi 'Asia/Jakarta'
    date_default_timezone_set('Asia/Jakarta');

    global $conn;
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i:s');
    
    $query = "SELECT batas_waktu, batas_tanggal FROM batas_waktu WHERE id = '$absenId'";
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
//fungtion send message telegram
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

// Endpoint untuk melakukan absensi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['nama'])) {
    $absenId = $_POST['id'];
    $nama = $_POST['nama'];
    $keterangan = "Hadir";
    $keteranganTelat = "Alpa";

    if (checkTimeLimit($absenId)) {
        $tanggalAbsen = date('Y-m-d');
        $waktuAbsen = date('H:i:s');
        
        $query = "INSERT INTO presensi (id_batas_waktu, nama, waktu_absen, tanggal_presensi,keterangan) VALUES ('$absenId', '$nama', '$waktuAbsen','$tanggalAbsen' ,'$keterangan')";

        if ($conn->query($query) === TRUE) {
            $response = array(
                'status' => 'success',
                'message' => 'Absensi berhasil'
            );
            //send otomatis tele
            $chatId = '6182861243'; // Ganti dengan chat ID penerima pesan di Telegram
            $message = "Anak anda Berhasil melakukan presensi Pada :\nTanggal: $tanggalAbsen\nWaktu: $waktuAbsen";
            sendTelegramMessage($chatId, $message);
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Gagal menyimpan data absensi: ' . $conn->error
            );
        }
    } else {
        $tanggalAbsen = date('Y-m-d');
        $waktuAbsen = date('H:i:s');

        $query = "INSERT INTO presensi (id_batas_waktu, nama, waktu_absen, tanggal_presensi,keterangan) VALUES ('$absenId', '$nama', '$waktuAbsen','$tanggalAbsen', '$keteranganTelat')";
        if ($conn->query($query) === TRUE) {
            $response = array(
                'status' => 'success',
                'message' => 'Maaf, Bukan waktu untuk presensi, Sialhkan hubungi petugas piket'
            );
            //send mesage bot tele
            $chatId = '6182861243'; // Ganti dengan chat ID penerima pesan di Telegram
            $message = "Terlambat, anak anda datang pada :\nTanggal: $tanggalAbsen\nWaktu: $waktuAbsen";
            sendTelegramMessage($chatId, $message);
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Gagal menyimpan data absensi: ' . $conn->error
            );
        }
        // $response = array(
        //     'status' => 'error',
        //     'message' => 'Maaf, Bukan waktu untuk presensi, Sialhkan hubungi petugas piket'
        // );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
?>