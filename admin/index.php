<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) header("location: /login.php");
if ($_SESSION["role"] != "admin") {
    die(403);
}
include "./layouts/header.php";
?>
    <div class="bg-white h-screen">
        <div class="max-w-screen-2xl flex flex-col mx-auto p-4">
            <h1 class="text-3xl font-bold">Welcome back, <?= $_SESSION['user']['username'] ?> !</h1>

            <div class="rounded-lg shadow-lg p-6 mt-4">
                <div class="mb-10">
                    <h2 class="text-xl font-semibold mb-6">Events List</h2>
                    <div class="relative overflow-x-auto">
                        <table id="events-table-dashboard"
                               class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Event
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-white border-b">
                                <th scope="row"
                                    class="px-6 py-4">
                                    Apple MacBook Pro 17"
                                </th>
                                <td class="px-6 py-4">
                                    Silver
                                </td>
                                <td class="px-6 py-4">
                                    Laptop
                                </td>
                                <td class="px-6 py-4">
                                    $2999
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <p class="mt-6">Detail lebih lanjut: <a href="/admin/events"
                                                            class="text-blue-700 underline">events</a></p>
                </div>
                <div class="mb-10">
                    <h2 class="text-xl font-semibold mb-6">Users List</h2>
                    <div class="relative overflow-x-auto">
                        <table id="users-table-dashboard"
                               class="w-full text-sm text-left rtl:text-right text-gray-500">
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
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-white border-b">
                                <th scope="row"
                                    class="px-6 py-4">
                                    Apple MacBook Pro 17"
                                </th>
                                <td class="px-6 py-4">
                                    Silver
                                </td>
                                <td class="px-6 py-4">
                                    Laptop
                                </td>
                            </tr>
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