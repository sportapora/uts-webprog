<?php
session_start();

include './layouts/header.php';
include './layouts/navbar.php';
include './connection/connection.php';


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Ambil data user dari session
    $user = $_SESSION['user'];
    $username = $user['username'];
    $email = $user['email'];
} else {
    // Jika belum login, redirect ke halaman login
    header("Location: /login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h1>Welcome to your profile, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>Your email is: <?php echo htmlspecialchars($email); ?></p>
</body>
</html>

<?php
include './layouts/footer.php';
?>