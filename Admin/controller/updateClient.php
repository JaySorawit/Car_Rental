<?php
    include('../../server.php');

    $client_id = $_POST['client_id'];
    $driving_license_no=$_POST['driving_license_no'];
    $fname= $_POST['fname'];
    $lname= $_POST['lname'];
    $tel_no= $_POST['tel_no'];

    if(empty($driving_license_no)) {
        $driving_license_no = NULL;
    }
    
    $updateItem = mysqli_query($con,"UPDATE client SET 
        driving_license_no='$driving_license_no',  
        fname='$fname',
        lname='$lname',
        tel_no='$tel_no' 
        WHERE client_id='$client_id'");


    if($updateItem)
    {
        echo "true";
    }
?>