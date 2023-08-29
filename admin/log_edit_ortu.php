<?php
    require '../connection.php';

    if(isset($_POST["ubah"])){

      $kd_ortu = $_POST['kd_ortu'];
      $nama_ortu =$_POST['nama_ortu'];
      $alamat_ortu = $_POST['alamat_ortu'];
      $nis_siswa =$_POST['nis_siswa'];
      $tlp_ortu =$_POST['telp_ortu'];

      // var_dump($kd_ortu,$nama_ortu,$alamat_ortu,$nis_siswa,$tlp_ortu);
      // exit;

      $update= "UPDATE orangtua SET 
                id_orangtua = '$kd_ortu', 
                nama_orangtua = '$nama_ortu', 
                alamat_ortu = '$alamat_ortu',
                siswa_orangtua = '$nis_siswa',
                no_tlp = '$tlp_ortu'
                WHERE id_orangtua = '$kd_ortu' ";
      $query = mysqli_query($connect, $update);
        //cekdata berhasil ditambahkan
        if ($query) {
          echo "
            <script>
            alert('Data Berhasil diupdate');
            document.location='admin_ortu.php?status=sukses';
            </script>";
        }
        else{
          echo "
            <script>
            alert('Data Gagal diupdate');
            document.location='admin_ortu.php?status=gagal';
            </script>";
        }

      }
      ?>