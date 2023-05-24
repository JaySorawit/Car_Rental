<?php
session_start();
if (!isset($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit;
}
include('server.php');

$banknumber = $_POST['banknumber'];
$bankname = $_POST['bankname'];

if (empty($banknumber)) {
    $_SESSION['error'] = 'Please enter your bank account number.';
    header("location: LessorForm.php");
} else if (empty($bankname)) {
    $_SESSION['error'] = 'Please enter your bank account name.';
    header("location: LessorForm.php");
} else {
   
    $email = $_SESSION['email'];

    try {
        $check_bank = "SELECT banking_account FROM client WHERE banking_account='$banknumber'";
        $result = mysqli_query($con, $check_bank);
        $row = mysqli_fetch_assoc($result);

        if ($row['banking_account'] == $banknumber) {
            $_SESSION['error'] = "The bank account number has already been used.";
            header("location: LessorForm.php");
        } else if (!isset($_SESSION['error'])) {
            // update the banking information using the email from the session variable
            $sql1 = "UPDATE client SET banking_account='$banknumber', bank_name='$bankname' WHERE email = '$email'";
            if (!mysqli_query($con, $sql1)) {
                die('Error: ' . mysqli_error($con));
            }

            $sql2 = "UPDATE client SET lessor_state = '1' WHERE banking_account = '$banknumber'";
            if (!mysqli_query($con, $sql2)) {
                die('Error: ' . mysqli_error($con));
            }

            // $_SESSION['success'] = "You have successfully registered as a lessor.";
            $_SESSION['lessor_state'] = 1;
            header("location: index.php");
        } else {
            $_SESSION['error'] = "Something went wrong";
            header("location: LessorForm.php");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
