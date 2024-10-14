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

<form class="max-w-sm mx-auto" method="post" action="/user/process/update_user.php">
    <div class="flex mb-5 justify-center">
        <div class="w-28 h-28 bg-blue-500 text-white flex items-center justify-center rounded-full">
            <span class="text-5xl"><?php echo substr($username, 0, 1);?></span>
        </div>
    </div>
    <div class="mb-5 text-center">
        <p >Welcome <span class="font-bold"><?php echo htmlspecialchars($username);?></span></p>
    </div>
    <div class="mb-5">
      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
      <input type="email" id="email" value="<?php echo htmlspecialchars($email); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
    </div>
    <div class="mb-5">
      <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
      <input type="username" id="username" value="<?php echo htmlspecialchars($username); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
    </div>
    <div class="flex justify-center">
        <button type="submit" class="text-white bg-yellow-700 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-500 dark:hover:bg-yellow-500 dark:focus:ring-blue-800">Update
        </button>
    </div>
</form>

<?php
include './layouts/footer.php';
?>