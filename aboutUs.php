<?php
    session_start();
    $loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;

    include('server.php');
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/styles.css">
    <title>About Us</title>
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
        <div class="container-sm">
            <div class="aboutus">
                <h1> About Us</h1>
                <p> <br>
                    Welcome to our car rental website! We are a team of passionate car enthusiasts 
                    who believe that everyone should have access to quality transportation at an 
                    affordable price. Our goal is to make it easy for people to find and rent cars 
                    from a trusted community of car owners.
                </p>
                <p> <br>
                    Whether you're looking for a reliable car for your daily commute, a spacious SUV 
                    for a family vacation, or a luxurious sports car for a special occasion, we have 
                    a wide selection of vehicles to choose from. All of our cars are well-maintained 
                    and regularly serviced to ensure your safety and comfort.
                </p>
                <p> <br>
                    If you're a car owner looking to make some extra income, we invite you to join our 
                    community and start renting out your car. We provide a simple and secure platform for
                    you to list your car and connect with potential renters. You can choose your own rental 
                    rates, availability, and we'll handle the rest, from marketing your car to processing 
                    payments and providing insurance coverage.
                </p>
                <p><br>
                    At our car rental website, we are committed to providing exceptional customer service 
                    and support. If you have any questions or concerns, our friendly and knowledgeable team 
                    is always here to help. We believe that renting a car should be a hassle-free and enjoyable 
                    experience, and we strive to make that a reality for all of our customers.
                </p>
                <p> <br>
                    Thank you for choosing our car rental website. We look forward to serving you and 
                    helping you make the most of your travels.
                </p>
            </div>
        </div> 
    </main>


  <footer>
        <p> Copyright © 2023.</p>
    </footer>
</body>
</html>
