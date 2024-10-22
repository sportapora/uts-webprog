<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
          rel="stylesheet">

    <style>
        #logo {
            font-family: "Monoton", sans-serif;;
        }

        body {
            font-family: "Rubik", sans-serif;
            font-optical-sizing: auto;
        }
    </style>

    <title>Festivo! - Dashboard</title>
</head>
<body>
<nav class="bg-sky-100 shadow-md">
    <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-3xl font-semibold whitespace-nowrap text-blue-700" id="logo">Festivo!</span>
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
                    <a href="" onclick="event.preventDefault()" data-modal-target="logout-modal"
                       data-modal-toggle="logout-modal"
                       class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Logout</a>

                    <div id="logout-modal" tabindex="-1"
                         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-sky-100 rounded-lg shadow">
                                <button type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="logout-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                         fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12"
                                         aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah Anda
                                        yakin ingin logout?</h3>
                                    <div class="flex flex-col md:flex-row gap-3 justify-center">
                                        <form action="/logout.php" id="logout-form" class="w-full md:w-auto" method="post">
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
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="bg-white min-h-screen mb-64 md:mb-48">