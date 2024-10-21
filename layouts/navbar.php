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


<nav class="bg-sky-100 fixed w-full z-20 top-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-3xl font-semibold whitespace-nowrap text-blue-700" id="logo">Festivo!</span>
        </a>
        <div class="flex items-center gap-6 md:order-2">
            <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search"
                    aria-expanded="false"
                    class="md:hidden text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 rounded-lg text-sm p-2.5 me-1">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
            <?php if ($current_page !== 'profile.php' && $current_page !== 'dashboard.php' && $current_page !== 'why-us.php'): ?>
                <div class="relative hidden md:block">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search icon</span>
                    </div>
                    <form action="" method="get">
                        <input type="text" id="search-navbar" name="query"
                               class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Search...">
                    </form>
                </div>
            <?php endif; ?>

            <?php if ($username): ?>
                <div class="relative hidden md:block">
                    <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300"
                            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown-1"
                            data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        <div class="w-8 h-8 bg-blue-500 text-white flex items-center justify-center rounded-full">
                            <span class="text-sm"><?php echo substr($username, 0, 1); ?></span>
                        </div>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow"
                         id="user-dropdown-1">
                        <div class="px-4 py-3">                            
                            <span class="block text-sm text-gray-900"><?php echo $username; ?></span>
                            <span class="block text-sm text-gray-500 truncate"><?php echo $email; ?></span>
                        </div>
                        <ul class="pt-2" aria-labelledby="user-menu-button">
                            <li class="mb-2">
                                <a href="/user/dashboard.php"
                                   class="block px-4 py-2 text-sm <?php if ($_SERVER['REQUEST_URI'] == '/user/dashboard.php') echo 'bg-blue-700 text-white md:text-blue-700 md:bg-transparent'; else echo 'md:text-gray-900 hover:bg-gray-100'; ?> rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700">
                                    Dashboard
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="/user/profile.php"
                                   class="block px-4 py-2 text-sm <?php if ($_SERVER['REQUEST_URI'] == '/user/profile.php') echo 'bg-blue-700 text-white md:text-blue-700 md:bg-transparent'; else echo 'md:text-gray-900 hover:bg-gray-100'; ?> rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700">
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="" onclick="event.preventDefault()" data-modal-target="logout-modal"
                                   data-modal-toggle="logout-modal"
                                   class="block px-4 py-2 text-sm text-white bg-red-600 rounded-b-lg hover:bg-red-700">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                <!-- Login button -->
                <a href="/login.php"
                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">Login</a>
            <?php endif; ?>
            <button data-collapse-toggle="navbar-search" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="navbar-search" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">
            <div class="relative mt-3 md:hidden">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" id="search-navbar"
                       class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Search...">
            </div>
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent md:items-center">
                <li class="block md:hidden">
                    <?php if ($username): ?>
                        <!-- User profile menu -->
                        <div class="border-b border-gray-500 rounded-md p-4">
                            <p><?= htmlspecialchars($user['username']) ?></p>
                            <small class="text-gray-500"><?= htmlspecialchars($user['email']) ?></small>
                            <ul aria-labelledby="user-menu-button">
                                <li class="mb-2">
                                    <a href="/user/dashboard.php"
                                       class="block px-4 py-2 text-sm <?php if ($_SERVER['REQUEST_URI'] == '/user/dashboard.php') echo 'bg-blue-700 text-white md:text-blue-700 md:bg-transparent'; else echo 'md:text-gray-900 hover:bg-gray-100'; ?> rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="/user/profile.php"
                                       class="block px-4 py-2 text-sm <?php if ($_SERVER['REQUEST_URI'] == '/user/profile.php') echo 'bg-blue-700 text-white md:text-blue-700 md:bg-transparent'; else echo 'md:text-gray-900 hover:bg-gray-100'; ?> rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">
                                        Profile
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <button
                                            type="submit" data-modal-target="logout-modal"
                                            data-modal-toggle="logout-modal"
                                            class="block w-full bg-red-600 text-white text-start rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-red-700">
                                        Sign
                                        out
                                    </button>
                                </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Login button -->
                        <a href="/login.php"
                           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">Login</a>
                    <?php endif; ?>
                </li>
                <li>
                    <a href="/"
                       class="block mb-2 md:mb-0 px-4 py-2 <?php if ($_SERVER['REQUEST_URI'] == '/') echo 'bg-blue-700 text-white md:text-blue-700 md:bg-transparent'; else echo 'md:text-gray-900 hover:bg-gray-100'; ?> rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700">
                        Home
                    </a>
                </li>
                <li>
                    <a href="/why-us.php"
                       class="block px-4 py-2 <?php if ($_SERVER['REQUEST_URI'] == '/why-us.php') echo 'bg-blue-700 text-white md:text-blue-700 md:bg-transparent'; else echo 'md:text-gray-900 hover:bg-gray-100'; ?> rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700">
                        Why Us?
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="logout-modal" tabindex="1"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-sky-100 rounded-lg shadow">
            <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="logout-modal">
                <svg class="w-3 h-3" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12"
                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah Anda
                    yakin ingin logout?</h3>
                <div class="flex flex-col md:flex-row gap-3 justify-center">
                    <form action="/logout.php" id="logout-form"
                          class="w-full md:w-auto" method="post">
                        <button type="submit"
                                class="text-white bg-red-600 hover:bg-red-800 w-full focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex justify-center items-center px-5 py-2.5 text-center">
                            Yakin
                        </button>
                    </form>
                    <button data-modal-hide="logout-modal" type="button"
                            class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-100">
                        Batalkan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>