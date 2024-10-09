<?php
include 'assets/header.php';
include 'assets/navbar.php';
include '../connection/connection.php';

$sql = 'SELECT namaEvent, descEvent, eventDate  FROM event';
$stmt = $connection->prepare($sql);
$stmt->execute();
$events = $stmt->fetchAll();
?>

<div class="max-w-screen-xl flex items-center flex-wrap justify-items-beetwen mx-auto p-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg items-center">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"> 
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Event Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Description Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Event Date
                </th>
            </tr>
        </thead>
            <?php foreach ($events as $event) : ?>
                <tbody>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?php echo $event['namaEvent'];?>
                        </th>
                        <td class="px-6 py-4">
                            <?php echo $event['descEvent'];?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $event['eventDate'];?>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="flex p-4">
        <button data-modal-target="insert-event-modal" data-modal-toggle="insert-event-modal" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" type="button">
          Add Event
        </button>
    </div>
</div>


<!-- Main modal INSERT -->
<div id="insert-event-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Insert Your Event
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="insert-event-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>


            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="function/insert_event_user.php" method="post">
                    <div>
                        <label for="event-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Name</label>
                        <input type="text" name="event-name" id="event-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <div>
                        <label for="event-desc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Description</label>
                        <input type="text" name="event-desc" id="event-desc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <div>
                        <label for="event-date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Date</label>
                        <input type="date" name="event-date" id="event-date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Your Event</button>
                </form>
            </div>
        </div>
    </div>
</div> 
<!-- END MODAL INSERT -->


<?php
include 'assets/footer.php';
?>