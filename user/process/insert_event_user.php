<?php
include '../../connection/connection.php'; // Pastikan koneksi sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_name = $_POST['event-name'];
    $event_desc = $_POST['event-desc'];
    $event_date = $_POST['event-date'];

    try {
        // Sesuaikan query sesuai dengan struktur tabel
        $sql = 'INSERT INTO event (namaEvent, descEvent, eventDate) VALUES (:event_name, :event_desc, :event_date)';
        $stmt = $connection->prepare($sql);

        // Eksekusi query dengan parameter yang sesuai
        if ($stmt->execute(['event_name' => $event_name, 'event_desc' => $event_desc, 'event_date' => $event_date])) {
            echo "Event berhasil ditambahkan!";
        } else {
            echo "Terjadi kesalahan saat menambahkan event.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
