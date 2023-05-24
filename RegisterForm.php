<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "carrental_db");
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
    <title>Register Form</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/b33e8d6cbf.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'navbaruser.php'; ?>

    <div class="container-md d-flex justify-content-center align-items-center mt-4">
        <div class="regis-table p-4 border rounded border-dark bg-white">
            <form class="d-flex justify-content-center" name="inpfrm" method="post" action="Register.php">
                <table>
                    <tr class="d-flex justify-content-center">
                        <td>
                            <h2 class="title text-uppercase fs-4">Create Account</h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php if (isset($_SESSION['error'])) { ?>
                                <div class="regis-error alert alert-danger mt-1" role="alert">
                                    <?php
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']);
                                    ?>
                                </div>
                            <?php } ?>
                            <?php if (isset($_SESSION['success'])) { ?>
                                <div class="regis-error alert alert-success" role="alert">
                                    <?php
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                    ?>
                                </div>
                            <?php } ?>
                            <?php if (isset($_SESSION['warning'])) { ?>
                                <div class="regis-error alert alert-warning mt-1" role="alert">
                                    <?php
                                    echo $_SESSION['warning'];
                                    unset($_SESSION['warning']);
                                    ?>
                                </div>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr class="regis-info">
                        <td><span class="ms-4 me-3"><i class="fa-solid fa-envelope"></i></span></td>
                        <td><input class="regis-input fs-6" name="email" type="text" id="email" size="52" value=""
                                maxlength="30" placeholder="Email"></td>
                    </tr>
                    <tr class="regis-info">
                        <td><span class="ms-4 me-3"><i class="fa-solid fa-lock"></i></span></td>
                        <td><input class="regis-input fs-6" name="password" type="password" id="password" size="52"
                                value="" maxlength="20" placeholder="Password"></td>
                    </tr>
                    <tr class="regis-info">
                        <td><span class="ms-4 me-3"><i class="fa-solid fa-lock"></i></span></td>
                        <td><input class="regis-input fs-6" name="c_password" type="password" id="c_password" size="52"
                                value="" maxlength="20" placeholder="Confirm Password"></td>
                    </tr>
                    <tr class="regis-info">
                        <td><span class="ms-4 me-3"><i class="fa-solid fa-user"></i></span></td>
                        <td><input class="regis-input regis-name me-1" name="firstname" type="text" id="firstname"
                                size="22" value="" maxlength="30" placeholder="First Name"></td>
                        <td><input class="regis-input regis-name" name="lastname" type="text" id="lastname" size="22"
                                value="" maxlength="30" placeholder="Last Name"></td>
                    </tr>
                    <tr class="regis-info">
                        <td><span class="ms-4 me-3"><i class="fa-solid fa-phone"></i></span></td>
                        <td class="number"><input class="regis-input" name="phone" type="text" id="phone" size="52"
                                value="" maxlength="10" placeholder="Phone Number">
                        </td>
                    </tr>
                    <tr class="regis-info gender ms-2 p-3 ps-3">
                        <td><label class="text-muted me-5">Gender: &nbsp;</label></td>
                        <td>
                            <input type="radio" name="gender" value="male"> Male
                            <span class="me-3"></span>
                            <input type="radio" name="gender" value="female"> Female
                        </td>
                    </tr>
                    <tr class="regis-info dob ms-2 p-3 ps-3">
                        <!-- <td><label class="text-muted me-3">Date of birth: &nbsp;</label></td>
                        <td><input name="date" type="date" id="date"></td> -->
                        <td class="text-muted">
                            <label class="me-1" for="day">Day:</label>
                            <select class="me-3" id="day" name="day">
                                <?php
                                for ($i = 1; $i <= 31; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>

                            <label class="me-1" for="month">Month:</label>
                            <select class="me-3" id="month" name="month">
                                <?php
                                $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                                foreach ($months as $month) {
                                    echo "<option value='$month'>$month</option>";
                                }
                                ?>
                            </select>

                            <label for="year">Year:</label>
                            <select id="year" name="year">
                                <?php
                                $current_year = date("Y");
                                for ($i = $current_year; $i >= $current_year - 100; $i--) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr class="regis-info interestedcar ms-2 p-3 ps-3">
                        <td><label class="text-muted" style="width: 120px;">Interested Car: &nbsp;</label></td>
                        <td>
                            <input type="checkbox" name="interestedcar[Sedan]" value="Sedan"> Sedan
                            <span class="me-4"></span>
                            <input type="checkbox" name="interestedcar[Van]" value="Van"> Van
                            <span class="me-4"></span>
                            <input type="checkbox" name="interestedcar[PPV]" value="PPV"> PPV
                            <span class="me-4"></span>
                            <input type="checkbox" name="interestedcar[SUV]" value="SUV"> SUV
                            <span class="me-5"></span><span class="me-5"></span><span class="me-5"></span>
                            <span class="me-4"></span>
                            <input type="checkbox" name="interestedcar[Pickup]" value="Pickup"> Pickup
                            <span class="me-4"></span>
                            <input type="checkbox" name="interestedcar[MPV]" value="MPV"> MPV
                            <span class="me-4"></span>
                            <input type="checkbox" name="interestedcar[Hatchback]" value="Hatchback"> Hatchback
                        </td>
                    </tr>
                    <tr class="regis-submit mt-4">
                        <td><input class="regis-submit-btn text-uppercase text-white fs-6" name="INSERT" type="submit"
                                id="INSERT" value="Register" /></td>
                    </tr>
                    <tr class="regis-submit mt-3">
                        <td>
                            <div class="regis-login text-muted fs-7">Already have an account? <a
                                    href="LoginForm.php">Log In</a></div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>

</body>

</html>