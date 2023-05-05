<?php
session_start();
$con=mysqli_connect("localhost","root","","CarRental_DB");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

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
  $_SESSION['user_id'] = $row['id'];
  $_SESSION['user_email'] = $row['email'];

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
    $_SESSION['email'] = $email;
    header("Location: index.php");
  }
} else {
    $_SESSION['error'] = 'Invalid Email or Password.';
    header("location: LoginForm.php");
}
mysqli_close($con);
?>
