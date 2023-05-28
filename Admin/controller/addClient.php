<?php
session_start();
include('../../server.php');


$email = $_POST['email'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$tel_no = $_POST['phone'];
$gender = $_POST['gender'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$my_date = $year . '-' . date('m', strtotime($month)) . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
$today = new DateTime();
$birthday = new DateTime($my_date);
$age = $today->diff($birthday)->y;

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "<script type='text/javascript'>alert('Records can\'t be added: Please enter a valid email.');</script>";
    header("location: ../AdminPage.php");
} else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
    $_SESSION['error'] = "<script type='text/javascript'>alert('Records can\'t be added: The password must be between 5 and 20 characters long.');</script>";
    header("location: ../AdminPage.php");
} else if (!checkdate(date('m', strtotime($month)), $day, $year)) {
    $_SESSION['error'] = "<script type='text/javascript'>alert('Records can\'t be added: Invalid date of birth.');</script>";
    header("location: ../AdminPage.php");
} else if ($age < 18) {
    $_SESSION['error'] = "<script type='text/javascript'>alert('Records can\'t be added: Client must be at least 18 years old to register.');</script>";
    header("location: ../AdminPage.php");
} else if (empty($_POST['interestedcar'])) {
    $_SESSION['error'] = "<script type='text/javascript'>alert('Records can\'t be added: Please select the car you are interested in.');</script>";
    header("location: ../AdminPage.php");
} else {
    try {
        $check_email = "SELECT email FROM client WHERE email='$email'";
        $result = mysqli_query($con,$check_email);
        $row = mysqli_fetch_assoc($result);
        header("location: ../AdminPage.php");

        if ($row['email'] == $email) {
            $_SESSION['error'] = "<script type='text/javascript'>alert('Records can\'t be added: The email has already been taken.');</script>";
            header("location: ../AdminPage.php");
        } else if (!isset($_SESSION['error'])) {
            $sql1 = "INSERT INTO client (fname,lname,dateofbirth,gender,email,password,tel_no)
	            VALUES ('$firstname', '$lastname', '$my_date','$gender','$email','$password','$tel_no')";
            if (!mysqli_query($con, $sql1)) {
                die('Error: ' . mysqli_error($con));
            }

            $interested_cars = array_values($_POST['interestedcar']);

            for ($i = 0; $i < count($interested_cars); $i++) {
                $car = $interested_cars[$i];

                $sql2 = "INSERT INTO interested(client_id,interested_car) VALUES ((SELECT client_id FROM client WHERE email LIKE '%$email%'),  '$car')";
                if (!mysqli_query($con, $sql2)) {
                    die('Error: ' . mysqli_error($con));
                }

            }

            $_SESSION['success'] = "<script type='text/javascript'>alert('Record added successfully.');</script>";
            header("location: ../AdminPage.php");
        } else {
            $_SESSION['error'] = "Something went wrong.";
            header("location: ../AdminPage.php");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>