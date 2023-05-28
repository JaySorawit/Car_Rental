<?php
    session_start();
    include('../../server.php');
    
    $id=$_POST['record'];
    $query="DELETE FROM car_info WHERE license_plate = '$id'";

    $data=mysqli_query($con,$query);

    if($data){
        echo"car Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>