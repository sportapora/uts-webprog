<?php

include_once "../../connection/connection.php";
require_once '../../vendor/autoload.php';

use Rakit\Validation\Validator;

$validator = new Validator();

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    date_default_timezone_set("Asia/Jakarta");

    $query = $connection->prepare("SELECT * FROM events WHERE id  = ?");
    $query->execute([$id]);
    $data = $query->fetch(PDO::FETCH_ASSOC);
    $gambarOld = $data['gambar'];
    $bannerOld = $data['banner'];

    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $lokasi = $_POST['lokasi'];
    $capacity = $_POST['capacity'];
    $deskripsi = $_POST['deskripsi'];
    $status = $_POST['status'];

    $gambar = $_FILES['gambar']['name'] == "" ? $gambarOld : $_FILES['gambar']['name'];
    $tmpGambar = $_FILES['gambar']['tmp_name'] ?? null;
    $banner = $_FILES['banner']['name'] == "" ? $bannerOld : $_FILES['banner']['name'];
    $tmpBanner = $_FILES['banner']['tmp_name'] ?? null;

    $validation = $validator->validate($_POST + $_FILES, [
        'nama' => 'required',
        'tanggal' => 'required|date',
        'waktu' => 'required',
        'lokasi' => 'required',
        'capacity' => 'required|numeric',
        'deskripsi' => 'required',
        'gambar' => 'nullable|uploaded_file:0,4M,png,jpg,jpeg,webp',
        'banner' => 'nullable|uploaded_file:0,4M,png,jpg,jpeg,webp'
    ]);

    if ($validation->fails()) {
        $_SESSION['errors'] = $validation->errors()->firstOfAll();
        header("location: /admin/events/edit.php?id=$id");
    } else {
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

            $statement = $connection->prepare('UPDATE events SET nama = ?, tanggal = ? , waktu = ?, lokasi = ?, capacity = ?, deskripsi = ?, gambar = ?, banner = ?, status = ?, updated_at = ? WHERE id = ?');
            $statement->execute(array($nama, $tanggal, $waktu, $lokasi, $capacity, $deskripsi, $gambar, $banner, $status, date('Y-m-d H:i:s'), $id));

            $_SESSION['message'] = "Berhasil mengupdate data event!";
            header("location: /admin/events");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
