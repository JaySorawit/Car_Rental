<?php
    session_start();
    if (!isset($_SESSION['loggedIn'])) {
        header('Location: login.php');
        exit;
    }
    include 'server.php';
    $client_id = $_SESSION['client_id'];

    $license_plate = $_POST['license_plate'];
    $brand = $_POST['brand'];
    $model_name = $_POST['model_name'];
    $year_car = $_POST['Year_car'];
    $transmission = $_POST['transmission'];
    $color = $_POST['color'];
    $seat = $_POST['seat'];
    $price_per_day = $_POST['price_per_day'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $zipcode = $_POST['zipcode'];

    $file = $_FILES['image_path'];
    $filename = $file['name'];

    // Check the file type
    $allowedTypes = array("jpeg", "jpg", "png");
    $fileType = $file['type'];
    
    if (in_array($fileType, $allowedTypes)) {
        // Invalid file type
        session_start();
        $_SESSION['error'] = 'Only JPG, JPEG, PNG files are allowed to upload.';
        header("location: CarForm.php");
        exit();
    }
    else{
        $newFilename = "car_" . $license_plate . "." . pathinfo($filename, PATHINFO_EXTENSION);
    }
    
    $targetDir = "./img/car/";
    $targetFilepath = $targetDir . $newFilename;
    // echo $file["name"];

    $check_license_plate = "SELECT license_plate FROM car_info WHERE license_plate='$license_plate'";
    $license_result = mysqli_query($con,$check_license_plate);
    $checklicense = mysqli_fetch_assoc($license_result);
    // echo $checklicense['license_plate'];
    if ($license_plate == $checklicense['license_plate']) {
        $_SESSION['warning'] = "The license_plate has already been taken.";
        header("location: CarForm.php");
        exit();
    }
    else {

        echo $_FILES['image_path']['tmp_name'];
        echo $targetFilepath;
        echo basename($_FILES['image_path']['name']);

        if(move_uploaded_file($_FILES['image_path']['tmp_name'], $targetFilepath)){
            echo "Yessss";
        }
        else{
            echo "Nooo";
        }

        // echo $license_plate;
        // echo $brand;
        // echo $model_name;
        // echo $model_id;
        // echo $year_car; 
        // echo $transmission;
        // echo $color; 
        // echo $seat;
        // echo $price_per_day;
        // echo $file["name"];
        // echo $newFilename;
        // echo $province;
        // echo $district;
        // echo $zipcode;

        $sql2 = "SELECT model_id FROM brand_info WHERE model_name = '$model_name' AND brand = '$brand';";
        $result2 = mysqli_query($con,$sql2);
        $model_id = mysqli_fetch_assoc($result2)['model_id'];

        
        $sql3 = "INSERT INTO car_info (license_plate ,client_id ,model_id ,price_per_day 
        ,transmission ,year_car ,seat ,color ,district ,zipcode	,image_path) 
        VALUES ('$license_plate', '$client_id', '$model_id', '$price_per_day', '$transmission',
        '$year_car', '$seat', '$color', '$district', '$zipcode', '$targetFilepath');";
        if (!mysqli_query($con, $sql3)) {
            die('error: ' . mysqli_error($con));
        }

        $_SESSION['success'] = "You have Successfully rented out a car!";
        header("location: CarForm.php");
    }
    
    




    // if(empty($license_plate)) {
    //     $_SESSION['error'] = 'Please fill out the license plate of car.';
    //     header("location: CarForm.php");
    //     exit();
    // }
    // if(empty($brand)) {
    //     $_SESSION['error'] = 'Please select the brand of car.';
    //     header("location: CarForm.php");
    //     exit();
    // }
    // if(empty($model_name)) {
    //     $_SESSION['error'] = 'Please select the model of car.';
    //     header("location: CarForm.php");
    //     exit();
    // }
    // if(empty($year_car)) {
    //     $_SESSION['error'] = 'Please select the year of car.';
    //     header("location: CarForm.php");
    //     exit();
    // }
    // if(empty($transmission)) {
    //     $_SESSION['error'] = 'Please select the transmission of car.';
    //     header("location: CarForm.php");
    //     exit();
    // }
    // if(empty($color)) {
    //     $_SESSION['error'] = 'Please select the color of car.';
    //     header("location: CarForm.php");
    //     exit();
    // }
    // if(empty($seat)) {
    //     $_SESSION['error'] = 'Please fill out the number of seat';
    //     header("location: CarForm.php");
    //     exit();
    // }
    // if(empty($price_per_day)) {
    //     $_SESSION['error'] = 'Please fill out the price/day of car';
    //     header("location: CarForm.php");
    //     exit();
    // }
    // if(empty($image_path)) {
    //     $_SESSION['error'] = 'Please select a file.';
    //     header("location: CarForm.php");
    //     exit();
    // }
    // if(empty($province)) {
    //     $_SESSION['error'] = 'Please select the province in the list.';
    //     header("location: CarForm.php");
    //     exit();
    // }
    // if(empty($district)) {
    //     $_SESSION['error'] = 'Please select the district in the list.';
    //     header("location: CarForm.php");
    //     exit();
    // }
    // if(empty($zipcode)) {
    //     $_SESSION['error'] = 'Please select the zipcode in the list.';
    //     header("location: CarForm.php");
    //     exit();
    // }

    // if(!empty($_FILES["image_path"]["name"])) {
    //     echo "Yes we have file";
    // }
    

?>