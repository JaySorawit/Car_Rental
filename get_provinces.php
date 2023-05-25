<?php
include 'server.php';

$sql = "SELECT DISTINCT province FROM address ORDER BY `address`.`province` ASC";
$result = mysqli_query($con, $sql);

$provinces = array();
while ($row = mysqli_fetch_assoc($result)) {
    $provinces[] = $row;
}

header('Content-Type: application/json');
echo json_encode($provinces);
?>
