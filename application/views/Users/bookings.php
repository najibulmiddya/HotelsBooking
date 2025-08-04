<div class="container">
    <div class="row">
        <!-- Page Heading -->
        <div class="col-12 my-2 mb-3">
            <h2 class="fw-bold">MY BOOKINGS</h2>
            <div class=" p-2" style="font-size: 14px;">
                <a href="<?= base_url("home") ?>" class=" text-decoration-none">Home</a>
                <span> > </span>
                <a href="<?= base_url("hotels-rooms"); ?>" class=" text-decoration-none">Rooms</a>
                <span> > </span>
                <span class="active">Bookings</span>
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

        <!-- Rate & Review Modal -->
        <div class="modal fade" id="rate_review_Modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-blur="true" style="backdrop-filter: blur(1px);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title"><i class="bi bi-star-fill text-warning"></i> Rate & Review</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="rateReviewForm">
                            <div class="mb-3 text-center">
                                <label for="rating" class="form-label fw-semibold mb-2" style="font-size: 1.1rem;">
                                    How would you rate your stay?
                                </label>
                                <div id="star-rating" class="mb-2">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="bi bi-star-fill star"
                                            data-value="<?= $i ?>"
                                            style="font-size: 2rem; color: #ccc; cursor: pointer; transition: color 0.2s;"></i>
                                    <?php endfor; ?>
                                </div>
                                <input type="hidden" id="rating" value="">
                                <span class="text-danger" id="star-error"></span>
                            </div>
                            <div class="mb-3">
                                <label for="review" class="form-label fw-semibold">Your Review</label>
                                <textarea id="review"
                                    class="form-control shadow-none rounded-3"
                                    rows="4"
                                    placeholder="Share your experience..."></textarea>
                                <span class="text-danger" id="review-error"></span>
                            </div>
                            <input type="hidden" id="bookingId" value="">
                            <input type="hidden" id="review_room_id" value="">

                            <div class="modal-footer border-0 pt-0">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle"></i> Close
                                </button>
                                <button type="submit" class="btn btn-info text-white shadow-none px-2">
                                    <i class="bi bi-send"></i> Submit Review
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Star rating logic
            $(document).on('mouseenter', '.star', function() {
                var val = $(this).data('value');
                $('.star').each(function(i, el) {
                    $(el).css('color', i < val ? '#ffc107' : '#ccc');
                });
            }).on('mouseleave', '#star-rating', function() {
                var selected = $('#rating').val();
                $('.star').each(function(i, el) {
                    $(el).css('color', i < selected ? '#ffc107' : '#ccc');
                });
            }).on('click', '.star', function() {
                var val = $(this).data('value');
                $('#rating').val(val);
                $('.star').each(function(i, el) {
                    $(el).css('color', i < val ? '#ffc107' : '#ccc');
                });
            });

            // When opening modal, set bookingId
            $('#rate_review_Modal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var bookingId = button.data('booking_id');
                $('#bookingId').val(bookingId);
                var review_room_id = button.data('room_id');
                $('#review_room_id').val(review_room_id);
                $('#rating').val('');
                $('.star').css('color', '#ccc');
                $('#review').val('');
            });

            // Submit review (AJAX logic to be implemented as needed)
            $('#rateReviewForm').on('submit', function(e) {
                e.preventDefault();
                var rating = $('#rating').val();
                var review = $('#review').val().trim();
                var bookingId = $('#bookingId').val();
                var review_room_id = $('#review_room_id').val();

                $('#star-error').text('');
                $('#review-error').text('');

                if (!rating) {
                    $('#star-error').text('Please select a rating.');
                    return;
                }
                if (!review) {
                    $('#review-error').text('Review cannot be empty.');
                    return;
                }

                $.ajax({
                    url: '<?= base_url("user/submit-room-review") ?>',
                    type: 'POST',
                    data: {
                        booking_id: bookingId,
                        rating: rating,
                        review: review,
                        room_id: review_room_id
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == true) {
                            $('#rate_review_Modal').modal('hide');
                            $('#success_modal_text').text(res.message);
                            $('#successModal').modal('show');
                            setTimeout(function() {
                                $('#successModal').modal('hide');
                                location.reload();
                            }, 2000);
                        } else {
                            $('#rate_review_Modal').modal('hide');
                            $('#failed_modal_text').text(res.message);
                            $('#failedModal').modal('show');
                        }
                    },
                    error: function() {
                        alert('Failed to submit review.');
                    }
                });
            });
        </script>


        <?php
        $bookings = $bookings ?? [];

        if (!empty($bookings)):
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
                        if ($data['rate_review'] == 0) {
                            $btn .= '<button class="btn btn-success btn-sm shadow-none" data-booking_id="' . $data['booking_id'] . '"  data-room_id="' . $data['room_id'] . '" data-bs-toggle="modal" data-bs-target="#rate_review_Modal" ><i class="bi bi-star-fill"></i> Rate & Review</button>';
                        } else if ($data['rate_review'] == 1) {
                            $btn .= '<button class="btn btn-success btn-sm shadow-none" disabled ><i class="bi bi-star-fill"></i> Rate & Review</button>';
                        }
                        $btn .= '<a href="' . base_url('user/download-booking-invoice/' . $data['booking_id']) . '" class="btn btn-primary btn-sm shadow-none"><i class="bi bi-download"></i> PDF</a>';
                    } else {
                        $btn .= '<button class="btn btn-danger btn-sm cancel-booking-btn shadow-none"
                    data-bs-toggle="modal" data-bs-target="#cancelBookingModal" data-id="' . $data['booking_id'] . '" onclick="cancelBooking(this)">
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
                    <div class="card shadow h-100 bg-white">
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
            <?php
            endforeach;
        else: ?>
            <!-- No Bookings Found Placeholder -->
            <div class="col-12">
                <div class="text-center p-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486800.png" alt="No Bookings" class="img-fluid mb-3" style="max-height: 150px;">
                    <h5 class="text-danger">No bookings found.</h5>
                    <p class="text-secondary">It looks like you haven’t made any bookings yet.</p>
                    <a href="<?= base_url('hotels-rooms') ?>" class="btn btn-ms custom-bg text-white shadow-none">
                        <i class="bi bi-search"></i> Browse Rooms
                    </a>
                </div>
            </div>
        <?php endif; ?>
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

