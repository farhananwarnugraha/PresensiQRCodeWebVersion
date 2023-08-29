<?php
    require '../connection.php';

    if(isset($_POST["ubah"])){

      $kd_keps = $_POST['nip_kepsek'];
        $nama_kepsek = $_POST['nama_kepsek'];
        $alamat_kepsek = $_POST['alamat_kepsek'];
        $tlp_kepsek = $_POST['tlp_kepsek'];
        $status = $_POST['status_kepsek'];
        $pwd_kepsek = $_POST['pawd_kepsek'];

      $update= "UPDATE siamad_kepsek SET 
                nip_kepsek = '$kd_keps', 
                nama_kepsek = '$nama_kepsek', 
                alamat_kepsek = '$alamat_kepsek', 
                tlp_kepsek = '$tlp_kepsek',
                status_kepsek = '$status',
                pawd_kepsek = '$pwd_kepsek'
                WHERE nip_kepsek = '$kd_keps' ";
      $query = mysqli_query($connect, $update);
        //cekdata berhasil ditambahkan
        if ($query) {
          echo "
            <script>
            alert('Data Kepala Sekolah Berhasil diupdate');
            document.location='admin_kepsek.php?status=sukses';
            </script>";
        }
        else{
          echo "
            <script>
            alert('Data Kepala Sekolah Gagal diupdate');
            document.location='admin_kepsek.php?status=gagal';
            </script>";
        }

      }
      ?>