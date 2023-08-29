<?php

function responseSuccess($message,$data=[],$dtneed=true) {
    $return['success'] = true;
    $return['message'] = $message;
    
    if($dtneed==true) {
        $return['data'] = $data;
    } else {
        $return['data'] ='';
    }    
    
    echo json_encode($return);
}

function responseError($message,$data=[],$dtneed=true) {
    $return['success'] = false;
    $return['message'] = $message;
    if($dtneed==true) {
        $return['data'] = $data;
    } else {
        $return['data'] ='';
    }   
    
    echo json_encode($return);
}

function generateRandomString($length = 40) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

function konekDB() {
    $connect = mysqli_connect(DBhostname, DBusername, DBpassword, DBdatabase);
    return $connect;
}

function tokenRet() {
    $token = '';
    $server = $_SERVER;
    
    foreach($server as $svk => $sv) {
        $name = 'HTTP_AUTHORIZATION';
        if($name==$svk) {
            $token = $sv;
        }
    }
    $header = apache_request_headers();
    if($token=='') {
        foreach($header as $hrk => $hr) {
            if($hrk=='Authorization') {
                $token = $hr;
            }
        }
    }
    //echo var_dump($token);
    return $token;
}
function tokenNew($data = []) {
    $token = generateRandomString();
    $connect = konekDB();
    
    $siswa  = isset($data['siswa'])?$data['siswa']:'';
    $guru   = isset($data['guru'])?$data['guru']:'';
    
    $query = $connect->query("INSERT INTO token(`token`,`guru`,`siswa`) VALUES ('$token','$guru','$siswa')");
    
    return $token;
}

function tokenRead() {
    $token = tokenRet();
    $connect = konekDB();
    
    $query = $connect->query("SELECT * FROM token where token='$token'");
    
    $status = false;
    $retdata = [];
    if(mysqli_num_rows($query)>0) {
        $data = mysqli_fetch_assoc($query);
        $retdata = ["guru"=>$data['guru'],"siswa"=>$data['siswa']];
        $status = true;
    }
    return ["status"=>$status,"data"=>$retdata];
}

function tokenDelete() {
    
}

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

function checkTimeLimit($absenId) {
    $conn = konekDB();
    // Mengatur zona waktu menjadi 'Asia/Jakarta'
    date_default_timezone_set('Asia/Jakarta');

    $current = date("Y-m-d H:i:s");
    
    $query = "SELECT batas_waktu, batas_tanggal FROM jadwal_masuk WHERE id = '$absenId'";
    $result = $conn->query($query);
    
    //echo var_dump($result->num_rows);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $batasWaktu = $row['batas_waktu'];
        $batasTanggal = $row['batas_tanggal'];
        $batas = date("Y-m-d H:i:s", strtotime("$batasTanggal $batasWaktu"));
        
        //echo var_dump($batas." - ".$current);

        if ($current<=$batas) {
            return true;
        }
    }

    //return false;
}