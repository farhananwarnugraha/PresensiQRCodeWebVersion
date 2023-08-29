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
$id_mapel = isset($_POST['nama_mapel'])?$_POST['nama_mapel']:0;
$waktu_presensi = date("H:i:s");
$tanggal_presensi = date('Y-m-d');
$keterangan = "Hadir";

$connect = konekDB();

$token = tokenRead();
if($token['status']==true) {
    $str = "SELECT * FROM presensi_mapel where tanggal_presensi='".date("Y-m-d")."' AND siswa='$nis' AND nama_mapel='$id_mapel'";
    $result = $connect->query($str);
        
    //echo $result->num_rows;
    if ($result->num_rows <1) {
    
        $query = "INSERT INTO `presensi_mapel` ( `nama_mapel`,`waktu_presensi`,`tanggal_presensi`,`keterangan`,`siswa` ) VALUES ('$id_mapel','$waktu_presensi','$tanggal_presensi','$keterangan','$nis')";
        if ($connect->query($query) === TRUE) {
            $message = 'Berhasil Melakukan Presensi';

            $qmapel = "SELECT nama_mapel FROM matapelajaran WHERE id_mapel = '$id_mapel'";
            $resultmp = $connect->query($qmapel);
            if ($resultmp->num_rows > 0) {
                $rowMp = $resultmp->fetch_assoc();
                $namamapel = $rowMp['nama_mapel'];

                $queryChat = "SELECT ot.no_tlp FROM siswa AS si
                            LEFT JOIN orangtua AS ot ON si.id_siswa = ot.siswa_orangtua
                            WHERE si.nis_siswa = '$nis'";
                $resultChatId = $connect->query($queryChat);

                if ($resultChatId->num_rows > 0) {
                    $rowChatId = $resultChatId->fetch_assoc();
                    $chatId = $rowChatId['no_tlp'];

                    // Kirim pesan ke Telegram setelah berhasil menginputkan absen
                    $messageTelegram = "Putra/Putri anda mengikuti mata pelajaran $namamapel pada :\nTanggal/Waktu: $tanggal_presensi - $waktu_presensi\nKeterangan: $keterangan\n";
                    sendTelegramMessage($chatId, $messageTelegram);
                } else {
                    $message = "Berhasil melakukan presensi, tetapi Chat ID tidak ditemukan";
                }
                responseSuccess($message);
            } else {
                $message = 'Mapel Tidak ditemukan';
                responseError($message, [], false);
            }


            // $queryChat = "select ot.`no_tlp` from `siswa` as si
            //                 left join `orangtua` as ot on si.`id_siswa`=ot.`siswa_orangtua`
            //                 where si.`nis_siswa`='$nis'";
            // $resultChatId = $connect->query($queryChat);

            // if ($resultChatId->num_rows > 0) {
            //     $rowChatId = $resultChatId->fetch_assoc();
            //     $chatId = $rowChatId['no_tlp'];

            //     // Kirim pesan ke Telegram setelah berhasil menginputkan absen
            //     $messageTelegram = "Putra/Putri anda mengikuti mata pelajaran $nama_mapel pada :\nTanggal/Waktu: $tanggal_presensi - $waktu_presensi\nKeterangan: $keterangan\n";
            //     sendTelegramMessage($chatId, $messageTelegram);
            // } else {
            //     $message = "Berhasil melakukan presensi, tetapi Chat ID tidak ditemukan";
            // }
            // responseSuccess($message);
        } else {
            
            $message = 'Gagal Presensi';
            responseError($message,[],false);
        }
    } else {
        $message = 'Anda sudah melakukan presensi';
        responseError($message,[],false);
    }
} else {
    responseError("Memerlukan token pengenal untuk mengakses fitur ini");
}

