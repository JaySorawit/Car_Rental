<?php
    session_start();
    $loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;

    include('server.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Contact</title>
</head>
<body>
    <?php
        // Check if user is logged in
        if (!$loggedIn) {
            include 'navbaruser.php';    
        } else {
            include 'navbarclient.php';
        }
    ?>
        <div class="contact">
            <div class="container-sm">
                <h1 style="color:#fe6721;"> Contact Us</h1>
                <div class="contact-des">
                    <p> 
                    Car Rental is part of a term project in CPE241: database systems, 
                    Faculty of Engineering. Department of Computer Engineering. King Mongkut's 
                    University of Technology Thonburi. Semester 2, Academic Year 2022. 
                    </p>
                </div>
            </div>
            <div class="memberofgroup">
                <div class="member">
                    <img src="./img/Jay.jpg" >
                    <h4> Sorawit Mokthaisong <br> <span > 64070501049</span> <hr>  </h4>
                    <p >Sorawit.mokt@kmutt.ac.th </p>
                </div>
                <div class="member">
                    <img src="./img/Phan.jpg" >
                    <h4> Natchanon Kammanee <br> <span > 64070501062 </span> <hr>  </h4>
                    <p> Natchanon.kamm@kmutt.ac.th</p>
                </div>
                <div class="member">
                    <img src="./img/Ohm.jpeg">
                    <h4> Woraphol Sae-Ku <br> <span > 64070501084 </span> <hr>  </h4>
                    <p> Woraphol.sae-@kmutt.ac.th</p>
                </div>
            </div>
        </div>

    <footer>
        <p> Copyright © 2023.</p>
    </footer>
</body>
</html>