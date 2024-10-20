<?php

session_start();

require_once './vendor/autoload.php';
include './connection/connection.php';

use Rakit\Validation\Validator;

$validator = new Validator();

if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"]) {
    if ($_SESSION['user']['role'] == 'admin') header("Location: /admin");
    else if ($_SESSION['user']['role'] == 'user') header("Location: /#");
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $validation = $validator->validate($_POST, [
        'email' => 'required|email',
        'password' => 'required|min:8'
    ]);

    if ($validation->fails()) {
        $_SESSION['errors'] = $validation->errors()->firstOfAll();
        header("Location: /login.php");
    } else {
        try {
            $query = $connection->prepare("SELECT * FROM users WHERE email = ?");
            $query->execute(array($email));
            $user = $query->fetch(PDO::FETCH_ASSOC);

            if ($user['email'] == $email && password_verify($password, $user['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $user;

                if ($user['role'] == 'admin') {
                    header("Location: /admin");
                } else if ($user['role'] == 'user') {
                    header("Location: /user/index.php");
                }
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Terdapat error server! Silakan coba lagi.";
            header("Location: /login.php");
        }
    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet"/>

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

    <title>Festivo! - Login</title>
</head>
<body>
<nav class="bg-sky-100 border-gray-200">
    <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-blue-700" id="logo">Festivo!</span>
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
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-transparent">
                <li>
                    <a href="#"
                       class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0"
                       aria-current="page">Home</a>
                </li>
                <li>
                    <a href="#"
                       class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Events</a>
                </li>
                <li>
                    <a href="#"
                       class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Users</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="bg-white h-screen">
    <div class="max-w-screen-2xl flex flex-col mx-auto p-4">
        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-center mt-6">Login Page</h1>
        <div class="flex flex-col items-center justify-center mt-6">
            <?php if (isset($_SESSION["error"])) { ?>
                <div id="alert-3"
                     class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50"
                     role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        <?= $_SESSION["error"] ?>
                    </div>
                    <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                            data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <?php $_SESSION['error'] = null;
            } ?>

            <form action="" method="post" class="w-1/2">
                <div class="mb-6">
                    <div class="relative z-0">
                        <input type="text" id="email" name="email"
                               class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 <?= isset($_SESSION['errors']['email']) ? 'border-red-300 focus:border-red-600' : 'text-gray-900 border-gray-300 focus:border-blue-600' ?> appearance-none focus:outline-none focus:ring-0 peer"
                               placeholder=" "/>
                        <label for="email"
                               class="absolute text-sm <?= isset($_SESSION['errors']['email']) ? 'text-red-500' : 'text-gray-500' ?> duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                            Email</label>
                    </div>
                    <?php if (isset($_SESSION['errors']['email'])): ?>
                        <p class="mt-2 text-sm text-red-600"><?= $_SESSION['errors']['email'] ?></p>
                    <?php endif; unset($_SESSION['errors']['email']); ?>
                </div>
                <div class="mb-8">
                    <div class="relative z-0">
                        <input type="password" id="password" name="password"
                               class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 <?= isset($_SESSION['errors']['password']) ? 'border-red-300 focus:border-red-600' : 'text-gray-900 border-gray-300 focus:border-blue-600' ?> appearance-none focus:outline-none focus:ring-0 peer"
                               placeholder=" "/>
                        <label for="password"
                               class="absolute text-sm <?= isset($_SESSION['errors']['password']) ? 'text-red-500' : 'text-gray-500' ?> duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                            Password</label>
                    </div>
                    <?php if (isset($_SESSION['errors']['password'])): ?>
                        <p class="mt-2 text-sm text-red-600"><?= $_SESSION['errors']['password'] ?></p>
                    <?php endif; unset($_SESSION['errors']['password']); ?>
                </div>

                <button type="submit"
                        name="login"
                        class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                    Login
                </button>
            </form>

            <div class="mt-8">
                <p>Belum memiliki akun? <a href="/register.php" class="text-blue-700 underline">Register</a> di sini
                </p>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</body>
</html>