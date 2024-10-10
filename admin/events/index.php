<?php
include '../../connection/connection.php';

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) header("location: /login.php");
if ($_SESSION["role"] != "admin") {
    die(403);
}

$query = $connection->query("SELECT * FROM events");
$query->execute();

include "../layouts/header.php";
?>
    <div class="bg-white text-gray-900 h-screen">
        <div class="max-w-screen-2xl flex flex-col mx-auto p-4">
            <h1 class="text-3xl font-bold">Events List</h1>

            <div class="rounded-lg shadow-lg p-6 mt-10">
                <a href="/admin/events/create.php"
                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Tambah
                    Event Baru</a>

                <div class="relative overflow-x-auto mt-6">
                    <?php if (isset($_SESSION["message"])) { ?>
                        <div id="alert-3"
                             class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50"
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
                        <?php $_SESSION['message'] = null;
                    } ?>

                    <table id="events-table-main"
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
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Waktu
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        while ($events = $query->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr class="bg-white border-b">
                                <th scope="row"
                                    class="px-6 py-4">
                                    <?= $no; ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?= $events['nama'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $events['tanggal'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $events['waktu'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-<?php if ($events['status'] == 'open') echo 'green'; else if ($events['status'] == 'closed') echo 'yellow'; else echo 'red'; ?>-100 text-<?php if ($events['status'] == 'open') echo 'green'; else if ($events['status'] == 'closed') echo 'yellow'; else echo 'red'; ?>-800 font-medium me-2 px-2.5 py-0.5 rounded-full">
                                        <?= $events['status'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex">
                                        <a href="/admin/events/detail.php?id=<?= $events['id'] ?>"
                                           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none dark:focus:ring-blue-800">Detail</a>

                                        <a href="/admin/events/edit.php?id=<?= $events['id'] ?>"
                                           class="focus:outline-none inline-block text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Edit</a>
                                        <form action="/admin/process/delete_event.php" method="post"
                                              class="inline-block">
                                            <input type="hidden" name="id" value="<?= $events['id'] ?>">
                                            <button onclick="return confirm('Apakah Anda yakin?')" type="submit"
                                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php $no++;
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
include "../layouts/footer.php";
?>