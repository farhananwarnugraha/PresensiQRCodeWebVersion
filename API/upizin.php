<?php
    //panggil koneksi database
    require_once '../config/database.php';
    //header json
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

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

    //menerima input
    if (isset($_FILES['gambar'])) {
        $gambar = $_FILES['gambar'];
    
        // Mendapatkan data yang dikirim melalui permintaan
        $id_izin = mt_rand(1000, 9999);;
        $siswa = $_POST['siswa'];
        $keterangan = $_POST['keterangan'];
        $tgl_pengajuan_izin = new DateTime();
        $status = "Prosess";
    
        // Format the date and time in the desired format (Y-m-d H:i:s)
        $tgl_pengajuan_izinFormatted = $tgl_pengajuan_izin->format('Y-m-d H:i:s');
        // Memeriksa tipe file gambar (hanya mengizinkan JPEG)
        $allowedTypes = array('image/jpeg');
        if (!in_array($gambar['type'], $allowedTypes)) {
            $response = array(
                "status" => "error",
                "message" => "Tipe file gambar tidak valid. Hanya file JPEG yang diizinkan."
            );
            echo json_encode($response);
            exit;
        }
    
        // Mengambil data dari file gambar yang diunggah
        $gambarName = $gambar['name'];
        $gambarTmpPath = $gambar['tmp_name'];
        $gambarSize = $gambar['size'];
        $gambarError = $gambar['error'];
    
        // Memeriksa apakah tidak ada kesalahan saat mengunggah gambar
        if ($gambarError === UPLOAD_ERR_OK) {
            // Membaca konten gambar
            $gambarData = file_get_contents($gambarTmpPath);
    
            // Menghindari SQL Injection dengan melakukan escape string pada data gambar
            $gambarData = $connect->real_escape_string($gambarData);
    
            // Menyimpan data gambar ke dalam tabel database
            $sql = "INSERT INTO perizinan (id_izin, siswa, kerterangan_izin, tgl_pengajuan_izin, nama_gambar, gambar_bukti, status) VALUES ('$id_izin','$siswa', '$keterangan', '$tgl_pengajuan_izinFormatted', '$gambarName', '$gambarData', '$status')";
    
            if ($connect->query($sql) === TRUE) {
                $response = array(
                    "status" => "success",
                    "message" => "Berhail mengajukan izin"
                );
                //pesan otomatis bot telegram
                $queryChat = "SELECT no_tlp FROM orangtua WHERE siswa_orangtua = '$siswa'";
                $resultChatId = $connect->query($queryChat);

                if ($resultChatId->num_rows > 0) {
                    $rowChatId = $resultChatId->fetch_assoc();
                    $chatId = $rowChatId['no_tlp'];

                    // Kirim pesan ke Telegram setelah berhasil menginputkan absen
                    $messageTelegram = "Hallo, Putra/Putri anda mengajukan izin tidak masuk, dengan detail sebagai berikut :\nTanggal: $tgl_pengajuan_izinFormatted\n Alasan : $keterangan";
                    sendTelegramMessage($chatId, $messageTelegram);
                } else {
                    // Jika Chat ID tidak ditemukan dalam database
                    $response['message'] = 'Berhasil melakukan pengajuan izin, tetapi Chat ID tidak ditemukan';
                }
            } else {
                $response = array(
                    "status" => "error",
                    "message" => "Gagal Mengajukan Izin " . $connect->error
                );
            }
        } else {
            $response = array(
                "status" => "error",
                "message" => "Terjadi kesalahan saat mengunggah file Bukti."
            );
        }
    } else {
        $response = array(
            "status" => "error",
            "message" => "File Bukti izin tidak ditemukan dalam permintaan."
        );
    }
    
    // Menutup koneksi database
    $connect->close();
    // Mengembalikan response dalam format JSON
    echo json_encode($response);
?>