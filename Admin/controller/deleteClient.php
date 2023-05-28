<?php
    session_start();
    include('../../server.php');
    
    $id=$_POST['record'];
    $query="DELETE FROM client WHERE client_id = '$id'";

    $data=mysqli_query($con,$query);

    if($data){
        echo"client Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>