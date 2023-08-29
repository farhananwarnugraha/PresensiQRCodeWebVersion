<?php

    require "../connection.php";

    $nip_kepsek = $_GET['nip_kepsek'];
    // var_dump($nip);
    // exit;
	$hapus = mysqli_query($connect,"DELETE FROM siamad_kepsek WHERE nip_kepsek ='$nip_kepsek'");
    if($hapus){
        echo "
            <script>
                alert('Berhasil Menghapus data');
                document.location.href = 'admin_kepsek.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Gagal Menghapus data');
                document.location.href = 'admin_kepsek.php';
            </script>";
    }

?>