<?php
    $con=mysqli_connect("localhost","root","","CarRental_DB");
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
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/b33e8d6cbf.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-sm">
        <div class="login-card center">
            <div class="login-content pt-3 pb-5">
                <div class="login-title pb-3 text-center text-uppercase text-white fs-4">
                    <h2>Account Login</h2>
                </div>
                <div class="login-form pt-3 pb-4">
                    <form name="inpfrm" method="post" action="Login.php">
                        <table class="login-table">
                            <tr class="login-info">
                                <td><span class="ms-5 me-2"><i class="fa-solid fa-user fa-lg"></i></span></td>
                                <td><input class="login-input fs-6 ps-4" name="email" type="text" id="email"
                                        placeholder="Email" size="35">
                            </tr>
                            <tr class="login-info">
                                <td><span class="ms-5 me-2"><i class="fa-solid fa-lock fa-lg"></i></span></td>
                                <td><input class="login-input fs-6 ps-4" name="password" type="password" id="password"
                                        placeholder="Password" size="35"></td>
                            </tr>
                            <tr class="login-submit mt-4">
                                <td><input class="login-submit-btn text-uppercase text-white fs-6" name="INSERT"
                                        type="submit" id="INSERT" value="LOGIN" /></td>
                            </tr>
                            <tr class="d-flex justify-content-center mt-3 mb-1">
                                <td><div class="text-muted fs-7">Don't have an account? <a href="SignupForm.php">Sign up</a></div></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>