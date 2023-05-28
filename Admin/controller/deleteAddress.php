<?php
    session_start();
    include('../../server.php');
    
    $id1=$_POST['record1'];
    $id2=$_POST['record2'];
    $query="DELETE FROM address WHERE zipcode = '$id1' AND district = '$id2'";

    $data=mysqli_query($con,$query);

    if($data){
        echo"address Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>