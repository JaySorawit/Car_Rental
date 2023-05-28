<?php
    session_start();
    include('../../server.php');
    
    $id=$_POST['record'];
    $query="DELETE FROM credit_card_client WHERE credit_card_id = '$id'";

    $data=mysqli_query($con,$query);

    if($data){
        echo"card Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>