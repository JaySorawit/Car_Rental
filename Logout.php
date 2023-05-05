<?php 
    session_start();
    unset($_SESSION['user_login']);
    unset($_SESSION['admin_login']);
    $_SESSION['loggedIn'] = false;
    header('location: index.php');
?>