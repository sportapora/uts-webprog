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
    $inTransaction = false;  // Add a flag to track if we are in a transaction

    try {
        // Cek apakah user sudah terdaftar pada event tersebut
        $checkQuery = "SELECT 1 FROM events_users WHERE user_id = :user_id AND event_id = :event_id";
        $statement = $connection->prepare($checkQuery);
        $statement->execute([':user_id' => $user_id, ':event_id' => $event_id]);

        if ($statement->fetchColumn()) {
            $_SESSION['message'] = "Anda sudah terdaftar di acara ini!";
        } else {
            // Cek kapasitas event
            $capacityQuery = "SELECT capacity, status FROM events WHERE id = :event_id";
            $statement = $connection->prepare($capacityQuery);
            $statement->execute([':event_id' => $event_id]);
            $event = $statement->fetch(PDO::FETCH_ASSOC);
            $capacity = $event['capacity'];
            $status = $event['status'];

            if ($status == 'full') {
                $_SESSION['message'] = "Acara ini sudah penuh!";
            } elseif ($capacity > 0) {
                // Mulai transaksi
                $connection->beginTransaction();
                $inTransaction = true;

                // Insert user ke event
                $insertQuery = "INSERT INTO events_users (user_id, event_id) VALUES (:user_id, :event_id)";
                $statement = $connection->prepare($insertQuery);
                $statement->execute([':user_id' => $user_id, ':event_id' => $event_id]);

                // Kurangi kapasitas
                $updateCapacityQuery = "UPDATE events SET capacity = capacity - 1 WHERE id = :event_id";
                $statement = $connection->prepare($updateCapacityQuery);
                $statement->execute([':event_id' => $event_id]);

                // Cek kapasitas setelah dikurangi = 0?, jika ya, status = 'full'
                if ($capacity - 1 == 0) {
                    $updateStatusQuery = "UPDATE events SET status = 'full' WHERE id = :event_id";
                    $statement = $connection->prepare($updateStatusQuery);
                    $statement->execute([':event_id' => $event_id]);
                }

                $connection->commit();
                $inTransaction = false;

                $_SESSION['message'] = "Berhasil bergabung dengan acara!";
            } else {
                $_SESSION['message'] = "Kapasitas acara sudah penuh!";
            }
        }

        header("Location: /user/dashboard.php");
        exit();
    } catch (PDOException $e) {
        if ($inTransaction) {
            $connection->rollBack();
        }

        error_log("Database error: " . $e->getMessage());
        $_SESSION['message'] = "Terjadi kesalahan. Silakan coba lagi.";
        header("Location: /user/dashboard.php");
        exit();
    }
} else {
    $_SESSION['message'] = "Permintaan tidak valid.";
    header("Location: /index.php");
    exit();
}
