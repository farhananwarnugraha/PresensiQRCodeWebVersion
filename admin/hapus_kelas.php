<?php

    require "../connection.php";

    $kd_kelas = $_GET['kode_kelas'];
    // var_dump($nip);
    // exit;
	$hapus = mysqli_query($connect,"DELETE FROM kelas WHERE id_kelas ='$kd_kelas'");
    if($hapus){
        echo "
            <script>
                alert('Kelas berhasil dihapus');
                document.location.href = 'admin_kelas.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Kelas tidak dapat dihapus');
                document.location.href = 'admin_kelas.php';
            </script>";
    }

?>