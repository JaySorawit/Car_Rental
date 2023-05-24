<?php 
    session_start();
    if (!isset($_SESSION['loggedIn'])) {
        header('Location: login.php');
        exit;
    }

    include 'server';
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rent out</title>
    </head>
    <body>
        <?php include 'navbarclient.php' ?>
        <main>
            <h1> test</h1>
            <button id="edit-button" class="profile-submit" >Edit</button>
            <input type="submit" class="profile-submit" value="Submit">
        </main>
        
    </body>
    </html>
