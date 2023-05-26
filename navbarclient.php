<?php
    include('server.php');

    $email = $_SESSION['email'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $lessor_state = $_SESSION['lessor_state'];

    if ($lessor_state != 1) {
        $rentout = 'LessorForm.php';
    } else {
        $rentout = 'CarForm.php';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <nav width="100%" height= "50px" style=" background-color: black;">
        <div class="navbar">
            <div class="nav-logo">
                <a href="index.php"> Car Rental</a> 
            </div>
            <ul class="nav-menu" id="myMenu" >
                <li> <a href="index.php"> Home</a> </li>
                <li> <a href="aboutUs.php"> About</a> </li>
                <li> <a href="contact.php"> Contact</a> </li>
                <li id="menu-signup"> <a href="<?php echo $rentout; ?>"> Rent out</a> </li>
                <li id="menu-signup"> <a href="profileForm.php"> My Profile</a> </li>
                <li id="menu-signup"> <a href="#"> My rental car</a> </li>
                <li id="menu-signup"> <a href="logout.php"> Log out</a> </li>
            </ul>
            <div class="nav-right">
                <a href="<?php echo $rentout; ?>"><button class="login-button">Rent out</button></a>
                <div class="profile-dropdown"> 
                    <div class="profile" onclick="menuToggle();">
                        <img src="img/icon/icons8-male-user-48.png" />
                        <img src="img/icon/icons8-sort-down-30.png" width="20px" height ="20px" style="margin:auto 0;"/>
                    </div>
                    <div class="menu">
                        <h3><?php echo $fname.' '.$lname; ?><br /></h3>
                        <ul>
                            <li> <img src="img/icon/user-avatar.png" /><a href="profileForm.php">My profile</a> </li>
                            <li> <img src="img/icon/car.png" /><a href="#">My rental car</a> </li>
                            <li> <img src="img/icon/exit.png" width="15px" height="15px" style="margin-left: 3px;"/><a href="Logout.php">Log out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="ham-menu" onclick="toggleHam(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>
    </nav>

    <script src="js/script.js"></script>
</body>
</html>
