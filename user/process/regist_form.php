<?php
session_start();
include '../connection/connection.php';

// Ambil id_user dari sesi login
$id_user = $_SESSION['id_user'];
$id_event = $_POST['event_id'];

// Cek apakah user sudah terdaftar di event ini
$sql = "SELECT * FROM event_reg WHERE id_user = ? AND id_event = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("ii", $id_user, $id_event);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Jika user sudah terdaftar
    echo "You are already registered for this event.";
} else {
    // Lanjutkan proses pendaftaran
    $sql_insert = "INSERT INTO event_reg (id_user, id_event, registration_date) VALUES (?, ?, NOW())";
    $stmt_insert = $connection->prepare($sql_insert);
    $stmt_insert->bind_param("ii", $id_user, $id_event);
    
    if ($stmt_insert->execute()) {
        echo "Registration successful!";
    } else {
        echo "Failed to register. Please try again.";
    }
}
?>