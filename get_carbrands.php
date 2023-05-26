<?php
include 'server.php';

$sql = "SELECT DISTINCT brand FROM brand_info ORDER BY brand_info.brand ASC";
$result = mysqli_query($con, $sql);

$brands = array();
while ($row = mysqli_fetch_assoc($result)) {
  $brands[] = $row;
}

header('Content-Type: application/json');
echo json_encode($brands);
?>
