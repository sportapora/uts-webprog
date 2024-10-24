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
        $checkQuery = "SELECT 1 FROM events_users WHERE user_id = :user_id AND event_id = :event_id";
        $statement = $connection->prepare($checkQuery);
        $statement->execute([':user_id' => $user_id, ':event_id' => $event_id]);

        if ($statement->rowCount() > 0) {
            $_SESSION['error'] = "Anda sudah terdaftar di acara ini!";
        } else {
            $capacityQuery = "SELECT capacity, status FROM events WHERE id = :event_id";
            $statement = $connection->prepare($capacityQuery);
            $statement->execute([':event_id' => $event_id]);
            $event = $statement->fetch(PDO::FETCH_ASSOC);
            $capacity = $event['capacity'];
            $status = $event['status'];

            if ($status == 'full') {
                $_SESSION['message'] = "Acara ini sudah penuh!";
            } elseif ($capacity > 0) {
                $connection->beginTransaction();

                $insertQuery = "INSERT INTO events_users (user_id, event_id) VALUES (:user_id, :event_id)";
                $statement = $connection->prepare($insertQuery);
                $statement->execute([':user_id' => $user_id, ':event_id' => $event_id]);

                $countEventsUsers = $connection->prepare("SELECT COUNT(*) AS count_users FROM events_users WHERE event_id = :event_id");
                $countEventsUsers->execute([':event_id' => $event_id]);
                $count = $countEventsUsers->fetch(PDO::FETCH_ASSOC)['count_users'];

                if ($capacity == $count) {
                    $updateStatusQuery = "UPDATE events SET status = 'full' WHERE id = :event_id";
                    $statement = $connection->prepare($updateStatusQuery);
                    $statement->execute([':event_id' => $event_id]);
                }

                $connection->commit();

                $_SESSION['message'] = "Berhasil bergabung dengan acara!";
            }
        }

        header("Location: /user/dashboard.php");
        exit();
    } catch (PDOException $e) {
        if ($connection->inTransaction()) {
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
