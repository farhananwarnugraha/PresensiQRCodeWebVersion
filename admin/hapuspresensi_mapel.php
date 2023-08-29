<?php

    require "../connection.php";

    $nis = $_GET['nis_siswa'];
    // var_dump($nip);
    // exit;
	$hapus = mysqli_query($connect,"DELETE FROM absen_siamad WHERE nis_siswa ='$nis'");
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