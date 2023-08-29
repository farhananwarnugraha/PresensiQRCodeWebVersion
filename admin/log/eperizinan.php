<?php
    require '../../connection.php';

    //function chat otomatis telegram
    
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

    if(isset($_POST["submit"])){
      $id_izin = $_POST['id_izin'];
      $status_izin = $_POST['status'];
      $siswa = $_POST['siswa'];
      $tgl = $_POST['tgl_izin'];
      $nama = $_POST['nama_siswa'];
    //   var_dump($id,$keterangan);
    //   exit;
     
      $update_presmapel = "UPDATE perizinan SET
                        id_izin = '$id_izin',
                        status = '$status_izin'
                        WHERE id_izin = $id_izin";

      $query = mysqli_query($connect, $update_presmapel);
        //cekdata berhasil ditambahkan
        if ($query) {
                $queryChat = "SELECT no_tlp FROM orangtua WHERE siswa_orangtua = '$siswa'";
                $resultChatId = $connect->query($queryChat);

                if ($resultChatId->num_rows > 0) {
                    $rowChatId = $resultChatId->fetch_assoc();
                    $chatId = $rowChatId['no_tlp'];

                    // Kirim pesan ke Telegram setelah berhasil menginputkan absen
                    $messageTelegram = "Hallo bapak/ibu dari $nama, Permohonan izin yang dilakukan pada $tgl oleh $nama, kami nyatakan $status_izin, Sekian Terimakasih 😁";
                    sendTelegramMessage($chatId, $messageTelegram);
                } else {
                    // Jika Chat ID tidak ditemukan dalam database
                    $response['message'] = 'Berhasil melakukan pengajuan izin, tetapi Chat ID tidak ditemukan';
                }
          echo "
            <script>
            alert('Data Berhasil diupdate');
            document.location='../perizinan.php?status=sukses';
            </script>";
            
        }
        else{
          echo "
            <script>
            alert('Data Gagal diupdate');
            document.location='../perizinan.php?status=gagal';
            </script>";
        }

      }
      ?>