<?php
    session_start();
    $loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;

    include('server.php');
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/styles.css">
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
    <div class="container-sm">
        <h1>About Us</h1>
        <p>We are a company that specializes in...</p>
    </div>

  <footer>
        <p> Copyright © 2023.</p>
    </footer>
</body>
</html>
