<?php
include 'layouts/header.php';
include 'layouts/navbar.php';
include 'connection/connection.php';

$sql = 'SELECT namaEvent, descEvent, eventDate  FROM event';
$stmt = $connection->prepare($sql);
$stmt->execute();
$events = $stmt->fetchAll();
?>

<?php
include 'layouts/footer.php';
?>