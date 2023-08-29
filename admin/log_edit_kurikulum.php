<?php
    require '../connection.php';

    if(isset($_POST["submit"])){

     
      $kd_kurikulum = $_POST['kd_kurikulum'];
      $nama_kurikulum = $_POST['nama_kurikulum'];
      $status_kurukulum = $_POST['status_kurukulum'];
    

      $update= "UPDATE siamad_kurikulum SET 
              kd_kurikulum  = '$kd_kurikulum', 
              nama_kurikulum = '$nama_kurikulum', 
              status_kurukulum	 = '$status_kurukulum'
              WHERE kd_kurikulum = '$kd_kurikulum' ";
        $query = mysqli_query($connect, $update);
        //cekdata berhasil ditambahkan
        if($query){
            echo "
              <script>
              alert('Data Kurikulum Berhasil diupdate');
              document.location='admin_kurikulum.php?status=sukses';
              </script>";
          }
          else{
            echo "
              <script>
              alert('Data Kurikulum Gagal diupdate');
              document.location='admin_kurikulum.php?status=gagal';
              </script>";
          }
      
        }
?>