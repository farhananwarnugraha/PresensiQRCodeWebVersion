<?php

    require "../../connection.php";

    $id = $_GET['id'];
    // var_dump($nip);
    // exit;
	$hapus = mysqli_query($connect,"DELETE FROM pengumuman WHERE id_pengumuman ='$id'");
    if($hapus){
        echo "
            <script>
                alert('Pengumuman Berhasil dihapus);
                document.location.href = '../pengumuman.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Pengumman Tidak dapat dihapus');
                document.location.href = '../pengumuman.php?failed';
            </script>";
    }

?>