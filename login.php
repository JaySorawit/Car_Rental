<?php
session_start(); // start the session

// check if form is submitted
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // validate username and password (e.g. check against database)
    if ($username === 'myuser' && $password === 'mypassword') {
        // set loggedIn variable to true and redirect to home page
        $_SESSION['loggedIn'] = true;
        header('Location: index.php');
        exit();
    } else {
        // show error message if login fails
        echo "Invalid username or password";
    }
}
?>
