<?php 
    session_start();
    unset($_SESSION['user_login']);
    unset($_SESSION['admin_login']);
    $_SESSION['loggedIn'] = false;

    session_destroy();
    header('location: index.php');
?>