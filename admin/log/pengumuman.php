<?php
    require '../../connection.php';

    if(isset($_POST["submit"])){
      $id = $_POST['id_pengumuman'];
      $isi = $_POST['isi'];
    //   var_dump($id,$keterangan);
    //   exit;
     
      $update_presmapel = "UPDATE pengumuman SET
                        id_pengumuman = '$id',
                        isi_pengumuman = '$isi'
                        WHERE id_pengumuman = $id";

      $query = mysqli_query($connect, $update_presmapel);
        //cekdata berhasil ditambahkan
        if ($query) {
          echo "
            <script>
            alert('Pengumuman Berhasil diupdate');
            document.location='../pengumuman.php?status=sukses';
            </script>";
        }
        else{
          echo "
            <script>
            alert('Pengumuman Gagal diupdate');
            document.location='../pengumuman.php?status=gagal';
            </script>";
        }

      }
      ?>