<?php
    session_start();
    include('../../server.php');
    
    $id=$_POST['record'];
    $query="DELETE FROM rent_info WHERE rental_id = '$id'";

    $data=mysqli_query($con,$query);

    if($data){
        echo"rental Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>