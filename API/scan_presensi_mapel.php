<?php
// Panggil koneksi database
require_once '../config/database.php';
// Header json
header('Content-Type: application/json');

date_default_timezone_set('Asia/Jakarta');
$currentDate = date('Y-m-d');
$currentTime = date('H:i:s');

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

// Menerima input
$id_presensi = mt_rand(1000, 9999);
$id_mapel = $_POST['nama_mapel'];
$waktu_presensi = $currentTime;
$tanggal_presensi = $currentDate;
$keterangan = "Hadir";
$siswa = $_POST['siswa'];

// Query untuk mendapatkan nama mata pelajaran berdasarkan ID mata pelajaran
$queryNamaMapel = "SELECT nama_mapel FROM matapelajaran WHERE id_mapel = '$id_mapel'";
$resultNamaMapel = mysqli_query($connect, $queryNamaMapel);

if (mysqli_num_rows($resultNamaMapel) > 0) {
    $rowNamaMapel = mysqli_fetch_assoc($resultNamaMapel);
    $nama_mapel = $rowNamaMapel['nama_mapel'];

    $query = "INSERT INTO presensi_mapel VALUE ('$id_presensi', '$id_mapel', '$nama_mapel', '$waktu_presensi', '$tanggal_presensi', '$keterangan', '$siswa')";
    mysqli_query($connect, $query);

    if ($query) {
        $response = array(
            'status' => 1,
            'message' => 'Berhasil Melakukan Presensi'
        );
        $queryChat = "SELECT no_tlp FROM orangtua WHERE siswa_orangtua = '$siswa'";
        $resultChatId = $connect->query($queryChat);

        if ($resultChatId->num_rows > 0) {
            $rowChatId = $resultChatId->fetch_assoc();
            $chatId = $rowChatId['no_tlp'];

            // Kirim pesan ke Telegram setelah berhasil menginputkan absen
            $messageTelegram = "Putra/Putri anda mengikuti mata pelajaran $nama_mapel pada :\nTanggal/Waktu: $tanggal_presensi - $waktu_presensi\nKeterangan: $keterangan\n";
            sendTelegramMessage($chatId, $messageTelegram);
        } else {
            // Jika Chat ID tidak ditemukan dalam database
            $response['message'] = 'Berhasil melakukan pengajuan izin, tetapi Chat ID tidak ditemukan';
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Gagal Presensi'
        );
    }
} else {
    $response = array(
        'status' => 0,
        'message' => 'ID mata pelajaran tidak valid'
    );
}

echo json_encode($response);
