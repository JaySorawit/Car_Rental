<?php
    session_start();
    include('server.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <nav>
        <div class="navbar">
            <div class="nav-logo">
                <a href="index.php"> Car Rental</a>
            </div>
            <hl class="nav-menu" id="myMenu" >
                <li> <a href="index.php"> Home</a> </li>
                <li> <a href="aboutUs.php"> About</a> </li>
                <li> <a href="#"> Contact</a> </li>
                <li id="menu-login"> <a href="LoginForm.php"> Log In</a> </li>
                <li id="menu-signup"> <a href="#"> Sign up</a> </li>
            </hl>
            <div class="nav-login" id="mylogin">
                <a href="LoginForm.php"> <button class="login-button">Log In</button> </a>
                <button class="signup-button">Sign up</button>
            </div>
            <div class="ham-menu" onclick="toggleHam(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>
    </nav>

    <script src="js/script.js"></script>
</body>
</html>