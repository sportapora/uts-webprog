<?php
session_start();
include_once '../../connection/connection.php';
require_once '../../vendor/autoload.php';

use Rakit\Validation\Validator;

$validator = new Validator();

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $currentEmail = $_SESSION['user']['email'];
    $currentUsername = $_SESSION['user']['username'];
    $id = $_SESSION['user']['id'];

    $validation = $validator->validate($_POST, [
        'username' => 'required',
        'email' => 'required|email'
    ]);

    if ($validation->fails()) {
        $_SESSION['errors'] = $validation->errors()->firstOfAll();
        header("location: /user/profile.php");
    } else {
        try {
            // Cek apakah username atau email sudah digunakan oleh pengguna lain (kecuali yang sedang login)
            if ($username == $currentUsername) {
                $query = "SELECT * FROM users WHERE email = ?";
                $statement = $connection->prepare($query);
                $statement->execute([$email]);
                $result = $statement->fetch(PDO::FETCH_ASSOC);
            } else if ($email == $currentEmail) {
                $query = "SELECT * FROM users WHERE username = ?";
                $statement = $connection->prepare($query);
                $statement->execute([$username]);
                $result = $statement->fetch(PDO::FETCH_ASSOC);
            }

            if ($result) {
                // Jika ada duplikasi username atau email
                $_SESSION['error'] = "Username atau Email sudah digunakan. Silakan coba yang lain!";
                header("Location: /user/profile.php");
                exit();  // Jangan lupa exit setelah header
            } else {
                // Lanjutkan update jika tidak ada duplikasi
                $updateQuery = "UPDATE users SET username = ?, email = ? WHERE id = ?";
                $updateStatement = $connection->prepare($updateQuery);
                $updateStatement->execute([$username, $email, $id]);

                // Update session email jika berhasil mengubah email
                if ($updateStatement->rowCount() > 0) {  // Cek jika ada perubahan data
                    $_SESSION['user']['email'] = $email;
                    $_SESSION['user']['username'] = $username;
                    $_SESSION['message'] = "Profil berhasil diperbarui!";
                } else {
                    $_SESSION['error'] = "Tidak ada perubahan yang dilakukan.";
                }

                header("Location: /user/profile.php");
                exit();  // Jangan lupa exit setelah header
            }
        } catch (PDOException $e) {
            // Tangani error PDO
            echo "Error: " . $e->getMessage();
        }
    }
}