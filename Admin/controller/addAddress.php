<?php
session_start();
include('../../server.php');


$zipcode = $_POST['zipcode'];
$district = $_POST['district'];
$province = $_POST['province'];

$check_address = "SELECT zipcode, district FROM address WHERE zipcode='$zipcode' AND district='$district'";
$result = mysqli_query($con,$check_address);
$row = mysqli_fetch_assoc($result);

if ($row['zipcode'] == $zipcode && $row['district'] == $district) {
    $_SESSION['error'] = "<script type='text/javascript'>alert('Records can\'t be added: The address has already been taken.');</script>";
    header("location: ../pages/admin/AdminPage6.php");
} else {
    try {
            if (!isset($_SESSION['error'])) {
            $sql1 = "INSERT INTO address (zipcode,district,province)
	            VALUES ('$zipcode', '$district', '$province')";
            if (!mysqli_query($con, $sql1)) {
                die('Error: ' . mysqli_error($con));
            }

            $_SESSION['success'] = "<script type='text/javascript'>alert('Record added successfully.');</script>";
            header("location: ../pages/admin/AdminPage6.php");
        } else {
            $_SESSION['error'] = "Something went wrong.";
            header("location: ../pages/admin/AdminPage6.php");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>