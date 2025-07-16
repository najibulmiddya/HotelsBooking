<div class="container">
    <div class="row">

        <!-- Page Heading -->
        <div class="col-12 my-5 mb-4 px-4">
            <h2 class="fw-bold">BOOKINGS</h2>
            <div style="font-size: 14px;">
                <a href="<?= base_url("home") ?>" class="text-secondary text-decoration-none">Home</a>
                <span class="text-secondary"> > </span>
                <a href="<?= base_url("hotels-rooms"); ?>" class="text-secondary text-decoration-none">Rooms</a>
                <span class="text-secondary"> > </span>
                <span class="text-secondary">Confirm</span>
            </div>
        </div>


        <!-- Cancel Booking Modal -->
        <!-- Cancel Booking Modal -->
        <div class="modal fade" id="cancelBookingModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Cancel Booking</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to cancel this booking?</p>
                        <textarea id="cancelReason" class="form-control shadow-none" placeholder="Enter cancellation reason" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-danger" id="confirmCancelBooking">Send Request</button>
                    </div>
                </div>
            </div>
        </div>


        <?php
        $bookings = $bookings ?? [];
        foreach ($bookings as $data):

            $class = '';
            $btn = '';

            $status = strtolower($data['booking_status'] ?? '');
            $arraval = $data['arraval'] ?? 0;
            $refund = $data['refund'] ?? 0;

            if ($status === 'confirmed') {
                $class = 'text-success';
                if ($arraval == 1) {
                    $btn .= '<a href="#" class="btn btn-success btn-sm me-1 mb-1"><i class="bi bi-star-fill"></i> Rate & Review</a>';
                    $btn .= '<a href="' . base_url('download-booking-pdf/' . $data['booking_id']) . '" class="btn btn-primary btn-sm mb-1"><i class="bi bi-download"></i> PDF</a>';
                } else {
                    $btn .= '<button class="btn btn-danger btn-sm" onclick="cancelBooking(this)"
                                        data-id="' . $data['booking_id'] . '"
                                        data-bs-toggle="modal" data-bs-target="#cancelBookingModal">
                                    <i class="bi bi-x-circle-fill"></i> Cancel Booking
                                </button>';
                }
            } elseif ($status === 'cancelled') {
                $class = 'text-danger';
                $btn = $refund == 0
                    ? '<span class="badge bg-info">Refund processing</span>'
                    : '<span class="badge bg-success">Refunded</span>';
            } elseif ($status === 'pending') {
                $class = 'text-warning';
            } elseif ($status === 'failed') {
                $class = 'text-muted';
            }
        ?>

            <!-- Booking Card -->
            <div class="col-md-4 px-4 mb-4">
                <div class="bg-white p-3 rounded shadow h-100">
                    <h5><?= htmlspecialchars($data['room_name'] ?? 'Room') ?></h5>
                    <p class="mb-1">₹<?= $data['price'] ?? '0.00' ?> <small class="text-muted">/ night</small></p>

                    <p class="mb-1">
                        <b>Check-in:</b> <?= $data['check_in'] ?><br>
                        <b>Check-out:</b> <?= $data['check_out'] ?>
                    </p>

                    <p class="mb-1">
                        <b>Order ID:</b> <?= $data['order_id'] ?><br>
                        <b>Date:</b> <?= date('d-m-Y h:i A', strtotime($data['datetime'])) ?>
                    </p>

                    <p class="mb-2"><b>Status:</b> <span class="<?= $class ?> text-capitalize"><?= $status ?></span></p>

                    <?= $btn ?>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>

<script>
    let selectedBookingId = null;

    function cancelBooking(button) {
        selectedBookingId = $(button).data('id');
    }

    $('#confirmCancelBooking').on('click', function() {
        const reason = $('#cancelReason').val().trim();

        if (!reason) {
            alert('Please enter a cancellation reason.');
            return;
        }

        $.ajax({
            url: '<?= base_url("user/request-cancel-booking") ?>',
            type: 'POST',
            data: {
                booking_id: selectedBookingId,
                cancel_reason: reason
            },
            dataType: 'json',
            success: function(res) {
                alert(res.message);
                if (res.status) location.reload();
            },
            error: function() {
                alert('Request failed.');
            }
        });

        $('#cancelBookingModal').modal('hide');
    });
</script>