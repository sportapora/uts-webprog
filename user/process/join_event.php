<?php
session_start();
include_once '../../connection/connection.php';

if (!isset($_SESSION['user'])) {
    $_SESSION['message'] = "Silakan login untuk melanjutkan.";
    header("Location: /login.php");
    exit();
}

if (isset($_POST['event_id'])) {
    $event_id = intval($_POST['event_id']);
    $user_id = intval($_SESSION['user']['id']);

    try {
        // Cek Jika Apakah User Sudah Terdaftar Pada Event Tersebut
        $checkQuery = "SELECT 1 FROM events_users WHERE user_id = :user_id AND event_id = :event_id";
        $statement = $connection->prepare($checkQuery);
        $statement->execute([':user_id' => $user_id, ':event_id' => $event_id]);

        if ($statement->fetchColumn()) {
            $_SESSION['message'] = "Anda sudah terdaftar di acara ini!";
        } else {
            // Dafter Dalam Event
            $insertQuery = "INSERT INTO events_users (user_id, event_id) VALUES (:user_id, :event_id)";
            $statement = $connection->prepare($insertQuery);
            $statement->execute([':user_id' => $user_id, ':event_id' => $event_id]);

            $_SESSION['message'] = "Berhasil bergabung dengan acara!";
        }

        header("Location: /user/profile.php");
        exit();
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $_SESSION['message'] = "Terjadi kesalahan. Silakan coba lagi.";
        header("Location: /user/profile.php");
        exit();
    }
} else {
    $_SESSION['message'] = "Permintaan tidak valid.";
    header("Location: /user/profile.php");
    exit();
}
