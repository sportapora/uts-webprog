<?php
include '../../connection/connection.php';

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) header("location: /login.php");
if ($_SESSION['user']["role"] != "admin") {
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
                            <th scope="col" class="px-6 py-3  bg-blue-300 text-white">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3  bg-blue-300 text-white">
                                Nama Event
                            </th>
                            <th scope="col" class="px-6 py-3  bg-blue-300 text-white">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3  bg-blue-300 text-white">
                                Waktu
                            </th>
                            <th scope="col" class="px-6 py-3  bg-blue-300 text-white">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3  bg-blue-300 text-white">
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
                                    class="px-6 py-4 bg-white">
                                    <?= $no; ?>
                                </th>
                                <td class="px-6 py-4 bg-white">
                                    <?= $events['nama'] ?>
                                </td>
                                <td class="px-6 py-4 bg-white">
                                    <?= $events['tanggal'] ?>
                                </td>
                                <td class="px-6 py-4 bg-white">
                                    <?= $events['waktu'] ?>
                                </td>
                                <td class="px-6 py-4 bg-white">
                                    <span class="bg-<?php if ($events['status'] == 'open') echo 'green'; else if ($events['status'] == 'closed') echo 'yellow'; else echo 'red'; ?>-100 text-<?php if ($events['status'] == 'open') echo 'green'; else if ($events['status'] == 'closed') echo 'yellow'; else echo 'red'; ?>-800 font-medium me-2 px-2.5 py-0.5 rounded-full">
                                        <?= $events['status'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex">
                                        <a href="/admin/events/detail.php?id=<?= $events['id'] ?>"
                                           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Detail</a>

                                        <a href="/admin/events/edit.php?id=<?= $events['id'] ?>"
                                           class="focus:outline-none inline-block text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Edit</a>
                                        <button data-modal-target="popup-modal-<?= $events['id'] ?>"
                                                data-modal-toggle="popup-modal-<?= $events['id'] ?>"
                                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none"
                                                type="button">
                                            Delete
                                        </button>

                                        <div id="popup-modal-<?= $events['id'] ?>" tabindex="-1"
                                             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-sky-100 rounded-lg shadow">
                                                    <button type="button"
                                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                            data-modal-hide="popup-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                             xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                  stroke-linejoin="round" stroke-width="2"
                                                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12"
                                                             aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                             fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                  stroke-linejoin="round" stroke-width="2"
                                                                  d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                        </svg>
                                                        <h3 class="mb-5 text-lg font-normal text-gray-500">
                                                            Apakah Anda yakin ingin menghapus
                                                            data <?= $events['nama'] ?>?</h3>
                                                        <div class="flex flex-col md:flex-row gap-4 justify-center">
                                                            <form action="/admin/process/delete_event.php" method="post">
                                                                <input type="hidden" name="id"
                                                                       value="<?= $events['id'] ?>">
                                                                <button data-modal-hide="popup-modal" type="submit"
                                                                        class="text-white bg-red-600 justify-center hover:bg-red-800 w-full focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                    Yes, I'm sure
                                                                </button>
                                                            </form>
                                                            <button data-modal-hide="popup-modal-<?= $events['id'] ?>" type="button"
                                                                    class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                                                No, cancel
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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