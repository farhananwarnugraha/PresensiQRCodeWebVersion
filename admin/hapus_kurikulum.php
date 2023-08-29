<?php

    require "../connection.php";

    $kd_kurikulum = $_GET['kd_kurikulum'];
    // var_dump($nip);
    // exit;
	$hapus = mysqli_query($connect,"DELETE FROM siamad_kurikulum WHERE kd_kurikulum ='$kd_kurikulum'");
    if($hapus){
        echo "
            <script>
                alert('Berhasil Menghapus data');
                document.location.href = 'admin_kurikulum.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Gagal Menghapus data');
                document.location.href = 'admin_kurikulum.php';
            </script>";
    }

?>