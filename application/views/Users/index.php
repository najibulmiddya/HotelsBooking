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
			<h5 class="mb-4">Chack Booking Availability</h5>
			<form>
				<div class="row align-items-end">
					<div class="col-lg-3 mb-3">
						<label class="form-label" style="font-size: 500;">Chack-in</label>
						<input id="checkin" type="date" class="form-control shadow-none">
					</div>
					<div class="col-lg-3 mb-3">
						<label class="form-label" style="font-size: 500;">Chack-out</label>
						<input id="checkout" type="date" class="form-control shadow-none">
					</div>

					<div class="col-lg-3 mb-3">
						<label class="form-label" style="font-size: 500;">Adult</label>
						<select class="form-select shadow-none">
							<option selected>select menu</option>
							<option value="1">One</option>
							<option value="2">Two</option>
							<option value="3">Three</option>
						</select>
					</div>
					<div class="col-lg-2 mb-3">
						<label class="form-label" style="font-size: 500;">Children</label>
						<select class="form-select shadow-none">
							<option selected>select menu</option>
							<option value="1">One</option>
							<option value="2">Two</option>
							<option value="3">Three</option>
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
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
<div class="container">
	<div class="row">
		<?php
		$roomsData = $this->session->userdata('roomsData');
		if (!empty($roomsData)):
			foreach ($roomsData as $room): ?>
				<div class="col-lg-4 col-md-6 my-3">
					<div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
						<img src="<?= base_url('assets/images/rooms/' . $room['image']) ?>" class="card-img-top" alt="">
						<div class="card-body">
							<h5><?= htmlspecialchars($room['room_name']) ?></h5>
							<h6 class="mb-4">₹<?= htmlspecialchars($room['price']) ?> Per Night</h6>
							<!-- Features -->
							<div class="features mb-4">
								<h6 class="mb-1">Features</h6>
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
								<h6 class="mb-1">Facilities</h6>
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
								<h6 class="mb-1">Guests</h6>
								<span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($room['adult']) ?> Adults</span>
								<span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($room['children']) ?> Children</span>
							</div>

							<!-- Static Rating (can be dynamic if you have rating data) -->
							<div class="rating mb-4">
								<h6 class="mb-1">Rating</h6>
								<span class="badge rounded-pill bg-light">
									<i class="bi bi-star-fill text-warning"></i>
									<i class="bi bi-star-fill text-warning"></i>
									<i class="bi bi-star-fill text-warning"></i>
									<i class="bi bi-star-fill text-warning"></i>
								</span>
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
									<button onclick="checkLoginToBook(<?= $userLogin ?>,<?= $room['id'] ?>)" class="btn btn-sm text-white shadow-none custom-bg">Book Now</button>
								<?php else: ?>
									<button class="btn btn-sm btn-secondary shadow-none" disabled>Booking Closed</button>
								<?php endif; ?>

								<a href="<?= base_url('room-details/' . $room['id']); ?>" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
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
		<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
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
					<a href="<?= base_url("facilities"); ?>" id="showMoreFacilities" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities >>></a>
				</div>
			</div>
		</div>

		<!-- Testimonials -->
		<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">TASTIMONIALS</h2>
		<div class="container mt-5">
			<!-- Swiper -->
			<div class="swiper testimonials">
				<div class="swiper-wrapper mb-5">

					<div class="swiper-slide bg-white p-4 shadow">
						<div class="profile d-flex align-items-center mb-3">
							<img src="<?= base_url('assets/images/facilities/wifi.svg') ?>" width="30px" alt="">
							<h6 class="m-0 ms-2">Rendon user</h6>
						</div>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
							Excepturi amet officiis laborum
							veritatis similique, sequi accusantium asperiores odio aliquid aut?
						</p>
						<div class="rating">
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
						</div>
					</div>

					<div class="swiper-slide bg-white p-4 shadow">
						<div class="profile d-flex align-items-center mb-3">
							<img src="<?= base_url('assets/images/facilities/wifi.svg') ?>" width="30px" alt="">
							<h6 class="m-0 ms-2">Rendon user</h6>
						</div>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
							Excepturi amet officiis laborum
							veritatis similique, sequi accusantium asperiores odio aliquid aut?
						</p>
						<div class="rating">
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
						</div>
					</div>

					<div class="swiper-slide bg-white p-4 shadow">
						<div class="profile d-flex align-items-center mb-3">
							<img src="<?= base_url('assets/images/facilities/wifi.svg') ?>" width="30px" alt="">
							<h6 class="m-0 ms-2">Rendon user</h6>
						</div>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
							Excepturi amet officiis laborum
							veritatis similique, sequi accusantium asperiores odio aliquid aut?
						</p>
						<div class="rating">
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
						</div>
					</div>
					<div class="swiper-slide bg-white p-4 shadow">
						<div class="profile d-flex align-items-center mb-3">
							<img src="<?= base_url('assets/images/facilities/wifi.svg') ?>" width="30px" alt="">
							<h6 class="m-0 ms-2">Rendon user</h6>
						</div>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
							Excepturi amet officiis laborum
							veritatis similique, sequi accusantium asperiores odio aliquid aut?
						</p>
						<div class="rating">
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
						</div>
					</div>
				</div>
				<div class="swiper-pagination"></div>
			</div>

			<div class="col-lg-12 text-center mt-5">
				<a href="<?= base_url("hotels-about"); ?>" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Know More >>></a>
			</div>
		</div>

		<!-- Reach us -->
		<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 shadow p-3 mb-lg-0 mb-3 bg-white rounded">
					<iframe class="w-100 rounded"
						src="<?= $contact_details->iframe ?>"
						height="355px" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="bg-white p-4 rounded mb-4 shadow">
						<h5>Call us</h5>
						<a class="text-decoration-none d-inline-block mb-2 text-dark" href="tel:<?= $contact_details->ph1 ?>"> <i
								class="bi bi-telephone-fill"></i> <?= $contact_details->ph1 ?>
						</a>
						<br>

						<?php if ($contact_details->ph2) {
						?>
							<a class="text-decoration-none d-inline-block text-dark" href="tel:<?= $contact_details->ph2 ?>"> <i
									class="bi bi-telephone-fill"></i> <?= $contact_details->ph2 ?>
							</a>
						<?php
						} ?>
					</div>

					<div class="bg-white p-4 rounded mb-4 shadow">
						<h5>Follow us</h5>
						<a class="d-inline-block mb-3 text-dark" href="<?= $contact_details->tw ?>">
							<span class="badge bg-light text-dark fs-6 p-2"><i class="bi bi-twitter me-1"></i> Twitter</span>
						</a>
						<br>
						<a class="d-inline-block mb-3 text-dark" href="<?= $contact_details->fb ?>">
							<span class="badge bg-light text-dark fs-6 p-2"><i class="bi bi-facebook me-1"></i> Facebook</span>
						</a>
						<br>
						<a class="d-inline-block text-dark" href="<?= $contact_details->insta ?>">
							<span class="badge bg-light text-dark fs-6 p-2"><i class="bi bi-instagram me-1"></i> Instagram</span>
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