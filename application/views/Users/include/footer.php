<!-- Footer -->
<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4 custom-shadow">
            <h3 class="h-font fw-bold fs-3 mb-2">Hotals</h3>
            <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Aspernatur cupiditate accusantium,
                magni quisquam harum reiciendis placeat optio animi aliquid quidem,
                maiores, nulla fugit officiis voluptate ea similique sint ipsa eveniet.
            </p>
        </div>
        <div class="col-lg-4 p-4 custom-shadow">
            <h5 class="mb-2">Links</h5>
            <a href="home" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
            <a href="" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
            <a href="" class="d-inline-block mb-2 text-dark text-decoration-none">Facilites</a><br>
            <a href="" class="d-inline-block mb-2 text-dark text-decoration-none">Contact us</a><br>
            <a href="about" class="d-inline-block mb-2 text-dark text-decoration-none">About</a>
        </div>

        <div class="col-lg-4 p-4 custom-shadow">
            <h5 class="mb-3">Follow us</h5>
            <a class="d-inline-block mb-2 text-dark text-decoration-none" href="">
                <i class="bi bi-twitter me-1"></i> Twitter</a><br>

            <a class="d-inline-block mb-2 text-dark text-decoration-none" href="">
                <i class="bi bi-facebook me-1"></i> Facebook</a><br>

            <a class="d-inline-block text-dark text-decoration-none" href="">
                <i class="bi bi-instagram me-1"></i> Instagram</a><br>
        </div>
    </div>
</div>

<h6 class="text-center bg-dark text-white p-3 m-0">Designed and Developed by Najibul Middya ||
    <a href="" class="text-decoration-none">
        <i class="bi bi-instagram me-1"></i>najibul_middya
    </a>
</h6>


<!-- Bootstrap Js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<!-- Carousel JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Carousel -->
<script>
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        autoplay: {
            delay: 2500, disableOnInteraction: false,
        }
    });

    var swiper = new Swiper(".testimonials", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        slidesPerView: "3",
        loop: true,
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: false,
        },
        pagination: {
            el: ".swiper-pagination",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });
</script>
</body>

</html>