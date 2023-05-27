<?php
session_start();
$loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;

include('server.php');
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
    <script src="https://kit.fontawesome.com/b33e8d6cbf.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
</head>

<body>
    <?php
    if (!$loggedIn) {
        include 'navbaruser.php';
    } else {
        include 'navbarclient.php';
    }
    ?>
    <div class="container-md d-flex justify-content-center align-items-center mt-3 text-white" style="height: 78vh;">
        <main class="search-container">
            <div class="mb-1">
                <label for="start-date"><i class="fa-regular fa-calendar me-2"></i>Start Date &nbsp; </label>
                <input type="text" id="start-date" name="start-date" class="date-info">
                <span class="me-4"></span>
                <label for="end-date"><i class="fa-regular fa-calendar me-2"></i>End Date &nbsp; </label>
                <input type="text" id="end-date" name="end-date" class="date-info">
            </div>

            <br>
            <center class="mb-2">Province</center>

            <div class="search-wrapper">
                <input type="text" id="province_selected" class="form-control"
                    onkeyup="fetchSuggestions(this.value,'fetch_suggestions_province.php')" style="border: 1px solid #ccc;
    background: #f9f9f9;">
                <ul id="suggestions-list1" class ="text-black"></ul>
            </div>

            <br>
            <center class="mb-2">District</center>

            <div class="search-wrapper">
                <input type="text" id="district_selected" class="form-control"
                    onkeyup="fetchSuggestions_district(this.value, 'fetch_suggestions_district.php', $('#province_selected').val())" style="border: 1px solid #ccc;
    background: #f9f9f9;">
                <ul id="suggestions-list2" class ="text-black"></ul>
            </div>

            <br>
            <center class="mb-2">Brand</center>

            <div class="search-wrapper mb-3">
                <input type="text" id="brand_selected" class="form-control"
                    onkeyup="fetchSuggestions(this.value,'fetch_suggestions_brand.php')" style="border: 1px solid #ccc;
    background: #f9f9f9;">
                <ul id="suggestions-list3" class ="text-black"></ul>
            </div>

            <div class="transmission-wrapper d-flex justify-content-center mb-4">
                    <input class="me-1" type="radio" name="transmission" value="auto"> Automatic
                    <span class="me-3"></span>
                    <input class="me-1" type="radio" name="transmission" value="manual"> Manual Transmission
            </div>

            <button class="search-btn" onclick="search()">Find Car</button>
            <script src="js/date.js"></script>
            <script>
                function fetchSuggestions(keyword, url) {

                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: { keyword: keyword },
                        success: function (data) {
                            var activeInput = $('.form-control:focus');
                            var suggestionsList;

                            if (activeInput.attr('id') === 'province_selected') {
                                suggestionsList = $('#suggestions-list1');
                            } else if (activeInput.attr('id') === 'brand_selected') {
                                suggestionsList = $('#suggestions-list3');
                            }
                            if (activeInput.attr('id') === 'province_selected') {
                                $('#district_selected').val('');
                            }
                            suggestionsList.html(data);
                        }
                    });
                }
                function fetchSuggestions_district(keyword, url, province) {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            keyword: keyword,
                            province: province
                        },
                        success: function (data) {
                            var suggestionsList = $('#suggestions-list2');
                            suggestionsList.html(data);
                        }
                    });
                }
    function formatDate(dateString) {
    var date = new Date(dateString);
    var year = date.getFullYear();
    var month = (date.getMonth() + 1).toString().padStart(2, '0');
    var day = date.getDate().toString().padStart(2, '0');
    return year + '-' + month + '-' + day;
}
function search() {
    var startDate = formatDate(document.getElementById('start-date').value);
    var endDate = formatDate(document.getElementById('end-date').value);
    var province = document.getElementById('province_selected').value;
    var district = document.getElementById('district_selected').value;
    var brand = document.getElementById('brand_selected').value;
    var transmission = document.querySelector('input[name="transmission"]:checked');

    // เพิ่มการตรวจสอบค่าว่างสำหรับ "district" และ "brand"
    if (district.trim() === '') {
        district = 'all'; // กำหนดค่าเริ่มต้นเป็น 'all' หรือค่าอื่นที่เหมาะสม
    }
    if (brand.trim() === '') {
        brand = 'all'; // กำหนดค่าเริ่มต้นเป็น 'all' หรือค่าอื่นที่เหมาะสม
    }
    if (province.trim() === '') {
        province = 'all'; // กำหนดค่าเริ่มต้นเป็น 'all' หรือค่าอื่นที่เหมาะสม
    }
    
    // ตรวจสอบการเลือก transmission
    if (transmission) {
        transmission = transmission.value;
    } else {
        transmission = 'all'; // กำหนดค่าเริ่มต้นเป็น 'all' หากไม่มีการเลือก
    }

    // รหัสที่มีอยู่ก่อน
    // Perform any necessary validations before redirecting to viewcars.php
    // For example, check if all required fields are filled

    // Redirect to viewcars.php with the search parameters
    var params = "?start-date=" + startDate + "&end-date=" + endDate + "&province=" + province + "&district=" + district + "&brand=" + brand + "&transmission=" + transmission;
    window.location.href = "viewcars.php" + params;
    console.log(startDate);
}


                $(document).on('click', '#suggestions-list1 li', function () {
                    var selectedOption = $(this).text();
                    $('#province_selected').val(selectedOption);
                    $('#suggestions-list1').empty();
                });

                $(document).on('click', '#suggestions-list2 li', function () {
                    var selectedOption = $(this).text();
                    $('#district_selected').val(selectedOption);
                    $('#suggestions-list2').empty();
                });
                $(document).on('click', '#suggestions-list3 li', function () {
                    var selectedOption = $(this).text();
                    $('#brand_selected').val(selectedOption);
                    $('#suggestions-list3').empty();
                });
                $(document).on('click', function (e) {

                    if (!$(e.target).closest('.search-wrapper').length) {
                        $('#suggestions-list1').empty();
                        $('#suggestions-list2').empty();
                        $('#suggestions-list3').empty();
                    }
                });
            </script>
            
        </main>
    </div>

    <footer>
        <p> Copyright © 2023.</p>
    </footer>
</body>

</html>