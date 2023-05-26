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
    ) AND model_id IN (
      SELECT model_id
      FROM brand_info
      WHERE brand = '$brand'
    ) 
    AND license_plate IN (SELECT license_plate
    FROM rent_info
    WHERE '$startDate' NOT BETWEEN start_date AND end_date
      AND '$endDate' NOT BETWEEN start_date AND end_date
    )AND transmission ='$transmission';
    "; 

    $conn = mysqli_connect('localhost', 'root', '', 'carrental_db');

    // ตรวจสอบการเชื่อมต่อฐานข้อมูล
    if (!$conn) {
        die("Error: " . mysqli_connect_error());
    }

    // ส่งคำสั่ง SQL ไปยังฐานข้อมูล
    $result = mysqli_query($conn, $query);

    // ตรวจสอบผลลัพธ์ของคำสั่ง SQL
    

    // ปิดการเชื่อมต่อฐานข้อมูล
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
       <main>
    <div class="car-list">
        <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="car-item">';
                //echo '<img src="' . $row['car_image'] . '" alt="Car Image">'; // เพิ่มบรรทัดนี้เพื่อแสดงรูปภาพรถ
                echo '<div class="car-details">';
                echo '<h2>' . $brand . ' ' . $row['model_id'] . '</h2>';
                echo '<p>License Plate: ' . $row['license_plate'] . '</p>';
                echo '<p>Transmission: ' . $row['transmission'] . '</p>';
                echo '<p>Color: ' . $row['color'] . '</p>';
                echo '<p>Seat: ' . $row['seat'] . '</p>';
                echo '<p>Price: ' . $row['price_per_day'] . ' per day</p>';
                echo '<a href="RentalForm.php?car_id=' . $row['license_plate'] . '">Book Now</a>'; // เพิ่มลิงก์ "Book Now" และส่งพารามิเตอร์ car_id
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