<?php
include_once '../../connection/connection.php';

if (isset($_POST['delete_btn'])) {
    $event_id = $_POST['event_id'];
    $user_id = $_POST['user_id'];

    $deleteQuery = $connection->prepare("DELETE FROM events_users WHERE event_id = ? AND user_id = ?");
    $deleteQuery->execute([$event_id, $user_id]);

    header("Location: /user/dashboard.php");
    exit();
} else {
    header("Location: /user/dashboard.php");
    exit();
}
