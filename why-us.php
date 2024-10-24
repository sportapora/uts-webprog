<?php
include 'layouts/header.php';
include 'layouts/navbar.php';
?>

<div class="flex flex-col justify-center items-center min-h-screen p-4" style="background-image: url('/assets/group.jpg');background-repeat: no-repeat;background-size: cover; background-position: center">
    <div class="flex flex-col xl:flex-row gap-8 xl:items-start px-6 sm:px-10 pt-10 lg:px-20">
        <div class="flex-grow text-center xl:text-left space-y-4 mt-10 lg:mt-0">
            <p class="text-white text-3xl sm:text-4xl lg:text-5xl xl:text-7xl font-medium">WHY</p>
            <span class="block text-5xl sm:text-6xl lg:text-7xl xl:text-9xl text-blue-700">
                <span class="font-bold" id="logo">Festivo!</span><span class="text-white">?</span>
            </span>
            <p class="text-white text-lg sm:text-xl lg:text-2xl xl:text-4xl">Your ultimate event management platform</p>
        </div>
        <div class="flex flex-col justify-evenly text-center space-y-6 sm:space-y-8">
            <div class="text-center">
                <p class="text-white font-bold text-lg sm:text-xl xl:text-2xl mb-3">Manajemen Acara Tanpa Ribet</p>
                <p class="text-white font-medium text-sm sm:text-base xl:text-lg">Atur Acara Anda dengan Mudah dan Efisien
                Dengan platform kami, mengelola setiap aspek acara menjadi lebih sederhana. Dari perencanaan hingga pelaksanaan, kami menyediakan alat intuitif yang memudahkan koordinasi tim, penjadwalan, dan pengelolaan sumber daya. Fokus pada menciptakan pengalaman tak terlupakan bagi peserta tanpa harus khawatir tentang detail operasional.</p>
            </div>
            <div class="text-center">
                <p class="text-white font-bold text-lg sm:text-xl xl:text-2xl mb-3">Terhubung dengan Peserta</p>
                <p class="text-white font-medium text-sm sm:text-base xl:text-lg">Bangun Koneksi yang Kuat dan Berkelanjutan
                Ciptakan interaksi yang bermakna antara Anda dan para peserta acara. Fitur-fitur kami memungkinkan komunikasi langsung, networking yang efektif, dan keterlibatan aktif sepanjang acara. Tingkatkan kepuasan peserta dan ciptakan komunitas yang solid melalui koneksi yang mudah dan personal.</p>
            </div>
            <div class="text-center">
                <p class="text-white font-bold text-lg sm:text-xl xl:text-2xl mb-3">Promosi Mudah</p>
                <p class="text-white font-medium text-sm sm:text-base xl:text-lg">Promosikan Acara Anda dengan Sederhana dan Efektif
                Perluas jangkauan acara Anda tanpa kesulitan. Gunakan alat promosi terintegrasi kami untuk menyebarkan informasi acara melalui berbagai saluran media sosial, email, dan pemasaran digital lainnya. Tarik perhatian audiens target dengan strategi pemasaran yang terarah dan hasil yang maksimal, semuanya dalam satu platform yang mudah digunakan.</p>
            </div>
        </div>
    </div>
    <div class="p-6 sm:p-10 lg:p-14 text-center">
        <a href="index.php" class="text-xl sm:text-2xl text-white font-extrabold xl:text-4xl hover:text-blue-700">Ready to host your next event?</a>
    </div>
</div>

<?php
include 'layouts/footer.php'
?>