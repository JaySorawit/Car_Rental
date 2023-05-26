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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .search-wrapper {
            position: relative;
            width: 300px; 
            margin: 0 auto; 
            margin-bottom: 10px;
        }

        #suggestions-list1 {
            position: absolute;
            width: 100%;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            max-height: 200px;
            overflow-y: auto;
            z-index: 9999;
            list-style: none; 
            padding: 0; 
            margin: 0; 
        }

        #suggestions-list1 li {
            padding: 10px;
            cursor: pointer;
        }

        #suggestions-list1 li:hover {
            background-color: #e9e9e9;
        }

        #suggestions-list2 {
            position: absolute;
            width: 100%;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            max-height: 200px;
            overflow-y: auto;
            z-index: 9999;
            list-style: none; 
            padding: 0; 
            margin: 0; 
            
        }

        #suggestions-list2 li {
            padding: 10px;
            cursor: pointer;
        }

        #suggestions-list2 li:hover {
            background-color: #e9e9e9;
        }

        #suggestions-list3 {
            position: absolute;
            width: 100%;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            max-height: 200px;
            overflow-y: auto;
            z-index: 9999;
            list-style: none; 
            padding: 0; 
            margin: 0; 
            
        }
        
        #suggestions-list3 li {
            padding: 10px;
            cursor: pointer;
        }

        #suggestions-list3 li:hover {
            background-color: #e9e9e9;
        }

        #search-input {
            width: 100%;
            padding: 10px;
        }

        .search-btn {
            display: block;
            width: 200px; 
            margin: 0 auto;
            padding: 10px;
            background-color: #E48D0A;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-btn:hover {
            background-color: #FFA41B;
        }

        .search-btn:active {
            background-color: #000000; 
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
        <main>
        <label for="start-date">Start Date:</label>
            <input type="date" id="start-date" name="start-date">
        <label for="end-date">End Date:</label>
            <input type="date" id="end-date" name="end-date">

        <br ><center>Province</center></br>

        <div class="search-wrapper">
            <input type="text" id="province_selected" class="form-control" onkeyup="fetchSuggestions(this.value,'fetch_suggestions_province.php')">
            <ul id="suggestions-list1"></ul>
        </div>

        <br ><center>District</center></br>

        <div class="search-wrapper">
            <input type="text" id="district_selected" class="form-control" onkeyup="fetchSuggestions_district(this.value, 'fetch_suggestions_district.php', $('#province_selected').val())">
            <ul id="suggestions-list2"></ul>
        </div>

        <br ><center>Brand</center></br>

        <div class="search-wrapper">
            <input type="text" id="brand_selected" class="form-control" onkeyup="fetchSuggestions(this.value,'fetch_suggestions_brand.php')">
            <ul id="suggestions-list3"></ul>
        </div>
        
        <div class="transmission-wrapper">
        <label>
            <input type="radio" name="transmission" value="Automatic"> Automatic
        </label>
        </div>

        <div class="transmission-wrapper">
        <label>
            <input type="radio" name="transmission" value="Manual Transmission"> Manual Transmission
        </label>
        </div>

        <button class="search-btn" onclick="search()">Find Car</button>
            <script>
                function fetchSuggestions(keyword,url) {
                    
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {keyword: keyword},
                        success: function (data) {
                            var activeInput = $('.form-control:focus');
                            var suggestionsList;

                            if (activeInput.attr('id') === 'province_selected') {
                                suggestionsList = $('#suggestions-list1');
                            }  else if (activeInput.attr('id') === 'brand_selected') {
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
                
                $(document).on('click', '#suggestions-list1 li', function() {
                    var selectedOption = $(this).text();
                    $('#province_selected').val(selectedOption);
                    $('#suggestions-list1').empty();
                });

                $(document).on('click', '#suggestions-list2 li', function() {
                    var selectedOption = $(this).text();
                    $('#district_selected').val(selectedOption);
                    $('#suggestions-list2').empty();
                });
                $(document).on('click', '#suggestions-list3 li', function() {
                    var selectedOption = $(this).text();
                    $('#brand_selected').val(selectedOption);
                    $('#suggestions-list3').empty();
                });
                $(document).on('click', function(e) {
        
                if (!$(e.target).closest('.search-wrapper').length) {
                    $('#suggestions-list1').empty();
                    $('#suggestions-list2').empty();
                    $('#suggestions-list3').empty();
                }
                });
            </script>
        </main>
    <footer>
        <p> Copyright © 2023.</p>
    </footer>
</body>
</html>