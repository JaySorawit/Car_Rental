<?php
include 'Rental.php';
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Form</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/rental.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/b33e8d6cbf.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
</head>

<body>

    <?php include 'navbarclient.php'; ?>

    <div class="container-md d-flex justify-content-center" style="height: auto;">
        <div class="row bg-white">

            <div class="rental-left col-7">
                <div class="ps-2 mb-2"><a href="#" class="back-btn"><i
                            class="fa-solid fa-angle-left"></i>&nbsp;&nbsp;Back</a></div>
                <div class="rent-form mb-5 ps-2 border-bottom">
                    <h2 class="title text-uppercase">Rental Form</h2>
                </div>

                <img src="<?php echo $image_path; ?>" alt="car-image" class="car-img ps-2 pe-2">

                <div class="ps-2 pb-2 mt-4 border-bottom">
                    <h3 class="fw-bold">
                        <?php echo $brand, ' ', $model_name, ' ', $year_car, ' | '; ?>
                        <span class="price-car">
                            <?php echo $formatted_price, ' THB/day'; ?>
                        </span>
                    </h3>

                    <div class="d-flex flex-wrap align-items-center mt-4">
                        <div class="me-5 pe-4">
                            <h6 class="car-info">License Plate</h6>
                            <p class="text-uppercase">
                                <?php echo $license_plate; ?>
                            </p>
                        </div>
                        <div class="me-5 pe-4">
                            <h6 class="car-info">Transmission</h6>
                            <p class="text-uppercase">
                                <?php echo $transmission; ?>
                            </p>
                        </div>
                        <div class="me-5 pe-4">
                            <h6 class="car-info">Seat</h6>
                            <p class="text-uppercase">
                                <?php echo $seat; ?>
                            </p>
                        </div>
                        <div>
                            <h6 class="car-info">Location</h6>
                            <p class="text-uppercase">
                                <?php echo $province, ' - ', $district; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="ps-2 pb-4 mt-4 border-bottom">
                    <h4 class="fw-bold">Lessor</h4>
                    <div class="mt-4">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-circle-user fa-2xl me-2"></i>
                            <p class="lessor-info">
                                <?php echo $lessor_name; ?>
                            </p>
                        </div>
                    </div>
                </div>

            </div>


            <div class="rental-right col-5">
                <form name="inpfrm" method="post" action="Rental2.php">

                    <div class="pickdrop-info border rounded me-2">
                        <h5 class="fw-bold mb-3">Pick-up and drop-off</h5>

                        <div class="d-flex flex-column ms-2">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="start-date"><i class="fa-regular fa-calendar me-2"></i>Pick-up</label>
                                <div>
                                    <input type="text" name="start-date" id="start-date" class="date-info" />
                                    <select id="time-picker1" name="time-picker1" class="time-info"></select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <label for="end-date"><i class="fa-regular fa-calendar me-2"></i>Drop-off</label>
                                <div>
                                    <input type="text" name="end-date" id="end-date" class="date-info" />
                                    <select id="time-picker2" name="time-picker2" class="time-info"></select>
                                </div>
                            </div>

                        </div>

                        <div class="mt-2 ms-2">
                            <p style="color: red; font-size: 12px;">* Pick-up and drop-off times will be the same.</p>
                        </div>
                    </div>

                    <div class="personal-info border rounded me-2 mt-4 pb-4 mb-3">

                        <h5 class="fw-bold mb-3">Personal information</h5>
                        <div class="d-flex justify-content-between align-items-center mb-2 ms-2">
                            <label for="start-date"><i class="fa-regular fa-id-card me-2"></i>Driver
                                license</label>
                            <div>
                                <?php
                                $query = "SELECT driving_license_no FROM client WHERE email = '$email'";
                                $result = mysqli_query($con, $query);
                                $row = mysqli_fetch_assoc($result);
                                if ($row['driving_license_no'] == null) {
                                    echo '<input style="width: 210px;" class="input-license" type="text" name="driving_license_no">';
                                    $_SESSION['have_license'] = 0;
                                } else {
                                    echo '<input style="width: 210px;" class="input-license input-license-already" type="text" name="driving_license_no2" value="' . $row['driving_license_no'] . '" readonly>';
                                    $_SESSION['have_license'] = 1;
                                }
                                ?>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-3 mt-4">Credit card infomation</h5>
                        <div>
                            <?php
                            $sql2 = "SELECT c.* FROM credit_card_client c JOIN client cl ON c.client_id = cl.client_id WHERE cl.email = '$email';";
                            $result = mysqli_query($con, $sql2);
                            if (mysqli_num_rows($result) == 0) {
                                $_SESSION['have_card'] = 0;
                                $display = 'block';
                                $display2 = 'none';
                            } else {
                                echo '<div class="d-flex justify-content-between align-items-center ms-2">';
                                echo '<label for="card-select"><i class="fa-regular fa-credit-card me-2"></i></i>Select a card</label>';
                                echo '<select id="card-select" class="card-info" name="card-select">';
                                echo '<option value="">Select a card</option>';
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['credit_card_id'] . '">' . $row['card_type'] . ' ending in ' . substr($row['credit_card_id'], -4) . '</option>';
                                }
                                echo '<option value="new_card">Add new card</option>';
                                echo '</select>';
                                echo '</div>';
                                $_SESSION['have_card'] = 1;
                                $display = 'none';
                                $display2 = 'block';
                            }
                            ?>


                            <div id="new-card-fields" style="display: <?php echo $display; ?>;">
                                <div class="d-flex justify-content-between align-items-center ms-2 mb-2">
                                    <label for="card-number"><i class="fa-regular fa-credit-card me-2"></i>Card number
                                    </label>
                                    <input type="text" id="card-number" class="card-info" name="card-number" size="20"
                                        maxlength="20">
                                </div>

                                <div class="d-flex justify-content-between align-items-center ms-2 mb-2">
                                    <label for="card-type"><i class="fa-brands fa-cc-visa me-2"></i>Card type</label>
                                    <select id="card-type" class="card-info" name="card-type">
                                        <option value="">Select a card type</option>
                                        <option value="Visa">Visa</option>
                                        <option value="Mastercard">Mastercard</option>
                                        <option value="American Express">American Express</option>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-between align-items-center ms-2 mb-2">
                                    <label for="expiration-date"><i
                                            class="fa-regular fa-calendar-xmark me-2"></i>Expiration (mm/yy) </label>
                                    <input type="month" id="expiration-date" class="card-info" name="expiration-date"
                                        size="20" maxlength="5">
                                </div>

                                <div class="d-flex justify-content-between align-items-center ms-2">
                                    <label for="cvv"><i class="fa-solid fa-key me-2"></i>CVV</label>
                                    <input type="text" id="cvv" class="card-info" name="cvv" size="20" maxlength="4">
                                </div>

                            </div>

                            <div id="new-card-fields2" style="display: <?php echo $display2; ?>;">

                                <div class="d-flex justify-content-between align-items-center ms-2 mt-2">
                                    <label for="cvv2"><i class="fa-solid fa-key me-2"></i>CVV</label>
                                    <input type="text" id="cvv2" class="card-info" name="cvv2" size="20" maxlength="4">
                                </div>

                            </div>

                            <div id="new-card-fields3" style="display:none" class="mt-2">
                                <div class="d-flex justify-content-between align-items-center ms-2 mb-2">
                                    <label for="new-card-number"><i class="fa-regular fa-credit-card me-2"></i>Card number
                                    </label>
                                    <input type="text" id="new-card-number" class="card-info" name="new-card-number" size="20"
                                        maxlength="20">
                                </div>

                                <div class="d-flex justify-content-between align-items-center ms-2 mb-2">
                                    <label for="new-card-type"><i class="fa-brands fa-cc-visa me-2"></i>Card type</label>
                                    <select id="new-card-type" class="card-info" name="new-card-type">
                                        <option value="">Select a card type</option>
                                        <option value="Visa">Visa</option>
                                        <option value="Mastercard">Mastercard</option>
                                        <option value="American Express">American Express</option>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-between align-items-center ms-2 mb-2">
                                    <label for="new-expiration-date"><i
                                            class="fa-regular fa-calendar-xmark me-2"></i>Expiration (mm/yy) </label>
                                    <input type="month" id="new-expiration-date" class="card-info" name="new-expiration-date"
                                        size="20" maxlength="5">
                                </div>

                                <div class="d-flex justify-content-between align-items-center ms-2">
                                    <label for="new-cvv"><i class="fa-solid fa-key me-2"></i>CVV</label>
                                    <input type="text" id="new-cvv" class="card-info" name="new-cvv" size="20" maxlength="4">
                                </div>
                            </div>


                        </div>

                    </div>

                    <?php if (isset($_SESSION['error'])) { ?>
                        <div class="regis-error alert alert-danger mt-1" role="alert">
                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                        </div>
                    <?php } ?>


                    <div class="cost-info border rounded me-2 mt-4">
                        <h5 class="fw-bold mb-3">Cost Detail</h5>

                        <div class="d-flex justify-content-between mb-3 border-bottom">
                            <p class="" id="day-diff">1 day rate</p>
                            <p class="" id="price1">
                                <?php echo 'THB ', $formatted_price; ?>
                            </p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p class="fs-5">Total payment</p>
                            <p class="fs-5 fw-bold total-price" id="price2">
                                <?php echo 'THB ', $formatted_price; ?>
                            </p>
                        </div>

                    </div>
                    <div class="mt-4"><a href="Rental2.php"> <button
                                class="submit-btn text-white rounded">Continue</button></a></div>
                </form>

            </div>

        </div>
    </div>


    <footer class="d-flex justify-content-center align-items-center">
        <p> Copyright © 2023.</p>
    </footer>

    <script src="js/bootstrap.min.js"></script>
    <script>
        var price = <?php echo $price; ?>;
    </script>
    <script src="js/rental.js"></script>

</body>

</html>