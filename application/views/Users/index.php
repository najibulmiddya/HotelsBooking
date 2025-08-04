<!-- Carousel -->
<div class="container-fluid px-lg-4 mt-4">
	<div class="swiper mySwiper">
		<div class="swiper-wrapper">
			<?php
			if ($carousel_image) {
				foreach ($carousel_image as $key => $v) { ?>
					<div class="swiper-slide">
						<img class="w-100 d-block" src="<?= CAROUSE_IMAGE_SITE_PATH . $v['image'] ?>" />
					</div>
			<?php
				}
			}
			?>
		</div>
	</div>
</div>

<!-- check Availability form -->
<div class="container availability-form">
	<div class="row">
		<div class="col-lg-12 bg-white shadow p-4 rounded">
			<h5 class="mb-4">
				<i class="bi bi-calendar-check-fill text-primary me-2"></i>
				Check Booking Availability
			</h5>

			<form action="<?= base_url('hotels-rooms') ?>" method="GET">
				<div class="row align-items-end">
					<div class="col-lg-3 mb-3">
						<label class="form-label" style="font-weight: 500;">Check-in</label>
						<input id="checkin" name="checkin" type="date" class="form-control shadow-none text-dark bg-white" placeholder="DD-MM-YYYY">
					</div>
					<div class="col-lg-3 mb-3">
						<label class="form-label" style="font-weight: 500;">Check-out</label>
						<input id="checkout" name="checkout" type="date" class="form-control shadow-none text-dark bg-white" placeholder="DD-MM-YYYY">
					</div>

					<div class="col-lg-3 mb-3">
						<label class="form-label" style="font-weight: 500;">Adult</label>
						<select name="adults" class="form-select shadow-none">
							<option value="">Select</option>
							<?php for ($i = 1; $i <= $max_adult; $i++): ?>
								<option value="<?= $i ?>"><?= $i ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="col-lg-2 mb-3">
						<label class="form-label" style="font-weight: 500;">Children</label>
						<select name="children" class="form-select shadow-none">
							<option value="">Select</option>
							<?php for ($i = 0; $i <= $max_children; $i++): ?>
								<option value="<?= $i ?>"><?= $i ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="col-lg-1 mb-lg-3 mt-2">
						<button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>

<!-- Our Rooms -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">
	<i class="bi-houses-fill text-success me-2"></i> OUR ROOMS
</h2>

<div class="container">
	<div class="row">
		<?php
		$roomsData = $this->session->userdata('roomsData');
		if (!empty($roomsData)):
			foreach ($roomsData as $room): ?>
				<div class="col-lg-4 col-md-6 my-3">
					<div class="card border-0 shadow" style="max-width: 350px; margin: auto;">


						<a href="<?= base_url('room-details/' . $room['id']); ?>">
							<img src="<?= base_url('assets/images/rooms/' . $room['image']) ?>" class="card-img-top" alt="">
						</a>

						<div class="card-body">
							<h5><?= htmlspecialchars($room['room_name']) ?></h5>


							<h6 class="text-success mb-4">
								<i class="bi bi-currency-rupee"></i><?= htmlspecialchars($room['price']) ?>
								<small class="text-muted">/ night</small>
							</h6>
							<!-- Features -->
							<div class="features mb-4">
								<h6 class="mb-1">
									<i class="bi bi-grid-fill text-primary me-2"></i> Features
								</h6>

								<?php if (!empty($room['features'])):
									foreach ($room['features'] as $feature): ?>
										<span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($feature['feature_name']) ?></span>
									<?php endforeach;
								else: ?>
									<span class="badge bg-light text-dark text-wrap">N/A</span>
								<?php endif; ?>
							</div>

							<!-- Facilities -->
							<div class="facilities mb-4">
								<h6 class="mb-1">
									<i class="bi bi-building-check text-success me-2"></i> Facilities
								</h6>

								<?php if (!empty($room['facilities'])):
									foreach ($room['facilities'] as $facility): ?>
										<span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($facility['facility_name']) ?></span>
									<?php endforeach;
								else: ?>
									<span class="badge bg-light text-dark text-wrap">N/A</span>
								<?php endif; ?>
							</div>

							<!-- Guests -->
							<div class="gueste mb-4">
								<h6 class="mb-1">
									<i class="bi bi-people-fill text-primary me-2"></i> Guests
								</h6>
								<span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($room['adult']) ?> Adults</span>
								<span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($room['children']) ?> Children</span>
							</div>


							<!-- Dynamic Rating Section -->
							<?php
							$this->db->select('rating');
							$this->db->from('room_reviews');
							$this->db->where('room_id', $room['id']);
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

							<!-- Rating Section -->
							<div class="rating mb-4">
								<h6 class="mb-1"> Rating</h6>
								<span class="badge rounded-pill bg-light">
									<?php
									$fullStars = floor($avg_rating);
									$hasHalfStar = ($avg_rating - $fullStars) >= 0.5;
									$emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
									for ($i = 0; $i < $fullStars; $i++) {
										echo '<i class="bi bi-star-fill text-warning"></i>';
									}

									// Half star
									if ($hasHalfStar) {
										echo '<i class="bi bi-star-half text-warning"></i>';
									}

									// Empty stars
									for ($i = 0; $i < $emptyStars; $i++) {
										echo '<i class="bi bi-star text-muted"></i>';
									}
									?>
								</span>
								<span class="ms-2 text-muted" style="font-size: 14px;"><?= $avg_rating ?>/5</span>
							</div>


							<!-- Action Buttons -->
							<div class="d-flex justify-content-evenly mb-2">
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
									<!-- <button onclick="checkLoginToBook(<?= $userLogin ?>,<?= $room['id'] ?>)" class="btn btn-sm text-white shadow-none custom-bg">Book Now</button> -->
									<button onclick="checkLoginToBook(<?= $userLogin ?>, <?= $room['id'] ?>)"
										class="btn btn-sm text-white shadow-none custom-bg">
										<i class="bi bi-calendar-check-fill me-1"></i> Book Now
									</button>

								<?php else: ?>
									<button class="btn btn-sm btn-secondary shadow-none" disabled>
										<i class="bi bi-lock-fill me-1"></i> Booking Closed
									</button>
								<?php endif; ?>

								<a href="<?= base_url('room-details/' . $room['id']); ?>"
									class="btn btn-sm btn-outline-dark shadow-none">
									<i class="bi bi-info-circle me-1"></i> More Details
								</a>
							</div>
						</div>
					</div>
				</div>
		<?php endforeach;
		else:
			echo "<p>No rooms available.</p>";
		endif;
		?>
		<!-- Our Facilities -->
		<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">
			<i class="bi bi-building-check text-primary me-2"></i> OUR FACILITIES
		</h2>

		<div class="container">
			<div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
				<?php
				$facilities = $this->session->userdata('facilities');
				if (!empty($facilities)) {
					$count = 0;
					foreach ($facilities as $facility) {
						if ($count >= 5) break;
				?>
						<div class="col-lg-2 col-md-2 text-center bg-white shadow py-4 my-3">
							<img src="<?= base_url('assets/images/facilities/' . $facility['icon']) ?>" width="60px" alt="">
							<h5 class="mt-3"><?= $facility['facility_name'] ?></h5>
							<!-- <p><?= $facility["description"] ?></p> -->
						</div>
				<?php
						$count++;
					}
				}
				?>

				<div class="col-lg-12 text-center mt-5">
					<a href="<?= base_url("facilities"); ?>"
						id="showMoreFacilities"
						class="btn  btn-outline-dark p-2 rounded-0 fw-bold shadow-none">
						<i class="bi bi-plus-circle me-1"></i> More Facilities >>>
					</a>
				</div>
			</div>
		</div>

		<!-- Testimonials -->
		<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">
			<i class="bi bi-chat-quote-fill text-warning me-2"></i> TESTIMONIALS
		</h2>

		<div class="container mt-3">
			<!-- Swiper -->
			<div class="swiper testimonials">
				<div class="swiper-wrapper mb-5">
					<?php if (!empty($reviews)) : ?>
						<?php foreach ($reviews as $review) : ?>
							<div class="swiper-slide" style="background:#fff; border-radius:12px; padding:20px; box-shadow:0 0 12px rgba(0,0,0,0.05); border:1px solid #eee; transition:all 0.3s ease;">

								<!-- Profile -->
								<div style="display:flex; align-items:center; margin-bottom:16px;">
									<img src="<?= USER_PROFILE_SITE_PATH . $review['profile'] ?>"
										alt="<?= htmlspecialchars($review['name']) ?>"
										style="width:40px; height:40px; border-radius:50%; border:1px solid #ccc; object-fit:cover;">
									<div style="margin-left:12px;">
										<h6 style="margin:0; font-weight:600; font-size:15px;"><?= htmlspecialchars($review['name']) ?></h6>
										<small style="color:#6c757d;"><?= htmlspecialchars($review['room_name']) ?></small>
									</div>
								</div>

								<!-- Review Text -->
								<p style="color:#6c757d; font-size:14px; line-height:1.5; min-height:60px; margin-bottom:16px;">
									“<?= htmlspecialchars($review['review']) ?>”
								</p>

								<!-- Star Rating -->
								<div style="display:flex; align-items:center; margin-bottom:6px;">
									<?php for ($i = 1; $i <= 5; $i++) : ?>
										<i class="bi <?= ($i <= $review['rating']) ? 'bi-star-fill text-warning' : 'bi-star text-muted' ?>"
											style="margin-right:4px; font-size:16px; color:<?= ($i <= $review['rating']) ? '#f1c40f' : '#ccc' ?>;"></i>
									<?php endfor; ?>
								</div>

								<!-- Date -->
								<small style="color:#999; font-size:13px;"><?= date('d M, Y', strtotime($review['created_at'])) ?></small>
							</div>
						<?php endforeach; ?>
					<?php else : ?>
						<div class="swiper-slide p-4 text-center text-danger">No reviews found.</div>
					<?php endif; ?>
				</div>

				<div class="swiper-pagination" style="margin-top:16px;"></div>
			</div>
			<div class="col-lg-12 text-center mt-5">
				<a href="<?= base_url("hotels/about"); ?>"
					class="btn btn-outline-dark p-2 rounded-0 fw-bold shadow-none">
					<i class="bi bi-info-circle-fill me-1"></i> Know More >>>
				</a>
			</div>
		</div>

		<!-- Reach us -->
		<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">
			<i class="bi bi-geo-alt-fill text-danger me-2"></i> REACH US
		</h2>

		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 shadow p-3 mb-lg-0 mb-3 bg-white rounded">
					<iframe class="w-100 rounded"
						src="<?= $contact_details->iframe ?>"
						height="355px" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="bg-white p-4 rounded mb-4 shadow">
						<h5 class="mb-3"><i class="bi bi-telephone-outbound-fill text-primary me-2"></i>Call Us</h5>

						<a class="text-decoration-none d-inline-block mb-2 text-dark" href="tel:<?= $contact_details->ph1 ?>">
							<i class="bi bi-telephone-fill text-success me-1"></i> <?= $contact_details->ph1 ?>
						</a>
						<br>

						<?php if (!empty($contact_details->ph2)) : ?>
							<a class="text-decoration-none d-inline-block text-dark" href="tel:<?= $contact_details->ph2 ?>">
								<i class="bi bi-telephone-fill text-success me-1"></i> <?= $contact_details->ph2 ?>
							</a>
						<?php endif; ?>
					</div>


					<div class="bg-white p-4 rounded mb-4 shadow">
						<h5 class="mb-2 fw-semibold"><i class="bi bi-share-fill text-danger me-1"></i> Follow us</h5>

						<a class="d-inline-block mb-2 text-dark" href="<?= $contact_details->tw ?>" target="_blank">
							<span class="badge bg-light text-dark fs-6 p-2">
								<i class="bi bi-twitter me-1" style="color: #1DA1F2;"></i> Twitter
							</span>
						</a>
						<br>

						<a class="d-inline-block mb-2 text-dark" href="<?= $contact_details->fb ?>" target="_blank">
							<span class="badge bg-light text-dark fs-6 p-2">
								<i class="bi bi-facebook me-1" style="color: #1877F2;"></i> Facebook
							</span>
						</a>
						<br>

						<a class="d-inline-block text-dark" href="<?= $contact_details->insta ?>" target="_blank">
							<span class="badge bg-light text-dark fs-6 p-2">
								<i class="bi bi-instagram me-1" style="color: #E4405F;"></i> Instagram
							</span>
						</a>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<script>
	// Check-in calendar
	const checkinCalendar = flatpickr("#checkin", {
		dateFormat: "d/m/Y",
		minDate: "today",
		 clickOpens: true,
        onChange: function(selectedDates, dateStr) {
            // Set minDate for checkout to +1 day after check-in
            const nextDay = new Date(selectedDates[0]);
            nextDay.setDate(nextDay.getDate() + 1);
            checkoutCalendar.set("minDate", nextDay);
        }
	});

	// Check-out calendar
	const checkoutCalendar = flatpickr("#checkout", {
		dateFormat: "d-m-Y",
        minDate: new Date().fp_incr(1), // today + 1
        clickOpens: true
	});
</script>