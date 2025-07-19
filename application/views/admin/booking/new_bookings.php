<h3 class="mb-4">NEW BOOKINGS</h3>
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <!-- Loader for Bookings -->
        <div id="bookingLoader" class="text-center my-3 d-none">
            <div class="spinner-border text-primary" role="status" aria-label="Loading">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 fw-bold mb-0">Loading bookings...</p>
        </div>
        <table class="table table-bordered" id="newBookingsTable">
            <thead>
                <tr>
                    <th>User Details</th>
                    <th>Room Details</th>
                    <th>Booking Info</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="newBookingsData">

            </tbody>
        </table>
    </div>
</div>

<!-- Assign Room Modal -->
<div class="modal fade" id="assignRoomModal" tabindex="-1" aria-labelledby="assignRoomLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header custom-bg text-white">
                <h5 class="modal-title" id="assignRoomLabel"><i class="bi bi-check2-square"></i> Assign Room</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="assignRoomForm">
                    <span class="badge bg-light text-dark me-3 text-wrap lh-base">
                        Note: Assing Room Number olny when user been Arrived!
                    </span>
                    <div class="col-md-12">
                        <label class="form-label ">Room Number</label>
                        <input type="text" name="room_number" id="room_number" class="form-control shadow-none">
                        <span class="error" id="room_number_error"></span>
                    </div>
                    <input type="hidden" id="assignBookingId" name="booking_id">
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="assignRoomForm" class="btn custom-bg text-white shadow-none">Assign</button>
            </div>

        </div>
    </div>
</div>

<!-- Cancerl Bookings -->
<div class="modal fade" id="cancelBooking" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"> <i class="bi bi-question-circle-fill"></i> Cancel Booking</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to <span class="fw-bold" id="statusAction"></span> user: <span class="fw-bold" id="statusUserName"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Back</button>
                <button type="button" class="btn custom-bg text-white shadow-none" id="confirmCancel">Yes, Cancel</button>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function() {
        fetchNewBookings();

        function fetchNewBookings() {
            $('#bookingLoader').removeClass('d-none');
            $('#newBookingsData').html('');
            $.ajax({
                url: '<?= base_url("admin/fetch-new-booking") ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#bookingLoader').addClass('d-none');
                    if (response.status === true) {
                        let rows = '';

                        $.each(response.data, function(index, val) {
                            // Date diff (for total days)
                            function parseDate(str) {
                                const parts = str.split('-'); // ["DD", "MM", "YYYY"]
                                return new Date(`${parts[2]}-${parts[1]}-${parts[0]}`);
                            }

                            let inDate = parseDate(val.check_in);
                            let outDate = parseDate(val.check_out);
                            let diffDays = Math.ceil((outDate - inDate) / (1000 * 60 * 60 * 24));

                            // Format booking datetime
                            let [datePart, timePart] = val.datetime.split(' ');
                            let [year, month, day] = datePart.split('-');
                            let formattedDate = `${day}-${month}-${year}`;
                            let [hours, minutes] = timePart.split(':');
                            let period = hours >= 12 ? 'PM' : 'AM';
                            hours = hours % 12 || 12;
                            hours = hours.toString().padStart(2, '0');
                            minutes = minutes.toString().padStart(2, '0');
                            let formattedTime = `${hours}:${minutes} ${period}`;

                            let btn = "";
                            let cancel_reason = '';
                            if (val.cancel_status == "requested") {

                                if (val.cancel_reason && val.cancel_reason.trim() !== '') {
                                    cancel_reason += `
                                        <div class="alert alert-warning p-2 mb-2 d-inline-block" style="font-size: 14px;">
                                            <i class="bi bi-exclamation-circle-fill me-1"></i>
                                            <strong>Cancellation Reason:</strong>
                                            <br> <span style="word-wrap: break-word; width: 70px;"> ${val.cancel_reason} </span>
                                        </div>

                                    `;
                                }

                                btn = `
                                    <div class="btn-group" role="group" aria-label="Cancel Actions">
                                        <button type="button"
                                            class="btn btn-success  shadow-none approve-btn"
                                            data-booking-id="${val.booking_id}"
                                            title="User cancel request Approve"
                                            data-bs-toggle="tooltip">
                                            <i class="bi bi-check-circle-fill"></i> Approve
                                        </button>

                                        <button type="button"
                                            class="btn btn-danger shadow-none reject-btn"
                                            data-booking-id="${val.booking_id}"
                                            title="User cancel request Reject"
                                            data-bs-toggle="tooltip">
                                            <i class="bi bi-x-circle-fill"></i> Reject
                                        </button>
                                    </div>
                                `;

                            } else {
                                btn = `
                                        <div class="btn-group d-flex justify-content-center" role="group" aria-label="Cancel Actions">
                                            <button
                                                class="btn btn-sm btn-success text-white shadow-none open-assign-room"
                                                data-bs-toggle="modal"
                                                data-bs-target="#assignRoomModal"
                                                onclick="assing_room(${val.booking_id})"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Assign room to this booking">
                                                <i class="bi bi-check2-square"></i> Assign
                                            </button>

                                            <button
                                                class="btn btn-sm btn-danger text-white shadow-none cancelBooking"
                                                data-booking-id="${val.booking_id}"
                                                data-user-name="${val.user_name}"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Cancel this booking by Admin">
                                                <i class="bi bi-archive-fill"></i> Cancel
                                            </button>
                                        </div>
                                    `;
                            }

                            // Render row
                            rows += `
                                    <tr>
                                        <td>
                                            <b>Name:</b> ${val.user_name}<br>
                                            <b>Mobile:</b> ${val.phonenum}
                                        </td>
                                        <td>
                                            <b>Room Name:</b> ${val.room_name || 'N/A'}<br>
                                            <b>Price:</b> ₹${val.price || '0'}
                                        </td>
                                        <td>
                                            <b>Order ID:</b> <span class="bg-primary text-white px-1 rounded">${val.order_id}</span><br>
                                            <b>Check-in:</b> ${val.check_in}<br>
                                            <b>Check-out:</b> ${val.check_out}<br>
                                            <b>Total Days:</b> ${diffDays}<br>
                                            <b>Total Pay:</b> ₹${val.total_pay}<br>
                                            <b>Booking Date & Time:</b> ${formattedDate} ${formattedTime}
                                        </td>

                                    <td class="text-center">
                                            ${cancel_reason ? cancel_reason : ''}
                                            <br>
                                            ${btn}
                                        </td>
                                    </tr>`;
                        });

                        // Inject new rows
                        if ($.fn.DataTable.isDataTable('#newBookingsTable')) {
                            $('#newBookingsTable').DataTable().clear().destroy();
                        }

                        $('#newBookingsData').html(rows);
                        $('#newBookingsTable').DataTable({
                            responsive: true,
                            destroy: true,
                            pageLength: 10,
                        });

                    } else {
                        $('#newBookingsData').html(`
                        <tr>
                            <td colspan="3" class="text-center text-danger">${response.message}</td>
                        </tr>`);
                    }
                },
                error: function() {
                    $('#bookingLoader').addClass('d-none');
                    $('#newBookingsData').html(`
                    <tr>
                        <td colspan="3" class="text-center text-danger">Failed to fetch data from server.</td>
                    </tr>`);
                }
            });
        }

        // <<---------- Assing Rooms Function ----------------->>
        $('#assignRoomForm').on('submit', function(e) {
            e.preventDefault();

            let roomNumber = $('#room_number').val().trim();
            let bookingId = $('#assignBookingId').val();
            $('#room_number').removeClass('is-invalid');
            $('#room_number_error').text('');

            // Basic validation
            if (roomNumber === '') {
                $('#room_number').addClass('is-invalid');
                $('#room_number_error').text('Room number is required.');
                return;
            }

            $.ajax({
                url: '<?= base_url("admin/assign-room") ?>',
                method: 'POST',
                data: {
                    room_number: roomNumber,
                    booking_id: bookingId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        $('#assignRoomModal').modal('hide');
                        $('#assignRoomForm')[0].reset();
                        $('#success_modal_text').text(response.message);
                        $('#successModal').modal('show');
                        setTimeout(function() {
                            $('#successModal').modal('hide');
                        }, 3000); // 3000ms = 3 seconds
                        fetchNewBookings();
                    } else {
                        alert(response.message || 'Something went wrong.');
                    }
                },
                error: function() {
                    alert('Server error. Please try again.');
                }
            });
        });

        // <<---------------- Cancel Booking Handle ------------->>
        let cancelBookingId = null;
        $(document).on('click', '.cancelBooking', function() {
            const bookingId = $(this).data('booking-id');
            const userName = $(this).data('user-name');

            cancelBookingId = bookingId;

            $('#statusAction').text('cancel booking for');
            $('#statusUserName').text(userName);
            $('#cancelBooking').modal('show');
        });

        // Handle confirm button click
        $('#confirmCancel').on('click', function() {
            if (!cancelBookingId) return;

            $.ajax({
                url: '<?= base_url("admin/cancel-booking") ?>',
                method: 'POST',
                data: {
                    booking_id: cancelBookingId
                },
                dataType: 'json',
                success: function(response) {
                    $('#cancelBooking').modal('hide');
                    if (response.status === true) {
                        $('#success_modal_text').text(response.message);
                        $('#successModal').modal('show');

                        setTimeout(function() {
                            $('#successModal').modal('hide');
                        }, 3000); // 3000ms = 3 seconds

                        fetchNewBookings();
                    } else {
                        alert(response.message || 'Something went wrong.');
                    }
                },
                error: function() {
                    $('#cancelBooking').modal('hide');
                    alert('Server error. Please try again.');
                }
            });
        });


        // Handle approve/reject cancellation requests
        let selectedBookingId = null;
        let selectedAction = null;

        $(document).on('click', '.approve-btn, .reject-btn', function() {
            selectedBookingId = $(this).data('booking-id');
            selectedAction = $(this).hasClass('approve-btn') ? 'approved' : 'rejected';

            // Set modal text
            $('#confirmActionText').html(`Are you sure you want to <strong>${selectedAction}</strong> this cancellation request?`);

            // Show modal
            $('#confirmActionModal').modal('show');
        });

        // Handle confirm button click inside modal
        $('#confirmActionBtn').on('click', function() {
            if (!selectedBookingId || !selectedAction) return;

            $.post('<?= base_url("admin/cancel-booking") ?>', {
                booking_id: selectedBookingId,
                action: selectedAction
            }, function(response) {
                $('#confirmActionModal').modal('hide'); // Hide modal

                if (response.status === true) {
                    $('#success_modal_text').text(response.message);
                    $('#successModal').modal('show');

                    setTimeout(function() {
                        $('#successModal').modal('hide');
                    }, 3000);

                    fetchNewBookings();
                } else {
                    alert(response.message || 'Something went wrong.');
                }
            }, 'json');
        });

    });

    function assing_room(booking_id) {
        $("#assignBookingId").val(booking_id);
    }
</script>