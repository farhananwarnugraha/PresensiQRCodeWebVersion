<?php
    require '../connection.php';

    if(isset($_POST["submit"])){

            $id_mapel  = $_POST['id_mapel'];
            $nama_mapel = $_POST['nama_mapel'];
            $guru_mapel = $_POST['guru_mapel'];
            $kategori_mapel = $_POST['kategori'];
            // var_dump($id_admin,$username_admin,$nama_admin,$alamat_admin,$tlp_admin,$pass_admin);
            // exit;
            $update= "UPDATE matapelajaran SET 
                      id_mapel = '$id_mapel',
                      nama_mapel = '$nama_mapel',
                      guru_mapel = '$guru_mapel',
                      kategori_mapel = '$kategori_mapel'
                      WHERE id_mapel = '$id_mapel'";
           $query = mysqli_query($connect, $update);
        //cekdata berhasil ditambahkan
        if ($query) {
          echo "
            <script>
            alert('Data Berhasil diupdate');
            document.location='admin_mapel.php?status=sukses';
            </script>";
        }
        else{
          echo "
            <script>
            alert('Data Gagal diupdate');
            document.location='admin_mapel.php?status=gagal';
            </script>";
        }

      }
      ?>