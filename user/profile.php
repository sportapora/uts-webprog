<?php
session_start();
include '../layouts/header.php';
include '../layouts/navbar.php';
include '../connection/connection.php';

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
    <div class="h-screen mx-10">
        <div class="flex justify-center pt-28">
            <?php if (isset($_SESSION["error"])) { ?>
                <div id="alert-3"
                     class="flex w-full mx-4 md:mx-0 md:w-1/2 mt-6 items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50"
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
            } else if (isset($_SESSION["errors"]['new_password']) || isset($_SESSION["errors"]['confirm_password'])) { ?>
                <div id="alert-3"
                     class="flex w-full mx-4 md:mx-0 md:w-1/2 mt-6 items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50"
                     role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        <ul>
                            <li><?= $_SESSION["errors"]['new_password'] ?></li>
                            <li><?= $_SESSION["errors"]['confirm_password'] ?></li>
                        </ul>
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
            <?php } else if (isset($_SESSION['message'])) { ?>
                <div id="alert-3"
                     class="flex w-full mx-4 md:mx-0 md:w-1/2 mt-6 items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50"
                     role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        <?= $_SESSION["message"] ?>
                    </div>
                    <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                            data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            <?php }
            unset($_SESSION['message']); unset($_SESSION['errors']); ?>
        </div>
        <form class="max-w-sm mx-auto mt-4" method="post" action="/user/process/update_user.php">
            <div class="flex mb-5 justify-center">
                <div class="w-28 h-28 bg-blue-500 text-white flex items-center justify-center rounded-full">
                    <span class="text-5xl"><?php echo substr($username, 0, 1); ?></span>
                </div>
            </div>
            <div class="mb-5 text-center">
                <p>Welcome <span class="font-bold"><?php echo htmlspecialchars($username); ?></span></p>
            </div>
            <div class="mb-10">
                <div class="relative z-0">
                    <input type="email" id="email" name="email"
                           value="<?= htmlspecialchars($email); ?>"
                           class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 <?= isset($_SESSION['errors']['email']) ? 'border-red-300 focus:border-red-600' : 'text-gray-900 border-gray-300 focus:border-blue-600' ?> appearance-none focus:outline-none focus:ring-0 peer"
                           placeholder=" "/>
                    <label for="email"
                           class="absolute text-sm <?= isset($_SESSION['errors']['email']) ? 'text-red-500' : 'text-gray-500' ?> duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                        Email</label>
                </div>
                <?php if (isset($_SESSION['errors']['email'])): ?>
                    <p class="mt-2 text-sm text-red-600"><?= $_SESSION['errors']['email'] ?></p>
                <?php endif;
                unset($_SESSION['errors']['email']); ?>
            </div>
            <div class="mb-2">
                <div class="relative z-0">
                    <input type="text" id="username" name="username"
                           value="<?= htmlspecialchars($username); ?>"
                           class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 <?= isset($_SESSION['errors']['username']) ? 'border-red-300 focus:border-red-600' : 'text-gray-900 border-gray-300 focus:border-blue-600' ?> appearance-none focus:outline-none focus:ring-0 peer"
                           placeholder=" "/>
                    <label for="username"
                           class="absolute text-sm <?= isset($_SESSION['errors']['username']) ? 'text-red-500' : 'text-gray-500' ?> duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                        Username</label>
                </div>
                <?php if (isset($_SESSION['errors']['username'])): ?>
                    <p class="mt-2 text-sm text-red-600"><?= $_SESSION['errors']['username'] ?></p>
                <?php endif;
                unset($_SESSION['errors']['username']); ?>
            </div>
            <div class="mb-6 text-right">
                <a data-modal-target="change-pass-modal" data-modal-toggle="change-pass-modal"
                   class="text-blue-700 hover:underline cursor-pointer">Ganti Password</a>
            </div>
            <button type="submit"
                    name="submit"
                    class="text-white w-full bg-yellow-700 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                Update
            </button>
        </form>

        <!-- Main modal -->
        <div id="change-pass-modal" tabindex="-1" aria-hidden="true"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Ubah Password
                        </h3>
                        <button type="button"
                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="change-pass-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form class="space-y-4" action="/user/process/change_password.php" method="post">
                            <div>
                                <label for="new_password"
                                       class="block mb-2 text-sm font-medium text-gray-900">Password Baru</label>
                                <input type="password" name="new_password" id="new_password" placeholder="••••••••"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                            </div>
                            <div>
                                <label for="confirm_password"
                                       class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi Password
                                    Anda</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                       placeholder="••••••••"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                            </div>
                            <button type="submit" name="submit"
                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Ubah Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include '../layouts/footer.php';
?>