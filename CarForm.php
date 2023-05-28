<?php
session_start();
if (!isset($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit;
}

$client_id = $_SESSION['client_id'];

include('server.php');

$sql = "SELECT c.*, b.brand, b.model_name, a.province
        FROM car_info c
        INNER JOIN brand_info b ON c.model_id = b.model_id
        INNER JOIN address a ON c.district = a.district AND c.zipcode = a.zipcode
        WHERE c.client_id = '$client_id'";

$result = mysqli_query($con, $sql);
if (!$result) {
    die('Error: ' . mysqli_error($con));
}

$license_plates = array();
$model_ids = array();
$brands = array();
$model_names = array();
$year_cars = array();
$transmissions = array();
$colors = array();
$seats = array();
$price_per_days = array();
$image_paths = array();
$provinces = array();
$districts = array();
$zipcodes = array();

while ($car = mysqli_fetch_assoc($result)) {
    $license_plates[] = $car['license_plate'];
    $model_ids[] = $car['model_id'];
    $brands[] = $car['brand'];
    $model_names[] = $car['model_name'];
    $year_cars[] = $car['year_car'];
    $transmissions[] = $car['transmission'];
    $colors[] = $car['color'];
    $seats[] = $car['seat'];
    $price_per_days[] = $car['price_per_day'];
    $image_paths[] = $car['image_path'];
    $districts[] = $car['district'];
    $zipcodes[] = $car['zipcode'];
    $provinces[] = $car['province'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent out</title>
    <link rel="stylesheet" href="css/carform.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <?php include 'navbarclient.php' ?>
</head>

<body>
    <div class="box" style="width:100%; background-color:white;">
        <div class="container-md d-flex justify-content-center" style="height: auto;">
            <div class="row bg-white">
                <div class="titlecar"> CAR FORM </div>
                <hr style="opacity: 0.5;width: 90%;margin: 20px auto;">
                <div class="alertbox" style="width:50%; margin:0 auto;">
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
                <form action="Car.php" method="post" enctype="multipart/form-data" id="Car-Form"
                    onsubmit="return validateForm()">
                    <div class="carinsert">
                        <div class="carinfo">
                            <h1> Your car information </h1>
                            <div class="carboxform">
                                <div class="carinput-box-group">
                                    <div class="carinput-box">
                                        <label>License plate:</label>
                                        <input class="carinput" type="text" id="license_plate" name="license_plate"
                                            maxlength="10" value="" required=><br>
                                    </div>
                                </div>
                                <div class="carinput-box-group">
                                    <div class="carinput-box">
                                        <label>Brand:</label>
                                        <select class="carinput" id="brand" name="brand" required>
                                            <option value="">Select car brand </option>
                                        </select> <br>
                                    </div>
                                    <div class="carinput-box">
                                        <label>Model:</label>
                                        <select class="carinput" id="model_name" name="model_name" required>
                                            <option value="">Select car model </option>
                                        </select> <br>
                                    </div>
                                </div>
                                <div class="carinput-box-group">
                                    <div class="carinput-box">
                                        <label>Year of car:</label>
                                        <select class="carinput" id="Year_car" name="Year_car" required>
                                            <?php
                                            $currentYear = date("Y");
                                            $years = range($currentYear, $currentYear - 100);
                                            echo '<option value="">Select year of car</option>';
                                            foreach ($years as $year) {
                                                echo '<option value="' . $year . '">' . $year . '</option>';
                                            }
                                            ?>
                                        </select><br>
                                    </div>
                                    <div class="carinput-box">
                                        <label>Transmission:</label>
                                        <div class="carradio-inputs">
                                            <label class="carradio">
                                                <input type="radio" name="transmission" value="auto" required>
                                                <span class="name">Auto</span>
                                            </label>
                                            <label class="carradio">
                                                <input type="radio" name="transmission" value="manual">
                                                <span class="name">Manual</span>
                                            </label>
                                        </div>
                                        <p id="transmissionError" style="color: red; display: none;">Please select one
                                            of
                                            the options.</p>
                                    </div>
                                </div>
                                <div class="carinput-box-group">
                                    <div class="carinput-box">
                                        <label>Color:</label>
                                        <select class="carinput" id="color" name="color" required>
                                            <?php
                                            $color = array("White", "Black", "Gray", "Silver", "Blue", "Red", "Brown", "Green", "Orange", "Beige", "Purple", "Gold", "Yellow");
                                            echo '<option value="">Select color of car</option>';
                                            foreach ($color as $color) {
                                                echo "<option value='$color'>$color</option>";
                                            }
                                            ?>
                                        </select> <br>
                                    </div>
                                    <div class="carinput-box">
                                        <label>Seat:</label>
                                        <input class="carinput" type="text" id="seat" name="seat" maxlength="2" value=""
                                            required><br>
                                    </div>
                                </div>
                                <div class="carinput-box-group">
                                    <div class="carinput-box">
                                        <label>Price / day:</label>
                                        <input class="carinput" type="text" id="price_per_day" name="price_per_day"
                                            maxlength="6" value="" required><br>
                                    </div>
                                    <div class="carinput-box">
                                        <label>Image of car:</label>
                                        <input class="carinput-pic" type="file" id="image_path" name="image_path"
                                            accept="image/jpg, image/jpeg, image/png" required>
                                        <p style="font-size:10px; margin-top:5px;"> <b>Note:</b> Only JPG, JPEG, PNG
                                            files
                                            are allowed to upload.</p><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="caraddress">
                            <div class="carboxform2">
                                <h1> Your car address </h1>
                                <div class="carinput-box-group">
                                    <div class="carinput-box">
                                        <label>Province:</label>
                                        <select class="carinput" id="province" name="province" required>
                                            <option value="">Select province</option>
                                        </select><br>
                                    </div>
                                </div>
                                <div class="carinput-box-group">
                                    <div class="carinput-box">
                                        <label>District:</label>
                                        <select class="carinput" id="district" name="district" required>
                                            <option value="">Select district</option>
                                        </select><br>
                                    </div>
                                </div>
                                <div class="carinput-box-group">
                                    <div class="carinput-box">
                                        <label>Zipcode:</label>
                                        <select class="carinput" id="zipcode" name="zipcode" required>
                                            <option value="">Select zipcode</option>
                                        </select><br>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="carsubmit" name="Submit " value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="box" style="width=100%; background-color:#333;">
        <div class="container-md d-flex justify-content-center" style="height: auto;">
            <div class="row bg-white">
                <?php if (!empty($license_plates)) { ?>
                    <div class="carshow">
                        <div class="titlecar" style="margin-bottom: 30px;">My car</div>
                        <div class="listcar">
                            <?php foreach ($license_plates as $index => $license_plate) { ?>
                                <div class="boxofcar">
                                    <div class="imgofcar">
                                        <img src="<?php echo $image_paths[$index]; ?>">
                                    </div>
                                    <div class="info_car">
                                        <div class="car_info">
                                            <div class="carinfotitle">
                                                <img src="">
                                                <h4> Information of car</h4>
                                            </div>
                                            <div class="carcontent">
                                                <div class="boxinfocar">
                                                    <p>License Plate:
                                                        <?php echo $license_plate; ?>
                                                    </p>
                                                    <p>Brand:
                                                        <?php echo $brands[$index]; ?>
                                                    </p>
                                                    <p>Model:
                                                        <?php echo $model_names[$index]; ?>
                                                    </p>
                                                    <p>Year:
                                                        <?php echo $year_cars[$index]; ?>
                                                    </p>
                                                </div>
                                                <div class="boxinfocar">
                                                    <p>Transmission:
                                                        <?php echo $transmissions[$index]; ?>
                                                    </p>
                                                    <p>Color:
                                                        <?php echo $colors[$index]; ?>
                                                    </p>
                                                    <p>Seat:
                                                        <?php echo $seats[$index]; ?>
                                                    </p>
                                                    <p>Price per Day:
                                                        <?php echo $price_per_days[$index]; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="car_address">
                                            <div class="carinfotitle">
                                                <img src="">
                                                <h4> Address of car</h4>
                                            </div>
                                            <div class="boxinfocar">
                                                <p>Province:
                                                    <?php echo $provinces[$index]; ?>
                                                </p>
                                                <p>District:
                                                    <?php echo $districts[$index]; ?>
                                                </p>
                                                <p>Zipcode:
                                                    <?php echo $zipcodes[$index]; ?>
                                                </p>
                                            </div>
                                            <form action="rentinfo.php" method="post">
                                                <input type="hidden" name="license_plate" value="<?php echo $license_plate; ?>">
                                                <input type="submit" class="carsubmit" name="rentinfo" style="margin:0 auto;"
                                                    value="Rent info">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="box" style="height:50px; background-color:#333;"></div>
            </div>
        </div>
    </div>


    <footer>
        <p> Copyright © 2023. </p>
    </footer>

    <?php if (isset($_SESSION['delete_success'])) { ?>
        <div>
            <?php
            echo $_SESSION['delete_success'];
            unset($_SESSION['delete_success']);
            ?>
        </div>
    <?php } ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        function validateForm() {
            var seat = document.getElementById('seat').value;
            var price = document.getElementById('price_per_day').value;

            // Check if seat is an integer
            if (!/^\d+$/.test(seat)) {
                displayAlert('Seat must be an integer!');
                return false; // Prevent form submission
            }

            // Check if price is an integer
            if (!/^\d+$/.test(price)) {
                displayAlert('Price must be an integer!');
                return false; // Prevent form submission
            }

            // Proceed with form submission
            return true;
        }

        function displayAlert(message) {
            var alertbox = document.querySelector('.alertbox');
            alertbox.innerHTML = '<div class="alert alert-danger">' + message + '</div>';
        }
    </script>

    <script>
        $(document).ready(function () {
            // Load provinces on page load
            $.ajax({
                url: 'get_provinces.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    var options = '<option value="">Select province</option>';
                    data.forEach(function (province) {
                        options += '<option value="' + province.province + '">' + province.province + '</option>';
                    });
                    $('#province').html(options);
                }
            });

            // Handle province change event
            $('#province').change(function () {
                var selectedProvince = $(this).val();

                // Clear district and zipcode dropdowns
                $('#district').html('<option value="">Select district</option>');
                $('#zipcode').html('<option value="">Select zipcode</option>');

                if (selectedProvince !== '') {
                    // Load districts based on the selected province
                    $.ajax({
                        url: 'get_districts.php',
                        method: 'GET',
                        dataType: 'json',
                        data: { province: selectedProvince },
                        success: function (data) {
                            var options = '<option value="">Select district</option>';
                            data.forEach(function (district) {
                                options += '<option value="' + district.district + '">' + district.district + '</option>';
                            });
                            $('#district').html(options);
                        }
                    });
                }
            });

            // Handle district change event
            $('#district').change(function () {
                var selectedDistrict = $(this).val();
                var selectedProvince = document.getElementById("province").value;

                // Clear zipcode dropdown
                $('#zipcode').html('<option value="">Select zipcode</option>');

                if (selectedDistrict !== '' && selectedProvince !== '') {
                    // Load zipcodes based on the selected district
                    $.ajax({
                        url: 'get_zipcodes.php',
                        method: 'GET',
                        dataType: 'json',
                        data: { district: selectedDistrict, province: selectedProvince },
                        success: function (data) {
                            var options = '<option value="">Select zipcode</option>';
                            data.forEach(function (zipcode) {
                                options += '<option value="' + zipcode.zipcode + '">' + zipcode.zipcode + '</option>';
                            });
                            $('#zipcode').html(options);
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            // Load car brands on page load
            $.ajax({
                url: 'get_carbrands.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    var options = '<option value="">Select car brand</option>';
                    data.forEach(function (brand) {
                        options += '<option value="' + brand.brand + '">' + brand.brand + '</option>';
                    });
                    $('#brand').html(options);
                }
            });


            // Handle province change event
            $('#brand').change(function () {
                var selectedBrand = $(this).val();

                // Clear model_name dropdowns
                $('#model_name').html('<option value="">Select car model</option>');

                if (selectedBrand !== '') {
                    // Load car models based on selected brand
                    $.ajax({
                        url: 'get_carmodels.php',
                        method: 'GET',
                        dataType: 'json',
                        data: { brand: selectedBrand },
                        success: function (data) {
                            var options = '<option value="">Select car model</option>';
                            data.forEach(function (model) {
                                options += '<option value="' + model.model_name + '">' + model.model_name + '</option>';
                            });
                            $('#model_name').html(options);
                        }
                    });
                }
            });
        });
    </script>




</body>

</html>