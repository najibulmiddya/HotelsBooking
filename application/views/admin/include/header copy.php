<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>
    </title>
    <?php require(APPPATH . 'views/admin/include/link.php') ?>

    <style>
        #fullscreenLoader {
            backdrop-filter: blur(3px);
        }
    </style>
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
            setTimeout(remAlert, 2000);
        }

        function remAlert() {
            document.getElementsByClassName('alert')[0].remove();
        }
    </script>
</head>

<body class="bg-white">
    <?php if (isset($_SESSION['loggedInAdmin']) == true) { ?>



        <div class="container-fluid bg-dark text-light p-3 d-flex align-item-center justify-content-between sticky-top">
            <h3 class="h-font">HOTELS ADMIN PANEL</h3>

            <a href="<?= base_url('logout') ?>" class="btn text-white text-b btn-ms custom-bg">Log out</a>

        </div>




        <div class="col-lg-2 bg-dark border-top border-3 border-secondary" id="dashboard-menu">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid flex-lg-column align-items-stretch ">
                    <h4 class="mt-2 text-light">ADMIN PANLE</h4>
                    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                        data-bs-target="#adminDropdown" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse flex-column mt-2 align-items-stretch" id="adminDropdown">
                        <ul class="nav nav-pills flex-column">

                            <li class="nav-item">
                                <a class="nav-link text-white <?= is_active('dashboard'); ?>" href="<?= base_url('dashboard') ?>">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>

                            <li class="nav-item">
                                <button class="btn text-white px-3 w-100 shadow-none text-start d-flex align-items-center justify-content-between"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#bookingLinks" aria-expanded="false" aria-controls="bookingLinks">
                                    <span><i class="bi bi-journal-bookmark-fill me-2"></i> Bookings</span>
                                    <i class="bi bi-caret-down-fill"></i>
                                </button>

                                <div class="collapse px-3 small mb-1" id="bookingLinks">
                                    <ul class="nav nav-pills flex-column rounded border border-secondary bg-dark">
                                        <li class="nav-item">
                                            <a class="nav-link text-white <?= is_active('bookings', 'index'); ?>" href="<?= base_url('admin/new-bookings') ?>">
                                                <i class="bi bi-plus-circle"></i> New Bookings
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-white <?= is_active('bookings', 'refund_booking'); ?>" href="<?= base_url('admin/refund-bookings') ?>">
                                                <i class="bi bi-arrow-counterclockwise"></i> Refund Bookings
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-white <?= is_active('bookings', 'all_bookings'); ?>" href="<?= base_url('admin/all-bookings') ?>">
                                                <i class="bi bi-journal-bookmark-fill"></i> Booking Records
                                            </a>
                                        </li>

                                    </ul>
                                </div>

                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white <?= is_active('users', 'index'); ?>" href="<?= base_url('users') ?>">
                                    <i class="bi bi-people"></i> Users
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link text-white <?= is_active('users_queries'); ?>" href="<?= base_url('users-queries') ?>">
                                    <i class="bi bi-chat-dots"></i> Users Queries
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link text-white <?= is_active('rooms'); ?>" href="<?= base_url('rooms') ?>">
                                    <i class="bi bi-door-closed me-1"></i> Rooms
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white <?= is_active('facilities'); ?>" href="<?= base_url('admin-facilities') ?>">
                                    <i class="bi bi-stars me-1"></i> Facilities
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white <?= is_active('Users', 'room_review'); ?>" href="<?= base_url('admin/room-rate-review') ?>">
                                    <i class="bi bi-star-half me-1"></i> Rate & Review
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link text-white <?= is_active('carousel'); ?>" href="<?= base_url('carousel') ?>">
                                    <i class="bi bi-images me-1"></i> Carousel
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white <?= is_active('settings'); ?>" href="<?= base_url('settings') ?>">
                                    <i class="bi bi-gear me-1"></i> Settings
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!-- main-content -->
        <div class="container-fluid" id="main-content">
            <div class="row">
                <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                    <?= bs_alert() ?>
                <?php } ?>