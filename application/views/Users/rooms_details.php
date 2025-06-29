<div class="container">
    <div class="row">
        <!-- Room Details  -->
        <div class="col-12 my-5 mb-4 px-4">
            <h2 class="fw-bold"><?= $roomsData['room']->room_name; ?></h2>
            <div style="font-size: 14px;">
                <a href="<?= base_url("home") ?>" class="text-secondary text-decoration-none">Home</a>
                <span class="text-secondary"> > </span>
                <a href="<?= base_url("hotels-rooms"); ?>" class="text-secondary text-decoration-none">Rooms</a>
            </div>
        </div>
        <div class="col-lg-7 col-md-12 px-4">
            <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    if ($roomsData['images']) {
                        $thumb_img = "";
                        $active_class = "active";
                        foreach ($roomsData['images'] as $images) {
                            if ($images['thumb'] == 1) {
                                $thumb_img = $images['thumb'];
                            }
                            echo '<div class="carousel-item ' . $active_class . '">
                            <img src="' . base_url('assets/images/rooms/' . $images['image']) . '" class="d-block w-100 rounded">
                            </div>';

                            $active_class = "";
                        }
                    } else {
                        echo '<div class="carousel-item active">
                        <img src="' . base_url('assets/images/rooms/7686_thumbnail.jpg') . '" class="d-block w-100 rounded">
                        </div>';
                    }




                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="col-lg-5 col-md-12 px-4">
            <div class="card mb-4 border-0 shadow-ms rounded-3">
                <div class="card-body">
                    <h4>Price ₹<?= $roomsData['room']->price ?> Per Night</h4>
                    <!-- Static Rating -->
                    <div class="rating mb-3">
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>

                    <!-- Features -->
                    <div class="features mb-3">
                        <h6 class="mb-1">Features</h6>
                        <?php if (!empty($roomsData['features'])):
                            foreach ($roomsData['features'] as $feature): ?>
                                <span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($feature['feature_name']) ?></span>
                            <?php endforeach;
                        else: ?>
                            <span class="badge bg-light text-dark text-wrap">N/A</span>
                        <?php endif; ?>
                    </div>

                    <!-- Facilities -->
                    <div class="facilities mb-3">
                        <h6 class="mb-1">Facilities</h6>
                        <?php if (!empty($roomsData['facilities'])):
                            foreach ($roomsData['facilities'] as $facility): ?>
                                <span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($facility['facility_name']) ?></span>
                            <?php endforeach;
                        else: ?>
                            <span class="badge bg-light text-dark text-wrap">N/A</span>
                        <?php endif; ?>
                    </div>

                    <!-- Guests -->
                    <div class="mb-3">
                        <h6 class="mb-1">Guests</h6>
                        <span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($roomsData['room']->adult) ?> Adults</span>
                        <span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($roomsData['room']->children) ?> Children</span>
                    </div>

                    <!-- area -->
                    <div class="mb-3">
                        <h6 class="mb-1">Area</h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap me-1">
                            <?= $roomsData['room']->area ?> sq. ft .
                        </span>
                    </div>

                    <?php
                    $data = $this->session->userdata('data');
                    if (isset($data['shutdown']) && $data['shutdown'] != 1):
                        $CI = &get_instance();
                        $loggedUser = $CI->session->userdata('loggedInuser');
                        $userLogin = 0;
                        if ($loggedUser && $loggedUser['USER_LOGGEDIN'] == true) {
                            $userLogin = 1;
                        }
                    ?>

                        <button onclick="checkLoginToBook(<?= $userLogin ?>,<?= $roomsData['room']->id ?>)" class="btn w-100 text-white shadow-none custom-bg">Book Now</button>
                    <?php else: ?>
                        <button class="btn w-100 btn-secondary shadow-none" disabled>Booking Closed</button>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <div class="col-12 px-4">
            <div class="">
                <h5>Description</h5>
                <p><?= $roomsData['room']->description; ?></p>
            </div>

            <div class="mb-3">
                <h5>Reviews & Rating</h5>
                <div>
                    <div class="d-flex align-items-center mb-2">
                        <img src="<?= base_url('assets/images/facilities/wifi.svg') ?>" width="30px" alt="...">
                        <h6 class="m-0 ms-2">Rendon user</h6>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Excepturi amet officiis laborum
                        veritatis similique, sequi accusantium asperiores odio aliquid aut?
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>

<script>
    // Check-in calendar
    const checkinCalendar = flatpickr("#checkin", {
        dateFormat: "Y-m-d",
        minDate: "today",
        defaultDate: "today",
        clickOpens: true,
        onChange: function(selectedDates, dateStr) {
            checkoutCalendar.set("minDate", dateStr);
        }
    });

    // Check-out calendar
    const checkoutCalendar = flatpickr("#checkout", {
        dateFormat: "Y-m-d",
        minDate: "today",
        clickOpens: true
    });
</script>