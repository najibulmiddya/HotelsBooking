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
                <span class="text-secondary">Bookings</span>
            </div>
        </div>


        <!-- Cancel Booking Request Modal -->
        <div class="modal fade" id="cancelBookingModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Booking Cancel Request</h5>
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

            $status = strtolower($data['booking_status'] ?? '');
            $arraval = $data['arraval'] ?? 0;
            $refund = $data['refund'] ?? 0;
            $cancel_status = $data['cancel_status'] ?? 'none';

            // Status label class
            $class = match ($status) {
                'confirmed' => 'text-success',
                'cancelled' => 'text-danger',
                'pending' => 'text-warning',
                'failed' => 'text-muted',
                default => ''
            };

            // Status badge
            $cancel_request = match ($cancel_status) {
                'requested' => '<span class="badge bg-warning">Cancellation Requested</span>',
                'approved' => '<span class="badge bg-success">Cancellation Approved</span>',
                'rejected' => '<span class="badge bg-danger">Cancellation Rejected</span>',
                default => ($status === 'cancelled' ? '<span class="badge bg-secondary">Cancelled by Admin</span>' : '')
            };

            // Action buttons
            $btn = '';
            if ($status === 'confirmed') {
                if ($arraval == 1) {
                    $btn .= '<a href="#" class="btn btn-success btn-sm"><i class="bi bi-star-fill"></i> Rate & Review</a>';
                    $btn .= '<a href="' . base_url('user/download-booking-invoice/' . $data['booking_id']) . '" class="btn btn-primary btn-sm"><i class="bi bi-download"></i> PDF</a>';
                } else {
                    $btn .= '<button class="btn btn-danger btn-sm cancel-booking-btn"
                        data-id="' . $data['booking_id'] . '"
                        data-bs-toggle="modal" data-bs-target="#cancelBookingModal">
                        <i class="bi bi-x-circle-fill"></i> Cancel Booking
                    </button>';
                }
            } elseif ($status === 'cancelled') {
                $btn = $refund == 0
                    ? '<span class="badge bg-info">Refund processing</span>'
                    : '<span class="badge bg-success">Refunded</span>';
            }

        ?>
            <!-- Booking Card -->
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">

                        <h5 class="card-title">
                            <a href="<?= base_url('room-details/' . $data['room_id']); ?>" class="text-decoration-none">
                                <?= htmlspecialchars($data['room_name'] ?? 'Room') ?>
                            </a>
                        </h5>


                        <p class="text-muted small mb-2">₹<?= $data['price'] ?? '0.00' ?> / night</p>

                        <ul class="list-unstyled mb-2 small">
                            <li><b>Check-in:</b> <?= $data['check_in'] ?></li>
                            <li><b>Check-out:</b> <?= $data['check_out'] ?></li>
                            <li><b>Order ID:</b> <?= $data['order_id'] ?></li>
                            <li><b>Booking Date:</b> <?= date('d-m-Y h:i A', strtotime($data['datetime'])) ?></li>
                            <li><b>Room No:</b> <?= $data['room_no'] ?: 'Not Assigned' ?></li>
                            <li><b>Status:</b> <span class="<?= $class ?> text-capitalize"><?= $status ?></span></li>
                            <?php if (!empty($cancel_request)): ?>
                                <li><b>Cancel Status:</b> <?= $cancel_request ?></li>
                            <?php endif; ?>
                        </ul>

                        <div class="d-flex flex-wrap gap-2">
                            <?= $btn ?>
                        </div>
                    </div>
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
                if (res.status == true) {
                    $('#cancelReason').val(''); // Clear the textarea
                    $('#cancelBookingModal').modal('hide');
                    $('#success_modal_text').text(res.message);
                    $('#successModal').modal('show');
                    setTimeout(function() {
                        $('#successModal').modal('hide');
                        location.reload();
                    }, 3000);
                } else {
                    $('#cancelReason').val(''); // Clear the textarea
                    $('#cancelBookingModal').modal('hide');
                    $('#failed_modal_text').text(res.message);
                    $('#failedModal').modal('show');
                }
            },
            error: function() {
                alert('Request failed.');
            }
        });

        $('#cancelBookingModal').modal('hide');
    });
</script>