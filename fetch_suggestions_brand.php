<?php

$pdo = new PDO('mysql:host=localhost;dbname=carrental_db', 'root', '');
$stmt = $pdo->prepare('SELECT DISTINCT brand FROM brand_info WHERE brand LIKE :keyword LIMIT 4');
$stmt->execute(['keyword' => '%' . $_POST['keyword'] . '%']);
$options = $stmt->fetchAll(PDO::FETCH_COLUMN);


foreach ($options as $option) {
    echo '<li>' . $option . '</li>';
}
?>
