<?php
session_start();

// Cek apakah pengguna sudah login (session id_user ada)
if (isset($_SESSION['id_user'])) {
  $id_user = $_SESSION['id_user'];

  // Ambil data user dari database berdasarkan id_user
  $sql = 'SELECT username, email FROM users WHERE id = ?';
  $stmt = $connection->prepare($sql);
  $stmt->bind_param('i', $id_user);  // Bind parameter
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();  // Ambil data user
      $username = $user['username'];   // Simpan username
      $email = $user['email'];         // Simpan email
  } else {
      // Jika user tidak ditemukan
      $username = 'Guest';
      $email = '';
  }
} else {
  // Jika user belum login
  $username = 'Guest';
  $email = '';
}
// include './connection/connection.php';

// $sql = 'SELECT id, username, email status FROM users';
// $stmt = $connection->prepare($sql);
// $stmt->execute();
// $users = $stmt->fetchAll();
// 
?>

<!-- Navbar User -->
<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
  </a>
  <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
      <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <div class="w-8 h-8 bg-blue-500 text-white flex items-center justify-center rounded-full">
            <span class="text-sm"><?php echo substr($username, 0, 1);?></span>
        </div>
      </button>
      <!-- Dropdown menu -->
      <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
        <div class="px-4 py-3">
          <span class="block text-sm text-gray-900 dark:text-white"><?php echo $username; ?></span>
          <span class="block text-sm text-gray-500 truncate dark:text-gray-400"><?php echo $email; ?></span>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
          <li>
            <a href="./user_profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
          </li>
          <li>
            <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
          </li>
        </ul>
      </div>
  </div>
</nav>
