<?php
//panggil koneksi database
require_once '../config/database.php';
require_once '../config/module.php';
//header json
header('Content-Type: application/json');

// cek token
$token = tokenRead();
if($token['status']==true) {
    $query = $connect->query("SELECT * FROM pengumuman");            
        while($row=mysqli_fetch_object($query))
        {
            $data[] =$row;  
        }
        responseSuccess("Data Loaded",$data);
} else {
    responseError("Memerlukan token pengenal untuk mengakses fitur ini");
}
?>