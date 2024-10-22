<?php
session_start();

include '../connection/connection.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) header("location: /login.php");
if ($_SESSION['user']["role"] != "admin") {
    die(403);
}

$events = $connection->prepare("SELECT nama, tanggal, status, created_at FROM events ORDER BY created_at DESC LIMIT 10");
$events->execute();

$users = $connection->prepare("SELECT username, email, created_at FROM users WHERE role = 'user' ORDER BY created_at DESC LIMIT 10");
$users->execute();

include "./layouts/header.php";
?>
    <div class="bg-white h-screen">
        <div class="max-w-screen-2xl flex flex-col mx-auto p-4 mt-6">
            <?php if (isset($_SESSION['message'])) { ?>
                <div id="alert-message"
                     class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 mb-10"
                     role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        <?= $_SESSION["message"] ?>
                    </div>
                    <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                            data-dismiss-target="#alert-message" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            <?php }
            unset($_SESSION['message']); ?>
            <h1 class="text-2xl md:text-3xl font-bold">Welcome back, <?= $_SESSION['user']['username'] ?> ! 👋🏻</h1>

            <div class="rounded-lg shadow-lg p-6 mt-6">
                <div class="mb-10">
                    <h2 class="text-xl font-semibold mb-6">Latest Events List</h2>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-blue-300 text-white">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3 bg-blue-300 text-white">
                                    Nama Event
                                </th>
                                <th scope="col" class="px-6 py-3 bg-blue-300 text-white">
                                    Tanggal Event
                                </th>
                                <th scope="col" class="px-6 py-3 bg-blue-300 text-white">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 bg-blue-300 text-white">
                                    Dibuat pada
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            if ($events->rowCount() > 0):
                                while ($data = $events->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr class="bg-white border-b">
                                        <th scope="row"
                                            class="px-6 py-4 bg-white">
                                            <?= $no++; ?>
                                        </th>
                                        <td class="px-6 py-4 bg-white">
                                            <?= $data['nama']; ?>
                                        </td>
                                        <td class="px-6 py-4 bg-white">
                                            <?= $data['tanggal']; ?>
                                        </td>
                                        <td class="px-6 py-4 bg-white">
                                        <span class="bg-<?php if ($data['status'] == 'open') echo 'green'; else if ($data['status'] == 'closed') echo 'yellow'; else echo 'red'; ?>-100 text-<?php if ($data['status'] == 'open') echo 'green'; else if ($data['status'] == 'closed') echo 'yellow'; else echo 'red'; ?>-800 font-medium me-2 px-2.5 py-0.5 rounded-full">
                                        <?= $data['status'] ?>
                                    </span>
                                        </td>
                                        <td class="px-6 py-4 bg-white">
                                            <?= $data['created_at']; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; else: ?>
                                <tr class="bg-white border-b">
                                    <th scope="row" colspan="5"
                                        class="px-6 py-4 bg-white text-center">
                                        Tidak ada data ditemukan
                                    </th>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <p class="mt-6">Detail lebih lanjut: <a href="/admin/events"
                                                            class="text-blue-700 underline">events</a></p>
                </div>
                <div class="mb-10">
                    <h2 class="text-xl font-semibold mb-6">Users List</h2>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-blue-300 text-white">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3 bg-blue-300 text-white">
                                    Username
                                </th>
                                <th scope="col" class="px-6 py-3 bg-blue-300 text-white">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 bg-blue-300 text-white">
                                    Dibuat pada
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;
                            if ($users->rowCount() > 0):
                                while ($data = $users->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr class="bg-white border-b">
                                        <th scope="row"
                                            class="px-6 py-4 bg-white">
                                            <?= $no++; ?>
                                        </th>
                                        <td class="px-6 py-4 bg-white">
                                            <?= $data['username']; ?>
                                        </td>
                                        <td class="px-6 py-4 bg-white">
                                            <?= $data['email']; ?>
                                        </td>
                                        <td class="px-6 py-4 bg-white">
                                            <?= $data['created_at']; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; else: ?>
                                <tr class="bg-white border-b">
                                    <th scope="row" colspan="5"
                                        class="px-6 py-4 bg-white text-center">
                                        Tidak ada data ditemukan
                                    </th>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <p class="mt-6">Detail lebih lanjut: <a href="/admin/users"
                                                            class="text-blue-700 underline">users</a></p>
                </div>
            </div>
        </div>
    </div>
<?php
include "./layouts/footer.php";
?>