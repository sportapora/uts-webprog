<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) header("location: /login.php");
if ($_SESSION["role"] != "admin") {
    die(403);
}
include "../layouts/header.php";
?>
    <div class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white h-screen">
        <div class="max-w-screen-2xl flex flex-col mx-auto p-4">
            <h1 class="text-3xl font-bold">Events List</h1>

            <div class="rounded-lg bg-gray-400 p-6 mt-10">
                <a href="/admin/events/create.php" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Event Baru</a>

                <div class="relative overflow-x-auto mt-6">
                    <table id="events-table-main" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Event
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Waktu
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
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
                            <td class="px-6 py-4">
                                $2999
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
include "../layouts/footer.php";
?>