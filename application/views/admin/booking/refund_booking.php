<h3 class="mb-4">
    <i class="bi bi-arrow-counterclockwise me-2"></i> REFUND BOOKINGS
</h3>

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <table class="table table-bordered" id="refundBookingTable">
            <thead>
                <tr>
                    <th>User Details</th>
                    <th>Room Details</th>
                    <th>Refund Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="refundBookingsData"></tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="confirmRefundModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-circle-fill"></i> Confirm Refund
                </h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to <b>refund ₹<span id="refundAmount"></span></b> to user: <b id="refundUserName"></b>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning fw-bold text-dark shadow-none" id="confirmRefundBtn">Yes, Refund</button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        cancelBookings();

        function cancelBookings() {
            $.ajax({
                url: '<?= base_url("admin/fetch-cancel-bookings") ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
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

                            // Render row
                            rows += `
                        <tr>
                            <td>
                            <b>Order ID:</b> <span class="bg-primary text-white px-1 rounded">${val.order_id}</span><br>
                                <b>Name:</b> ${val.user_name}<br>
                                <b>Mobile:</b> ${val.phonenum}
                            </td>
                           
                            <td>
                                <b>Room Name:</b> ${val.room_name || 'N/A'}<br>
                                <b>Price:</b> ₹${val.price || '0'}<br>
                                <b>Check-in:</b> ${val.check_in}<br>
                                <b>Check-out:</b> ${val.check_out}<br>
                                <b>Total Days:</b> ${diffDays}<br>

                                <b>Booking Date & Time:</b> ${formattedDate} ${formattedTime}
                            </td>

                             <td>
                                ₹${val.total_pay}
                            </td>

                          <td class="text-center">
                                <button
                                    class="btn btn-sm btn-warning fw-bold text-dark shadow-none refundBooking"
                                    data-booking-id="${val.booking_id}"
                                    data-amount="${val.total_pay}"
                                    data-user-name="${val.user_name}">
                                    <i class="bi bi-cash-coin me-1"></i> Refund
                                </button>
                            </td>

                        </tr>`;
                        });

                        // Inject new rows
                        if ($.fn.DataTable.isDataTable('#refundBookingTable')) {
                            $('#refundBookingTable').DataTable().clear().destroy();
                        }

                        $('#refundBookingsData').html(rows);
                        $('#refundBookingTable').DataTable({
                            responsive: true,
                            destroy: true,
                            pageLength: 10,
                        });
                    } else {
                        $('#refundBookingsData').html(`
                        <tr>
                            <td colspan="3" class="text-center text-danger">${response.message}</td>
                        </tr>`);
                    }
                },
                error: function() {
                    $('#refundBookingsData').html(`
                    <tr>
                        <td colspan="3" class="text-center text-danger">Failed to fetch data from server.</td>
                    </tr>`);
                }
            });
        }

        let refundBookingId = null;
        let refundAmount = 0;

        $(document).on('click', '.refundBooking', function() {
            refundBookingId = $(this).data('booking-id');
            refundAmount = $(this).data('amount');
            const userName = $(this).data('user-name');

            $('#refundAmount').text(refundAmount);
            $('#refundUserName').text(userName);
            $('#confirmRefundModal').modal('show');
        });

        $('#confirmRefundBtn').on('click', function() {
            if (!refundBookingId || !refundAmount) return;

            $.ajax({
                url: '<?= base_url("admin/refund-amount") ?>',
                method: 'POST',
                dataType: 'json',
                data: {
                    booking_id: refundBookingId,
                    refund_amount: refundAmount
                },
                success: function(res) {
                    $('#confirmRefundModal').modal('hide');
                    if (res.status) {
                        $('#success_modal_text').text(res.message);
                        $('#successModal').modal('show');
                        cancelBookings();
                        setTimeout(function() {
                            $('#successModal').modal('hide');
                        }, 2000);
                    } else {
                        alert(res.message || 'Refund failed.');
                    }

                },
                error: function() {
                    alert('Server error. Try again.');
                }
            });
        });


    });
</script>