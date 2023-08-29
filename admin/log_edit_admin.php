<?php
    require '../connection.php';

    if(isset($_POST["submit"])){

            $id_admin  = $_POST['id_admin'];
            $username_admin = $_POST['username_admin'];
            $nama_admin = $_POST['nama_admin'];
            $pass_admin = md5($_POST['pwd_admin']);
            // var_dump($id_admin,$username_admin,$nama_admin,$alamat_admin,$tlp_admin,$pass_admin);
            // exit;
            $update= "UPDATE admin SET 
                      id_admin = '$id_admin',
                      usename_admin = '$username_admin',
                      nama_admin = '$nama_admin',
                      pass_admin = '$pass_admin'
                      WHERE id_admin = '$id_admin'";
           $query = mysqli_query($connect, $update);
        //cekdata berhasil ditambahkan
        if ($query) {
          echo "
            <script>
            alert('Data Berhasil diupdate');
            document.location='data_admin.php?status=sukses';
            </script>";
        }
        else{
          echo "
            <script>
            alert('Data Gagal diupdate');
            document.location='data_admin.php?status=gagal';
            </script>";
        }

      }
      ?>