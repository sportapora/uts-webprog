<?php
session_start();
include_once '../../connection/connection.php';

if (isset($_POST['submit'])) {
    $newPassword = trim($_POST['new_password']);
    $confirmPassword = trim($_POST['confirm_password']);
    $id = $_SESSION['user']['id'];

    // Validasi Password = confirm password
    if ($newPassword !== $confirmPassword) {
        $_SESSION['error'] = "Password baru dan konfirmasi password tidak cocok!";
        header("Location: /index.php");
        exit();  
    }

    try {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updateQuery = "UPDATE users SET password = ? WHERE id = ?";
        $updateStatement = $connection->prepare($updateQuery);
        $updateStatement->execute([$hashedPassword, $id]);

        if ($updateStatement->rowCount() > 0) {

            $_SESSION['message'] = "Password berhasil diperbarui! Silakan login kembali.";

            session_unset();   
            session_destroy(); 

            header("Location: /login.php");  
            exit();
        } else {
            $_SESSION['error'] = "Terjadi kesalahan saat memperbarui password.";
            header("Location: /index.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}