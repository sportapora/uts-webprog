<?php
include 'assets/header.php';
include 'assets/navbar.php';
include 'connection/connection.php';

$sql = 'SELECT namaEvent, descEvent, eventDate  FROM event';
$stmt = $connection->prepare($sql);
$stmt->execute();
$events = $stmt->fetchAll();
?>

<?php
include 'assets/footer.php';
?>