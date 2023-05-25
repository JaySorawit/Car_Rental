<?php
include 'server.php';

$province = $_GET['province'];
$sql = "SELECT district FROM address WHERE province = '$province' ORDER BY address.district ASC";
$result = mysqli_query($con, $sql);

$districts = array();
while ($row = mysqli_fetch_assoc($result)) {
    $districts[] = $row;
}

header('Content-Type: application/json');
echo json_encode($districts);
?>
