<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
    <div class="h-line bg-dark"></div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-12  mb-lg-0 mb-4 px-lg-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                <div class="container-fluid flex-lg-column align-items-stretch ">
                    <h4 class="mt-2">FILTERS</h4>
                    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                        data-bs-target="#filtersDropdown" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse flex-column mt-2 align-items-stretch" id="filtersDropdown">
                        <!-- CHECK ABAILABILITY -->
                        <div class="border bg-ligth p-3 rounded mb-3">
                            <h5 class="mb-3" style="font-size: 18px;">CHECK ABAILABILITY</h5>
                            <label class="form-label">Chack-in</label>
                            <input id="checkin" type="date" class="form-control shadow-none mb-3">
                            <label class="form-label">Chack-out</label>
                            <input id="checkout" type="date" class="form-control shadow-none" placeholder="Select">
                        </div>
                        <!-- FACILITIES -->
                        <div class="border bg-ligth p-3 rounded mb-3">
                            <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
                            <div class="mb-2">
                                <input type="checkbox" id="f1" class="form-chack-input shadow-none me-1">
                                <label class="form-chack-label" for="f1">Facility one</label>
                            </div>

                            <div class="mb-2">
                                <input type="checkbox" id="f2" class="form-chack-input shadow-none me-1">
                                <label class="form-chack-label" for="f2">Facility tow</label>
                            </div>

                            <div class="mb-2">
                                <input type="checkbox" id="f3" class="form-chack-input shadow-none me-1">
                                <label class="form-chack-label" for="f3">Facility three</label>
                            </div>
                        </div>

                        <!-- GUESTS -->
                        <div class="border bg-ligth p-3 rounded mb-3">
                            <h5 class="mb-3" style="font-size: 18px;">GUESTS</h5>
                            <div class="d-flex">
                                <div class="me-3">
                                    <label class="form-label">Adults</label>
                                    <input type="number" class="form-control shadow-none">
                                </div>
                                <div>
                                    <label class="form-label">Children</label>
                                    <input type="number" class="form-control shadow-none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- OUR ROOMS -->
        <div class="col-lg-9 col-md-12 px-4">
            <?php
            // $roomsData = $this->session->userdata('roomsData');
            foreach ($allRoomsData as $key => $room) { ?>
                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <!-- Rooms Image -->
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="<?= base_url('assets/images/rooms/' . $room['image']) ?>" class="img-fluid rounded" alt="">
                        </div>

                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                            <h5 class="mb-3"><?= $room['room_name']; ?></h5>
                            <!-- Rooms Features -->
                            <div class="features mb-3">
                                <h6 class="mb-1">Features</h6>
                                <?php if (!empty($room['features'])):
                                    foreach ($room['features'] as $feature): ?>
                                        <span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($feature['feature_name']) ?></span>
                                    <?php endforeach;
                                else: ?>
                                    <span class="badge bg-light text-dark text-wrap">N/A</span>
                                <?php endif; ?>
                            </div>

                            <!-- Rooms Facilities -->
                            <div class="facilities mb-3">
                                <h6 class="mb-1">Facilities</h6>
                                <?php if (!empty($room['facilities'])):
                                    foreach ($room['facilities'] as $facility): ?>
                                        <span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($facility['facility_name']) ?></span>
                                    <?php endforeach;
                                else: ?>
                                    <span class="badge bg-light text-dark text-wrap">N/A</span>
                                <?php endif; ?>
                            </div>

                            <!-- Rooms Gueste -->
                            <div class="gueste">
                                <h6 class="mb-1">Gueste</h6>
                                <span class="badge bg-light text-dark text-wrap">
                                    <?= htmlspecialchars($room['adult']) ?> Adults
                                </span>
                                <span class="badge bg-light text-dark text-wrap">
                                    <?= htmlspecialchars($room['children']) ?> Children
                                </span>
                            </div>

                        </div>
                        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                            <h6 class="mb-4">₹<?= htmlspecialchars($room['price']) ?> Per Night</h6>
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
                                <button onclick="checkLoginToBook(<?= $userLogin ?>,<?= $room['id'] ?>)" class="btn btn-sm w-100 text-white shadow-none custom-bg mb-2 ">Book Now</button>
                            <?php else: ?>
                                <button class="btn btn-sm btn-secondary shadow-none mb-2" disabled>Booking Closed</button>
                            <?php endif; ?>

                            <a href="<?= base_url('room-details/' . $room['id']); ?>" class="btn btn-sm w-100 btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
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