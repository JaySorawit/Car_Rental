<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "CarRental_DB");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/b33e8d6cbf.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'navbaruser.php';?>

    <div class="container-md mt-5 pt-5 d-flex justify-content-center align-items-center">
        <div class="row rounded bg-white">

            <div class="login-left col d-flex justify-content-center align-items-center rounded-start">
                <img src="img/logo.png" alt="login-image" class="login-img">
            </div>

            <div class="login-right col align-items-center justify-content-center pt-5 pb-4 rounded-end">
                <div>
                    <div class="mb-1 text-center">
                        <h2 class="title text-uppercase fs-5">Account Login</h2>
                    </div>
                    <form name="inpfrm" method="post" action="Login.php">
                        <?php if (isset($_SESSION['error'])) { ?>
                            <div class="login-incorrect alert alert-danger mb-0 mt-4" role="alert">
                                <?php
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php } ?>
                        <table class="login-table">
                            <tr class="login-info">
                                <td><span class="ms-4 me-3"><i class="fa-solid fa-envelope fa-lg"></i></span></td>
                                <td><input class="login-input fs-6 ps-4" name="email" type="text" id="email" placeholder="Email" size="40"></td>
                            </tr>
                            <tr class="login-info">
                                <td><span class="ms-4 me-3"><i class="fa-solid fa-lock fa-lg"></i></span></td>
                                <td><input class="login-input fs-6 ps-4" name="password" type="password" id="password" placeholder="Password" size="40"></td>
                            </tr>
                            <tr class="login-submit mt-4">
                                <td><input class="login-submit-btn text-uppercase text-white fs-6" name="INSERT" type="submit" id="INSERT" value="LOGIN" /></td>
                            </tr>
                            <tr class="login-signup d-flex justify-content-center mt-3 mb-1">
                                <td>
                                    <div class="text-muted fs-7">Don't have an account? <a href="RegisterForm.php">Sign
                                            up</a></div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>

    <script src="js/bootstrap.min.js"></script>

</body>

</html>