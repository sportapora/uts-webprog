<?php
include '../../connection/connection.php';
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) header("location: /login.php");
if ($_SESSION['user']["role"] != "admin") {
    die(403);
}

$query = $connection->prepare("SELECT * FROM events WHERE id = ?");
$query->execute([$_GET["id"]]);

$event = $query->fetch(PDO::FETCH_ASSOC);

if (!$event) header("location: /admin/events");

include "../layouts/header.php";
?>
    <div class="bg-white text-gray-900 h-auto pb-10">
        <div class="max-w-screen-xl flex flex-col items-center mx-auto p-4">
            <h1 class="font-bold text-3xl mb-10">Edit Event: <?= $event['nama'] ?></h1>
            <form class="w-1/2" method="post" action="/admin/process/edit_event.php" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= $event['id'] ?>">
                <div class="mb-7">
                    <div class="relative z-0">
                        <input type="text" id="nama" name="nama"
                               class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 <?= isset($_SESSION['errors']['nama']) ? 'border-red-300 focus:border-red-600' : 'text-gray-900 border-gray-300 focus:border-blue-600' ?> appearance-none focus:outline-none focus:ring-0 peer"
                               placeholder=" " value="<?= $event['nama'] ?>" />
                        <label for="nama"
                               class="absolute text-sm <?= isset($_SESSION['errors']['nama']) ? 'text-red-500' : 'text-gray-500' ?> duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                            Nama Event</label>
                    </div>
                    <?php if (isset($_SESSION['errors']['nama'])): ?>
                        <p class="mt-2 text-sm text-red-600"><?= $_SESSION['errors']['nama'] ?></p>
                    <?php endif; unset($_SESSION['errors']['nama']); ?>
                </div>
                <div class="mb-7">
                    <label for="tanggal"
                           class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" value="<?= $event['tanggal'] ?>"
                           class="bg-gray-50 border <?php if (isset($_SESSION['errors']['tanggal'])) echo 'border-red-300'; else echo 'border-gray-300'; ?> text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    />
                    <?php if (isset($_SESSION['errors']['tanggal'])): ?>
                        <p class="mt-2 text-sm text-red-600"><?= $_SESSION['errors']['tanggal'] ?></p>
                    <?php endif; unset($_SESSION['errors']['tanggal']); ?>
                </div>
                <div class="mb-7">
                    <label for="waktu"
                           class="block mb-2 text-sm font-medium text-gray-900">Waktu</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                      d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input type="time" id="waktu" name="waktu" value="<?= $event['waktu'] ?>"
                               class="bg-gray-50 border leading-none <?php if (isset($_SESSION['errors']['tanggal'])) echo 'border-red-300'; else echo 'border-gray-300'; ?> text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        />
                    </div>
                    <?php if (isset($_SESSION['errors']['waktu'])): ?>
                        <p class="mt-2 text-sm text-red-600"><?= $_SESSION['errors']['waktu'] ?></p>
                    <?php endif; unset($_SESSION['errors']['waktu']); ?>
                </div>
                <div class="mb-7">
                    <div class="relative z-0">
                        <input type="text" id="lokasi" name="lokasi" value="<?= $event['lokasi'] ?>"
                               class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 <?= isset($_SESSION['errors']['lokasi']) ? 'border-red-300 focus:border-red-600' : 'text-gray-900 border-gray-300 focus:border-blue-600' ?> appearance-none focus:outline-none focus:ring-0 peer"
                               placeholder=" "/>
                        <label for="lokasi"
                               class="absolute text-sm <?= isset($_SESSION['errors']['lokasi']) ? 'text-red-500' : 'text-gray-500' ?> duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                            Lokasi</label>
                    </div>
                    <?php if (isset($_SESSION['errors']['lokasi'])): ?>
                        <p class="mt-2 text-sm text-red-600"><?= $_SESSION['errors']['lokasi'] ?></p>
                    <?php endif; unset($_SESSION['errors']['lokasi']); ?>
                </div>
                <div class="mb-5">
                    <div class="relative z-0">
                        <input type="number" id="jumlah_maks" name="jumlah_maks" value="<?= $event['jumlah_maks'] ?>"
                               class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 <?= isset($_SESSION['errors']['jumlah_maks']) ? 'border-red-300 focus:border-red-600' : 'text-gray-900 border-gray-300 focus:border-blue-600' ?> appearance-none focus:outline-none focus:ring-0 peer"
                               placeholder=" "/>
                        <label for="jumlah_maks"
                               class="absolute text-sm <?= isset($_SESSION['errors']['jumlah_maks']) ? 'text-red-500' : 'text-gray-500' ?> duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                            Jumlah maks. pendaftar</label>
                    </div>
                    <?php if (isset($_SESSION['errors']['jumlah_maks'])): ?>
                        <p class="mt-2 text-sm text-red-600"><?= $_SESSION['errors']['jumlah_maks'] ?></p>
                    <?php endif; unset($_SESSION['errors']['jumlah_maks']); ?>
                </div>

                <div class="mb-7">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                    <select id="status" name="status"
                            class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </div>
                <div class="mb-7">
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                    <textarea id="deskripsi" rows="10" name="deskripsi"
                              class="bg-gray-50 border <?php if (isset($_SESSION['errors']['deskripsi'])) echo 'border-red-300'; else echo 'border-gray-300'; ?> text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"><?= $event['deskripsi'] ?></textarea>
                    <?php if (isset($_SESSION['errors']['deskripsi'])): ?>
                        <p class="mt-2 text-sm text-red-600"><?= $_SESSION['errors']['deskripsi'] ?></p>
                    <?php endif; unset($_SESSION['errors']['deskripsi']); ?>
                </div>
                <div class="mb-7">
                    <label for="banner"
                           class="block mb-2 text-sm font-medium text-gray-900">Banner</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                           id="banner" name="banner" type="file">
                    <p class="mt-2">Banner sebelumnya:</p>
                    <img src="../../assets/events/banner/<?= $event['banner'] ?>" alt="<?= $event['nama'] ?>"
                         class="w-[200px] rounded-md">
                </div>
                <div class="mb-10">
                    <label for="gambar"
                           class="block mb-2 text-sm font-medium text-gray-900">Gambar</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                           id="gambar" name="gambar" type="file">
                    <p class="mt-2">Gambar sebelumnya:</p>
                    <img src="../../assets/events/gambar/<?= $event['gambar'] ?>" alt="<?= $event['nama'] ?>"
                         class="w-[200px] rounded-md">
                </div>
                <button type="submit"
                        name="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-full font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center">
                    Update
                </button>
            </form>
        </div>
    </div>

<?php
include "../layouts/footer.php";
?>