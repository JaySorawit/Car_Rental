<?php
    session_start();
    include('../../server.php');
    
    $id=$_POST['record'];
    $query="DELETE FROM brand_info WHERE model_id = '$id'";

    $data=mysqli_query($con,$query);

    if($data){
        echo"brand Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>