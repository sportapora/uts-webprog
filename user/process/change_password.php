<?php
session_start();
include_once '../../connection/connection.php';
require_once '../../vendor/autoload.php';

use Rakit\Validation\Validator;

$validator = new Validator();

if (isset($_POST['submit'])) {
    $newPassword = trim($_POST['new_password']);
    $confirmPassword = trim($_POST['confirm_password']);
    $id = $_SESSION['user']['id'];

    $validation = $validator->validate($_POST, [
        'new_password' => 'required|min:8',
        'confirm_password' => 'required|same:new_password|min:8',
    ]);

    if ($validation->fails()) {
        $_SESSION['errors'] = $validation->errors()->firstOfAll();
        header("location: /user/profile.php");
    } else {
        try {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $updateQuery = "UPDATE users SET password = ? WHERE id = ?";
            $updateStatement = $connection->prepare($updateQuery);
            $updateStatement->execute([$hashedPassword, $id]);

            if ($updateStatement->rowCount() > 0) {
                $_SESSION['message'] = "Password berhasil diperbarui! Silakan login kembali.";

                unset($_SESSION['loggedin']);
                unset($_SESSION['user']);

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
}