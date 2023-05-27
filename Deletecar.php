<?php
session_start();
include('server.php');


$id = $_POST['license_plate'];
$check_date = "SELECT end_date FROM rent_info WHERE license_plate = '$id'";

$today = date("Y-m-d");
$_SESSION['current_selected_car'] = $id;

if ($result = mysqli_query($con, $check_date)) {
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['end_date'] >= $today) {
            $_SESSION['error'] = "Cannot delete this car because it is currently rented.";
            header("location: Rentinfo.php");
            exit();
        }
    }
}

$sql = "SELECT image_path FROM car_info WHERE license_plate = '$id'";
$result = mysqli_query($con, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $image_path = $row['image_path'];
} else {
    echo "Error executing the query: " . mysqli_error($con);
}

$query = "DELETE FROM car_info WHERE license_plate = '$id'";
$data = mysqli_query($con, $query);

unlink($image_path);
$_SESSION['delete_success'] = "<script type='text/javascript'>alert('Successfully deleted.');</script>";
header("location: CarForm.php");



?>