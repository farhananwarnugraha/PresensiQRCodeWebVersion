<?php

    require "../connection.php";

    $id_mapel = $_GET['id_mapel'];
    // var_dump($nip);
    // exit;
	$hapus = mysqli_query($connect,"DELETE FROM matapelajaran WHERE id_mapel ='$id_mapel'");
    if($hapus){
        echo "
            <script>
                alert('Berhasil Menghapus data');
                document.location.href = 'admin_mapel.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Gagal Menghapus data');
                document.location.href = 'admin_mapel.php';
            </script>";
    }

?>