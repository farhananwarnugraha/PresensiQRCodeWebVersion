<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');

    //menerima input
    $username = $_POST['nip_guru'];
    $password = md5($_POST['pass_guru']);
    //validasi data
    if ($connect) {
        $sql = "SELECT * FROM guru WHERE nip_guru = '$username' AND pass_guru = '$password'";
        $hasil = mysqli_query($connect, $sql);

        if (mysqli_num_rows($hasil) > 0 ) {
            $row = mysqli_fetch_assoc($hasil);
            $status = "Login Success";
            $hasil_code = true;
            echo json_encode(array(
                'status' => $hasil_code,
                'resul_code' => $status,
                'data ' => [
                    'nama_guru' => $row['nama_guru'],
                    'nip_guru' => $row['nip_guru']
                ]
            ));
        }else {
            $status = "Username and Password lost";
            $hasil_code = false;
            echo json_encode(array(
                'status' => $hasil_code,
                'resul_code' => $status
            ));
        }
    }else {
        $status = failed;
        echo json_encode(array(
            'status' => $status
        ), JSON_FORCE_OBJECT);
    }
    mysqli_close($connect)
?>