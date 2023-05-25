<?php 
    session_start();
    if (!isset($_SESSION['loggedIn'])) {
        header('Location: login.php');
        exit;
    }

    include 'sever.php';

    // $sql1 = "SELECT * FROM address;";
    // $result1 = mysqli_query($con,$sql1);
    // $address = mysqli_fetch_assoc($result1);

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
        <div class="container-md d-flex justify-content-center" style="height: auto;">
        <div class="row bg-white">
            <div class="titlecar"> CAR FORM </div>
            <hr style="opacity: 0.5;width: 90%;margin: 20px auto;">
            <div class="alertbox">
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
            
            <form action="Car.php" method="post" enctype="multipart/form-data" id="Car-Form">
                <div class="carinsert">                
                    <div class="carinfo">
                        <h1> Your car information </h1>
                        <div class="carboxform">
                            <div class="carinput-box-group">
                                <div class="carinput-box">
                                    <label>License plate:</label>
                                    <input class="carinput" type="text" id="bank_name" name="bank_name"
                                        placeholder="<?php echo $bank_name ?>" value=""><br>
                                </div>
                            </div>
                            <div class="carinput-box-group">
                                <div class="carinput-box">
                                    <label>Brand:</label>
                                    <select class="carinput" id="brand" name="brand">
                                        <option value="">Select car brand </option>
                                    </select> <br>
                                </div>
                                <div class="carinput-box">
                                    <label>Model:</label>
                                    <select class="carinput" id="model_name" name="model_name">
                                        <option value="">Select car model </option>
                                    </select> <br>
                                </div>
                            </div> 
                            <div class="carinput-box-group">   
                                <div class="carinput-box">
                                    <label>Year of car:</label>
                                    <select class="carinput" id="Year_car" name="Year_car">
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
                                            <input type="radio" name="Transmission" value="auto">
                                            <span class="name">Auto</span>
                                        </label>
                                        <label class="carradio">
                                            <input type="radio" name="Transmission" value="manual">
                                            <span class="name">Manual</span>
                                        </label>
                                    </div><br>
                                </div>
                            </div>
                            <div class="carinput-box-group">
                                <div class="carinput-box">
                                    <label>Color:</label>
                                    <input class="carinput" type="text" id="bank_name" name="bank_name"
                                        placeholder="<?php echo $bank_name ?>" value=""><br>
                                </div>
                                <div class="carinput-box">
                                    <label>Seat:</label>
                                    <input class="carinput" type="text" id="bank_account" name="bank_account"
                                     placeholder="<?php echo $banking_account ?>" value=""><br>
                                </div>
                            </div>
                            <div class="carinput-box-group">
                                <div class="carinput-box">
                                    <label>Price / day:</label>
                                    <input class="carinput" type="text" id="bank_name" name="bank_name"
                                        placeholder="<?php echo $bank_name ?>" value=""><br>
                                </div>
                                <div class="carinput-box">
                                    <label>Image of car:</label>
                                    <input class="carinput-pic" type="file" id="bank_account" name="bank_account"
                                     placeholder="<?php echo $banking_account ?>" value=""><br>
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
                                <select class="carinput" id="province" name="province">
                                <option value="">Select province</option>
                                </select><br>
                            </div>
                            </div>
                            <div class="carinput-box-group">
                            <div class="carinput-box">
                                <label>District:</label>
                                <select class="carinput" id="district" name="district">
                                <option value="">Select district</option>
                                </select><br>
                            </div>
                            </div>
                            <div class="carinput-box-group">
                            <div class="carinput-box">
                                <label>Zipcode:</label>
                                <select class="carinput" id="zipcode" name="zipcode">
                                <option value="">Select zipcode</option>
                                </select><br>
                            </div>
                            </div>
                        </div>
                        <input type="submit" class="carsubmit" value="Submit">
                    </div>   
                </div>
            </form>
            <div class="carshow">
                <hr style="opacity: 0.5;width: 90%;margin: 20px auto 0;">
                <div class="titlecar" style="margin-bottom:30px"> My car </div>
                <div class="listcar">
                    <div class="boxofcar">
                        <div class="imgofcar">
                            <img src="img/car/aaa.jpg">
                        </div>
                        <div class="infocar">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        
        <footer>
            <p> Copyright © 2023. </p>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
        $(document).ready(function() {
        // Load provinces on page load
        $.ajax({
            url: 'get_provinces.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) 
            {
                var options = '<option value="">Select province</option>';
                data.forEach(function(province) 
                {
                    options += '<option value="' + province.province + '">' + province.province + '</option>';
                });
                $('#province').html(options);
            }
        });

        // Handle province change event
        $('#province').change(function() {
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
                success: function(data) {
                var options = '<option value="">Select district</option>';
                data.forEach(function(district) {
                    options += '<option value="' + district.district + '">' + district.district + '</option>';
                });
                $('#district').html(options);
                }
            });
            }
        });

        // Handle district change event
        $('#district').change(function() {
            var selectedDistrict = $(this).val();

            // Clear zipcode dropdown
            $('#zipcode').html('<option value="">Select zipcode</option>');

            if (selectedDistrict !== '') {
            // Load zipcodes based on the selected district
            $.ajax({
                url: 'get_zipcodes.php',
                method: 'GET',
                dataType: 'json',
                data: { district: selectedDistrict },
                success: function(data) {
                    var options = '<option value="">Select zipcode</option>';
                    data.forEach(function(zipcode) {
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
        $(document).ready(function() {
        // Load car brands on page load
        $.ajax({
            url: 'get_carbrands.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
            var options = '<option value="">Select car brand</option>';
            data.forEach(function(brand) {
                options += '<option value="' + brand.brand + '">' + brand.brand + '</option>';
            });
            $('#brand').html(options);
            }
        });

        
        // Handle province change event
        $('#brand').change(function() {
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
                success: function(data) {
                var options = '<option value="">Select car model</option>';
                data.forEach(function(model) {
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