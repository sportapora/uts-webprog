<?php
session_start();
include_once '../../connection/connection.php';

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $currentEmail = $_SESSION['email'];  // Assuming the current logged-in email is stored in session

    try {
        // Cek apakah username atau email sudah digunakan oleh pengguna lain (kecuali yang sedang login)
        $query = "SELECT * FROM users WHERE (username = :username OR email = :email) AND email != :currentEmail";
        $statement = $connection->prepare($query);
        $statement->execute([
            ':username' => $username,
            ':email' => $email,
            ':currentEmail' => $currentEmail
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Jika ada duplikasi username atau email
            $_SESSION['message'] = "Username atau Email sudah digunakan. Silakan coba yang lain!";
            header("Location: /user/profile.php");
            exit();  // Jangan lupa exit setelah header
        } else {
            // Lanjutkan update jika tidak ada duplikasi
            $updateQuery = "UPDATE users SET username = :username, email = :email WHERE email = :currentEmail";
            $updateStatement = $connection->prepare($updateQuery);
            $updateStatement->execute([
                ':username' => $username,
                ':email' => $email,
                ':currentEmail' => $currentEmail
            ]);

            // Update session email jika berhasil mengubah email
            if ($updateStatement->rowCount() > 0) {  // Cek jika ada perubahan data
                $_SESSION['email'] = $email;
                $_SESSION['message'] = "Profil berhasil diperbarui!";
            } else {
                $_SESSION['message'] = "Tidak ada perubahan yang dilakukan.";
            }

            header("Location: /user/profile.php");
            exit();  // Jangan lupa exit setelah header
        }
    } catch (PDOException $e) {
        // Tangani error PDO
        echo "Error: " . $e->getMessage();
    }
}
