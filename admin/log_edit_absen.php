<?php
    require '../connection.php';

    if(isset($_POST["ubah"])){
      $nis = $_POST['nis_siswa'];
      $pertemuan = $_POST['pertemuan'];
      $tgl_absen = $_POST['tgl_absen'];
      $keterangan = $_POST['keterangan'];
      $semester = $_POST['semester'];

      $update_nilai = "UPDATE siamad_absen SET
                        nis_siswa = '$nis',
                        pertemuan = '$pertemuan',
                        keterangan ='$keterangan',
                        semester = '$semester'
                        WHERE nis_siswa = $nis";

      $query = mysqli_query($connect, $update_nilai);
        //cekdata berhasil ditambahkan
        if ($query) {
          echo "
            <script>
            alert('Absen Berhasil diupdate');
            document.location='admin_absen.php?status=sukses';
            </script>";
        }
        else{
          echo "
            <script>
            alert('Absen Gagal diupdate');
            document.location='admin_absen.php?status=gagal';
            </script>";
        }

      }
      ?>