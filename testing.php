<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_presensi");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Query untuk mengambil data dari tabel
$query = "SELECT keterangan, COUNT(*) FROM presensi_masuk";
$result = mysqli_query($koneksi, $query);

// Buat array untuk menyimpan label dan nilai
$labels = array();
$values = array();

// Ambil data dari hasil query
while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['keterangan'];
    $values[] = $row['COUNT(*)'];
}

// Tutup koneksi database
mysqli_close($koneksi);
?>

<!-- Buat tampilan grafik menggunakan library grafik, misalnya Chart.js -->
<!DOCTYPE html>
<html>
<head>
    <title>Grafik</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart"></canvas>

    <script>
    // Ambil data dari PHP dan gunakan untuk membuat grafik
    var labels = <?php echo json_encode($labels); ?>;
    var values = <?php echo json_encode($values); ?>;

    // Membuat grafik menggunakan Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar', // Jenis grafik (misalnya bar, line, pie)
        data: {
            labels: labels, // Label dari data
            datasets: [{
                label: 'Grafik', // Label untuk grafik
                data: values, // Nilai dari data
                backgroundColor: 'rgba(0, 123, 255, 0.5)', // Warna latar belakang batang
                borderColor: 'rgba(0, 123, 255, 1)', // Warna garis batang
                borderWidth: 1 // Lebar garis batang
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true // Mulai sumbu Y dari nol
                }
            }
        }
    });
    </script>
</body>
</html>
