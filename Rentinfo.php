<?php
    session_start();
    if (!isset($_SESSION['loggedIn'])) {
        header('Location: login.php');
        exit;
    }
    include 'server.php';

    if (isset($_POST['license_plate'])) {
        $license_plate = $_POST['license_plate'];
    } else {
        $license_plate = $_SESSION['current_selected_car'];
    }

    $sql1 = "SELECT c.*,b.* 
    FROM car_info c
    JOIN brand_info b ON c.model_id = b.model_id 
    WHERE license_plate='$license_plate'";
    $result1 = mysqli_query($con,$sql1);
    $car = mysqli_fetch_assoc($result1);

    $sql2 = "SELECT r.*, c.fname, c.lname
    FROM rent_info r
    JOIN client c ON r.client_id = c.client_id
    WHERE r.license_plate = '$license_plate'
    ORDER BY r.start_date ASC";

    $result2 = mysqli_query($con, $sql2);
    if (!$result2) {
        die('Error: ' . mysqli_error($con));
    }
    $rentals = array(); // Initialize an empty array to store the rental data

    while ($row = mysqli_fetch_assoc($result2)) {
        $rentals[] = $row; // Append each row to the rentals array
    }

    $money = 0;
    $count = 0;

    function getRentalStatus($startDate, $endDate) {
        $currentDate = date('Y-m-d');
        if($startDate = 0 && $endDate = 0){
            return "There are currently no rentals";
        }
        if ($currentDate < $startDate) {
            return "Soon rental";
        } elseif ($currentDate >= $startDate && $currentDate <= $endDate) {
            return "Currently Renting";
        } else {
            return "There are currently no rentals";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent information</title>
    <link rel="stylesheet" href="css/carform.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <?php include 'navbarclient.php' ?>
</head>
<body>
    <div class="container-md d-flex justify-content-center" style="height: auto;">
    <div class="row bg-white" style="display:flex; flex-direction:row;">
        <div class="titlecar"><?php echo $car['brand'] .' '. $car['model_name']; ?></div>
        <span style="display: block; text-align: center; font-size: 18px;">License Plate: <?php echo $license_plate ?></span>
        <hr style="opacity: 0.5;width: 90%;margin: 20px auto;">
        <div class="alertbox" style="width:50%;">
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
        <div class="box" style="height:10px;"></div>
        <div class="imgofcarforrent">
            <img src="<?php echo $car['image_path']; ?>">
        </div>
        <div class="box" style="height:30px;"></div>
        <div class="renthistory">
            <h2> Rental history of car</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Start date</th>
                        <th scope="col">End date</th>
                        <th scope="col">Days</th>
                        <th scope="col">Payment date</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $start_date = ""; // Initialize with an empty value
                    $end_date = ""; // Initialize with an empty value
                    if (!empty($rentals)) {
                        foreach ($rentals as $index => $rental) {
                            $client_fname = $rental['fname'];
                            $client_lname = $rental['lname'];
                            if ($rental['start_date'] === NULL && $rental['end_date'] === NULL) {
                                $start_date = 0;
                                $end_date = 0;
                            } else {
                                $start_date = $rental['start_date'];
                                $end_date = $rental['end_date'];
                            }
                            
                            if (!isset($start_date)) {
                                $start_date = 0;
                            }
                            
                            if (!isset($end_date)) {
                                $end_date = 0;
                            }
                            $days = floor((strtotime($rental['end_date']) - strtotime($rental['start_date'])) / (60 * 60 * 24));
                            $payment_date = $rental['payment_date'];
                            $price = $car['price_per_day']*$days;
                            $money += $price;
                            $count++;
                            ?>

                            <tr>
                                <th scope="row"><?php echo $index + 1; ?></th>
                                <td><?php echo $client_fname .' ' . $client_lname; ?></td>
                                <td><?php echo $start_date; ?></td>
                                <td><?php echo $end_date; ?></td>
                                <td><?php echo $days; ?></td>
                                <td><?php echo $payment_date; ?></td>
                                <td><?php echo $price; ?></td>
                            </tr>

                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7">No rental data available / Never been rented before.</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>
        <div class="rentalinfo">
            <h2>Rental information</h2>
            <p>The total number that this car has been rented: <?php echo $count;?> </p>
            <p>The total of income from renting out this car: <?php echo $money . ' ' . "Baht";?> </p>
            <p>Status rental of this car: <?php echo getRentalStatus($start_date, $end_date); ?></p>
        </div>

        <form action="Deletecar.php" class="d-flex justify-content-center" method="post">
            <input type="hidden" name="license_plate"  value="<?php echo $license_plate; ?>">
            <button class="btn btn-danger m-3"  style="height:40px">Delete car</button>
        </form>
    </div>
    </div>
    <footer>
        <p> Copyright © 2023. </p>
    </footer>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>