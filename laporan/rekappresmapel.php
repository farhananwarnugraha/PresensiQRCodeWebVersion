<?php
//menyertakan file fpdf, file fpdf.php di dalam folder FPDF yang diekstrak
include "fpdf.php";

//membuat objek baru bernama pdf dari class FPDF
//dan melakukan setting kertas l : landscape, A5 : ukuran kertas
$pdf = new FPDF('p','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// menyetel font yang digunakan, font yang digunakan adalah arial, bold dengan ukuran 16
$pdf->SetFont('Arial','B',16);
// Kop Surat
$pdf->Image('../style/logorota.png',8, 7, 20, 20);
$pdf->Cell(190,7,'KEMENTERIAN PENDIDIKAN DAN KEBUDYAAN',0,1,'C');
$pdf->Cell(190,7,'SMK NEGERI 1 ROTA BAYAT',0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,7,'Jl. Cawas - Bayat No.Km. 1, Kebu, Beluk, Kec. Bayat, Kabupaten Klaten, Jawa Tengah 57462',0,1,'C');
$pdf->Cell(190,0.6,'','0','1','C',true);
//kopsurat
//judul surat
$pdf->Cell(190,7,'REKAP PRESENSI MASUK SISWA',0,1,'C');
$pdf->Cell(30,6,'Kode Kelas : ',0,0);
$pdf->Cell(40,6,$_POST['kelas'],0,0);
$pdf->Cell(10,7,'',0,1);
$pdf->Cell(30,6,'Tanggal : ',0,0);
$pdf->Cell(35,6,$_POST['waktu_presensi'],0,0);
$pdf->Cell(10,7,'',0,1);
$pdf->Cell(30,6,'Matapelajaran : ',0,0);
$pdf->Cell(35,6,$_POST['mapel'],0,0);

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 10, 'No', 1, 0, 'C');
$pdf->Cell(30, 10, 'NIS', 1, 0, 'C');
$pdf->Cell(50, 10, 'Nama', 1, 0, 'C');
$pdf->Cell(40, 10, 'Tanggal', 1, 0, 'C');
$pdf->Cell(40, 10, 'Waktu', 1, 0, 'C');
$pdf->Cell(20, 10, 'Ket.', 1, 1, 'C');
 
$pdf->SetFont('Arial','',10);
 
// koneksi ke database
$mysqli = new mysqli("localhost","root","","db_presensi");
$no = 1;
// $hadir = mysqli_query($mysqli, "SELECT * FROM siamad_absen
//                                 WHERE keteangan = 'Hadir' AND kd_kelas ='$_POST[kelas_siswa]' AND semester = '$_POST[semester]'");
// // $jumlah_hadir = mysqli_num_row($hadir);
$tampil = mysqli_query($mysqli, "SELECT presensi_mapel.id_presensi,presensi_mapel.nama_mapel,presensi_mapel.waktu_presensi,presensi_mapel.keterangan,presensi_mapel.siswa,presensi_mapel.pertemuan,siswa.id_siswa,siswa.nis_siswa,siswa.nama_siswa,siswa.kelas_siswa,siswa.jurusan_siswa,kelas.id_kelas,kelas.nama_kelas,jurusan.id_jurusan,jurusan.nama_jurusan,matapelajaran.id_mapel,matapelajaran.nama_mapel 
                                    FROM `presensi_mapel` 
                                    JOIN siswa ON siswa.id_siswa = presensi_mapel.siswa 
                                    JOIN matapelajaran ON matapelajaran.id_mapel = presensi_mapel.nama_mapel 
                                    JOIN kelas ON kelas.id_kelas = siswa.kelas_siswa 
                                    JOIN jurusan ON jurusan.id_jurusan = siswa.jurusan_siswa 
                                    WHERE kelas.`nama_kelas`='$_POST[kelas]' 
                                    AND presensi_mapel.`pertemuan`='$_POST[pertemuan]' 
                                    AND matapelajaran.`nama_mapel`='$_POST[mapel]'");



while ($hasil = mysqli_fetch_array($tampil)){
    $pdf->Cell(8,6,$no++,1,0,'C');
    $pdf->Cell(35,6,$hasil['nis_siswa'],1,0);
    $pdf->Cell(80,6,$hasil['nama_siswa'],1,0);
    $pdf->Cell(48,6,$hasil['keterangan'],1,1,'C'); 
}
// $pdf->Cell(8,6,'Total Kehadiran : ',1,0,'C');
// $pdf->Cell(8,6,$jumlah_hadir,1,0,'C');
 
$pdf->Output();


?>