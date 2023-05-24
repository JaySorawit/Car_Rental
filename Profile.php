<?php

session_start();
if (!isset($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit;
}
include 'server.php';
$email = $_SESSION['email'];

$sql = "SELECT * FROM client WHERE email='$email';";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$client_ID = $row['client_id'];

$sql2 = "SELECT * FROM interested WHERE client_id='$client_ID';";
$carresult = mysqli_query($con,$sql2);
$interested_car = array();
while ($row2 = mysqli_fetch_assoc($carresult)) {
    $interested_car[] = $row2['interested_car'];
}

$nemail = $_POST['nemail']; 
$password = $_POST['password'];
$npassword = $_POST['npassword'];
$cpassword = $_POST['cpassword'];
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$tel_no = $_POST['tel_no'];
$gender = $_POST['gender'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$bank_name =$_POST['bank_name'];
$bank_account =$_POST['bank_account'];
$interested_cars = array();
if(isset($_POST['interestedcar'])) {
    foreach($_POST['interestedcar'] as $car) {
        $interested_cars[] = $car;
    }
}

sort($interested_cars);
sort($interested_car);
$carinter;
if ($interested_cars === $interested_car) {
    $carinter = 1;
  } 
else {
    $carinter = 0;
}


$my_date = DateTime::createFromFormat('j-n-Y', $day.'-'.$month.'-'.$year)->format('Y-m-d');

if(empty($password)) {
    $password  = $row['password'];
}
if(empty($firstname)) {
    $firstname = $row['fname'];
}
if(empty($lastname)) {
    $lastname = $row['lname'];
}
if(empty($tel_no)) {
    $tel_no = $row['tel_no'];
}
if(empty($gender)) {
    $gender = $row['gender'];
}
if(empty($my_date)) {
    $my_date = $row['dateofbirth'];
}
if(empty($bank_account)) {
    $bank_account = $row['banking_account'];
}
if(empty($bank_name)) {
    $bank_name = $row['bank_name'];
}

echo $nemail;
echo $password;
echo $npassword;
echo $cpassword;
echo $firstname;
echo $lastname;
echo $tel_no;
echo $gender;
echo $my_date;
echo $bank_name;
echo $bank_account;
echo $interested_cars;

echo $row['email'];
echo $row['password'];
echo $npassword;
echo $cpassword;
echo $row['fname'];
echo $row['lname'];
echo $row['tel_no'];
echo $row['gender'];
echo $row['dateofbirth'];
echo $row['banking_account'];
echo $row['bank_name'];
foreach ($interested_cars as $value) {
    echo $value . '<br>';
}
foreach ($interested_car as $value) {
    echo $value . '<br>';
}
echo "<br>\n";

if (empty($nemail) &&
    $password == $row['password'] &&
    empty($npassword) &&
    $firstname == $row['fname'] &&
    $lastname == $row['lname'] &&
    $tel_no == $row['tel_no'] &&
    $gender == $row['gender'] &&
    $my_date == $row['dateofbirth'] &&
    $bank_account == $row['banking_account'] &&
    $bank_name == $row['bank_name'] &&
    $carinter == 1
) {
    $_SESSION['error'] = 'Please edit your profile before submit';
    header("location: ProfileForm.php");
    exit();
}
else if ($password != $row['password'] ) {
    $_SESSION['error'] = 'The current password is incorrect. please try again';
    header("location: ProfileForm.php");
    exit();
}
else if (!empty($npassword) and empty($cpassword)) {
    $_SESSION['error'] = 'Please confirm your password.';
    header("location: ProfileForm.php");
    exit();
}
else if (!empty($npassword) and strlen($npassword) > 20 || strlen($npassword) < 5) {
    $_SESSION['error'] = 'The password must be between 5 and 20 characters long.';
    header("location: ProfileForm.php");
    exit();
} 
else if ($npassword != $cpassword) {
    $_SESSION['error'] = 'Passwords do not match';
    header("location: ProfileForm.php");
    exit();
}
else {
    try {
        if(!empty($npassword)){
            $password = $npassword;
        }
        if (!isset($_SESSION['error'])) {   
            $validation_passed = true;
            echo $nemail;
            if (!empty($nemail))
            {      
                $check_email = "SELECT email FROM client WHERE email='$nemail'";
                $mailresult = mysqli_query($con,$check_email);
                $checkmail = mysqli_fetch_assoc($mailresult);
                echo $checkmail['email'];
                if ($nemail == $checkmail['email']) {
                    $_SESSION['warning'] = "The email has already been taken.";
                    header("location: ProfileForm.php");
                    $validation_passed = false;
                    exit();
                }
                else if (!filter_var($nemail, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['error'] = 'Please enter a valid email.';
                    header("location: ProfileForm.php");
                    $validation_passed = false;
                    exit();
                }
            }

            if ($validation_passed) {
                if(empty($nemail)) {
                    $nemail  = $row['email'];
                }
                if (count($interested_cars) < 1) {
                    $_SESSION['error'] = 'Please input at least 1 interested car';
                    header("location: ProfileForm.php");
                    exit();
                }  
                $sql2 = "UPDATE client SET
                fname = '$firstname',
                lname = '$lastname',
                dateofbirth = '$my_date',
                gender = '$gender',
                email = '$nemail',
                password = '$password',
                tel_no = '$tel_no',
                banking_account = '$bank_account',
                bank_name = '$bank_name'
                WHERE client_id = '$client_ID';";

                if (!mysqli_query($con, $sql2)) {
                    die('Error: ' . mysqli_error($con));
                }
        
                $sql3 = "DELETE FROM interested WHERE client_id = '$client_ID'";
                if (!mysqli_query($con, $sql3)) {
                    die('Error: ' . mysqli_error($con));
                }

                for ($i = 0; $i < count($interested_cars); $i++) {
                    $car = $interested_cars[$i];
                    $sql4 = "INSERT INTO interested (client_id, interested_car) VALUES ('$client_ID', '$car')";
                    if (!mysqli_query($con, $sql4)) {
                        die('Error: ' . mysqli_error($con));
                    }
                }            
                echo $nemail;
                $_SESSION['success'] = "You have successfully edited your profile. <a href='LoginForm.php' class='alert-link'>Click Here!</a> to Login again.";
                header("location: ProfileForm.php");
            } 
        }
        else {
            $_SESSION['error'] = "Something went wrong";
            header("location: ProfileForm.php");
        }
    } 
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>