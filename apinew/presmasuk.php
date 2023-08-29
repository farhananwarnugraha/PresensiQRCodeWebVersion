<?php
// Panggil koneksi database
require_once '../config/database.php';
require_once '../config/module.php';

// Set header JSON
// Header JSON
header('Content-Type: application/json');

$do = isset($_GET['do'])?$_GET['do']:'';
$id = isset($_POST['id'])?$_POST['id']:0;
$nis= isset($_POST['nis_siswa'])?$_POST['nis_siswa']:0;

$connect = konekDB();

$token = tokenRead();
//echo var_dump($token);
if($token['status']==true) {
    $keterangan = "Hadir";
    $keteranganTelat = "Alpa";
    //echo var_dump(checkTimeLimit($id));

    $cekidjadwal = "SELECT id_jadwal FROM jadwal_masuk WHERE id_jadwal = '$id'";
    $resultidjadwal = $connect->query($cekidjadwal);

    if ($resultidjadwal->num_rows = 1) {

        if(checkTimeLimit($id)) {
            $tanggalAbsen = date('Y-m-d');
            $waktuAbsen = date('H:i:s');
            
            $qu = "SELECT * FROM presensi_masuk where tanggal_presensi='".date("Y-m-d")."' AND siswa='$nis'";//echo $qu;
            $result = $connect->query($qu);
            
            //echo $result->num_rows;
            if ($result->num_rows <1) {
            
                $query = "INSERT INTO presensi_masuk (waktu_presensi, tanggal_presensi,keterangan, siswa) VALUES ('$waktuAbsen','$tanggalAbsen' ,'$keterangan', '$nis')";

                if ($connect->query($query) === TRUE) {
                    $message = 'Presensi berhasil';

                    //mengambil chat id orangtua
                    $queryChat = "SELECT no_tlp FROM orangtua WHERE siswa_orangtua = '{$token['data']['siswa']}'";//echo var_dump($queryChat);
                    $resultChatId = $connect->query($queryChat);

                if ($resultChatId->num_rows > 0) {
                    $rowChatId = $resultChatId->fetch_assoc();
                    $chatId = $rowChatId['no_tlp'];

                    // Kirim pesan ke Telegram setelah berhasil menginputkan absen
                    $messageTelegram = "Putra/Putri anda berhasil melakukan presensi pada :\nTanggal: $tanggalAbsen\nWaktu: $waktuAbsen";
                    sendTelegramMessage($chatId, $messageTelegram);
                } else {
                    // Jika Chat ID tidak ditemukan dalam database
                    $message = 'Presensi berhasil, tetapi Chat ID tidak ditemukan';
                }
                responseSuccess($message,[],false);
                } else {
                    responseError("Gagal menyimpan presensi",[],false);
                }
            } else {
                $message = 'Anda sudah melakukan presensi';
                responseError($message,[],false);
            }
        } else {
            $tanggalAbsen = date('Y-m-d');
            $waktuAbsen = date('H:i:s');
            
            $qu = "SELECT * FROM presensi_masuk where tanggal_presensi='".date("Y-m-d")."' AND siswa='$nis'";//echo $qu;
            $result = $connect->query($qu);
            
            if ($result->num_rows <1) {
                $query = "INSERT INTO presensi_masuk (waktu_presensi, tanggal_presensi,keterangan, siswa) VALUES ('$waktuAbsen','$tanggalAbsen' ,'$keteranganTelat', '$nis')";
                if ($connect->query($query) === TRUE) {
                    $message = 'Mohon Maaf, Bukan waktu untuk presensi, Sialhkan hubungi petugas piket';
                    $queryChatId = "SELECT no_tlp FROM orangtua WHERE siswa_orangtua = '{$token['data']['siswa']}'";
                    $resultChatId = $connect->query($queryChatId);

                if ($resultChatId->num_rows > 0) {
                    $rowChatId = $resultChatId->fetch_assoc();
                    $chatId = $rowChatId['no_tlp'];

                    // Kirim pesan ke Telegram setelah berhasil menginputkan absen
                    $messageTelegram = "Putra/Putri anda terlambat datang sekolah, dan datang pada :\nTanggal: $tanggalAbsen\nWaktu: $waktuAbsen";
                    sendTelegramMessage($chatId, $messageTelegram);
                } else {
                    // Jika Chat ID tidak ditemukan dalam database
                    $message = 'Mohon Maaf, Bukan waktu untuk presensi, Sialhkan hubungi petugas piket, tetapi Chat ID tidak ditemukan';
                }
                responseSuccess($message,[],false);
                } else {
                    responseError("Gagal Presensi",[],false);
                }
            } else {
                $message = 'Anda sudah melakukan presensi[]';
                responseError($message,[],false);
            }
        }
    } else {
        $message = 'Bukan QR Presensi[]';
        responseError($message,[],false);
    }
} else {
    responseError("Memerlukan token pengenal untuk mengakses fitur ini",[],false);
}




?>