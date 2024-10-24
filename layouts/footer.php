<footer class="bg-gray-900 text-white">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
            <div class="mb-6 md:mb-0">
                <a href="/" class="flex items-center">
                    <span class="self-center text-2xl lg:text-3xl font-semibold whitespace-nowrap"
                          id="logo">Festivo!</span>
                </a>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold text-white uppercase">Quick Links</h2>
                <ul class="text-gray-500  font-medium">
                    <li class="mb-4">
                        <a href="/" class="hover:underline">Home</a>
                    </li>
                    <li>
                        <a href="/why-us.php" class="hover:underline">Why Us?</a>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8"/>
        <div class="sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-gray-500 sm:text-center ">© 2023 <a href="/"
                                                                        class="hover:underline font-semibold" id="logo">Festivo</a>. All Rights Reserved.
          </span>
        </div>
    </div>
</footer>
<script>
    let tl = gsap.timeline({repeat: -1, repeatDelay: 1});
    tl.from("#logo", {
        opacity: 0,
        scale: 0,
        ease: "back.out(1.7)",
        duration: 1.5
    })
        .to("#logo", {
            color: "#FF5733",
            duration: 0.5,
            ease: "power1.inOut"
        })
        .to("#logo", {
            scale: 1.5,
            duration: 1,
            ease: "elastic.out(1, 0.5)"
        })
        .to("#logo", {
            scale: 1,
            duration: 1,
            ease: "power2.out"
        })
        .to("#logo", {
            y: -15,
            duration: 0.6,
            ease: "sine.inOut",
            yoyo: true,
            repeat: -1
        });

</script>


<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
<script>
    if (document.getElementById("history-user") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#history-user", {
            searchable: true,
            sortable: true
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/Flip.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/Observer.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollToPlugin.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/Draggable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/MotionPathPlugin.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/EaselPlugin.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/PixiPlugin.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/TextPlugin.min.js"></script>


<!-- RoughEase, ExpoScaleEase and SlowMo are all included in the EasePack file -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/EasePack.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/CustomEase.min.js"></script>
</body>
</html>