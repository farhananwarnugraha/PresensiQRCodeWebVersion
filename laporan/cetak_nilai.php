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
// Kopsurat
$pdf->Image('../style/logoMI.png',8, 7, 20, 20);
$pdf->Cell(190,7,'KEMENTERIAN AGAMA',0,1,'C');
$pdf->Cell(190,7,'MADRASAH IBTIDAIYAH (MI) KERTAYASA',0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,7,'Jl. Buyut Lampe Pakarden, Kertayasa, Kec. Sindangagung, Kabupaten Kuningan, Jawa Barat 45573',0,1,'C');
$pdf->Cell(190,0.6,'','0','1','C',true);
//kopsurat

$pdf->Cell(190,7,'REKAPITULASI ABSENSI SISWA',0,1,'C');
$pdf->Cell(28,6,'No Induk Siswa : ',0,0);
$pdf->Cell(30,6,$_GET['nis_siswa'],0,0);
$pdf->Cell(10,7,'',0,1);
$pdf->Cell(19,6,'Semester : ',0,0);
$pdf->Cell(20,6,$_GET['nilai_semester'],0,0);;
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,8,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(8,6,'NO',1,0,'C');
$pdf->Cell(60,6,'Nama Siswa',1,0,'C');
$pdf->Cell(50,6,'Mata Pelajaran',1,0,'C');
$pdf->Cell(30,6,'Rata Rata Nilai',1,0,'C');
$pdf->Cell(23,6,'Nilai Akhir',1,0,'C');
$pdf->Cell(20,6,'Nilai Huruf',1,1,'C');
 
$pdf->SetFont('Arial','',10);
 
//koneksi ke database
$mysqli = new mysqli("localhost","root","","siamad_db");
$no = 1;
$tampil = mysqli_query($mysqli, "SELECT presensi_mapel.id_presensi,presensi_mapel.nama_mapel,presensi_mapel.waktu_presensi,presensi_mapel.keterangan,presensi_mapel.siswa,presensi_mapel.pertemuan,siswa.id_siswa,siswa.nis_siswa,siswa.nama_siswa,siswa.kelas_siswa,siswa.jurusan_siswa,kelas.id_kelas,kelas.nama_kelas,jurusan.id_jurusan,jurusan.nama_jurusan,matapelajaran.id_mapel,matapelajaran.nama_mapel FROM `presensi_mapel` JOIN siswa ON siswa.id_siswa = presensi_mapel.siswa JOIN matapelajaran ON matapelajaran.id_mapel = presensi_mapel.nama_mapel JOIN kelas ON kelas.id_kelas = siswa.kelas_siswa JOIN jurusan ON jurusan.id_jurusan = siswa.jurusan_siswa
WHERE matapelajaran.`nama_mapel`=$_GET[nis_siswa] AND siamad_nilai.`nilai_semester`=$_GET[nilai_semester]");
while ($hasil = mysqli_fetch_array($tampil)){
    $pdf->Cell(8,6,$no++,1,0,'C');
    $pdf->Cell(60,6,htmlspecialchars($hasil['nama_siswa']),1,0);
    $pdf->Cell(50,6,htmlspecialchars($hasil['nama_mapel']),1,0);
    $pdf->Cell(30,6,$hasil['rph'],1,0,'C');
    $pdf->Cell(23,6,$hasil['akhir_nilai'],1,0,'C');
    $pdf->Cell(20,6,$hasil['pred_nilai'],1,1,'C'); 
}
 
$pdf->Output();


?>