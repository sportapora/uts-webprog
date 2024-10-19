<?php
include '../../connection/connection.php';
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) header("location: /login.php");
if ($_SESSION['user']["role"] != "admin") {
    die(403);
}

$query = $connection->prepare("select eu.event_id as event_id, eu.user_id, e.nama as nama, eu.created_at as created_at
                                        from events_users eu
                                        inner join events e on eu.event_id = e.id
                                        inner join users u on eu.user_id = ?");
$query->execute([$_GET["id"]]);

include "../layouts/header.php";
?>
    <div class="bg-white text-gray-900 h-auto pb-10">
        <div class="max-w-screen-2xl flex flex-col mx-auto p-4">
            <h1 class="text-3xl font-bold">List Event yang Pernah Didaftar</h1>

            <div class="rounded-lg shadow-lg p-6 mt-10">
                <a href="/admin/users"
                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Kembali</a>
                <div class="relative overflow-x-auto mt-6">
                    <table id="events_users-table"
                           class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama event
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal registrasi
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
                                    <?= $events['created_at'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex">
                                        <a href="/admin/events/detail.php?id=<?= $events['event_id'] ?>"
                                           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Detail</a>
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