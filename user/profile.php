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
    <div class="flex justify-center">
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
        } else if(isset($_SESSION['message'])) { ?>
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
        <?php } $_SESSION['message'] = null; ?>
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
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
            <input type="email" id="email" value="<?php echo htmlspecialchars($email); ?>" name="email"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                   required/>
        </div>
        <div class="mb-5">
            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
            <input type="text" id="username" value="<?php echo htmlspecialchars($username); ?>" name="username"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                   required/>
        </div>
        <button type="submit"
                name="submit"
                class="text-white w-full bg-yellow-700 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
            Update
        </button>
    </form>

<?php
include './layouts/footer.php';
?>