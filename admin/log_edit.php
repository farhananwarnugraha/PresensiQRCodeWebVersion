<?php
    require '../connection.php';

    if(isset($_POST["submit"])){

            $nip  = $_POST['nip_guru'];
            $nama = $_POST['nama_guru'];
            $alamat = $_POST['alamat_guru'];
            $kota = $_POST['kota_guru'];
            $jenis_kelamin = $_POST ['jenis_kelamin'];
            $tlp =    $_POST ['no_tlp'];
            $pass =   md5($_POST['pass_guru']);

            $update= "UPDATE guru SET 
                        nip_guru = '$nip', 
                        nama_guru = '$nama', 
                        alamat_guru = '$alamat', 
                        kota_guru = '$kota',
                        jenis_kelamin = '$jenis_kelamin', 
                        no_tlp = '$tlp', 
                        pass_guru = '$pass'
                        WHERE nip_guru = '$nip' ";
           $query = mysqli_query($connect, $update);
        //cekdata berhasil ditambahkan
        if ($query) {
          echo "
            <script>
            alert('Data Berhasil diupdate');
            document.location='admin_guru.php?status=sukses';
            </script>";
        }
        else{
          echo "
            <script>
            alert('Data Gagal diupdate');
            document.location='admin_guru.php?status=gagal';
            </script>";
        }

      }
      ?>