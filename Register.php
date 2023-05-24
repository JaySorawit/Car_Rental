<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "carrental_db");
if (!$con) {
    die('Could not connect: ' . mysqli_error());
}

$email = $_POST['email'];
$password = $_POST['password'];
$c_password = $_POST['c_password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$tel_no = $_POST['phone'];
$gender = $_POST['gender'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$my_date = $year . '-' . date('m', strtotime($month)) . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);

if (empty($email)) {
    $_SESSION['error'] = 'Please enter your email.';
    header("location: RegisterForm.php");
} 
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Please enter a valid email.';
    header("location: RegisterForm.php");
} 
else if (empty($password)) {
    $_SESSION['error'] = 'Please enter your password.';
    header("location: RegisterForm.php");
} 
else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
    $_SESSION['error'] = 'The password must be between 5 and 20 characters long.';
    header("location: RegisterForm.php");
} 
else if (empty($c_password)) {
    $_SESSION['error'] = 'Please confirm your password.';
    header("location: RegisterForm.php");
} 
else if (empty($firstname)) {
    $_SESSION['error'] = 'Please enter your first name.';
    header("location: RegisterForm.php");
} 
else if (empty($lastname)) {
    $_SESSION['error'] = 'Please enter your last name.';
    header("location: RegisterForm.php");
} 
else if (empty($tel_no)) {
    $_SESSION['error'] = 'Please enter your mobile number.';
    header("location: RegisterForm.php");
} 
else if (empty($gender)) {
    $_SESSION['error'] = 'Please select your gender.';
    header("location: RegisterForm.php");
} 
else if (!checkdate(date('m', strtotime($month)), $day, $year)) {
    $_SESSION['error'] = 'Invalid date of birth.';
    header("location: RegisterForm.php");
} 
else if (empty($_POST['interestedcar'])) {
    $_SESSION['error'] = 'Please select the car you are interested in.';
    header("location: RegisterForm.php");
} 
else if ($password != $c_password) {
    $_SESSION['error'] = 'Passwords do not match';
    header("location: RegisterForm.php");
} 
else {
    try {
       
        $check_email = "SELECT email FROM client WHERE email='$email'";
        $result = mysqli_query($con,$check_email);
        $row = mysqli_fetch_assoc($result);

        if ($row['email'] == $email) {
            $_SESSION['warning'] = "The email has already been taken.";
            header("location: RegisterForm.php");

        } 
        else if (!isset($_SESSION['error'])) 
        {
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
        
            $_SESSION['success'] = "You have Successfully Subscribed! <a href='LoginForm.php' class='alert-link'>Click Here!</a> to Login";
            header("location: RegisterForm.php");
        } 
        else {
            $_SESSION['error'] = "Something went wrong";
            header("location: RegisterForm.php");
        }
    } 
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>