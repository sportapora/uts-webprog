<?php

include_once "../../connection/connection.php";

if (isset($_POST['submit'])) {
    session_start();

    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $lokasi = $_POST['lokasi'];
    $jumlah_maks = $_POST['jumlah_maks'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $_FILES['gambar']['name'];
    $tmpGambar = $_FILES['gambar']['tmp_name'];
    $banner = $_FILES['banner']['name'];
    $tmpBanner = $_FILES['banner']['tmp_name'];

    try {
        move_uploaded_file($tmpGambar, "../../assets/events/gambar/$gambar");
        move_uploaded_file($tmpBanner, "../../assets/events/banner/$banner");

        $statement = $connection->prepare('INSERT INTO events (nama, tanggal, waktu, lokasi, jumlah_maks, deskripsi, gambar, banner) VALUE (?, ?, ?, ?, ?, ?, ?, ?)');
        $statement->execute(array($nama, $tanggal, $waktu, $lokasi, $jumlah_maks, $deskripsi, $gambar, $banner));

        $_SESSION['message'] = "Berhasil menambahkan event!";
        header("location: /admin/events");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
