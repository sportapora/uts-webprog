<?php
include 'layouts/header.php';
include 'layouts/navbar.php';
?>

<div class="flex flex-col justify-center items-center min-h-screen p-4">
    <div class="flex flex-col md:flex-row gap-12 items-center md:items-start">
        <div class="flex-grow text-center md:text-left space-y-4">
            <p class="text-5xl md:text-7xl font-medium">WHY</p>
            <span class="block text-7xl md:text-9xl text-blue-700">
                <span class="font-bold" id="logo">Festivo!</span> 
                <span class="text-black">?</span>
            </span>
            <p class="text-2xl md:text-4xl">Your ultimate event management platform</p>
        </div>
        <div class="flex flex-col justify-evenly text-center space-y-8">
            <div class="text-center">
                <p class="font-semibold text-xl md:text-2xl">Effortless Event Management</p>
                <p class="text-sm md:text-base">Plan, organize, and manage events smoothly with our intuitive platform.</p>
            </div>
            <div class="text-center">
                <p class="font-semibold text-xl md:text-2xl">Connect with Attendees</p>
                <p class="text-sm md:text-base">Interact with your audience and keep them informed with real-time updates.</p>
            </div>
            <div class="text-center">
                <p class="font-semibold text-xl md:text-2xl">Easy Promotion</p>
                <p class="text-sm md:text-base">Promote your events across multiple channels effortlessly.</p>
            </div>
        </div>
    </div>
    <div class="p-14 text-center">
        <a href="index.php" class="text-2xl md:text-4xl hover:text-blue-700">Ready to host your next event?</a>
    </div>
</div>

<?php
include 'layouts/footer.php'
?>