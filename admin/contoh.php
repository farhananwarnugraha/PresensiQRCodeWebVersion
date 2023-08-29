<?php
// 1. Terhubung ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_presensi");

// 2. Ambil data gambar dari database
$query = "SELECT status, gambar_bukti FROM perizinan";
$result = mysqli_query($koneksi, $query);

// 3. Tampilkan gambar
while ($row = mysqli_fetch_assoc($result)) {
    $nama = $row['status'];
    $fileData = $row['gambar_bukti'];

    // Mengubah data gambar menjadi format base64
    $base64Data = base64_encode($fileData);
    $imageSrc = "data:image/jpeg;base64," . $base64Data;

    // Menampilkan gambar
    echo "<h2>$nama</h2>";
    echo "<img src='$imageSrc' alt='$nama' />";
}

// Tutup koneksi
mysqli_close($koneksi);
?>
