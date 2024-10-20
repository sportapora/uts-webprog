<?php
session_start();

include '../connection/connection.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) header("location: /login.php");
if ($_SESSION['user']["role"] != "admin") {
    die(403);
}

$events = $connection->prepare("SELECT nama, tanggal, status, created_at FROM events ORDER BY created_at DESC LIMIT 10");
$events->execute();

$users = $connection->prepare("SELECT username, email, created_at FROM users ORDER BY created_at DESC LIMIT 10");
$users->execute();

include "./layouts/header.php";
?>
    <div class="bg-white h-screen">
        <div class="max-w-screen-2xl flex flex-col mx-auto p-4 mt-6">
            <h1 class="text-2xl md:text-3xl font-bold">Welcome back, <?= $_SESSION['user']['username'] ?> ! 👋🏻</h1>

            <div class="rounded-lg shadow-lg p-6 mt-6">
                <div class="mb-10">
                    <h2 class="text-xl font-semibold mb-6">Latest Events List</h2>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Event
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal Event
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Dibuat pada
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;
                            while ($data = $events->fetch(PDO::FETCH_ASSOC)): ?>
                                <tr class="bg-white border-b">
                                    <th scope="row"
                                        class="px-6 py-4">
                                        <?= $no++; ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?= $data['nama']; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= $data['tanggal']; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-<?php if ($data['status'] == 'open') echo 'green'; else if ($data['status'] == 'closed') echo 'yellow'; else echo 'red'; ?>-100 text-<?php if ($data['status'] == 'open') echo 'green'; else if ($data['status'] == 'closed') echo 'yellow'; else echo 'red'; ?>-800 font-medium me-2 px-2.5 py-0.5 rounded-full">
                                        <?= $data['status'] ?>
                                    </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= $data['created_at']; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
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
                                <th scope="col" class="px-6 py-3">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Username
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Dibuat pada
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;
                            while ($data = $users->fetch(PDO::FETCH_ASSOC)): ?>
                                <tr class="bg-white border-b">
                                    <th scope="row"
                                        class="px-6 py-4">
                                        <?= $no++; ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?= $data['username']; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= $data['email']; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= $data['created_at']; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
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