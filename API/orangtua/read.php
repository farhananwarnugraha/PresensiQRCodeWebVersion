<?php
    //panggil koneksi database
    require_once '../../config/database.php';
    //header json
    header('Content-Type: application/json');
    $query = $connect->query("SELECT * FROM orangtua ORDER BY nama_orangtua ASC");            
        while($row=mysqli_fetch_object($query))
        {
            $data[] =$row;
        }
    $response=array(
        'status' => 1,
        'message' =>'Success',
        'data' => $data
    );    
    echo json_encode($response);
?>