<?php
include 'server.php';

$district = $_GET['district'];

$sql = "SELECT zipcode FROM address WHERE district = '$district'";
$result = mysqli_query($con, $sql);

$zipcodes = array();
while ($row = mysqli_fetch_assoc($result)) {
    $zipcodes[] = $row;
}

header('Content-Type: application/json');
echo json_encode($zipcodes);
?>
