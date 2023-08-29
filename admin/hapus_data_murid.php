<?php

    require "../connection.php";

    $nis = $_GET['id_siswa'];
    // var_dump($nip);
    // exit;
	$hapus = mysqli_query($connect,"DELETE FROM siswa WHERE id_siswa ='$nis'");
    if($hapus){
        echo "
            <script>
                alert('Berhasil Menghapus data');
                document.location.href = 'admin_murid.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Gagal Menghapus data');
                document.location.href = 'admin_murid.php';
            </script>";
    }

?>