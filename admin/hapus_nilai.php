<?php

    require "../connection.php";

    $kd_nilai = $_GET['kd_nilai'];
    // var_dump($nip);
    // exit;
	$hapus = mysqli_query($connect,"DELETE FROM siamad_nilai WHERE kd_nilai ='$kd_nilai'");
    if($hapus){
        echo "
            <script>
                alert('Berhasil Menghapus data');
                document.location.href = 'admin_nilai.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Gagal Menghapus data');
                document.location.href = 'admin_nilai.php';
            </script>";
    }

?>