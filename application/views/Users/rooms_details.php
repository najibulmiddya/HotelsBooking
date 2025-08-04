<div class="container">
    <div class="row">
        <!-- Room Details  -->
        <div class="col-12 my-4 mb-4 px-4">
            <h2 class="fw-bold"><?= $roomsData['room']->room_name; ?></h2>
            <div style="font-size: 14px;">
                <a href="<?= base_url("home") ?>" class="text-secondary text-decoration-none">Home</a>
                <span class="text-secondary"> > </span>
                <a href="<?= base_url("hotels-rooms"); ?>" class="text-secondary text-decoration-none">Rooms</a>
                <span class="text-secondary"> > </span>
                <a href="#" class="active text-decoration-none text-dark">Room Details</a>
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

                    <!-- ⭐ Dynamic Rating -->
                    <?php
                    $this->db->select('room_reviews.rating,room_reviews.review,room_reviews.created_at,users.name, users.profile,');
                    $this->db->from('room_reviews');
                    $this->db->join('users', 'users.id = room_reviews.user_id', 'left');
                    $this->db->where('room_id', $roomsData['room']->id);
                    $this->db->order_by('created_at', 'DESC');
                    $this->db->limit(10);
                    $query = $this->db->get();
                    $ratings = $query->result_array();

                    $avg_rating = 0;

                    if (!empty($ratings)) {
                        $total = array_sum(array_column($ratings, 'rating'));
                        $avg_rating = round($total / count($ratings), 1); // e.g. 4.3
                    }
                    ?>
                    <!-- Static Rating -->
                    <div class="rating mb-3">
                        <span class="badge rounded-pill bg-light">
                            <?php
                            $fullStars = floor($avg_rating);
                            $hasHalfStar = ($avg_rating - $fullStars) >= 0.5;
                            $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);

                            for ($i = 0; $i < $fullStars; $i++) {
                                echo '<i class="bi bi-star-fill text-warning"></i>';
                            }

                            if ($hasHalfStar) {
                                echo '<i class="bi bi-star-half text-warning"></i>';
                            }

                            for ($i = 0; $i < $emptyStars; $i++) {
                                echo '<i class="bi bi-star text-muted"></i>';
                            }
                            ?>
                        </span>
                        <?php if ($avg_rating > 0): ?>
                            <span class="ms-2 text-muted" style="font-size: 14px;"><?= $avg_rating ?>/5</span>
                        <?php endif; ?>
                    </div>

                    <!-- Features -->
                    <div class="features mb-3">
                        <h6 class="mb-1">
                            <i class="bi bi-tools me-1 text-warning"></i> Features
                        </h6>
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
                        <h6 class="mb-1">
                            <i class="bi bi-wrench-adjustable-circle me-1 text-success"></i> Facilities
                        </h6>
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
                        <h6 class="mb-1">
                            <i class="bi bi-people-fill me-1 text-primary"></i> Guests
                        </h6>
                        <span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($roomsData['room']->adult) ?> Adults</span>
                        <span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($roomsData['room']->children) ?> Children</span>
                    </div>

                    <!-- area -->
                    <div class="mb-3">
                        <h6 class="mb-1">
                            <i class="bi bi-aspect-ratio-fill me-1 text-info"></i> Area
                        </h6>

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

                        <button onclick="checkLoginToBook(<?= $userLogin ?>,<?= $roomsData['room']->id ?>)" class="btn w-100 text-white shadow-none custom-bg">
                            <i class="bi bi-calendar-check-fill me-1"></i> Book Now
                        </button>

                    <?php else: ?>
                        <button class="btn w-100 btn-secondary shadow-none" disabled>
                            <i class="bi bi-lock-fill me-1"></i> Booking Closed
                        </button>

                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-12 px-4">
            <div class="">
                <h5 class="mb-3">
                    <i class="bi bi-card-text text-primary me-2"></i> Description
                </h5>
                <p><?= $roomsData['room']->description; ?></p>
            </div>
            <div class="mb-3">
                <h5 class="mb-3">
                    <i class="bi bi-star-fill text-warning me-2"></i> Reviews & Rating
                </h5>
                <?php if (!empty($ratings)) : ?>
                    <?php foreach ($ratings as $review) : ?>
                        <div class="bg-white p-3 rounded shadow-sm mb-3">
                            <!-- User Info -->
                            <div class="d-flex align-items-center mb-2">
                                <img src="<?= USER_PROFILE_SITE_PATH . $review['profile']; ?>" width="40" height="40" class="rounded-circle border" style="object-fit:cover;">
                                <div class="ms-2">
                                    <h6 class="mb-0"><?= htmlspecialchars($review['name']) ?></h6>
                                    <small class="text-muted"><?= date('d M Y', strtotime($review['created_at'])) ?></small>
                                </div>
                            </div>

                            <!-- Review Text -->
                            <p class="mb-2 text-muted" style="font-size:14px;">
                                “<?= htmlspecialchars($review['review']) ?>”
                            </p>

                            <!-- Star Rating -->
                            <div class="rating">
                                <?php
                                $fullStars = floor($review['rating']);
                                $hasHalf = ($review['rating'] - $fullStars) >= 0.5;
                                $emptyStars = 5 - $fullStars - ($hasHalf ? 1 : 0);

                                for ($i = 0; $i < $fullStars; $i++) {
                                    echo '<i class="bi bi-star-fill text-warning me-1"></i>';
                                }

                                if ($hasHalf) {
                                    echo '<i class="bi bi-star-half text-warning me-1"></i>';
                                }

                                for ($i = 0; $i < $emptyStars; $i++) {
                                    echo '<i class="bi bi-star text-muted me-1"></i>';
                                }
                                ?>
                                <span class="ms-1 text-muted small">(<?= $review['rating'] ?>/5)</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="text-muted">
                        <i class="bi bi-chat-left-dots text-danger me-1"></i> No reviews found.
                    </p>
                <?php endif; ?>

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

