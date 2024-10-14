<?php
session_start();
include_once '../../connection/connection.php';

if (isset($_POST['event_id']) && isset($_SESSION['user_id'])) {
    $event_id = intval($_POST['event_id']);
    $user_id = intval($_SESSION['user_id']);  // Pastikan user_id diambil dari session yang sudah divalidasi

    try {
        // Cek apakah pengguna sudah terdaftar di event tersebut
        $checkQuery = "SELECT 1 FROM event_users WHERE user_id = :user_id AND event_id = :event_id";
        $statement = $connection->prepare($checkQuery);
        $statement->execute([':user_id' => $user_id, ':event_id' => $event_id]);

        if ($statement->fetch()) {
            // Jika sudah terdaftar
            $_SESSION['message'] = "Anda sudah terdaftar di acara ini!";
        } else {
            // Daftarkan pengguna ke acara
            $query = "INSERT INTO event_users (user_id, event_id) VALUES (:user_id, :event_id)";
            $statement = $connection->prepare($query);
            $statement->execute([':user_id' => $user_id, ':event_id' => $event_id]);

            $_SESSION['message'] = "Berhasil bergabung dengan acara!";
        }

        // Redirect kembali ke halaman profil atau halaman event
        header("Location: /user/profile.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Permintaan tidak valid.";
}