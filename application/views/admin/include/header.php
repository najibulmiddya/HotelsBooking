<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>
    </title>
    <?php require(APPPATH . 'views/admin/include/link.php') ?>

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
                                <a class="nav-link text-white <?= is_active('dashboard'); ?>" href="<?= base_url('dashboard') ?>">Dashboard</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white <?= is_active('Rooms'); ?>" href="<?= base_url('rooms') ?>">Rooms</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link text-white  <?= is_active('facilities',); ?>" href="admin-facilities">Feature & Facilities</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link text-white <?= is_active('users_queries'); ?>" href="<?= base_url('users-queries') ?>">Users Queries</a>
                            </li>
                           
                            <li class="nav-item">
                                <a class="nav-link text-white  <?= is_active('carousel'); ?>" href="<?= base_url('carousel') ?>">Carousel</a>
                            </li>
                            <!-- new add -->
                            <li class="nav-item">
                                <a class="nav-link text-white <?= is_active('students'); ?>" href="<?= base_url('students') ?>">Students</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white <?= is_active('settings'); ?>" href="<?= base_url('settings') ?>">Settings</a>
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