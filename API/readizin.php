<?php
// Mengatur header agar mengizinkan permintaan dari berbagai sumber (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Menghubungkan ke database (gantikan dengan informasi database Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_presensi";

$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi database
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Mengambil data dari tabel database
$sql = "SELECT * FROM perizinan";
$result = $conn->query($sql);

// Memeriksa apakah terdapat data yang diambil
if ($result->num_rows > 0) {
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            "id" => $row["id_izin"],
            "nama" => $row["siswa"],
            "keterangan" => $row["kerterangan_izin"],
            "gambar_nama" => $row["nama_gambar"]
        );
    }

    $response = array(
        "status" => "success",
        "message" => "Data berhasil diambil dari database.",
        "data" => $data
    );
} else {
    $response = array(
        "status" => "error",
        "message" => "Tidak ada data yang ditemukan dalam database."
    );
}

// Menutup koneksi database
$conn->close();

// Mengembalikan response dalam format JSON
echo json_encode($response);
?>
