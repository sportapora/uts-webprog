<?php

include '../../connection/connection.php';

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) header("location: /login.php");
if ($_SESSION['user']["role"] != "admin") {
    die(403);
}

$queryEvent = $connection->prepare("SELECT * FROM events WHERE id = ?");
$queryEvent->execute([$_GET["id"]]);

$event = $queryEvent->fetch(PDO::FETCH_ASSOC);

$queryEventDetail = $connection->prepare("select eu.event_id, eu.user_id, u.email as email, u.username as username, eu.created_at as created_at 
                                                    from events_users eu 
                                                    inner join events e on eu.event_id = e.id 
                                                    inner join users u on eu.user_id = u.id where e.id = ?");
$queryEventDetail->execute([$_GET["id"]]);

if (!$event) header("location: /admin/events");

include "../layouts/header.php";
?>
    <div class="bg-white text-gray-900 h-auto pb-10">
        <div class="max-w-screen-2xl flex flex-col mx-auto p-4">
            <h1 class="text-3xl font-bold">Event Detail: <?= $event['nama'] ?></h1>

            <div class="rounded-lg shadow-lg p-6 mt-10 bg-sky-200">
                <a href="/admin/events"
                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Kembali</a>

                <h1 class="text-2xl md:text-3xl lg:text-4xl mt-10 font-bold text-center"><?= $event['nama'] ?></h1>
                <div class="grid grid-cols-2 gap-6 mt-12">
                    <div class="space-y-3">
                        <p class="flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="lucide lucide-calendar-range inline-block mr-4">
                                <rect width="18" height="18" x="3" y="4" rx="2"/>
                                <path d="M16 2v4"/>
                                <path d="M3 10h18"/>
                                <path d="M8 2v4"/>
                                <path d="M17 14h-6"/>
                                <path d="M13 18H7"/>
                                <path d="M7 14h.01"/>
                                <path d="M17 18h.01"/>
                            </svg>
                            Tanggal event
                        </p>
                        <p class="flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="lucide lucide-clock inline-block mr-4">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            Waktu event
                        </p>
                        <p class="flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="lucide lucide-users-round inline-block mr-4">
                                <path d="M18 21a8 8 0 0 0-16 0"/>
                                <circle cx="10" cy="8" r="5"/>
                                <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"/>
                            </svg>
                            Jumlah maks. peserta event
                        </p>
                        <p class="flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="lucide lucide-clock inline-block mr-4">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            Data diinput pada
                        </p>
                        <p class="flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="lucide lucide-clock inline-block mr-4">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            Data terakhir diupdate pada
                        </p>
                        <p class="flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="lucide lucide-info inline-block mr-4">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 16v-4"/>
                                <path d="M12 8h.01"/>
                            </svg>
                            Status
                        </p>
                    </div>
                    <div class="space-y-3">
                        <p class="font-semibold"><?= $event['tanggal'] ?></p>
                        <p class="font-semibold"><?= $event['waktu'] ?></p>
                        <p class="font-semibold"><?= $event['jumlah_maks'] ?></p>
                        <p class="font-semibold"><?= $event['created_at'] ?></p>
                        <p class="font-semibold"><?= $event['updated_at'] ?></p>
                        <p class="font-semibold">
                            <span class="bg-<?php if ($event['status'] == 'open') echo 'green'; else if ($event['status'] == 'closed') echo 'yellow'; else echo 'red'; ?>-100 text-<?php if ($event['status'] == 'open') echo 'green'; else if ($event['status'] == 'closed') echo 'yellow'; else echo 'red'; ?>-800 font-medium me-2 px-2.5 py-0.5 rounded-full">
                                        <?= $event['status'] ?>
                                    </span>
                        </p>
                    </div>
                </div>
                <p class="mt-4"><?= $event['deskripsi'] ?></p>
                <div class="flex flex-col lg:flex-row gap-6 mt-10">
                    <div class="w-full lg:w-1/2">
                        <p class="font-bold">Gambar event</p>
                        <img src="../../assets/events/gambar/<?= $event['gambar'] ?>"
                             class="w-full md:w-[320px] rounded-md mt-4"
                             alt="<?= $event['nama'] ?>">
                    </div>
                    <div class="w-full lg:w-1/2">
                        <p class="font-bold">Banner event</p>
                        <img src="../../assets/events/banner/<?= $event['banner'] ?>"
                             class="w-full md:w-[320px] rounded-md mt-4"
                             alt="<?= $event['nama'] ?>">
                    </div>
                </div>
            </div>

            <div class="rounded-lg shadow-lg p-6 mt-16 bg-sky-100">
                <div class="relative overflow-x-auto mt-16">
                    <h2 class="text-xl md:text-2xl font-bold text-center mb-6">Pendaftar</h2>

                    <table id="event-detail-table"
                           class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email user
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Username
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Waktu pendaftaran
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        while ($eventDetail = $queryEventDetail->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr class="bg-white border-b">
                                <th scope="row"
                                    class="px-6 py-4">
                                    <?= $no; ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?= $eventDetail['email'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $eventDetail['username'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $eventDetail['created_at'] ?>
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