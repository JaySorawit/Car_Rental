<?php
session_start();
$loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;
include('server.php');
$email = $_SESSION['email'];
$query = "SELECT * FROM rent_info 
JOIN car_info ON rent_info.license_plate = car_info.license_plate 
JOIN brand_info ON car_info.model_id = brand_info.model_id 
JOIN address ON car_info.district = address.district AND car_info.zipcode = address.zipcode
WHERE rent_info.client_id = (SELECT client_id FROM client WHERE email='$email');";

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
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/carform.css">
    <script src="https://kit.fontawesome.com/b33e8d6cbf.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
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
        body{
        /* background-image: url('your-image-url.jpg');  */
        background-size: cover; 
        background-repeat: no-repeat;
        background-attachment: fixed; }
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

<?php
if (!$loggedIn) {
    include 'navbaruser.php';
} else {
    include 'navbarclient.php';
}
?>

<body>
    <div class="container-md d-flex justify-content-center" style="height: auto; ">
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
                                            <p>Brand: <?php echo $row['brand']; ?></p>
                                            <p>Model: <?php echo $row['model_id']; ?></p>
                                            <p>Year: <?php echo $row['year_car']; ?></p>
                                            <p>Transmission: <?php echo $row['transmission']; ?></p>
                                        </div>
                                        <div class="boxinfocar">
                                            <p>Color: <?php echo $row['color']; ?></p>
                                            <p>Seat: <?php echo $row['seat']; ?></p>
                                            <p>Price per Day: <?php echo $row['price_per_day']; ?></p>
                                            <p>Start Date: <?php echo $row['start_date']; ?></p>
                                            <p>End Date: <?php echo $row['end_date']; ?></p>
                                            <?php
                                            $start_date = strtotime($row['start_date']);
                                            $end_date = strtotime($row['end_date']);
                                            $num_days = ($end_date - $start_date) / (60 * 60 * 24);
                                            $total_cost = $row['price_per_day'] * $num_days;
                                            $formatted_total_cost = number_format($total_cost, 2);
                                            ?>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="car_address">
                                    <div class="carinfotitle">
                                        <img src="">
                                        <h4>Rented Address</h4>
                                    </div>
                                    <div class="boxinfocar">
                                        <p>Province: <?php echo $row['province']; ?></p>
                                        <p>District: <?php echo $row['district']; ?></p>
                                        <p style="font-size: 25px; color: red;"><?php echo $formatted_total_cost; ?> THB</p>

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
        <p> Copyright © 2023.
        </p>
    </footer>
</body>

</html>
