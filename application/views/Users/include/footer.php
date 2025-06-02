<!-- Footer -->
<?php
if ($data = $this->session->userdata('data')) {
}
?>
<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4 custom-shadow">
            <h3 class="h-font fw-bold fs-3 mb-2"><?= $data['site_title'] ?></h3>
            <p>
                <?= $data['site_about'] ?>
            </p>
        </div>
        <div class="col-lg-4 p-4 custom-shadow">
            <h5 class="mb-2">Links</h5>
            <a href="home" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
            <a href="" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
            <a href="" class="d-inline-block mb-2 text-dark text-decoration-none">Facilites</a><br>
            <a href="<?= base_url('contact') ?>" class="d-inline-block mb-2 text-dark text-decoration-none">Contact us</a><br>
            <a href="<?= base_url('about') ?>" class="d-inline-block mb-2 text-dark text-decoration-none ">About</a>
        </div>

        <div class="col-lg-4 p-4 custom-shadow">
            <h5 class="mb-3">Follow us</h5>
            <a class="d-inline-block mb-2 text-dark text-decoration-none" href="<?= $data['twitter']; ?>">
                <i class="bi bi-twitter me-1"></i> Twitter</a><br>

            <a class="d-inline-block mb-2 text-dark text-decoration-none" href="<?= $data['facebook']; ?>">
                <i class="bi bi-facebook me-1"></i> Facebook</a><br>

            <a class="d-inline-block text-dark text-decoration-none" href="<?= $data['instagram']; ?>">
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
<?php require(APPPATH . 'views/users/include/scripts.php'); ?>
<!-- Custom js -->
<script src="<?= base_url('assets/js/swiper/custom.js') ?>"></script>



</body>

</html>