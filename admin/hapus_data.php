<?php

    require "../connection.php";

    $nip = $_GET['id_guru'];
    // var_dump($nip);
    // exit;
	$hapus = mysqli_query($connect,"DELETE FROM guru WHERE id_guru ='$nip'");
    if($hapus){
        echo "
            <script>
                alert('Berhasil Menghapus data');
                document.location.href = 'admin_guru.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Gagal Menghapus data');
                document.location.href = 'admin_guru.php';
            </script>";
    }

?>