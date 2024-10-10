<?php
include '../../connection/connection.php';

try {
    session_start();

    $event = $connection->prepare("SELECT * FROM events WHERE id = ?");
    $event->execute([$_POST['id']]);
    $data = $event->fetch(PDO::FETCH_ASSOC);
    $gambar = $data['gambar'];
    $banner = $data['banner'];

    $statement = $connection->prepare("DELETE FROM events WHERE id = ?");
    $statement->execute(array($_POST['id']));
    unlink("../../assets/events/gambar/$gambar");
    unlink("../../assets/events/banner/$banner");

    $_SESSION['message'] = "Event berhasil dihapus!";

    header('location: /admin/events');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
