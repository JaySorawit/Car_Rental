<?php

$pdo = new PDO('mysql:host=localhost;dbname=carrental_db', 'root', '');
$stmt = $pdo->prepare('SELECT DISTINCT province FROM address WHERE province LIKE :keyword LIMIT 4');
$stmt->execute(['keyword' => '%' . $_POST['keyword'] . '%']);
$options = $stmt->fetchAll(PDO::FETCH_COLUMN);


foreach ($options as $option) {
    echo '<li>' . $option . '</li>';
}
?>
