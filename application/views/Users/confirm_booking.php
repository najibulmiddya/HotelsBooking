<div class="container">
    <div class="row">
        <!-- Room Details  -->
        <div class="col-12 my-5 mb-4 px-4">
            <h2 class="fw-bold">CONFIRM BOOKING</h2>
            <div style="font-size: 14px;">
                <a href="<?= base_url("home") ?>" class="text-secondary text-decoration-none">Home</a>
                <span class="text-secondary"> > </span>
                <a href="<?= base_url("hotels-rooms"); ?>" class="text-secondary text-decoration-none">Rooms</a>
                <span class="text-secondary"> > </span>
                <a href="<?= base_url("hotels-rooms"); ?>" class="text-secondary text-decoration-none">Confirm</a>
            </div>
        </div>
        <div class="col-lg-7 col-md-12 px-4">
            <div class="card p-3 shadow-sm rounded">
                <img src="<?= base_url('assets/images/rooms/' . $_SESSION['room']['room_thumbnail']) ?>" class="img-fluid rounded mb-3" alt="">
                <h5><?= $_SESSION['room']['name'] ?></h5>
                <h6>₹<?= $_SESSION['room']['price'] ?></h6>
            </div>
        </div>

        <div class="col-lg-5 col-md-12 px-4">
            <div class="card mb-4 border-0 shadow-ms rounded-3">
                <div class="card-body">
                    <form id="bookingDetailsForm" action="#">
                        <h6 class="mb-3">BOOKING DETAILS</h6>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" id="name" value="<?= $_SESSION['loggedInuser']['NAME'] ?>" class="form-control shadow-none">
                                <span class="error" id="name_error"></span>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="number" id="number" value="<?= $_SESSION['loggedInuser']['NUMBER'] ?>" class="form-control shadow-none">
                                <span class="error" id="number_error"></span>
                            </div>

                            <div class="col-md-12 mb-2">
                                <label class="form-label">Address</label>
                                <textarea class="form-control shadow-none" id="address"><?= $_SESSION['room']['user_address'] ?></textarea>
                                <span id="address_error" class="error"></span>
                            </div>


                            <div class="col-md-6 mb-2">
                                <label class="form-label">Chack-in</label>
                                <input id="checkin" onchange="check_availability()" type="date" class="form-control shadow-none">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label">Chack-out</label>
                                <input id="checkout" onchange="check_availability()" type="date" class="form-control shadow-none">
                            </div>

                            <span id="checkout_and_checkout_error" class="error col-md-12"></span>

                            <div class="col-md-12 my-3">
                                <div class="spinner-border text-info mb-1 d-none" id="info_loader" role="status">
                                    <span class="sr-only"></span>
                                </div>
                                <h6 class="mb-3 text-danger" id="pay_info">Provide Chack-in & chack-out date !</h6>
                                <button id="pay_new" class="btn w-100 text-white shadow-none custom-bg" disabled>Pay Now</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>




    </div>
</div>

<script>
  function check_availability() {
    let checkin = $('#checkin').val();
    let checkout = $('#checkout').val();


    let loader = $('#info_loader');
    let payInfo = $('#pay_info');
    let payBtn = $('#pay_new');
    let checkoutErr = $('#checkout_and_checkout_error');

    // Reset UI
    loader.addClass('d-none');
    payBtn.prop('disabled', true);
    payInfo.removeClass('text-success text-danger').addClass('text-danger').text("Provide check-in & check-out date!");
    checkoutErr.text('');

    if (!checkin || !checkout) return;

    // Convert d-m-Y to JS Date
    function parseDMY(dmy) {
        const [day, month, year] = dmy.split('-');
        return new Date(`${year}-${month}-${day}`); 
    }

    const checkinDate = parseDMY(checkin);
    const checkoutDate = parseDMY(checkout);



    if (checkoutDate <= checkinDate) {
        checkoutErr.text('Check-out must be after check-in date.');
        return;
    }

    let nights = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
    let pricePerNight = <?= $_SESSION['room']['price'] ?>;
    let total = nights * pricePerNight;

    loader.removeClass('d-none');

    $.ajax({
        type: "POST",
        url: "<?= base_url("check-room-availability") ?>",
        data: {
            checkin: checkin,
            checkout: checkout
        },
        dataType: "json",
        success: function(response) {
            loader.addClass('d-none');

            if (response.status === true) {
                payInfo
                    .removeClass('text-danger')
                    .addClass('text-success')
                    .text(`Available! Total nights: ${nights} | Total: ₹${total}`);
                payBtn.prop('disabled', false);
            } else {
                payInfo
                    .removeClass('text-success')
                    .addClass('text-danger')
                    .text(response.message || "Room not available on selected dates.");
            }
        },
        error: function() {
            loader.addClass('d-none');
            payInfo.text("Server error. Please try again later.");
        }
    });
}

    $(document).ready(function() {
        let checkoutCalendar;

        // Initialize Flatpickr for check-in
        const checkinCalendar = flatpickr("#checkin", {
            dateFormat: "d-m-Y", // <-- changed from Y-m-d
            minDate: "today",
            defaultDate: "today",
            clickOpens: true,
            onChange: function(selectedDates, dateStr) {
                if (checkoutCalendar) {
                    checkoutCalendar.set("minDate", selectedDates[0]);
                }
                check_availability();
            }
        });

        // Initialize Flatpickr for check-out
        checkoutCalendar = flatpickr("#checkout", {
            dateFormat: "d-m-Y", // <-- changed from Y-m-d
            minDate: "today",
            clickOpens: true,
            onChange: function() {
                check_availability();
            }
        });

    });
</script>