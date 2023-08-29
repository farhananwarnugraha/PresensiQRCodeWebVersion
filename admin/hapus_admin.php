<?php

    require "../connection.php";

    $id_admin = $_GET['id_admin'];
    // var_dump($nip);
    // exit;
	$hapus = mysqli_query($connect,"DELETE FROM admin WHERE id_admin ='$id_admin'");
    if($hapus){
        echo "
            <script>
                alert('Berhasil Menghapus data');
                document.location.href = 'data_admin.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Gagal Menghapus data');
                document.location.href = 'data_admin.php';
            </script>";
    }

?>