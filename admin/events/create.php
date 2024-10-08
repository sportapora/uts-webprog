<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) header("location: /login.php");
if ($_SESSION["role"] != "admin") {
    die(403);
}
include "../layouts/header.php";
?>
    <div class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white h-auto pb-10">
        <div class="max-w-screen-xl flex flex-col items-center mx-auto p-4">
            <h1 class="font-bold text-3xl mb-10">Tambah Event Baru</h1>
            <form class="w-1/2" method="post" action="/admin/process/create_event.php" enctype="multipart/form-data">
                <div class="mb-5">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Event</label>
                    <input type="text" id="nama" name="nama"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           required/>
                </div>
                <div class="mb-5">
                    <label for="tanggal"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           required/>
                </div>
                <div class="mb-5">
                    <label for="waktu"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu</label>
                    <input type="time" id="waktu" name="waktu"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           required/>
                </div>
                <div class="mb-5">
                    <label for="lokasi"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           required/>
                </div>
                <div class="mb-5">
                    <label for="jumlah_maks" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah
                        Maks.</label>
                    <input type="number" id="jumlah_maks" name="jumlah_maks"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           required/>
                </div>
                <div class="mb-5">
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                    <textarea id="deskripsi" rows="10" name="deskripsi"
                              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>
                <div class="mb-5">
                    <label for="gambar"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Banner</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           id="banner" name="banner" type="file">

                </div>
                <div class="mb-10">
                    <label for="gambar"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           id="gambar" name="gambar" type="file">

                </div>
                <button type="submit"
                        name="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-full font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Submit
                </button>
            </form>
        </div>
    </div>

<?php
include "../layouts/footer.php";
?>