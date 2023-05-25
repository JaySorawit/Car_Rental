<?php
include 'server.php';

$brand = $_GET['brand'];

$sql = "SELECT DISTINCT model_name FROM brand_info WHERE brand = '$brand'";
$result = mysqli_query($con, $sql);

$models = array();
while ($row = mysqli_fetch_assoc($result)) {
  $models[] = $row;
}

header('Content-Type: application/json');
echo json_encode($models);
?>
