<?php
    session_start();
    if (!isset($_SESSION['loggedIn'])) {
        header('Location: login.php');
        exit;
    }
    include 'server.php';

    $license_plate = $_POST['license_plate'];

    echo $license_plate;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="Deletecar.php" method="post">
        <input type="submit" class="carsubmit" name="Delete" style="margin:0 auto;" value="Delete">
    </form>
</body>
</html>