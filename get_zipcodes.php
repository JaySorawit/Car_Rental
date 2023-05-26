<?php
include 'server.php';

$district = $_GET['district'];
$province = $_GET['province'];

$sql = "SELECT DISTINCT zipcode FROM address WHERE district = '$district' AND province = '$province';";
$result = mysqli_query($con, $sql);

$zipcodes = array();
while ($row = mysqli_fetch_assoc($result)) {
    $zipcodes[] = $row;
}

header('Content-Type: application/json');
echo json_encode($zipcodes);
?>
