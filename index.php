<?php
session_start();

include 'layouts/header.php';
include 'layouts/navbar.php';
include 'connection/connection.php';

$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$users = $loggedIn ? $_SESSION['user'] : null;
$user_id = $loggedIn ? $users['id'] : null;

if (isset($_GET['query'])) {
    $searchTerm = htmlspecialchars(trim($_GET['query']));

    $sql = "SELECT * 
            FROM events 
            WHERE nama LIKE ? OR deskripsi LIKE ?";
    $stmt = $connection->prepare($sql);
    $stmt->execute(["%$searchTerm%", "%$searchTerm%"]);

    if (empty($events)) {
        $_SESSION['message'] = "No events found.";
    }
} else {
    $sql = 'SELECT * FROM events ORDER BY created_at DESC';
    $stmt = $connection->prepare($sql);
    $stmt->execute();
}

$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="h-<?= count($events) > 2 ? 'auto' : 'screen' ?> lg:h-screen"
         style="background-image: url('/assets/background.jpg');background-repeat: no-repeat;background-size: cover;">
        <h1 class="text-4xl md:text-5xl text-center pt-24 text-white font-bold">Welcome to <span id="logo"
                                                                                                 class="text-blue-700">Festivo!</span>

            <?php if (isset($_SESSION['logout_message'])) {
                echo '<div class="alert alert-success">' . $_SESSION['logout_message'] . '</div>';
                unset($_SESSION['logout_message']);
            } ?>
        </h1>
        <?php if (count($events) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 px-20 mt-10 md:mt-20 content-center p-4 pb-20"
                 id="search-results">
                <?php foreach ($events as $event) : ?>
                    <!-- Card Events -->
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md">
                        <a href="#" data-modal-target="event_detail_<?php echo $event['id']; ?>"
                           data-modal-toggle="event_detail_<?php echo $event['id']; ?>">
                            <img class="rounded-t-lg w-full h-[200px] object-cover"
                                 src="/assets/events/gambar/<?php echo htmlspecialchars($event['gambar']); ?>"
                                 alt="Event Image"/>
                        </a>
                        <div class="p-5">
                            <a href="#" data-modal-target="event_detail_<?php echo $event['id']; ?>"
                               data-modal-toggle="event_detail_<?php echo $event['id']; ?>">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><?php echo htmlspecialchars($event['nama']); ?></h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700"><?php echo htmlspecialchars($event['deskripsi']); ?></p>
                            <div class="flex flex-row justify-between items-center">
                                <button data-modal-target="event_detail_<?php echo $event['id']; ?>"
                                        data-modal-toggle="event_detail_<?php echo $event['id']; ?>"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    Read more
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg"
                                         fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </button>
                                <p>
                                    <span class="bg-<?php if ($event['status'] == 'open') echo 'green'; else if ($event['status'] == 'closed') echo 'yellow'; else echo 'red'; ?>-100 text-<?php if ($event['status'] == 'open') echo 'green'; else if ($event['status'] == 'closed') echo 'yellow'; else echo 'red'; ?>-800 font-medium me-2 px-2.5 py-0.5 rounded-full">
                                                <?= $event['status'] ?>
                                            </span>
                                </p>
                            </div>
                        </div>
                        <!-- !Card Events -->

                        <div id="event_detail_<?php echo $event['id']; ?>" tabindex="-1" aria-hidden="true"
                             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow">
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                        <h3 class="text-xl font-semibold text-gray-900"><?php echo htmlspecialchars($event['nama']); ?></h3>
                                        <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                data-modal-target="event_detail_<?php echo $event['id']; ?>"
                                                data-modal-toggle="event_detail_<?php echo $event['id']; ?>">
                                            <svg class="w-3 h-3" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 fill="none"
                                                 viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>

                                    <!-- Modal body with event details -->
                                    <div class="p-4 md:p-5">
                                        <p class="mb-2">
                                            <strong>Date:</strong> <?php echo htmlspecialchars($event['tanggal']); ?>
                                        </p>
                                        <p class="mb-2">
                                            <strong>Time:</strong> <?php echo htmlspecialchars($event['waktu']); ?>
                                        </p>
                                        <p class="mb-2">
                                            <strong>Location:</strong> <?php echo htmlspecialchars($event['lokasi']); ?>
                                        </p>
                                        <p class="mb-2">
                                            <strong>Capacity:</strong> <?php echo htmlspecialchars($event['jumlah_maks']); ?>
                                        </p>
                                        <p class="mb-2">
                                            <strong>Description:</strong> <?php echo htmlspecialchars($event['deskripsi']); ?>
                                        </p>
                                        <img src="/assets/events/banner/<?php echo htmlspecialchars($event['banner']); ?>"
                                             alt="Event Banner" class="rounded-md w-full h-auto mt-4"/>


                                        <div class="flex justify-end mt-4">
                                            <?php if (!$loggedIn) : ?>
                                                <a href="/login.php"
                                                   class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                                    Login to Join Event
                                                </a>
                                            <?php elseif ($event['status'] === 'canceled') : ?>
                                                <button class="text-gray-500 bg-gray-300 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5"
                                                        type="button" disabled>
                                                    Event Cancelled
                                                </button>
                                            <?php elseif ($event['status'] === 'closed') : ?>
                                                <button class="text-gray-500 bg-gray-300 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5"
                                                        type="button" disabled>
                                                    Event Closed
                                                </button>
                                            <?php else : ?>
                                            <form action="/user/process/join_event.php" method="post">
                                                <input type="hidden" name="event_id"
                                                       value="<?php echo $event['id']; ?>">
                                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                                <button class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5"
                                                        type="submit">
                                                    Join Event
                                                </button>
                                                <?php endif; ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="flex mt-48 items-center justify-center mx-10">
                <div class="p-4 rounded-lg bg-sky-200 text-gray-900 flex items-center justify-center w-full md:w-1/2">
                    <h2 class="text-2xl lg:text-4xl text-center font-bold">Tidak ada event ditemukan!</h2>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php
include 'layouts/footer.php';
?>