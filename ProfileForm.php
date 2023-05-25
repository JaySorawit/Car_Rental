<?php 
    session_start();
    include('server.php');

    if (!isset($_SESSION['loggedIn'])) {
        header('Location: login.php');
        exit;
    }

    $email = $_SESSION['email'];
    $fname = $_SESSION['lname'];
    $lname = $_SESSION['fname'];
    $client_id = $_SESSION['client_id'];
    $sql1 = "SELECT * FROM client WHERE client_id='$client_id';";
    $result = mysqli_query($con,$sql1);
    $client = mysqli_fetch_assoc($result);

    $dateofbirth = $client['dateofbirth'];
    $gender = $client['gender'];
    $tel_no = $client['tel_no'];
    $banking_account = $client['banking_account'];
    $bank_name = $client['bank_name'];
    $lessor_state = $client['lessor_state'];
    $driverlicense = $client['driving_license_no'];

    $sql2 = "SELECT * FROM interested WHERE client_id ='$client_id';";
    $result = mysqli_query($con, $sql2);
    $interested_car = array();

    while ($interested = mysqli_fetch_assoc($result)) {
        $interested_car[] = $interested['interested_car'];
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <?php include "navbarclient.php"; ?>
    <title>My Profile</title>
    <style>
    body {
        background-image: url("./img/component/bg2.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    </style>
</head>

<body>
    <div class="container-md">
        <div class="profile-container">
            <div class="titleProfile">
                <h1>Profile</h1>
            </div>
            <hr style="opacity: 0.5;width: 90%;margin: 20px auto;">
            <div class="alertbox">
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
            </div>
            <form id="profile-Form" name="inpfrm" method="post" action="Profile.php">
                <div class="profile-form">
                    <div class="profile-form1">
                        <h1> Your personal information </h1>
                        <div class="boxform">
                            <div class="input-box-group">
                                <div class="input-box">
                                    <label for="fname">First name:</label><br>
                                    <input class="input-text" type="text" id="fname" name="fname" size="30"
                                        placeholder="<?php echo $fname ?>" value=""><br>
                                </div>
                                <div class="input-box">
                                    <label>Last name:</label><br>
                                    <input class="input-text" type="text" id="lname" name="lname" size="30"
                                        placeholder="<?php echo $lname ?>" value=""><br>
                                </div>
                            </div>
                            <div class="input-box-group">
                                <div class="input-box">
                                    <label>Date of birth:</label><br>
                                    <div class="inputboxdate" id="myDate">
                                        <?php
                                        $day = date('d', strtotime($client['dateofbirth']));
                                        $month = date('F', strtotime($client['dateofbirth']));
                                        $year = date('Y', strtotime($client['dateofbirth']));
                                        echo "<span>$day $month $year</span>";
                                        ?>
                                    </div>
                                    <div class="myPass">
                                        <select class="input-text-date" id="day" name="day">
                                        <?php
                                        for ($i = 1; $i <= 31; $i++) {
                                        $selected = ($i == date('d', strtotime($client['dateofbirth']))) ? 'selected' : '';
                                        echo "<option value='$i' $selected>$i</option>";
                                        }
                                        ?>
                                        </select>

                                        <select class="input-text-date" id="month" name="month">
                                        <?php
                                        $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                                        foreach ($months as $index => $month) {
                                            $value = $index + 1;
                                            $selected = ($value == date('m', strtotime($client['dateofbirth']))) ? 'selected' : '';
                                            echo "<option value='$value' $selected>$month</option>";
                                        }
                                        ?>
                                        </select>

                                        <select class="input-text-date" id="year" name="year">
                                        <?php
                                        $current_year = date("Y");
                                        for ($i = $current_year; $i >= $current_year - 100; $i--) {
                                           $selected = ($i == date('Y', strtotime($client['dateofbirth']))) ? 'selected' : '';
                                           echo "<option value='$i' $selected>$i</option>";
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label>Gender:</label><br>
                                    <div class="radio-inputs">
                                        <label class="radio">
                                            <input type="radio" name="gender" value="male"
                                                <?php echo ($client['gender'] == 'male') ? 'checked' : ''; ?>>
                                            <span class="name">Male</span>
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="gender" value="female"
                                                <?php echo ($client['gender'] == 'female') ? 'checked' : ''; ?>>
                                            <span class="name">Female</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="input-box-group">
                                <div class="input-box">
                                    <label>Email:</label><br>
                                    <input class="input-text" type="text" id="nemail" name="nemail" size="35"
                                        placeholder="<?php echo $email ?>" value=""><br>
                                </div>
                                <div class="input-box">
                                    <label>Tel number:</label><br>
                                    <input class="input-text" type="text" id="tel_no" name="tel_no" size="35"
                                        placeholder="<?php echo $tel_no ?>" value=""><br>
                                </div>
                            </div>
                            <div class="input-box-group">
                                <div class="input-box">
                                    <label>Bank name:</label><br>
                                    <input class="input-text" type="text" id="bank_name" name="bank_name" size="35"
                                        placeholder="<?php echo $bank_name ?>" value=""><br>
                                </div>
                                <div class="input-box">
                                    <label>Bank account:</label><br>
                                    <input class="input-text" type="text" id="bank_account" name="bank_account"
                                        size="35" placeholder="<?php echo $banking_account ?>" value=""><br>
                                </div>
                            </div>
                            <div class="input-box-group">
                                <div class="inputboxhide" id="myDrive">
                                    <label>Driver license:</label><br>
                                    <div class="inputboxdate">
                                        <?php 
                                        if (!empty($driverlicense)){
                                            echo "<span>$driverlicense</span>";
                                        }
                                        else {
                                            echo "<span>-</span>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="inputboxhide" id="mylessor">
                                    <label>Lessor:</label><br>
                                    <div class="inputboxdate">
                                        <?php
                                        if ($lessor_state == 1){
                                            echo "<span>Yes</span>";
                                        }
                                        else{
                                            echo "<span>No</span>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-form2">
                        <div class="input-box-mini">
                            <h1> Your password </h1>
                            <div class="boxform">
                                <div class="input-box-group2">
                                    <div class="input-box">
                                        <label>Current password:</label><br>
                                        <input class="input-text-pass" type="password" id="password" name="password"
                                            size="25" placeholder="*****" value=""><br><br>
                                    </div>
                                    <div class="myPass">
                                        <label>New password:</label><br>
                                        <input class="input-text-pass" type="password" id="npassword" name="npassword"
                                            size="25" value=""><br><br>
                                    </div>
                                    <div class="myPass">
                                        <label>Confirm new password:</label><br>
                                        <input class="input-text-pass" type="password" id="cpassword" name="cpassword"
                                            size="25" value=""><br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-box-mini">
                            <h1> Your interested car </h1>
                            <div class="box-form">
                                <div class="input-box-group2">
                                    <div class="input-box">
                                        <label style="width: 120px;">Interested Car: </label> <br>
                                        <input type="checkbox" name="interestedcar[Sedan]" value="Sedan"
                                            <?php if (in_array('Sedan', $interested_car)) echo 'checked'; ?>> Sedan
                                        <input type="checkbox" name="interestedcar[Van]" value="Van"
                                            <?php if (in_array('Van', $interested_car)) echo 'checked'; ?>> Van
                                        <input type="checkbox" name="interestedcar[PPV]" value="PPV"
                                            <?php if (in_array('PPV', $interested_car)) echo 'checked'; ?>> PPV
                                        <input type="checkbox" name="interestedcar[SUV]" value="SUV"
                                            <?php if (in_array('SUV', $interested_car)) echo 'checked'; ?>> SUV
                                    </div>
                                </div>
                                <div class="input-box-group2">
                                    <div class="input-box">
                                        <input type="checkbox" name="interestedcar[Pickup]" value="Pickup"
                                            <?php if (in_array('Pickup', $interested_car)) echo 'checked'; ?>> Pickup
                                        <input type="checkbox" name="interestedcar[MPV]" value="MPV"
                                            <?php if (in_array('MPV', $interested_car)) echo 'checked'; ?>> MPV
                                        <input type="checkbox" name="interestedcar[Hatchback]" value="Hatchback"
                                            <?php if (in_array('Hatchback', $interested_car)) echo 'checked'; ?>> Hatchback
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-button">
                    <button id="edit-button" class="profile-submit" type="button" onclick="editToggle(this);">Edit</button>
                    <input id="myPass" type="submit" class="profile-submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <footer>
        <p> Copyright © 2023. </p>
    </footer>

    <script src="js/script.js"></script>
</body>

</html>