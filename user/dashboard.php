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

<div class="flex justify-center pt-28">
    <?php if (isset($_SESSION["error"])) { ?>
        <div id="alert-3"
             class="flex w-full mx-4 md:mx-0 md:w-1/2 mt-6 items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50"
             role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ms-3 text-sm font-medium">
                <?= $_SESSION["error"] ?>
            </div>
            <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                    data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
        <?php $_SESSION['error'] = null;
    } else if(isset($_SESSION['message'])) { ?>
        <div id="alert-3"
             class="flex w-full mx-4 md:mx-0 md:w-1/2 mt-6 items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50"
             role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ms-3 text-sm font-medium">
                <?= $_SESSION["message"] ?>
            </div>
            <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                    data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    <?php } $_SESSION['message'] = null; ?>
</div>

<div class="flex justify-center">
    <div class="container justify-center pt-16">
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
