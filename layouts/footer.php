    <script>
        let tl = gsap.timeline({ repeat: -1, repeatDelay: 1 });

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