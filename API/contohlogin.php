<?php

// Membuat koneksi ke database
$hostname = "localhost";
   //  $database = "db_presensi";
   //  $username = "root";
   //  $password = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_presensi";
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi database
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Mengatur header response menjadi JSON
header('Content-Type: application/json');

// Mendapatkan data dari permintaan HTTP
$data = json_decode(file_get_contents('php://input'), true);

// Menangani permintaan login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($data['nis_siswa']) && isset($data['pass_siswa'])) {
    $username = $data['nis_siswa'];
    $password = $data['pass_siswa'];

    // Memeriksa kecocokan username dan password dalam database
    $sql = "SELECT * FROM siswa WHERE nis_siswa = '$username' AND pass_siswa = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login berhasil
        session_start();
        $_SESSION['nis_siswa'] = $username;
        echo json_encode(['message' => 'Login berhasil']);
    } else {
        // Login gagal
        echo json_encode(['message' => 'Login gagal']);
    }
}

// Menangani permintaan logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($data['logout'])) {
    // Menghancurkan sesi dan menghapus data sesi
    session_start();
    session_destroy();
    echo json_encode(['message' => 'Logout berhasil']);
}

// Menangani permintaan cek status sesi dan mengambil data dashboard
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['nis_siswa'])) {
    // Mengambil data dari database berdasarkan username yang di-session
    $username = $_SESSION['nis_siswa'];
    $sql = "SELECT siswa.id_siswa, siswa.nis_siswa,siswa.nama_siswa, siswa.kelas_siswa, siswa.jurusan_siswa, jurusan.id_jurusan, jurusan.nama_jurusan, kelas.id_kelas, kelas.nama_kelas
            FROM siswa
            JOIN kelas ON kelas.id_kelas = siswa.kelas_siswa
            JOIN jurusan ON jurusan.id_jurusan = siswa.jurusan_siswa WHERE nis_siswa = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mengonversi hasil query menjadi array asosiatif
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode(['message' => 'Data tidak ditemukan']);
    }
} else {
    echo json_encode(['message' => 'Sesi tidak aktif']);
}

// Menutup koneksi database
$conn->close();

?>
