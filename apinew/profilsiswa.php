<?php
// Panggil koneksi database
require_once '../config/database.php';
require_once '../config/module.php';

// Set header JSON
// Header JSON
header('Content-Type: application/json');

$do = isset($_GET['do'])?$_GET['do']:'';
$id = isset($_GET['id'])?$_GET['id']:0;
$poid = isset($_POST['id'])?$_POST['id']:0;
$connect = konekDB();
$token = tokenRead();
if($token['status']==true) {
switch($do) {
    case 'edit' :
        $nama = isset($_POST['nama_siswa'])?$_POST['nama_siswa']:'';
        $alamat = isset($_POST['alamat_siswa'])?$_POST['alamat_siswa']:'';
        $kota = isset($_POST['kota_siswa'])?$_POST['kota_siswa']:'';
        $tgl = isset($_POST['tgl_lahir'])?$_POST['tgl_lahir']:'';
        $tlp = isset($_POST['no_tlp'])?$_POST['no_tlp']:'';
        $pass =   isset($_POST['pass_siswa'])?md5($_POST['pass_siswa']):md5('123456');
        
        $update= "UPDATE siswa SET 
                        nama_siswa = '$nama', 
                        alamat_siswa = '$alamat', 
                        kota_siswa = '$kota', 
                        no_tlp = '$tlp', 
                        pass_siswa = '$pass'
                        WHERE nis_siswa = '$id' ";
        //echo var_dump($update);
        $result = $connect->query($update);
        
        if($result) {
            responseSuccess("Berhasil diperbaharui");
        } else {
            responseError("Gagal memperbaharui");
        }
        break;
    case 'hadir' :
        $queryPresensi = "SELECT keterangan, COUNT(*) AS jumlah FROM presensi_masuk WHERE siswa = '$poid' GROUP BY keterangan";
        $resultPresensi = $connect->query($queryPresensi);

        $rekapPresensi = array(
            'Hadir' => 0,
            'Izin' => 0,
            'Alpa' => 0,
            'Sakit' => 0
        );

        while ($rowPresensi = mysqli_fetch_assoc($resultPresensi)) {
            $keterangan = $rowPresensi['keterangan'];
            $jumlah = $rowPresensi['jumlah'];
            $rekapPresensi[$keterangan] = (string)$jumlah;
        }
        
        responseSuccess("Berhasil load",$rekapPresensi);
        break;
    case 'jadwal' :
        // Mengeksekusi query untuk mendapatkan mata pelajaran berdasarkan jurusan
        $query = "SELECT matapelajaran.id_mapel, matapelajaran.nama_mapel, siswa.id_siswa,siswa.nis_siswa,matapelajaran.kategori_mapel, jurusan.id_jurusan FROM matapelajaran
        JOIN jurusan ON jurusan.id_jurusan = matapelajaran.kategori_mapel
        JOIN siswa ON siswa.jurusan_siswa = jurusan.id_jurusan
        WHERE siswa.nis_siswa = '$poid'";
        $result = $connect->query($query);
    
        if ($result->num_rows > 0) {
            $mataPelajaran = [];
            while ($row = $result->fetch_assoc()) {
                $mataPelajaran[] = array(
                    'id_mapel' => $row['id_mapel'],
                    'nama_mapel' => $row['nama_mapel']
                );
            }
            responseSuccess("Data loaded",$mataPelajaran);
        } else {
            responseError("Mata pelajaran tidak ditemukan untuk jurusan tersebut",[]);
        }
        break;
    case 'morehadir' :
        $queryPresensi = "SELECT * FROM presensi_masuk WHERE siswa = '$poid' ORDER BY tanggal_presensi DESC";
        $result = $connect->query($queryPresensi);
            //echo var_dump($result->fetch_assoc());
        if ($result->num_rows > 0) {
            $riw = [];
            while ($row = $result->fetch_assoc()) {
                $riw[] = array(
                    'tanggal_presensi' => $row['tanggal_presensi'],
                    'waktu_presensi' => $row['waktu_presensi'],
                    'keterangan' => $row['keterangan']
                );
            }
            responseSuccess("Data loaded",$riw);
        } else {
            responseError("Riwayat tidak ditemukan",[]);
        }
        break;
    default :
        $query = "SELECT siswa.*, kelas.id_kelas, kelas.nama_kelas
            FROM siswa
            LEFT JOIN kelas ON kelas.id_kelas = siswa.kelas_siswa
            LEFT JOIN jurusan ON jurusan.id_jurusan = siswa.jurusan_siswa 
            WHERE nis_siswa = '$poid'";//echo var_dump($query);
        $result = $connect->query($query);

        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $siswaId = $row['nis_siswa'];
            $queryPresensi = "SELECT keterangan, COUNT(*) AS jumlah FROM presensi_masuk WHERE siswa = '$poid' GROUP BY keterangan";//echo var_dump($queryPresensi);
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
            
            $datareturn = [
                'nis_siswa' => $row['nis_siswa'],
                'nama_siswa' => $row['nama_siswa'],
                'alamat_siswa'=>$row['alamat_siswa'],
                'kota_siswa' => $row['kota_siswa'],
                'tgl_lahir' => $row['tgl_lahir'],
                'no_tlp'=> $row['no_tlp'],
                'pass_siswa'=> $row['pass_siswa'],
                //'rekap_presensi' => $rekapPresensi,
            ];
            responseSuccess("Data Loaded", $datareturn);
        } else {
            responseError("Data siswa kosong",[
                'nis_siswa' => '',
                'nama_siswa' => '',
                'alamat_siswa'=>'',
                'kota_siswa' =>'',
                'tgl_lahir' => '',
                'no_tlp'=> '',
                'pass_siswa'=> '',
            ]);
        }
}
} else {
    responseError("Memerlukan token pengenal untuk mengakses fitur ini");
}


?>