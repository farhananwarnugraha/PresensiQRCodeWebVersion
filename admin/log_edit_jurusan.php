<?php
    require '../connection.php';

    if(isset($_POST["submit"])){

     
      $kd_jurusan = $_POST['kode_kelas'];
      $nama_jurusan = $_POST['nama_jurusan'];

      $update= "UPDATE jurusan SET 
              id_jurusan  = '$kd_jurusan', 
              nama_jurusan = '$nama_jurusan'
              WHERE id_jurusan = '$kd_jurusan' ";
        $query = mysqli_query($connect, $update);
        //cekdata berhasil ditambahkan
        if($query){
            echo "
              <script>
              alert('Data Berhasil diupdate');
              document.location='admin_jurusan.php?status=sukses';
              </script>";
          }
          else{
            echo "
              <script>
              alert('Data Gagal diupdate');
              document.location='admin_jurusan.php?status=gagal';
              </script>";
          }
      
        }
?>