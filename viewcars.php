1<?php
    session_start();
    $loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;
    
    include('server.php');
    $startDate = $_GET['start-date'];
    $endDate = $_GET['end-date'];
    $province = $_GET['province'];
    $district = $_GET['district'];
    $brand = $_GET['brand'];
    $transmission = $_GET['transmission'];
    if ($district == 'all' && $province == 'all' && $brand == 'all' && $transmission == 'all') {
        $query = "SELECT *
        FROM car_info
        WHERE license_plate NOT IN (
            SELECT license_plate
            FROM rent_info
            WHERE ('$startDate' BETWEEN start_date AND end_date)
              OR ('$endDate' BETWEEN start_date AND end_date)
          )
          OR NOT EXISTS (
            SELECT license_plate
            FROM rent_info
            WHERE car_info.license_plate = rent_info.license_plate
          );
        ";
    } 
    elseif ($district != 'all' && $province == 'all' && $brand == 'all' && $transmission == 'all') {
        $query = "SELECT * 
            FROM car_info 
            WHERE zipcode 
            IN ( SELECT zipcode 
            FROM address 
            WHERE district = '$district' )AND ( license_plate NOT IN ( SELECT license_plate FROM rent_info 
            WHERE ('$startDate' BETWEEN start_date AND end_date) OR 
            ('$endDate' BETWEEN start_date AND end_date) ) OR NOT EXISTS ( SELECT license_plate FROM rent_info WHERE car_info.license_plate = rent_info.license_plate ));
        ";
    }
    
    elseif ($district == 'all' && $province != 'all' && $brand == 'all' && $transmission == 'all') {
        $query = "SELECT *
            FROM car_info
            WHERE zipcode IN (
              SELECT zipcode
              FROM address
              WHERE province = '$province'
            )
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
              )
            );
    ";
    }
    
    elseif ($district == 'all' && $province == 'all' && $brand != 'all' && $transmission == 'all') {
        $query = "SELECT *
            FROM car_info
            WHERE model_id IN (
              SELECT model_id
              FROM brand_info
              WHERE brand = '$brand'
            )
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
              )
            );
    ";
    }
    
    elseif ($district == 'all' && $province == 'all' && $brand == 'all' && $transmission != 'all') {
        $query = "SELECT *
            FROM car_info
            WHERE transmission = '$transmission'
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
              )
            );
    ";
    }
    
    elseif ($district != 'all' && $province != 'all' && $brand == 'all' && $transmission == 'all') {
        $query = "SELECT *
            FROM car_info
            WHERE zipcode IN (
              SELECT zipcode
              FROM address
              WHERE province = '$province'
              AND district = '$district'
            )
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
              )
            );
    ";
    }
    
    elseif ($district == 'all' && $province != 'all' && $brand != 'all' && $transmission == 'all') {
        $query = "SELECT *
            FROM car_info
            WHERE model_id IN (
              SELECT model_id
              FROM brand_info
              WHERE brand = '$brand'
            )
            AND zipcode IN (
              SELECT zipcode
              FROM address
              WHERE province = '$province'
            )
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
              )
            );
    ";
    }
    
    elseif ($district == 'all' && $province == 'all' && $brand != 'all' && $transmission != 'all') {
        $query = "SELECT *
            FROM car_info
            WHERE model_id IN (
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
              )
            );
    ";
    }
    
    elseif ($district != 'all' && $province != 'all' && $brand != 'all' && $transmission == 'all') {
        $query = "SELECT *
            FROM car_info
            WHERE model_id IN (
              SELECT model_id
              FROM brand_info
              WHERE brand = '$brand'
            )
            AND zipcode IN (
              SELECT zipcode
              FROM address
              WHERE province = '$province'
              AND district = '$district'
            )
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
              )
            );
    ";
    }
    
    elseif ($district == 'all' && $province != 'all' && $brand != 'all' && $transmission != 'all') {
        $query = "SELECT *
            FROM car_info
            WHERE model_id IN (
              SELECT model_id
              FROM brand_info
              WHERE brand = '$brand'
            )
            AND transmission = '$transmission'
            AND zipcode IN (
              SELECT zipcode
              FROM address
              WHERE province = '$province'
            )
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
              )
            );
    ";
    }
    elseif ($district != 'all' && $province == 'all' && $brand != 'all' && $transmission == 'all') {
        $query = "SELECT *
            FROM car_info
            WHERE model_id IN (
              SELECT model_id
              FROM brand_info
              WHERE brand = '$brand'
            )
            AND zipcode IN (
              SELECT zipcode
              FROM address
              WHERE district = '$district'
            )
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
              )
            );
    ";
    }
    
    elseif ($district != 'all' && $province == 'all' && $brand == 'all' && $transmission != 'all') {
        $query = "SELECT *
            FROM car_info
            WHERE transmission = '$transmission'
            AND zipcode IN (
              SELECT zipcode
              FROM address
              WHERE district = '$district'
            )
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
              )
            );
    ";
    }
    
    elseif ($district == 'all' && $province != 'all' && $brand == 'all' && $transmission != 'all') {
        $query = "SELECT *
            FROM car_info
            WHERE transmission = '$transmission'
            AND zipcode IN (
              SELECT zipcode
              FROM address
              WHERE province = '$province'
            )
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
              )
            );
    ";
    }
    
    elseif ($district != 'all' && $province != 'all' && $brand == 'all' && $transmission != 'all') {
        $query = "SELECT *
            FROM car_info
            WHERE transmission = '$transmission'
            AND zipcode IN (
              SELECT zipcode
              FROM address
              WHERE province = '$province'
              AND district = '$district'
            )
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
              )
            );
    ";
    }
    
    elseif ($district != 'all' && $province == 'all' && $brand != 'all' && $transmission != 'all') {
        $query = "SELECT *
            FROM car_info
            WHERE model_id IN (
              SELECT model_id
              FROM brand_info
              WHERE brand = '$brand'
            )
            AND zipcode IN (
              SELECT zipcode
              FROM address
              WHERE district = '$district'
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
              )
            );
    ";
    }
    
    else {
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
    }
    

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
    <link rel="stylesheet" href="css/carform.css">
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
    <div class="container-md d-flex justify-content-center" style="height: auto;">
        <div class="row bg-white">
                <div class="carshow">
                    <div class="titlecar" style="margin-bottom: 30px;">My car</div>
                    <div class="listcar">
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="boxofcar">
                            <div class="imgofcar">
                                <img src="<?php echo $row['image_path']; ?>">
                            </div>
                            <div class="info_car">
                                <div class="car_info">
                                    <div class="carinfotitle">
                                        <img src="">
                                        <h4> Information of car</h4>
                                    </div>
                                    <div class="carcontent">
                                        <div class="boxinfocar">
                                            <p>License Plate: <?php echo $row['license_plate']; ?></p>
                                            <p>Brand: <?php echo $brand; ?></p>
                                            <p>Model: <?php echo $row['model_id']; ?></p>
                                            <p>Year: <?php echo $row['year_car']; ?></p>
                                        </div>
                                        <div class="boxinfocar">
                                            <p>Transmission: <?php echo $row['transmission']; ?></p>
                                            <p>Color: <?php echo $row['color']; ?></p>
                                            <p>Seat: <?php echo $row['seat']; ?></p>
                                            <p>Price per Day: <?php echo $row['price_per_day']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="car_address">
                                    <div class="carinfotitle">
                                        <img src="">
                                        <h4> Address</h4>
                                    </div>
                                    <div class="boxinfocar">
                                        <p>Province: <?php echo $province; ?></p>
                                        <p>District: <?php echo $district; ?></p>
                                        <a href="RentalForm.php?car_id=<?php echo $row['license_plate']; ?>"><button
                                                class="carsubmit">Book</button></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="box" style="height:50px; background-color:#333;"></div>
        </div>
    </div>



    <footer>
        <p> Copyright © 2023.</p>
    </footer>
</body>

</html>