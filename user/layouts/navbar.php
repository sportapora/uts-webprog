<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
 
  $user = $_SESSION['user'];
  $username = $user['username'];
  $email = $user['email'];

} else {
  header("Location: /login.php");
  exit();
}
?>

<!-- Navbar User -->
<nav class="bg-sky-100 border-gray-200">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="/user/index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
      <span class="self-center text-2xl font-semibold whitespace-nowrap">Festivo!</span>
  </a>
  <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
      <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <div class="w-8 h-8 bg-blue-500 text-white flex items-center justify-center rounded-full">
            <span class="text-sm"><?php echo substr($username, 0, 1);?></span>
        </div>
      </button>
      <!-- Dropdown menu -->
      <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
        <div class="px-4 py-3">
          <a href="/user/profile.php">
            <span class="block text-sm text-gray-900"><?php echo $username; ?></span>
            <span class="block text-sm text-gray-500 truncate"><?php echo $email; ?></span>
          </a>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
          <li>
            <a href="/user/dashboard.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
          </li>
          <li>
            <a href="/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>
          </li>
        </ul>
      </div>
  </div>
</nav>
