<?php
    require '../connection.php';

    if(isset($_POST["submit"])){

     
      $kd_kelas = $_POST['kode_kelas'];
      $nama_kelas = $_POST['nama_kelas'];
      $walikelas = $_POST['jurusan'];
    

      $update= "UPDATE kelas SET 
              id_kelas  = '$kd_kelas', 
              nama_kelas = '$nama_kelas', 
              jurusan	 = '$walikelas'
              WHERE id_kelas = '$kd_kelas' ";
        $query = mysqli_query($connect, $update);
        //cekdata berhasil ditambahkan
        if($query){
            echo "
              <script>
              alert('Data Berhasil diupdate');
              document.location='admin_kelas.php?status=sukses';
              </script>";
          }
          else{
            echo "
              <script>
              alert('Data Gagal diupdate');
              document.location='admin_kelas.php?status=gagal';
              </script>";
          }
      
        }
?>