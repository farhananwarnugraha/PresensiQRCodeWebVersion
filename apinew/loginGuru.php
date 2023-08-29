<?php
// Panggil koneksi database
require_once '../config/database.php';
require_once '../config/module.php';

// Set header JSON
// Header JSON
header("Access-Control-Allow-Origin", "*");
header("Access-Control-Allow-Methods", "GET,PUT,PATCH,POST,DELETE");
header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

// Menerima input
$username = isset($_POST['username'])?$_POST['username']:'';
$password = isset($_POST['password'])?md5($_POST['password']):'';

// Validasi data
if ($connect) {
    // Query untuk melakukan login
    $query = "SELECT * FROM guru WHERE nip_guru = '$username' AND pass_guru = '$password'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $guruId = $row['id_guru'];
        $nama = $row['nama_guru'];
        $nip = $row['nip_guru'];

        // Query untuk mendapatkan jumlah mata pelajaran
        $queryJumlahMapel = "SELECT COUNT(*) AS jumlah_mapel FROM matapelajaran WHERE guru_mapel = '$guruId'";
        $resultJumlahMapel = mysqli_query($connect, $queryJumlahMapel);
        $rowJumlahMapel = mysqli_fetch_assoc($resultJumlahMapel);
        $jumlahMapel = $rowJumlahMapel['jumlah_mapel'];

        // Query untuk mendapatkan daftar mata pelajaran yang diampu
        $queryMapel = "SELECT * FROM matapelajaran WHERE guru_mapel = '$guruId'";
        $resultMapel = mysqli_query($connect, $queryMapel);

        $datareturn = [
            'nama' => $nama,
            'nip' => $nip,
            'jumlah_matapelajaran' => $jumlahMapel,
            'daftar_matapelajaran' => array()
        ];

        while ($rowMapel = mysqli_fetch_assoc($resultMapel)) {
            $datareturn['daftar_matapelajaran'][] = $rowMapel;
        }

        $datareturn['token'] = tokenNew(["guru"=>$guruId]);

        $message = "Login Success";
        responseSuccess($message, $datareturn);
    } else {
        $message = "Username and Password tidak cocok";
        responseError($message);
    }
} else {
    $message = "Database can't connect";
    responseError($message);
}
mysqli_close($connect);
?>
