<?php
session_start();
include('server.php');

$email = $_POST['email'];
$password = $_POST['password'];

// Escape special characters to prevent SQL injection
$email = mysqli_real_escape_string($con, $email);
$password = mysqli_real_escape_string($con, $password);

$sql = "SELECT * FROM client WHERE email='$email' AND password='$password'";
$result = mysqli_query($con,$sql);
$count = mysqli_num_rows($result);

if($count == 1){
  $row = mysqli_fetch_assoc($result);
  $client_id = $row['client_id'];
  $fname = $row['fname'];
  $lname = $row['lname'];
  $lessor_state = $row['lessor_state'];

  // Check if the email belongs to the admin
  if ($email == 'admin@carrental.com') {
    $_SESSION['user_role'] = 'admin';
  } else {
    $_SESSION['user_role'] = 'user';
  }

  // Redirect to the appropriate page based on the user's role
  if ($_SESSION['user_role'] == 'admin') {
    header("Location: Admin/AdminHome.php");
    $_SESSION['loggedIn'] = true;
  } else {
    $_SESSION['loggedIn'] = true;
    $_SESSION['client_id'] = $client_id;
    $_SESSION['email'] = $email;
    $_SESSION['lname'] = $lname;
    $_SESSION['fname'] = $fname;
    $_SESSION['lessor_state'] = $lessor_state;
    header("Location: index.php");
  }
} else {
    $_SESSION['error'] = 'Invalid Email or Password.';
    header("location: LoginForm.php");
}
mysqli_close($con);
?>