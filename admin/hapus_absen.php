<?php

    require "../connection.php";

    $id = $_GET['id'];
    // var_dump($nip);
    // exit;
	$hapus = mysqli_query($connect,"DELETE FROM presensi_masuk WHERE id_presensi ='$id'");
    if($hapus){
        echo "
            <script>
                alert('Berhasil Menghapus data');
                document.location.href = 'admin_absen.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Gagal Menghapus data');
                document.location.href = 'admin_absen.php';
            </script>";
    }

?>