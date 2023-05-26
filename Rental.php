<?php
session_start();
$loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;
if (!isset($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit;
}
include('server.php');

$_SESSION['license_plate'] = $carId ; // สมมติว่า $_SESSION['license_plate'] ส่ง 'aaa' เข้ามา

$license_plate = $_SESSION['license_plate'];
$query1 = "SELECT * FROM car_info WHERE license_plate = '$license_plate'";
$result = mysqli_query($con, $query1);
$car_row = mysqli_fetch_assoc($result);
$license_plate = $car_row['license_plate'];
$lessor = $car_row['client_id'];
$model_id = $car_row['model_id'];
$price = $car_row['price_per_day'];
$formatted_price = number_format($price, 2, '.', ',');
$transmission = $car_row['transmission'];
$year_car = $car_row['year_car'];
$seat = $car_row['seat'];
$district = $car_row['district'];
$zipcode = $car_row['zipcode'];
$image_path = $car_row['image_path'];

$query2 = "SELECT model_name, brand FROM brand_info WHERE model_id = '$model_id'";
$result = mysqli_query($con, $query2);
$brand_row = mysqli_fetch_assoc($result);
$model_name = $brand_row['model_name'];
$brand = $brand_row['brand'];

$query3 = "SELECT province FROM address WHERE district = '$district' AND zipcode = '$zipcode'";
$result = mysqli_query($con, $query3);
$address_row = mysqli_fetch_assoc($result);
$province = $address_row['province'];

$query4 = "SELECT * FROM client WHERE client_id = '$lessor'";
$result = mysqli_query($con, $query4);
$client_row = mysqli_fetch_assoc($result);
$lessor_name = $client_row['fname'] . ' ' . $client_row['lname'];
$lessor_phone = $client_row['tel_no'];
?>