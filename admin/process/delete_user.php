<?php
include '../../connection/connection.php';

try {
    session_start();

    $statement = $connection->prepare("DELETE FROM users WHERE id = ?");
    $statement->execute(array($_POST['id']));

    $_SESSION['message'] = "User berhasil dihapus!";

    header('location: /admin/users');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
