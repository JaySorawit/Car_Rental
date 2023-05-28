<?php
    include('../../server.php');

    $zipcode = $_POST['zipcode'];
    $district=$_POST['district'];
    $province= $_POST['province'];
    
    $updateItem = mysqli_query($con,"UPDATE address SET 
        province='$province'
        WHERE zipcode='$zipcode' AND district='$district'");


    if($updateItem)
    {
        echo "true";
    }
?>