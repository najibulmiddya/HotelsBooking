<h3 class="mb-2"><i class="bi bi-journal-bookmark-fill me-2"></i>BOOKING RECORDS</h3>

<!-- Filter Section -->
<div class="row mb-3">
    <div class="col-md-2">
        <label for="filterStatus" class="form-label fw-bold">Status</label>
        <select id="filterStatus" class="form-select shadow-none">
            <option value="">All</option>
            <option value="confirmed">Confirmed</option>
            <option value="cancelled">Cancelled</option>
            <option value="pending">Pending</option>
            <option value="failed">Failed</option>
        </select>
    </div>

    <div class="col-md-2">
        <label for="filterStartDate" class="form-label fw-bold">Start Date</label>
        <input type="date" id="filterStartDate" placeholder="Select Start Date" class="form-control shadow-none">
    </div>

    <div class="col-md-2">
        <label for="filterEndDate" class="form-label fw-bold">End Date</label>
        <input type="date" id="filterEndDate" placeholder="Select End Date" class="form-control shadow-none">
    </div>

    <div class="col-md-3 d-flex align-items-end">
        <button class="btn btn-primary me-2 shadow-none" id="applyFilter">
            <i class="bi bi-funnel-fill"></i> Filter
        </button>
        <button class="btn btn-secondary shadow-none" id="resetFilter">
            <i class="bi bi-arrow-clockwise"></i> Reset
        </button>
    </div>

</div>

<div id="bookingLoader" class="text-center my-3 d-none">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <p class="mt-2 fw-bold">Loading bookings...</p>
</div>



<!-- Table -->
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <table class="table table-bordered" id="allBookingTable">
            <thead>
                <tr>
                    <th>User Details</th>
                    <th>Room Details</th>
                    <th>Booking Info</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="allBookings"></tbody>
        </table>
    </div>
</div>


<script>
    $(document).ready(function() {
        fetchAllBookings();

        function fetchAllBookings() {
            const status = $('#filterStatus').val();
            const startDate = $('#filterStartDate').val();
            const endDate = $('#filterEndDate').val();

            $('#bookingLoader').removeClass('d-none');
            $('#allBookings').html('');

            $.ajax({
                url: '<?= base_url("admin/fetch-all-booking") ?>',
                type: 'GET',
                data: {
                    status: status,
                    start_date: startDate,
                    end_date: endDate
                },
                dataType: 'json',
                success: function(response) {
                    $('#bookingLoader').addClass('d-none');
                    let rows = '';
                    if (response.status === true) {
                        $.each(response.data, function(index, val) {
                            function parseDate(str) {
                                const parts = str.split('-');
                                return new Date(`${parts[2]}-${parts[1]}-${parts[0]}`);
                            }

                            let inDate = parseDate(val.check_in);
                            let outDate = parseDate(val.check_out);
                            let diffDays = Math.ceil((outDate - inDate) / (1000 * 60 * 60 * 24));

                            let [datePart, timePart] = val.datetime.split(' ');
                            let [year, month, day] = datePart.split('-');
                            let formattedDate = `${day}-${month}-${year}`;
                            let [hours, minutes] = timePart.split(':');
                            let period = hours >= 12 ? 'PM' : 'AM';
                            hours = hours % 12 || 12;
                            hours = hours.toString().padStart(2, '0');
                            minutes = minutes.toString().padStart(2, '0');
                            let formattedTime = `${hours}:${minutes} ${period}`;

                            let status = (val.booking_status || 'unknown').toLowerCase();
                            let statusClass = 'secondary';
                            if (status === 'confirmed') statusClass = 'success';
                            else if (status === 'cancelled') statusClass = 'danger';
                            else if (status === 'pending') statusClass = 'warning';
                            else if (status === 'failed') statusClass = 'dark';

                            rows += `
                                <tr>
                                    <td>
                                        <b>Name:</b> ${val.user_name}<br>
                                        <b>Mobile:</b> ${val.phonenum}
                                    </td>
                                    <td>
                                        <b>Room Name:</b> ${val.room_name || 'N/A'}<br>
                                        <b>Room Number:</b> ${val.room_no || 'N/A'}<br>
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
                                        <span class="badge bg-${statusClass} text-uppercase px-2 py-1">${status}</span>
                                    </td>

                                    <td>
                                        <button class="btn btn-sm btn-danger text-white shadow-none downloadPdf"
                                            data-booking-id="${val.booking_id}" title="Download PDF">
                                            <i class="bi bi-file-earmark-pdf-fill"></i>
                                        </button>
                                    </td>


                                </tr>`;
                        });

                        if ($.fn.DataTable.isDataTable('#allBookingTable')) {
                            $('#allBookingTable').DataTable().clear().destroy();
                        }

                        $('#allBookings').html(rows);
                        $('#allBookingTable').DataTable({
                            responsive: true,
                            pageLength: 10
                        });
                    } else {
                        $('#allBookings').html(`
                            <tr>
                                <td colspan="5" class="text-center text-danger fw-bold">
                                    <i class="bi bi-info-circle"></i> ${response.message}
                                </td>
                            </tr>
                        `);
                    }
                },
                error: function() {
                    $('#bookingLoader').addClass('d-none');
                    $('#allBookings').html(`
                        <tr>
                            <td colspan="5" class="text-center text-danger fw-bold">
                                <i class="bi bi-x-circle"></i> Failed to fetch data from server.
                            </td>
                        </tr>
                    `);
                }
            });
        }

        const startCalendar = flatpickr("#filterStartDate", {
            dateFormat: "Y-m-d",
            maxDate: "today", // Optional: limit to today
            defaultDate: null,
            onChange: function(selectedDates, dateStr) {
                endCalendar.set("minDate", dateStr); // Set minDate of end calendar
            }
        });

        const endCalendar = flatpickr("#filterEndDate", {
            dateFormat: "Y-m-d",
            maxDate: "today",
            defaultDate: null
        });


        $('#applyFilter').on('click', function() {
            fetchAllBookings();
        });

        $('#resetFilter').on('click', function() {
            $('#filterStatus').val('');
            $('#filterStartDate').val('');
            $('#filterEndDate').val('');
            fetchAllBookings();
        });

        $(document).on('click', '.downloadPdf', function() {
            const bookingId = $(this).data('booking-id');
            if (bookingId) {
                window.open(`<?= base_url("admin/download-pdf/") ?>${bookingId}`, '_blank');
            }
        });

    });
</script>