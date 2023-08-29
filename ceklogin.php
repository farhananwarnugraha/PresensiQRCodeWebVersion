<?php 
    session_start();
     include 'connection.php';
     
        // menangkap data yang dikirim dari form login
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        // $lvl = $_POST['level'];
        
        //meneyeleksi level dari form
        // if ($lvl == 'kepsek') {
            $data = mysqli_query($connect, "SELECT * FROM admin WHERE usename_admin ='$username' and pass_admin ='$password'");
     
        // menghitung jumlah data yang ditemukan
            $cek = mysqli_fetch_assoc($data);
            // var_dump ($cek);
     
            if($cek > 0){
                $_SESSION['username'] = $username;
                $_SESSION['status'] = "login";
                $_SESSION['nama_admin']= $cek['nama_admin'];
                header("location:admin/");
            }
            else{
            echo "
                <script>
                alert('Data Gagal diupdate');
                document.location='data_admin.php?status=gagal';
                </script>";
                header("location:index.php?pesan=gagal");
            }
        // }

        // elseif ($lvl == 'guru') {
        //     $data2 = mysqli_query($connect, "SELECT * FROM siamad_guru WHERE nik_guru='$username' and pwd_guru='$password'");
     
        // // menghitung jumlah data yang ditemukan
        //     $cek = mysqli_fetch_assoc($data2);
     
        //     if($cek > 0){
        //         $_SESSION['username'] = $username;
        //         $_SESSION['status'] = "login";
        //         $_SESSION['nama_guru']=$cek['nama_guru'];
        //         header("location:guru/");
        //     }
        //     else{
        //         header("location:index.php?pesan=gagal");
        //     }
        // }
        // elseif ($lvl == 'admin') {
        //     $data3 = mysqli_query($connect, "SELECT * FROM siamad_admin WHERE username_admin='$username' and pwd_admin='$password'");
     
        // // menghitung jumlah data yang ditemukan
        //     $cek = mysqli_num_rows($data3);
     
        //     if($cek > 0){
        //         $_SESSION['username'] = $username;
        //         $_SESSION['status'] = "login";
        //         $_SESSION['nama_admin']=$cek['nama_admin'];
        //         header("location:admin/");
        //     }
        //     else{
        //         header("location:index.php?pesan=gagal");
        //     }
        // }
        // elseif ($lvl == 'siswa') {
        //     $data4 = mysqli_query($connect, "SELECT * FROM siamad_siswa WHERE nis_siswa='$username' and pwd_siswa='$password'");
     
        // // menghitung jumlah data yang ditemukan
        //     $cek = mysqli_num_rows($data4);
     
        //     if($cek > 0){
        //         $_SESSION['username'] = $username;
        //         $_SESSION['status'] = "login";
        //         $_SESSION['nama_siswa']= $cek['nama_siswa'];
        //         header("location:siswa/");
        //     }
        //     else{
        //         header("location:index.php?pesan=gagal");
        //     }
        // }
        // elseif ($lvl == 'ortu') {
        //     $data5 = mysqli_query($connect, "SELECT * FROM siamad_ortu WHERE siswa_ortu='$username' and password_ortu ='$password'");
     
        // // menghitung jumlah data yang ditemukan
        //     $cek = mysqli_num_rows($data5);
     
        //     if($cek > 0){
        //         $_SESSION['username'] = $username;
        //         $_SESSION['status'] = "login";
        //         $_SESSION['nama_ortu']=$cek['nama_ortu'];
        //         header("location:ortu/");
        //     }
        //     else{
        //         header("location:index.php?pesan=gagal");
        //     }
        // }

        // else{
        //     header("location:index.php?pesan=gagal");
        // }
?>