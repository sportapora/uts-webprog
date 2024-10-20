<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  $user = $_SESSION['user'];
  $username = $user['username'];
  $email = $user['email'];
} else {
  $username = null;
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Navbar -->
<?php

session_start();
?>
<nav class="bg-sky-100 fixed w-full z-20 top-0 start-0 border-b border-gray-200">

  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <!-- Logo -->
    <a href="/index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
      <span class="self-center text-2xl font-semibold whitespace-nowrap">Festivo!</span>
    </a>

    <?php if ($current_page !== 'profile.php' && $current_page !== 'dashboard.php'): ?>
      <!-- Search form (Desktop) -->
      <form action="/user/process/search.php" method="get" class="hidden md:flex items-center">
        <div class="relative">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            <span class="sr-only">Search icon</span>
          </div>
          <input type="text" id="search-navbar" name="query" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
        </div>
      </form>
    <?php endif; ?>

    <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
      <?php if ($username): ?>
        <!-- User profile menu -->
        <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
          <span class="sr-only">Open user menu</span>
          <div class="w-8 h-8 bg-blue-500 text-white flex items-center justify-center rounded-full">
            <span class="text-sm"><?php echo substr($username, 0, 1); ?></span>
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
      <?php else: ?>
        <!-- Login button -->
        <a href="/login.php" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">Login</a>
      <?php endif; ?>
      
      <!-- Mobile menu button -->
      <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
    </div>

    <?php if ($current_page !== 'profile.php'): ?>
      <!-- Mobile search -->
      <div class="flex md:order-1">
        <form action="/user/process/search.php" method="get" class="flex items-center md:hidden">
          <button type="submit" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            <span class="sr-only">Search</span>
          </button>
        </form>
      </div>
    <?php endif; ?>
  </div>
</nav>