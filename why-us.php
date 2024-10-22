<?php
include 'layouts/header.php';
include 'layouts/navbar.php';
?>

<div class="flex flex-col justify-center items-center min-h-screen p-4" style="background-image: url('/assets/group.jpg');background-repeat: no-repeat;background-size: cover;">
    <div class="flex flex-col md:flex-row gap-12 items-center md:items-start">
        <div class="flex-grow text-center md:text-left space-y-4 ps-12">
            <p class="text-white text-5xl md:text-7xl font-medium">WHY</p>
            <span class="block text-7xl md:text-9xl text-blue-700">
                <span class="font-bold" id="logo">Festivo!</span><span class="text-white">?</span>
            </span>
            <p class="text-white text-2xl md:text-4xl">Your ultimate event management platform</p>
        </div>
        <div class="flex flex-col justify-evenly text-center space-y-8">
            <div class="text-center">
                <p class="text-white font-bold text-xl md:text-2xl">Manajemen Acara Tanpa Ribet</p>
                <p class="text-white font-medium text-sm md:text-base text-balance">Atur Acara Anda dengan Mudah dan Efisien
                Dengan platform kami, mengelola setiap aspek acara menjadi lebih sederhana. Dari perencanaan hingga pelaksanaan, kami menyediakan alat intuitif yang memudahkan koordinasi tim, penjadwalan, dan pengelolaan sumber daya. Fokus pada menciptakan pengalaman tak terlupakan bagi peserta tanpa harus khawatir tentang detail operasional.</p>
            </div>
            <div class="text-center">
                <p class="text-white font-bold text-xl md:text-2xl">Terhubung dengan Peserta</p>
                <p class="text-white font-medium text-sm md:text-base text-balance">Bangun Koneksi yang Kuat dan Berkelanjutan
                Ciptakan interaksi yang bermakna antara Anda dan para peserta acara. Fitur-fitur kami memungkinkan komunikasi langsung, networking yang efektif, dan keterlibatan aktif sepanjang acara. Tingkatkan kepuasan peserta dan ciptakan komunitas yang solid melalui koneksi yang mudah dan personal.</p>
            </div>
            <div class="text-center">
                <p class="text-white font-bold text-xl md:text-2xl">Promosi Mudah</p>
                <p class="text-white font-medium text-sm md:text-base text-balance">Promosikan Acara Anda dengan Sederhana dan Efektif
                Perluas jangkauan acara Anda tanpa kesulitan. Gunakan alat promosi terintegrasi kami untuk menyebarkan informasi acara melalui berbagai saluran media sosial, email, dan pemasaran digital lainnya. Tarik perhatian audiens target dengan strategi pemasaran yang terarah dan hasil yang maksimal, semuanya dalam satu platform yang mudah digunakan.</p>
            </div>
        </div>
    </div>
    <div class="p-14 text-center">
        <a href="index.php" class="text-2xl text-white font-extrabold md:text-4xl hover:text-blue-700">Ready to host your next event?</a>
    </div>
</div>

<?php
include 'layouts/footer.php'
?>