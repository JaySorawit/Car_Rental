<?php 
    session_start();
    $_SESSION['rent_success'] = false;
    header('location: index.php');
?>