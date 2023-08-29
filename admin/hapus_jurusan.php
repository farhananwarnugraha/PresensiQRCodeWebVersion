<?php

    require "../connection.php";

    $kd_jurusan = $_GET['kode_jurusan'];
    // var_dump($nip);
    // exit;
	$hapus = mysqli_query($connect,"DELETE FROM jurusan WHERE id_jurusan ='$kd_jurusan'");
    if($hapus){
        echo "
            <script>
                alert('Jurusan berhasil dihapus');
                document.location.href = 'admin_jurusan.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Kelas tidak dapat dihapus');
                document.location.href = 'admin_jurusan.php';
            </script>";
    }

?>