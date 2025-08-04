<div class="my-3 px-4">
    <h2 class="fw-bold h-font text-center">
        <i class="bi bi-door-open-fill text-primary"></i> OUR ROOMS
    </h2>
    <div class="mx-auto mt-2" style="width: 150px; height: 3px; background-color: #0d6efd; border-radius: 5px;"></div>
</div>

<?php
$checkin   = isset($_GET['checkin']) ? $_GET['checkin'] : '';
$checkout  = isset($_GET['checkout']) ? $_GET['checkout'] : '';
$adults    = isset($_GET['adults']) ? $_GET['adults'] : '';
$children  = isset($_GET['children']) ? $_GET['children'] : '';

// pp($_GET);
?>

<div class="container">
    <div class="row">
        <!-- Example sidebar only -->
        <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-lg-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                <div class="container-fluid flex-lg-column align-items-stretch">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mt-2"> <i class="bi bi-funnel-fill text-primary"></i> FILTERS</h4>
                        <button type="reset" id="allFilterReset" class="btn btn-outline-danger btn-sm shadow-none">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </button>
                    </div>

                    <div class="collapse navbar-collapse flex-column mt-2 align-items-stretch show" id="filtersDropdown">
                        <!-- Check Availability -->
                        <div class="border bg-light p-3 rounded mb-3">

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0"> CHECK AVAILABILITY</h6>
                                <button type="button" id="resetAvailabilityBtn" class="btn btn-outline-danger btn-sm shadow-none d-none">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                                </button>
                            </div>

                            <!-- <h5 class="mb-3">CHECK AVAILABILITY</h5> -->
                            <label class="form-label">Check-in</label>
                            <input id="checkin" name="checkin" type="text" value="<?= isset($_GET['checkin']) ? htmlspecialchars($_GET['checkin']) : '' ?>" class="form-control shadow-none mb-3 text-dark bg-white" placeholder="DD-MM-YYYY">

                            <label class="form-label">Check-out</label>
                            <input id="checkout" name="checkout" type="text" value="<?= isset($_GET['checkout']) ? htmlspecialchars($_GET['checkout']) : '' ?>" class="form-control shadow-none text-dark bg-white" placeholder="DD-MM-YYYY">
                        </div>

                        <!-- Facilities -->
                        <div class="border bg-light p-3 rounded mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0"> <i class="bi bi-tools text-primary"></i> Facilities</h5>
                                <button type="button" id="resetFacilitiesBtn" class="btn btn-outline-danger btn-sm shadow-none d-none">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                                </button>
                            </div>

                            <?php if (!empty($facilities)) : ?>
                                <div class="row">
                                    <?php foreach ($facilities as $facility) : ?>
                                        <div class="col-6 mb-2">
                                            <div class="form-check d-flex align-items-center">
                                                <input
                                                    type="checkbox" class="form-check-input me-2 shadow-none" name="facilities[]" value="<?= $facility['id'] ?>" id="f<?= $facility['id'] ?>">
                                                <label class="form-check-label d-flex align-items-center" for="f<?= $facility['id'] ?>">
                                                    <?= htmlspecialchars($facility['facility_name']) ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <p class="text-muted">No facilities available.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Guests -->
                        <div class="border bg-light p-3 rounded mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0"> <i class="bi bi-people-fill text-primary"></i> GUESTS</h5>
                                <button type="button" id="resetGuestsBtn" class="btn btn-outline-danger btn-sm shadow-none d-none">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                                </button>
                            </div>

                            <div class="d-flex">
                                <div class="me-3">
                                    <label class="form-label">Adults</label>
                                    <input type="number"
                                        class="form-control shadow-none"
                                        id="adults"
                                        name="adults"
                                        value="<?= isset($_GET['adults']) ? (int)$_GET['adults'] : '' ?>"
                                        min="0">
                                </div>

                                <div>
                                    <label class="form-label">Children</label>
                                    <input type="number"
                                        class="form-control shadow-none"
                                        id="children"
                                        name="children"
                                        value="<?= isset($_GET['children']) ? (int)$_GET['children'] : '' ?>"
                                        min="0">
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </nav>
        </div>

        <!-- ROOM RESULTS -->
        <div class="col-lg-9 col-md-12" id="room-listing">

        </div>
    </div>
</div>

<?php
$CI = &get_instance();
$data = $CI->session->userdata('data');
$userLogin = 0;
$shutdown = 0;
if (isset($data['shutdown']) && $data['shutdown'] != 1) {
    $loggedUser = $CI->session->userdata('loggedInuser');
    if ($loggedUser && isset($loggedUser['USER_LOGGEDIN']) && $loggedUser['USER_LOGGEDIN'] === true) {
        $userLogin = 1;
    }
} else {
    $shutdown = 1;
}
?>

<script>
    const userLogin = <?= $userLogin ?>;
    const shutdown = <?= $shutdown ?>;
    $(document).ready(function() {

        function fetchFilteredRooms() {
            const checkin = $('#checkin').val();
            const checkout = $('#checkout').val();
            const adults = $('#adults').val();
            const children = $('#children').val();

            let facilities = [];
            $("input[name='facilities[]']:checked").each(function() {
                facilities.push($(this).val());

            });

            $.ajax({
                url: "<?= base_url('rooms/get_filtered_rooms') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    checkin: checkin,
                    checkout: checkout,
                    adults: adults,
                    children: children,
                    facilities: facilities
                },
                beforeSend: function() {
                    $('#room-listing').html(`
                        <div class="d-flex justify-content-center align-items-center w-100" style="height: 300px;">
                            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    `);

                },
                success: function(resp) {
                    // console.log(resp.data);
                    if (resp.status && resp.data.length > 0) {
                        let html = '';
                        $.each(resp.data, function(i, room) {
                            let features = room.features.length > 0 ?
                                room.features.map(f => `<span class="badge bg-light text-dark text-wrap">${f.feature_name}</span>`).join(' ') :
                                '<span class="badge bg-light text-dark text-wrap">N/A</span>';

                            let facilityBadges = room.facilities.length > 0 ?
                                room.facilities.map(f => `<span class="badge bg-light text-dark text-wrap">${f.facility_name}</span>`).join(' ') :
                                '<span class="badge bg-light text-dark text-wrap">N/A</span>';
                            let book_btn = "";
                            if (shutdown == 1) {
                                book_btn = `<button class="btn btn-sm btn-secondary shadow-none mb-2" disabled> <i class="bi bi-lock-fill me-1"></i> Booking Closed</button>`
                            } else {
                                book_btn = `<button onclick="checkLoginToBook(<?= $userLogin ?? 0 ?>,${room.id})" class="btn btn-sm w-100 text-white shadow-none custom-bg mb-2">
                                     <i class="bi bi-calendar-check-fill me-1"></i> Book Now
                                      </button>`;
                            }

                            html += `
                        <div class="card mb-4 border-0 shadow">
                            <div class="row g-0 p-3 align-items-center">
                                <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                <a class="text-decoration-none" href="<?= base_url('room-details/') ?>${room.id}">
                                            <img src="<?= base_url('assets/images/rooms/') ?>${room.image}" class="img-fluid rounded" alt="">
                                        </a>
                                   
                                </div>
                                <div class="col-md-5 px-lg-3 px-md-3 px-0">
                                    <h5 class="mb-3">
                                        <a class="text-dark text-decoration-none" href="<?= base_url('room-details/') ?>${room.id}">
                                            ${room.room_name}
                                        </a>
                                    </h5>

                                    <div class="features mb-3">
                                        <h6 class="mb-1">
                                            <i class="bi bi-tools me-1 text-warning"></i> Features
                                        </h6>
                                        ${features}
                                    </div>

                                    <div class="facilities mb-3">
                                        <h6 class="mb-1">
                                            <i class="bi bi-wrench-adjustable-circle me-1 text-success"></i> Facilities
                                        </h6>
                                        ${facilityBadges}
                                    </div>

                                    <div class="gueste">
                                        <h6 class="mb-1">
                                            <i class="bi bi-people-fill me-1 text-primary"></i> Guests
                                        </h6>
                                        <span class="badge bg-light text-dark text-wrap">${room.adult} Adults</span>
                                        <span class="badge bg-light text-dark text-wrap">${room.children} Children</span>
                                    </div>
                                </div>

                                <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                                    <h6 class="mb-4">₹${room.price} Per Night</h6>
                                        ${book_btn}
                                    <a href="<?= base_url('room-details/') ?>${room.id}" class="btn btn-sm w-100 btn-outline-dark shadow-none">
                                        <i class="bi bi-info-circle-fill me-1"></i> More Details
                                    </a>
                                </div>

                            </div>
                        </div>
                    `;
                        });

                        $('#room-listing').html(html);
                    } else {
                        $('#room-listing').html(`
                            <div class="d-flex justify-content-center align-items-center flex-column text-center" style="min-height: 400px;">
                                <div class="text-danger mb-2" style="font-size: 2rem;">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                </div>
                                <div class="text-danger fw-bold px-3" role="alert" style="max-width: 600px;">
                                    Sorry, no rooms match your selected filters. Please adjust your search criteria and try again.
                                </div>
                            </div>
                        `);


                    }
                },
                error: function() {
                    $('#room-listing').html('<div class="text-danger text-center">Error loading rooms.</div>');
                }
            });
        }
        // Initial load
        fetchFilteredRooms();

        $('#checkout, #children').on('change', function() {
            const checkin = $('#checkin').val();
            const checkout = $('#checkout').val();
            if (checkin && checkout) {
                $('#resetAvailabilityBtn').removeClass('d-none');
                fetchFilteredRooms();
            }
        });

        $('#resetAvailabilityBtn').on('click', function() {
            // $('#checkin').val('');
            const checkinCalendar = flatpickr("#checkin", {
                dateFormat: "d-m-Y",
                minDate: "today",
                defaultDate: "today",
                clickOpens: true,
                onChange: function(selectedDates, dateStr) {
                    const nextDay = new Date(selectedDates[0]);
                    nextDay.setDate(nextDay.getDate() + 1);
                    checkoutCalendar.set("minDate", nextDay);
                }
            });
            $('#checkin').val('');
            $('#checkout').val('');
            $('#resetAvailabilityBtn').addClass('d-none');
            fetchFilteredRooms();
        });

        $('#adults, #children').on('input', function() {
            const adults = parseInt($('#adults').val()) || 0;
            const children = parseInt($('#children').val()) || 0;
            if (adults > 0 || children > 0) {
                $('#resetGuestsBtn').removeClass('d-none');
                fetchFilteredRooms();
            }

        });

        $('#resetGuestsBtn').on('click', function() {
            $('#adults').val('');
            $('#children').val('');
            $('#resetGuestsBtn').addClass('d-none');
            fetchFilteredRooms();
        });

        $("input[name='facilities[]']").on('change', function() {
            let facilities = [];
            $("input[name='facilities[]']:checked").each(function() {
                facilities.push($(this).val());
            });
            // console.log(facilities);
            if (facilities) {
                $('#resetFacilitiesBtn').removeClass('d-none');
                fetchFilteredRooms();
            }
        });

        $('#resetFacilitiesBtn').on('click', function() {
            $("input[name='facilities[]']").prop('checked', false);
            $(this).addClass('d-none');
            fetchFilteredRooms();
        });


        // All Reset Filter Filters Data
        $("#allFilterReset").on('click', function() {
            const checkinCalendar = flatpickr("#checkin", {
                dateFormat: "d-m-Y",
                minDate: "today",
                defaultDate: "today",
                clickOpens: true,
                onChange: function(selectedDates, dateStr) {
                    const nextDay = new Date(selectedDates[0]);
                    nextDay.setDate(nextDay.getDate() + 1);
                    checkoutCalendar.set("minDate", nextDay);
                }
            });

            $('#checkin').val('');
            $('#checkout').val('');
            $('#resetAvailabilityBtn').addClass('d-none');

            $('#adults').val('');
            $('#children').val('');
            $('#resetGuestsBtn').addClass('d-none');

            $("input[name='facilities[]']").prop('checked', false);
            $("#resetFacilitiesBtn").addClass('d-none');

            fetchFilteredRooms();

        })
    });
</script>


<script>
    // Check-in calendar
    const checkinCalendar = flatpickr("#checkin", {
        dateFormat: "d-m-Y",
        minDate: "today",
        // defaultDate: "today",
        clickOpens: true,
        onChange: function(selectedDates, dateStr) {
            // Set minDate for checkout to +1 day after check-in
            const nextDay = new Date(selectedDates[0]);
            nextDay.setDate(nextDay.getDate() + 1);
            checkoutCalendar.set("minDate", nextDay);
        }
    });

    // Checkout calendar
    const checkoutCalendar = flatpickr("#checkout", {
        dateFormat: "d-m-Y",
        minDate: new Date().fp_incr(1), // today + 1
        clickOpens: true
    });
</script>