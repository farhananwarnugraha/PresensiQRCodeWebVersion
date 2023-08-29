<?php
     //koneksi database
  $connect = mysqli_connect("localhost","root","","db_presensi");

  function query($query){
      global $connect;
      
      $result = mysqli_query($connect, $query);
      $rows = [];
      while( $row = mysqli_fetch_assoc($result)){
          $rows[] = $row;
      }
      return $rows;
    }

    function tambah_guru($data){
        global $connect;
        //mengambildata dari from
        $id_guru = mt_rand(1000, 9999);
        $nip_guru  = htmlspecialchars($data['nip_guru']);
        $nama_guru = htmlspecialchars($data['nama_guru']);
        $alamat_guru = htmlspecialchars($data['alamat_guru']);
        $kota_guru = htmlspecialchars($data['kota_guru']);
        $jenis_kelamin =    htmlspecialchars($data['jenis_kelamin']);
        $no_tlp =    htmlspecialchars($data['no_tlp']);
        $pass =   md5($nip_guru);
         //query insert
         $insert = "INSERT INTO guru VALUE ('$id_guru', '$nip_guru', '$nama_guru','$alamat_guru','$kota_guru','$jenis_kelamin',
         '$no_tlp', '$pass')";
         mysqli_query($connect, $insert);

         return mysqli_affected_rows($connect);

    }

    function tambah_admin($data){
        global $connect;
        //mengambildata dari from
        $id_admin = mt_rand(1000, 9999);
        $username_admin = htmlspecialchars($data['usename_admin']);
        $nama_admin = htmlspecialchars($data['nama_admin']);
        $pass_admin = md5($username_admin);
         //query insert
         $insert = "INSERT INTO admin VALUES ('$id_admin','$username_admin','$nama_admin','$pass_admin')";
         mysqli_query($connect, $insert);

         return mysqli_affected_rows($connect);

    }
    function tambah_siswa($data){
        global $connect;
        //mengambildata dari from
        $id_siswa = mt_rand(1000, 9999);
        $nis_siswa = $data['nis_siswa'];
        $nama_lengkap = htmlspecialchars($data['nama_siswa']);
        $alamat_lengkap = htmlspecialchars($data['alamat_siswa']);
        $asal_kota = htmlspecialchars($data['kota_siswa']);
        $tgl_lahir = htmlspecialchars($data['tgl_lahir']);
        $no_tlp = $data['no_tlp'];
        $kelas = $data['kelas_siswa'];
        $jurusan = $data['jurusan_siswa'];
        $pass_siswa = md5($nis_siswa);
         //query insert
         $insert = "INSERT INTO siswa VALUES ('$id_siswa','$nis_siswa','$nama_lengkap','$alamat_lengkap','$asal_kota','$tgl_lahir','$no_tlp','$kelas','$jurusan','$pass_siswa')";
         mysqli_query($connect, $insert);

         return mysqli_affected_rows($connect);

    }

    function tambah_ortu($data){
        global $connect;
        //mengambildata dari from
        $id_orangtua = mt_rand(1000, 9999);
        $nama_orangtua = $data['nama_orangtua'];
        $alamat_lengkap = htmlspecialchars($data['alamat_ortu']);
        $no_tlp = $data['telp_ortu'];
        $siswa = $data['siswa_orangtua'];
         //query insert
         $insert = "INSERT INTO orangtua VALUES ('$id_orangtua','$nama_orangtua','$alamat_lengkap','$siswa','$no_tlp')";
         mysqli_query($connect, $insert);

         return mysqli_affected_rows($connect);

    }

    // function tambah_nilai($nilai){
    //         global $connect;
            
    //         $nis  = htmlspecialchars($nilai['nis_siswa']);
    //         $kdmapel = htmlspecialchars($nilai['kd_mapel']);
    //         $nilai_semester = $_POST['nilai_semester'];
    //         $ph1 = $_POST['ph_satu'];
    //         $ph2 = $_POST['ph_dua'];
    //         $ph3 = $_POST['ph_tiga'];
    //         $ph4 = $_POST['ph_empat'];
    //         $ph5 = $_POST['ph_lima'];
    //         $ph6 = $_POST['ph_enam'];
    //         $ph7 = $_POST['ph_tujuh'];
    //         $ph8 = $_POST['ph_delapan'];
    //         $rnh = ($ph1+$ph2+$ph3+$ph4+$ph5+$ph6+$ph7+$ph8)/8;
    //         $pts = $_POST['pts'];
    //         $pas = $_POST['pas'];
    //         $tn  = (0.4*$rnh)+(0.3*$pts)+(0.3*$pas);
    //         if ($tn >=81 && $tn<=100) {
    //                 echo $pred = 'A';
    //             }
    //             elseif ($tn >=61 && $tn <=80) {
    //                 echo $pred = 'B';
    //             } 
    //             elseif ($tn >=41 && $tn <= 60) {
    //                 echo $pred = 'C';
    //             }
    //             elseif ($tn >=21 && $tn <= 40) {
    //                 echo $pred = 'D';
    //             }
    //             elseif ($tn >= 11 && $tn <= 20) {
    //                 echo $pred = 'E';
    //             }
    //             else {
    //                 echo $pred = 'F';
    //             }
    //             var_dump($nis,$kdmapel,$nilai_semester,$ph1,$ph2,$ph3,$ph4,$ph5,$ph5,$ph6,$ph7,$ph8,$rnh,$pts,$pas,$tn,$pred);
    //             $insert_nilai = "INSERT INTO siamad_nilai 
    //                             VALUES 
    //                             (' ','$nis','$kdmapel','$nilai_semester','$ph1','$ph2','$ph3','$ph4','$ph5','$ph6','$ph7','$ph8','$rnh','$pts','$pas','$tn','$pred')";
    //             mysqli_query($connect,$insert_nilai);
    //             return mysqli_affected_rows($connect);
    // }

    // function edit_nilai($data){
    //     global $connect;

    //     $kd_nilai = $_POST['kd_nilai'];
    //     $nis  = htmlspecialchars($nilai['nis_siswa']);
    //     $kdmapel = htmlspecialchars($nilai['kd_mapel']);
    //     $ph1 = $_POST['ph_satu'];
    //     $ph2 = $_POST['ph_dua'];
    //     $ph3 = $_POST['ph_tiga'];
    //     $ph4 = $_POST['ph_empat'];
    //     $ph5 = $_POST['ph_lima'];
    //     $ph6 = $_POST['ph_enam'];
    //     $ph7 = $_POST['ph_tujuh'];
    //     $ph8 = $_POST['ph_delapan'];
    //     $rnh = ($ph1+$ph2+$ph3+$ph4+$ph5+$ph6+$ph7+$ph8)/8;
    //     $pts = $_POST['pts'];
    //     $pas = $_POST['pas'];
    //     $tn  = (0.4*$rnh)+(0.3*$pts)+(0.3*$pas);
    //         if ($tn >=81 && $tn<=100) {
    //             $pred = 'A';
    //         }
    //         elseif ($tn >=61 && $tn <=80) {
    //            $pred = 'B';
    //         } 
    //         elseif ($tn >=41 && $tn <= 60) {
    //             $pred = 'C';
    //         }
    //         elseif ($tn >=21 && $tn <= 40) {
    //             $pred = 'D';
    //         }
    //         elseif ($tn >= 11 && $tn <= 20) {
    //             $pred = 'E';
    //         }
    //         else {
    //             $pred = 'F';
    //         }

    //     $update_nilai = "UPDATE siamad_nilai SET
    //                     nis_siswa = '$nis',
    //                     kd_mapel = '$kdmapel',
    //                     ph_satu = $ph1,
    //                     ph_dua = $ph2,
    //                     ph_tiga = $ph3,
    //                     ph_empat = $ph4,
    //                     ph_lima = $ph5,
    //                     ph_enam = $ph6,
    //                     ph_tujuh = $ph7,
    //                     ph_delapan = $ph8,
    //                     rph = $rnh,
    //                     pts_nilai = $pts,
    //                     pas_nilai = $pas,
    //                     akhir_nilai = $tn,
    //                     pred_nilai = '$pred'
    //                     WHERE kd_nilai = $kd_nilai";
    //     mysqli_query($connect, $update_nilai);
    //     return mysqli_affected_rows($connect);
    // }

    // function edit_guru($edit){
    //         global $connect;

    //         $nip  = $edit['nik_guru'];
    //         $nama = $edit['nama_guru'];
    //         $lahir = $edit['lahir_guru'];
    //         $alamat = $edit['alamat_guru'];
    //         $tlp =    $edit['tlp_guru'];
    //         $pass =   $edit['pwd_guru'];

    //         $update_guru = "UPDATE siamad_guru 
    //                         SET 
    //                         nama_guru = '$nama', 
    //                         lahir_guru = '$lahir', 
    //                         alamat_guru = '$alamat',
    //                         tlp_guru = '$tlp', 
    //                         pwd_guru = '$pass'
    //                         WHERE nik_guru= '$nip'";
    //         mysqli_query($connect, $update_guru);

    //      return mysqli_affected_rows($connect);
    // }

    function absen($absen){
            global $connect;

            $nis = $_POST['nis_siswa'];
            $tgl_absen = $_POST['tgl_absen'];
            $keterangan = $_POST['keterangan'];
            $jam_absen = $_POST['jam_absen'];
            // var_dump($nis,$tgl_absen,$jam_absen,$keterangan);
            // exit;

            $tambah_absen = "INSERT INTO presensi_masuk VALUES (' ' , '$tgl_absen','$jam_absen','$keterangan','$nis')";
            mysqli_query($connect, $tambah_absen);
            return mysqli_affected_rows($connect);
        }

    function absen_mapel($absen){
            global $connect;

            $id_presensi = mt_rand(1000, 9999);
            $nama_mapel = $_POST['nama_mapel'];
            $waktu_presensi = $_POST['waktu_presensi'];
            $keterangan = $_POST['keterangan'];
            $nis = $_POST['nis_siswa'];
            $pertemuan = $_POST['pertemuan'];
            // var_dump($id_presensi,$nama_mapel,$waktu_presensi,$keterangan,$nis,$pertemuan);
            // exit;
            
            $presensi_mapel = "INSERT INTO presensi_mapel VALUES ('$id_presensi','$nama_mapel','$waktu_presensi','$keterangan','$nis','$pertemuan')";
            mysqli_query($connect, $presensi_mapel);
            return mysqli_affected_rows($connect);
        }

    function tambah_kelas($data){
            global $connect;

            $id_kelas = mt_rand(1000, 9999);
            $nama_kelas = $_POST['nama_kelas'];
            $jurusan = $_POST['jurusan'];

            $query = "INSERT INTO kelas VALUES ('$id_kelas','$nama_kelas','$jurusan')";
            mysqli_query($connect,$query);
            return mysqli_affected_rows($connect);
    }

    function tambah_jurusan($data){
            global $connect;

            $id_jurusan = mt_rand(1000, 9999);
            $nama_jurusan = $_POST['nama_jurusan'];

            $query = "INSERT INTO jurusan VALUES ('$id_jurusan','$nama_jurusan')";
            mysqli_query($connect,$query);
            return mysqli_affected_rows($connect);
    }

    function buat_pengumuman($data){
            global $connect;

            $id_pengumuman = mt_rand(1000, 9999);
            $tgl_pengumuman = $_POST['tgl'];
            $isi_pengumuman = $_POST['isi_pengumuman'];

            $query = "INSERT INTO pengumuman VALUES ('$id_pengumuman','$tgl_pengumuman','$isi_pengumuman')";
            mysqli_query($connect,$query);
            return mysqli_affected_rows($connect);
    }
    // // function hapus_data($nip){
    // //     global $connect;
    // //     mysqli_query($connect, "DELETE FROM guru_siamad WHERE nik_guru = $nip");

    // //     return mysqli_affected_rows($connect);
    // // }
    // function tambah_kurikulum($data){
    //     global $connect;

    //     $kd_kurikulum = $_POST['kd_kurikulum'];
    //     $nama_kurikulum = $_POST['nama_kurikulum'];
    //     $status_kurukulum = $_POST['status_kurukulum'];

    //     $input_kurikulum = "INSERT INTO siamad_kurikulum VALUES ('$kd_kurikulum','$nama_kurikulum','$status_kurukulum')";
    //     mysqli_query($connect,$input_kurikulum);
    //     return mysqli_affected_rows($connect);
    // }

    // function tambah_kepsek($data){
    //     global $connect;

    //     $kd_keps = $_POST['nip_kepsek'];
    //     $nama_kepsek = $_POST['nama_kepsek'];
    //     $alamat_kepsek = $_POST['alamat_kepsek'];
    //     $tlp_kepsek = $_POST['tlp_kepsek'];
    //     $status = $_POST['status_kepsek'];
    //     $pwd_kepsek = $_POST['pawd_kepsek'];

    //     $query = "INSERT INTO siamad_kepsek VALUES 
    //               ('$kd_kepsek','$nama_kepsek','$alamat_kepsek','$tlp_kepsek','$status','$pwd_kepsek')";
    //     mysqli_query($connect,$query);
    //     return mysqli_affected_rows($connect);

    // }
    function tambah_mapel($data){
        global $connect;

        $id_mapel = mt_rand(1000, 9999);
        $nama_mapel = $_POST['nama_mapel'];
        $guru_mapel = $_POST['nama_guru'];
        $kategori = $_POST['kategori'];

        $insert_mapel = "INSERT INTO matapelajaran VALUES  
                  ('$id_mapel','$nama_mapel','$guru_mapel','$kategori')";
        mysqli_query($connect,$insert_mapel);
        return mysqli_affected_rows($connect);
    }

    // function edit_kurikulum($data){
    //     global $connect;

    //     $kd_kurikulum = $_POST['kd_kurikulum'];
    //     $nama_kurikulum = $_POST['nama_kurikulum'];
    //     $status_kurukulum = $_POST['status_kurukulum'];
      

    //     $update= "UPDATE siamad_kurikulum SET 
    //             kd_kurikulum = '$kd_kurikulum', 
    //             nama_kurikulum = '$nama_kurikulum', 
    //             status_kurukulum = '$status_kurukulum',
    //             WHERE kd_kurikulum = '$kd_kurikulum' ";
    //     mysqli_query($connect,$update);
    //     return mysqli_affected_rows($connect);

    // }

    
?>  