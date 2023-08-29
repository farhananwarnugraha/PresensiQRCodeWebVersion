<?php
// Panggil koneksi database
require_once '../config/database.php';
require_once '../config/module.php';

// Set header JSON
header("Access-Control-Allow-Origin", "*");
header("Access-Control-Allow-Methods", "GET,PUT,PATCH,POST,DELETE");
header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

// Menerima input
$username = isset($_POST['username'])?$_POST['username']:'';
$password = isset($_POST['password'])?md5($_POST['password']):'';

//echo var_dump($_POST);

// Validasi data
if ($connect) {
    // Query untuk memeriksa kecocokan username dan password
    $sql = "SELECT siswa.id_siswa, siswa.nis_siswa, siswa.nama_siswa, siswa.kelas_siswa, siswa.jurusan_siswa, jurusan.id_jurusan, jurusan.nama_jurusan, kelas.id_kelas, kelas.nama_kelas
            FROM siswa
            JOIN kelas ON kelas.id_kelas = siswa.kelas_siswa
            JOIN jurusan ON jurusan.id_jurusan = siswa.jurusan_siswa
            WHERE nis_siswa = '$username' AND pass_siswa = '$password'";
    //echo var_dump($_SERVER);
    $hasil = mysqli_query($connect, $sql);

    if (mysqli_num_rows($hasil) > 0) {
        $row = mysqli_fetch_assoc($hasil);
        //$hasil_code = true;
        $message = "Login Success";

        // Ambil data presensi siswa
        $siswaId = $row['id_siswa'];
        $queryPresensi = "SELECT keterangan, COUNT(*) AS jumlah FROM presensi_masuk WHERE siswa = '$siswaId' GROUP BY keterangan";
        $resultPresensi = mysqli_query($connect, $queryPresensi);

        $rekapPresensi = array(
            'Hadir' => 0,
            'Izin' => 0,
            'Alpa' => 0,
            'Sakit' => 0
        );

        while ($rowPresensi = mysqli_fetch_assoc($resultPresensi)) {
            $keterangan = $rowPresensi['keterangan'];
            $jumlah = $rowPresensi['jumlah'];
            $rekapPresensi[$keterangan] = $jumlah;
        }
        
        // panggil api
        $token = tokenNew(["siswa"=>$siswaId]);
        
        $datareturn = [
            'nis_siswa' => $row['nis_siswa'],
            'nama_siswa' => $row['nama_siswa'],
            'kelas' => $row['nama_kelas'],
            'jurusan' => $row['nama_jurusan'],
            //'rekap_presensi' => $rekapPresensi,
            'token' => $token
        ];
        responseSuccess($message, $datareturn);
        
        /*
        // Buat response JSON
        $response = array(
            'result_code' => $hasil_code,
            'status' => $status,
            'data' => array(
                
            )
        );

        echo json_encode($response);
         * 
         */
    } else {
        $message = "Username and Password Tidak Cocok";
        responseError($message,[
            'nis_siswa' => '',
            'nama_siswa' => '',
            'kelas' => '',
            'jurusan' => '',
            'token' => generateRandomString()
        ]);
    }
} else {
    $message = "Database can't connect";
    responseError($message,[
            'nis_siswa' => '',
            'nama_siswa' => '',
            'kelas' => '',
            'jurusan' => '',
            'token' => generateRandomString()
        ]);
}

mysqli_close($connect);
?>
