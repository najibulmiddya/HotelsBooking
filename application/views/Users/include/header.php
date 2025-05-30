<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <?php require(APPPATH . 'views/users/include/link.php'); ?>

    <script>
        // ja alert function
        function js_alert(status, message) {
            if (status == true) {
                status = "success";
                mes_type = "Successfully ! "
            } else {
                status = "warning";
                mes_type = "Warning ! ";
            }
            if (status == 'error') {
                status == 'danger'
                mes_type = "Failed ! "
            }

            let mes = ` <div class="alert alert-${status} alert-dismissible fade show custom-alert" role="alert">
                            <strong>${mes_type}</strong>${message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
            $(document.body).append(mes);
        }
    </script>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="#">Hotels</a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= is_active('home'); ?> me-2" aria-current="page" href="<?= base_url('home') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2  <?= is_active('rooms'); ?>" href="<?= base_url('hotels-rooms') ?>">Rooms</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link me-2  <?= is_active('facilities'); ?>" href="<?= base_url('facilities') ?>">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 <?= is_active('contact'); ?>" href="<?= base_url('contact') ?>">Contact us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= is_active('about'); ?>" href="<?= base_url('hotels-about') ?>">About</a>
                    </li>

                </ul>
                <div class="d-flex">
                    <!-- Button trigger Login -->
                    <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal"
                        data-bs-target="#loginModal">
                        Login
                    </button>
                    <!-- Button trigger register -->
                    <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal"
                        data-bs-target="#registerModal">
                        Register
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="login-from">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center" id="staticBackdropLabel"> <i
                                class="bi bi-person-circle fs-3 me-2"></i> User Login</h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control shadow-none">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="email" class="form-control shadow-none">
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button class="btn btn-dark shadow-none" type="submit">Login</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Frogot
                                Password</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="login-from">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center" id="staticBackdropLabel"> <i
                                class="bi bi-person-lines-fill fs-3 me-2"></i> User Registration</h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge bg-light text-dark me-3 text-wrap lh-base">
                            Note: Your Details must match with your ID (Aadhaar card, Passport, driving license, etc.)
                            that will be
                            required during check-in.
                        </span>
                        <div class="contaniner-fluid">
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control shadow-none">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="number" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Picture</label>
                                    <input type="file" class="form-control shadow-none">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control shadow-none"></textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pincode</label>
                                    <input type="number" class="form-control shadow-none">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control shadow-none">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control shadow-none">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="Password" class="form-control shadow-none">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button class="btn btn-dark shadow-none" type="submit">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>