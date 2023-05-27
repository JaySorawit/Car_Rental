<?php
    session_start();
    $loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;
    
    include('server.php');
    $startDate = $_GET['start-date'];
    $endDate = $_GET['end-date'];
    $province = $_GET['province'];
    $district = $_GET['district'];
    $brand = $_GET['brand'];
    $transmission = $_GET['transmission'];
    $query = "SELECT *
    FROM car_info
    WHERE zipcode IN (
      SELECT zipcode
      FROM address
      WHERE province = '$province'
      AND district = '$district'
    )
    AND model_id IN (
      SELECT model_id
      FROM brand_info
      WHERE brand = '$brand'
    )
    AND transmission = '$transmission'
    AND (
      license_plate NOT IN (
        SELECT license_plate
        FROM rent_info
        WHERE ('$startDate' BETWEEN start_date AND end_date)
          OR ('$endDate' BETWEEN start_date AND end_date)
      )
      OR NOT EXISTS (
        SELECT license_plate
        FROM rent_info
        WHERE car_info.license_plate = rent_info.license_plate
      ));
    "; 

    $conn = mysqli_connect('localhost', 'root', '', 'carrental_db');


    if (!$conn) {
        die("Error: " . mysqli_connect_error());
    }


    $result = mysqli_query($conn, $query);


    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
       
        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .car-item {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
        
        .car-item img {
            width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .car-details {
            text-align: center;
        }

        .car-details a {
            display: inline-block;
            padding: 8px 16px;
            background-color: #E48D0A;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }

        .car-details a:hover {
            background-color: #FFA41B;
        }
    </style>
</head>

<body>
    <?php
        if (!$loggedIn) {
            include 'navbaruser.php';    
        } else {
            include 'navbarclient.php';
        }
    ?>
     <div class="location">
        <!-- <p>Location: <?php echo $province; ?>, <?php echo $district; ?></p> -->
        <!-- <p>Date: <?php echo $startDate; ?> to <?php echo $endDate; ?></p>
        <p>brand: <?php echo $brand; ?> to <?php echo $transmission; ?></p> -->
    </div>
       <main>
    <div class="car-list">
        <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="car-item">';
                //echo '<img src="' . $row['car_image'] . '" alt="Car Image">'; // แสดงรูปภาพรถ
                echo '<div class="car-details">';
                echo '<h2>' . $brand . ' ' . $row['model_id'] . '</h2>';
                //echo '<p>License Plate: ' . $row['license_plate'] . '</p>';
                echo '<p>Transmission: ' . $row['transmission'] . '</p>';
                echo '<p>Color: ' . $row['color'] . '</p>';
                echo '<p>Seat: ' . $row['seat'] . '</p>';
                echo '<p>Years: ' . $row['year_car'] . '</p>';
                echo '<p>Price: ' . $row['price_per_day'] . ' per day</p>';
                echo '<a href="RentalForm.php?car_id=' . $row['license_plate'] . '">Book Now</a>'; 
                echo '</div>';
                echo '</div>';
            }
            
        ?>
    </div>
</main>


    <footer>
        <p> Copyright © 2023.</p>
    </footer>
</body>
</html>