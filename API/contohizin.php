<?php
// Mengatur header agar mengizinkan permintaan dari berbagai sumber (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Menghubungkan ke database (gantikan dengan informasi database Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contoh_uploadfile";

$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi database
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Memeriksa apakah file gambar ada dalam permintaan
if (isset($_FILES['gambar'])) {
    $gambar = $_FILES['gambar'];

    // Mendapatkan data yang dikirim melalui permintaan
    $nama = $_POST['nama'];
    $alamat = $_POST['keterangan'];
    $createdAt = new DateTime();

    // Format the date and time in the desired format (Y-m-d H:i:s)
    $createdAtFormatted = $createdAt->format('Y-m-d H:i:s');

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
        $gambarData = $conn->real_escape_string($gambarData);

        // Menyimpan data gambar ke dalam tabel database
        $sql = "INSERT INTO izin (nama, keterangan, gambar_nama, gambar_data, created_at) VALUES ('$nama', '$alamat', '$gambarName', '$gambarData', '$createdAtFormatted')";

        if ($conn->query($sql) === TRUE) {
            $response = array(
                "status" => "success",
                "message" => "Data dan gambar berhasil disimpan ke database."
            );
        } else {
            $response = array(
                "status" => "error",
                "message" => "Terjadi kesalahan saat menyimpan data dan gambar ke database: " . $conn->error
            );
        }
    } else {
        $response = array(
            "status" => "error",
            "message" => "Terjadi kesalahan saat mengunggah file gambar."
        );
    }
} else {
    $response = array(
        "status" => "error",
        "message" => "File gambar tidak ditemukan dalam permintaan."
    );
}

// Menutup koneksi database
$conn->close();

// Mengembalikan response dalam format JSON
echo json_encode($response);
?>
