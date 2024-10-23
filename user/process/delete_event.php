<?php
session_start();
include_once '../../connection/connection.php';

if (isset($_POST['delete_btn'])) {
    $event_id = intval($_POST['event_id']);
    $user_id = intval($_POST['user_id']);

    try {
        $connection->beginTransaction();

        $delete = $connection->prepare("DELETE FROM events_users WHERE event_id = ? AND user_id = ?");
        $delete->execute([$event_id, $user_id]);

        // tambahkan kapasitas apabila batal mengikuti event
        $updateCapacity = $connection->prepare("UPDATE events SET capacity = capacity + 1 WHERE id = ?");
        $updateCapacity->execute([$event_id]);

        // cek kapasitas baru dan update status
        $checkCapacity = $connection->prepare("SELECT capacity FROM events WHERE id = ?");
        $checkCapacity->execute([$event_id]);
        $capacity = $checkCapacity->fetchColumn();

        if ($capacity > 0) {
            // Ubah status menjadi "open" kalo kapasitasnya > 0
            $updateStatus = $connection->prepare("UPDATE events SET status = 'open' WHERE id = ?");
            $updateStatus->execute([$event_id]);
        }

        $connection->commit();

        $_SESSION['message'] = 'Berhasil membatalkan pendaftaran!';
    } catch (PDOException $e) {
        $connection->rollBack();
        $_SESSION['message'] = 'Terjadi kesalahan saat membatalkan pendaftaran.';
        error_log("Error: " . $e->getMessage());
    }

    header("Location: /user/dashboard.php");
    exit();
} else {
    header("Location: /user/dashboard.php");
    exit();
}
