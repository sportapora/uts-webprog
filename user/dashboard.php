<?php
include '../connection/connection.php';
include '../layouts/header.php';
include '../layouts/navbar.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Ambil data user dari session
    $user = $_SESSION['user'];
    $user_id = $user['id'];  // Corrected to fetch user id from session
    $username = $user['username'];
    $email = $user['email'];
} else {
    // Jika belum login, redirect ke halaman login
    header("Location: /login.php");
    exit();
}

$queryEventDetail = $connection->prepare(
    "SELECT eu.event_id, e.nama_event, eu.created_at, e.lokasi, e.tanggal_event, e.waktu_event
     FROM events_users eu
     INNER JOIN events e ON eu.event_id = e.id
     INNER JOIN users u ON eu.user_id = u.id
     WHERE eu.user_id = ?"
);

$queryEventDetail->execute([$user_id]);

// Fetch all event data
$events_users = $queryEventDetail->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="flex justify-center">
    <div class="container justify-center pt-32">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Event</th>
                        <th scope="col" class="px-6 py-3">Tanggal Registrasi</th>
                        <th scope="col" class="px-6 py-3">Lokasi Event</th>
                        <th scope="col" class="px-6 py-3">Tanggal Event</th>
                        <th scope="col" class="px-6 py-3">Waktu Event</th>
                        <th scope="col" class="px-6 py-3"><span class="sr-only">Edit</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events_users as $event_user) : ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= htmlspecialchars($event_user['nama_event']); ?>
                        </th>
                        <td class="px-6 py-4">
                            <?= htmlspecialchars($event_user['created_at']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= htmlspecialchars($event_user['lokasi']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= htmlspecialchars($event_user['tanggal_event']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= htmlspecialchars($event_user['waktu_event']); ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="/user/process/delete_event.php" method="post" >
                                <input type="hidden" name="event_id" value="<?= htmlspecialchars($event_user['event_id']); ?>">
                                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id); ?>">
                                <button type="submit" name="delete_btn" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    Cancel
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../layouts/footer.php';
?>
