<?php
session_start();
if (!isset($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit;
}
include('server.php');

$email = $_SESSION['email'];
$license_plate = $_SESSION['license_plate'];
$start_date_str = $_POST['start-date'];
$time_str = $_POST['time-picker1'];
$datetime_str = $start_date_str . ' ' . $time_str;
$start_datetime = date('Y-m-d H:i:s', strtotime($datetime_str));
$end_date_str = $_POST['end-date'];
$time_str = $_POST['time-picker2'];
$datetime_str = $end_date_str . ' ' . $time_str;
$end_datetime = date('Y-m-d H:i:s', strtotime($datetime_str));

$have_license = $_SESSION['have_license'];
$have_card = $_SESSION['have_card'];

if ($_POST['card-select'] == 'new_card') {
    $driving_license_no = $_POST['driving_license_no2'];
    $card_number = $_POST['new-card-number'];
    $card_type = $_POST['new-card-type'];
    $expiration_date = $_POST['new-expiration-date'];
    $cvv = $_POST['new-cvv'];
    $have_card = 0;
    $have_license = 0;
} else if ($have_license || $have_card) {
    $driving_license_no = $_POST['driving_license_no2'];
    $card_number = $_POST['card-select'];
    $sql = "SELECT * FROM credit_card_client WHERE credit_card_id = '$card_number'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $card_type = $row['card_type'];
    $expiration_date = $row['expires'];
    $cvv_true = $row['cvv'];
    $cvv = $_POST['cvv2'];
} else {
    $driving_license_no = $_POST['driving_license_no'];
    $card_number = $_POST['card-number'];
    $card_type = $_POST['card-type'];
    $expiration_date = $_POST['expiration-date'];
    $cvv = $_POST['cvv'];
}


if (empty($driving_license_no)) {
    $_SESSION['error'] = 'Please enter a driver license.';
    header("location: RentalForm.php");
} else if (empty($card_number)) {
    $_SESSION['error'] = 'Please enter a card number.';
    header("location: RentalForm.php");
} else if (empty($card_type) && !($_SESSION['have_card'])) {
    $_SESSION['error'] = 'Please enter a card type.';
    header("location: RentalForm.php");
} else if (empty($expiration_date) && !($_SESSION['have_card'])) {
    $_SESSION['error'] = 'Please enter an expiration date.';
    header("location: RentalForm.php");
} else if (empty($cvv)) {
    $_SESSION['error'] = 'Please enter a cvv.';
    header("location: RentalForm.php");
} else if (($have_license || $have_card) && $cvv != $cvv_true) {
    $_SESSION['error'] = 'Please enter a valid cvv.';
    header("location: RentalForm.php");
} else {
    try {
        $check_license = "SELECT driving_license_no FROM client WHERE driving_license_no = '$driving_license_no'";
        $result1 = mysqli_query($con, $check_license);
        $row1 = mysqli_fetch_assoc($result1);

        $check_card = "SELECT credit_card_id FROM credit_card_client WHERE credit_card_id = '$card_number'";
        $result = mysqli_query($con, $check_card);
        $row = mysqli_fetch_assoc($result);

        if (($row1 && $row1['driving_license_no'] == $driving_license_no) && !($_SESSION['have_license'])) {
            $_SESSION['error'] = "The driver license has already been used.";
            header("location: RentalForm.php");
        } else if (($row && $row['credit_card_id'] == $card_number) && !($_SESSION['have_card'])) {
            $_SESSION['error'] = "The card number has already been used.";
            header("location: RentalForm.php");
        } else if (!isset($_SESSION['error'])) {
            $query = "UPDATE client SET driving_license_no = '$driving_license_no' WHERE email = '$email'";
            $result = mysqli_query($con, $query);

            $sql = "SELECT client_id FROM client WHERE email = '$email';";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            $client_id = $row['client_id'];

            $sql = "SELECT c.* FROM credit_card_client c JOIN client cl ON c.client_id = cl.client_id WHERE cl.email = '$email';";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) == 0 || !($have_card)) {
                $sql = "INSERT INTO credit_card_client (credit_card_id, client_id, expires, card_type, cvv) 
                VALUES ('$card_number', '$client_id', '$expiration_date', '$card_type', '$cvv')";
                mysqli_query($con, $sql);
            }

            $sql = "INSERT INTO rent_info (client_id, license_plate, start_date, end_date, credit_card_id) 
                    VALUES ('$client_id', '$license_plate', '$start_datetime', '$end_datetime', '$card_number')";
            mysqli_query($con, $sql);

            $_SESSION['success'] = "You have Successfully Subscribed! <a href='LoginForm.php' class='alert-link'>Click Here!</a> to Login";
            header("location: index.php");
        } else {
            $_SESSION['error'] = "Something went wrong";
            header("location: RentalForm.php");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>