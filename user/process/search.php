<?php
include '../../connection/connection.php';

if (isset($_GET['query']) && !empty(trim($_GET['query']))) {
    $searchTerm = htmlspecialchars(trim($_GET['query']));
    $searchTerm = "%{$searchTerm}%";

    $sql = "SELECT * 
            FROM events 
            WHERE nama LIKE ? OR deskripsi LIKE ?";
    $stmt = $connection->prepare($sql);
    if ($stmt->execute([$searchTerm, $searchTerm])) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($results)) {
            foreach ($results as $event) {
                echo '<div class="bg-white rounded-lg shadow-md overflow-hidden">';
                echo '<img src="' . htmlspecialchars($event['gambar']) . '" alt="' . htmlspecialchars($event['nama']) . '" class="w-full h-48 object-cover">';
                echo '<div class="p-4">';
                echo '<h2 class="text-xl font-bold">' . htmlspecialchars($event['nama']) . '</h2>';
                echo '<p class="text-gray-600">' . htmlspecialchars($event['deskripsi']) . '</p>';
                echo '<p>Date: ' . htmlspecialchars($event['tanggal']) . '</p>';
                echo '<p>Time: ' . htmlspecialchars($event['waktu']) . '</p>';
                echo '<p>Location: ' . htmlspecialchars($event['lokasi']) . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p class="col-span-4 text-center text-gray-500">No events found.</p>';
        }
    } else {
        echo '<p class="col-span-4 text-center text-red-500">Error executing the search query.</p>';
    }
} else {
    echo '<p class="col-span-4 text-center text-gray-500">Please enter a search term.</p>';
}
