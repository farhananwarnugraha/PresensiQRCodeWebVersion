<?php
    require '../connection.php';

    if(isset($_POST["submit"])){
      $kd_nilai = $_POST['kd_nilai'];
      $nis  = $_POST['nis_siswa'];
      $kdmapel = $_POST['kd_mapel'];
      $ph1 = $_POST['ph_satu'];
      $ph2 = $_POST['ph_dua'];
      $ph3 = $_POST['ph_tiga'];
      $ph4 = $_POST['ph_empat'];
      $ph5 = $_POST['ph_lima'];
      $ph6 = $_POST['ph_enam'];
      $ph7 = $_POST['ph_tujuh'];
      $ph8 = $_POST['ph_delapan'];
      $rnh = ($ph1+$ph2+$ph3+$ph4+$ph5+$ph6+$ph7+$ph8)/8;
      $pts = $_POST['pts'];
      $pas = $_POST['pas'];
      $tn  = (0.4*$rnh)+(0.3*$pts)+(0.3*$pas);
      if ($tn >=81 && $tn<=100) {
          $pred = 'A';
      }
      elseif ($tn >=61 && $tn <=80) {
          $pred = 'B';
      } 
      elseif ($tn >=41 && $tn <= 60) {
        $pred = 'C';
      }
      elseif ($tn >=21 && $tn <= 40) {
         $pred = 'D';
      }
      elseif ($tn >= 11 && $tn <= 20) {
        $pred = 'E';
      }
      else {
         $pred = 'F';
      }
      $update_nilai = "UPDATE siamad_nilai SET
                        kd_nilai = $kd_nilai,
                        nis_siswa = '$nis',
                        kd_mapel = '$kdmapel',
                        ph_satu = $ph1,
                        ph_dua = $ph2,
                        ph_tiga = $ph3,
                        ph_empat = $ph4,
                        ph_lima = $ph5,
                        ph_enam = $ph6,
                        ph_tujuh = $ph7,
                        ph_delapan = $ph8,
                        rph = $rnh,
                        pts_nilai = $pts,
                        pas_nilai = $pas,
                        akhir_nilai = $tn,
                        pred_nilai = '$pred'
                        WHERE kd_nilai = $kd_nilai";

      $query = mysqli_query($connect, $update_nilai);
        //cekdata berhasil ditambahkan
        if ($query) {
          echo "
            <script>
            alert('Nilai Berhasil diupdate');
            document.location='admin_nilai.php?status=sukses';
            </script>";
        }
        else{
          echo "
            <script>
            alert('Nilai Gagal diupdate');
            document.location='admin_nilai.php?status=gagal';
            </script>";
        }

      }
      ?>