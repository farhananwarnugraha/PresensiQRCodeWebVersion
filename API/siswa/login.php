<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');

    //menerima input
    $username = $_POST['nis_siswa'];
    $password = md5($_POST['pass_siswa']);
    //validasi data
    if ($connect) {
        $sql = "SELECT siswa.id_siswa, siswa.nis_siswa,siswa.nama_siswa, siswa.kelas_siswa, siswa.jurusan_siswa, jurusan.id_jurusan, jurusan.nama_jurusan, kelas.id_kelas, kelas.nama_kelas
                FROM siswa
                JOIN kelas ON kelas.id_kelas = siswa.kelas_siswa
                JOIN jurusan ON jurusan.id_jurusan = siswa.jurusan_siswa WHERE nis_siswa = '$username' AND pass_siswa = '$password'";
        $hasil = mysqli_query($connect, $sql);

        if (mysqli_num_rows($hasil) > 0 ) {
            $row = mysqli_fetch_assoc($hasil);
            // echo json_encode("Success");
            $status = "Login Success";
            $hasil_code = true;
            echo json_encode(array(
                'result_code' => $hasil_code,
                'status' => $status,
                'data' => [
                    'nis_siswa' => $row['nis_siswa'],
                    'nama_siswa' => $row['nama_siswa'],
                    'kelas' => $row['nama_kelas'],
                    'jurusan' =>$row['nama_jurusan']
                ]
            ));
        }else {
            $hasil_code = false;
            // echo json_encode("error");
            $status = "Username and Password lost";
            echo json_encode(array(
                'status' => $status,
                'resul_code' => $hasil_code
            ));
        }
    }else {
        $status = failed;
        echo json_encode(array(
            'status' => $status
        ), JSON_FORCE_OBJECT);
    }
    mysqli_close($connect)
    //contoh//
    // $data = mysqli_query($connect, "SELECT * FROM siswa WHERE nis_siswa = '$username' OR pass_siswa = '$password' ");
    // $cek = mysqli_fetch_assoc($data);

    // if ($cek > 0){
    //     $response=array(
    //         'status' => 1,
    //         'message' =>'Login Success'
    //      );
    // }
    // else {
    //     $response=array(
    //         'status' => 0,
    //         'message' =>'Login Failed.'
    //      );
    // }
    // echo json_encode($response);
?>