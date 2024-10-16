<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet"/>


    <title>Event Management - Dashboard</title>
</head>
<body>
<nav class="bg-sky-100 shadow-md">
    <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-blue-700">Event Management</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-transparent md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-transparent">
                <li>
                    <a href="/admin"
                       class="block py-2 px-3 <?php if ($_SERVER['REQUEST_URI'] == '/admin') echo 'bg-blue-700 text-white md:text-blue-700 md:bg-transparent'; else echo 'md:text-gray-900 hover:bg-gray-100'; ?> rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
                       aria-current="page">Home</a>
                </li>
                <li>
                    <a href="/admin/events"
                       class="block py-2 px-3 <?php if ($_SERVER['REQUEST_URI'] == '/admin/events') echo 'bg-blue-700 text-white md:text-blue-700 md:bg-transparent'; else echo 'md:text-gray-900 hover:bg-gray-100'; ?> rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
                       aria-current="page">Events</a>
                </li>
                <li>
                    <a href="/admin/users"
                       class="block py-2 px-3 <?php if ($_SERVER['REQUEST_URI'] == '/admin/users') echo 'bg-blue-700 text-white md:text-blue-700 md:bg-transparent'; else echo 'md:text-gray-900 hover:bg-gray-100'; ?> rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">
                        Users
                    </a>
                </li>
                <li>
                    <form action="/logout.php" id="logout-form" class="hidden" method="post"></form>
                    <a href="/logout"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="bg-white h-screen">