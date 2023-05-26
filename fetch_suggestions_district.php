<?php

$pdo = new PDO('mysql:host=localhost;dbname=carrental_db', 'root', '');
$stmt = $pdo->prepare('SELECT DISTINCT district FROM address WHERE district LIKE :keyword AND province LIKE :province LIMIT 4');
$stmt->execute([
    'keyword' => '%' . $_POST['keyword'] . '%',
    'province' => '%' . $_POST['province'] . '%'
]);
$options = $stmt->fetchAll(PDO::FETCH_COLUMN);


foreach ($options as $option) {
    echo '<li>' . $option . '</li>';
}
?>
