<?php

    require "../connection.php";

    $ortu = $_GET['ortu'];
    // var_dump($ortu);
    // exit;
	$hapus = mysqli_query($connect,"DELETE FROM orangtua WHERE id_orangtua ='$ortu'");
    if($hapus){
        echo "
            <script>
                alert('Berhasil Menghapus data');
                document.location.href = 'admin_ortu.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Gagal Menghapus data');
                document.location.href = 'admin_ortu.php';
            </script>";
    }

?>