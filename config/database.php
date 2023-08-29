<?php
    $hostname = "localhost";
    $database = "db_presensi";
    $username = "root";
    $password = "";
    $connect = mysqli_connect($hostname, $username, $password, $database);
    // script cek koneksi   
    define('DBhostname',$hostname);
    define('DBdatabase',$database);
    define('DBusername',$username);
    define('DBpassword',$password);
    if (!$connect) {
        die("Koneksi Tidak Berhasil: " . mysqli_connect_error());
    }
?> 