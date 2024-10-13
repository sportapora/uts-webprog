<?php

include_once "../../connection/connection.php";

if (isset($_POST['submit'])) {
    $id = $_POST['id'];

    $query = $connection->prepare("SELECT * FROM events WHERE id  = ?");
    $query->execute([$id]);
    $data = $query->fetch(PDO::FETCH_ASSOC);
    $gambarOld = $data['gambar'];
    $bannerOld = $data['banner'];

    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $lokasi = $_POST['lokasi'];
    $jumlah_maks = $_POST['jumlah_maks'];
    $deskripsi = $_POST['deskripsi'];
    $status = $_POST['status'];

    $gambar = $_FILES['gambar']['name'] == "" ? $gambarOld : $_FILES['gambar']['name'];
    $tmpGambar = $_FILES['gambar']['tmp_name'] ?? null;
    $banner = $_FILES['banner']['name'] == "" ? $bannerOld : $_FILES['banner']['name'];
    $tmpBanner = $_FILES['banner']['tmp_name'] ?? null;

    try {
        session_start();
        if ($tmpGambar != "") {
            unlink("../../assets/events/gambar/$gambarOld");
            move_uploaded_file($tmpGambar, "../../assets/events/gambar/$gambar");
        }

        if ($tmpBanner != "") {
            unlink("../../assets/events/banner/$bannerOld");
            move_uploaded_file($tmpBanner, "../../assets/events/banner/$banner");
        }

        $statement = $connection->prepare('UPDATE events SET nama = ?, tanggal = ? , waktu = ?, lokasi = ?, jumlah_maks = ?, deskripsi = ?, gambar = ?, banner = ?, status = ?, updated_at = ? WHERE id = ?');
        $statement->execute(array($nama, $tanggal, $waktu, $lokasi, $jumlah_maks, $deskripsi, $gambar, $banner, $status, date('Y-m-4') . ' '. time(), $id));

        $_SESSION['message'] = "Berhasil mengupdate data event!";
        header("location: /admin/events");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
