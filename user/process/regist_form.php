<?php
session_start();
include '../connection/connection.php';


// Ambil id_user dari sesi login
$id_user = $_SESSION['user_id'];
$id_event = $_POST['event_id'];

// Cek apakah user sudah terdaftar di event ini
$sql = "SELECT * FROM event_users WHERE user_id = ? AND event_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("ii", $id_user, $id_event);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Jika user sudah terdaftar
    echo "You are already registered for this event.";
} else {
    // Lanjutkan proses pendaftaran
    $sql_insert = "INSERT INTO event_users (users_id, event_id) VALUES (?, ?)";
    $stmt_insert = $connection->prepare($sql_insert);
    $stmt_insert->bind_param("ii", $id_user, $id_event);
    
    if ($stmt_insert->execute()) {
        echo "Registration successful!";
    } else {
        echo "Failed to register. Please try again.";
    }
}
?>