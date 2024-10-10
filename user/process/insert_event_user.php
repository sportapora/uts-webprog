<?php
include '../../connection/connection.php';

// Check if the form is submitted
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    $event_name = $_POST['event_name'];
    $event_desc = $_POST['event_desc'];
    $event_date = $_POST['event_date'];

    // Check if any field is empty
    if (empty($event_name) || empty($event_desc) || empty($event_date)) {
        echo "All fields are required!";
        exit;
    }

    try {
        // Prepare the INSERT statement
        $statement = $connection->prepare('INSERT INTO event (namaEvent, descEvent, eventDate) VALUES (?, ?, ?)');
        $statement->execute([$event_name, $event_desc, $event_date]);

        $_SESSION['message'] = "Event added successfully!";
        header("Location: /");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}