<?php
    require '../../connection.php';

    if(isset($_POST["submit"])){
      $id = $_POST['id_presensi'];
      $keterangan = $_POST['keterangan'];
    //   var_dump($id,$keterangan);
    //   exit;
     
      $update_presmapel = "UPDATE presensi_masuk SET
                        id_presensi = '$id',
                        keterangan = '$keterangan'
                        WHERE id_presensi = $id";

      $query = mysqli_query($connect, $update_presmapel);
        //cekdata berhasil ditambahkan
        if ($query) {
          echo "
            <script>
            alert('Presensi Berhasil diupdate');
            document.location='../admin_absen.php?status=sukses';
            </script>";
        }
        else{
          echo "
            <script>
            alert('Presensi Gagal diupdate');
            document.location='../admin_absen.php?status=gagal';
            </script>";
        }

      }
      ?>