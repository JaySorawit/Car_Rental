<?php
    session_start();
    $loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;

    include('server.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>About Us</title>
</head>
<body>
    <?php
        // Check if user is logged in
        if (!$loggedIn) {
            include 'navbaruser.php';    
        } else {
            include 'navbarclient.php';
        }
    ?>
  <h1>About Us</h1>
  <p>We are a company that specializes in...</p>
  <footer>
        <p> Copyright © 2023.</p>
    </footer>
</body>
</html>
