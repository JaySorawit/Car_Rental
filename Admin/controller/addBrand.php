<?php
session_start();
include('../../server.php');


$model_id = $_POST['model_id'];
$model_name = $_POST['model_name'];
$brand = $_POST['brand'];

$check_model = "SELECT model_id FROM brand_info WHERE model_id='$model_id'";
$result = mysqli_query($con,$check_model);
$row = mysqli_fetch_assoc($result);

if ($row['model_id'] == $model_id) {
    $_SESSION['error'] = "<script type='text/javascript'>alert('Records can\'t be added: The model has already been taken.');</script>";
    header("location: ../pages/admin/AdminPage4.php");
} else {
    try {
            if (!isset($_SESSION['error'])) {
            $sql1 = "INSERT INTO brand_info (model_id,model_name,brand)
	            VALUES ('$model_id', '$model_name', '$brand')";
            if (!mysqli_query($con, $sql1)) {
                die('Error: ' . mysqli_error($con));
            }

            $_SESSION['success'] = "<script type='text/javascript'>alert('Record added successfully.');</script>";
            header("location: ../pages/admin/AdminPage4.php");
        } else {
            $_SESSION['error'] = "Something went wrong.";
            header("location: ../pages/admin/AdminPage4.php");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>