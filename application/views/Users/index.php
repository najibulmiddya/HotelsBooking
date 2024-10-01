<!-- Carousel -->
<div class="container-fluid px-lg-4 mt-4">
	<div class="swiper mySwiper">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<img class="w-100 d-block" src="<?=base_url('assets/images/carousel/IMG1.png')?>" />
			</div>
			<div class="swiper-slide">
				<img class="w-100 d-block" src="<?=base_url('assets/images/carousel/IMG2.png')?>" />
			</div>
			<div class="swiper-slide">
				<img class="w-100 d-block" src="<?=base_url('assets/images/carousel/IMG3.png')?>" />
			</div>
			<div class="swiper-slide">
				<img class="w-100 d-block" src="<?=base_url('assets/images/carousel/IMG4.png')?>" />
			</div>
			<div class="swiper-slide">
				<img class="w-100 d-block" src="<?=base_url('assets/images/carousel/IMG5.png')?>" />
			</div>
			<div class="swiper-slide">
				<img class="w-100 d-block" src="<?=base_url('assets/images/carousel/IMG6.png')?>" />
			</div>
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
						<input type="date" class="form-control shadow-none">
					</div>
					<div class="col-lg-3 mb-3">
						<label class="form-label" style="font-size: 500;">Chack-out</label>
						<input type="date" class="form-control shadow-none">
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
		<div class="col-lg-4 col-md-6 my-3">
			<div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
				<img src="<?=base_url('assets/images/rooms/1.jpg')?>" class="card-img-top" alt="...">
				<div class="card-body">
					<h5>Room Name</h5>
					<h6 class="mb-4">₹500 Par Night</h6>
					<!-- Rooms features -->
					<div class="features mb-4">
						<h6 class="mb-1">Features</h6>
						<span class="badge bg-light text-dark text-wrap">
							2 Rooms
						</span>
						<span class="badge bg-light text-dark text-wrap">
							1 Bathroom
						</span>
						<span class="badge bg-light text-dark text-wrap">
							1 Balcony
						</span>
						<span class="badge bg-light text-dark text-wrap">
							2 Sofa
						</span>
					</div>
					
					<!-- Rooms Facilities -->
					<div class="facilities mb-4">
						<h6 class="mb-1">Facilities</h6>
						<span class="badge bg-light text-dark text-wrap">
							Wifi
						</span>
						<span class="badge bg-light text-dark text-wrap">
							Television
						</span>
						<span class="badge bg-light text-dark text-wrap">
							Ac
						</span>
						<span class="badge bg-light text-dark text-wrap">
							Room Heater
						</span>
					</div>

					<!-- Rooms Gueste -->
					<div class="gueste mb-4">
						<h6 class="mb-1">Gueste</h6>
						<span class="badge bg-light text-dark text-wrap">
							5 Adults
						</span>
						<span class="badge bg-light text-dark text-wrap">
							4 Children
						</span>
					</div>

					<!-- Rooms Rating -->
					<div class="rating mb-4">
						<h6 class="mb-1">Rating</h6>
						<span class="badge rounded-pill bg-light">
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
						</span>
					</div>
					<div class="d-flex justify-content-evenly mb-2">
						<a href="#" class="btn btn-sm text-white shadow-none custom-bg">Book Now</a>
						<a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
					</div>

				</div>
			</div>
		</div>

		<div class="col-lg-4 col-md-6 my-3">
			<div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
				<img src="<?=base_url('assets/images/rooms/2.jpg')?>" class="card-img-top" alt="...">
				<div class="card-body">
					<h5>Room Name</h5>
					<h6 class="mb-4">₹500 Par Night</h6>
					<!-- Rooms features -->
					<div class="features mb-4">
						<h6 class="mb-1">Features</h6>
						<span class="badge bg-light text-dark text-wrap">
							2 Rooms
						</span>
						<span class="badge bg-light text-dark text-wrap">
							1 Bathroom
						</span>
						<span class="badge bg-light text-dark text-wrap">
							1 Balcony
						</span>
						<span class="badge bg-light text-dark text-wrap">
							2 Sofa
						</span>
					</div>
					<!-- Rooms Facilities -->
					<div class="facilities mb-4">
						<h6 class="mb-1">Facilities</h6>
						<span class="badge bg-light text-dark text-wrap">
							Wifi
						</span>
						<span class="badge bg-light text-dark text-wrap">
							Television
						</span>
						<span class="badge bg-light text-dark text-wrap">
							Ac
						</span>
						<span class="badge bg-light text-dark text-wrap">
							Room Heater
						</span>
					</div>

					<!-- Rooms Gueste -->
					<div class="gueste mb-4">
						<h6 class="mb-1">Gueste</h6>
						<span class="badge bg-light text-dark text-wrap">
							5 Adults
						</span>
						<span class="badge bg-light text-dark text-wrap">
							4 Children
						</span>
					</div>

					<!-- Rooms Rating -->
					<div class="rating mb-4">
						<h6 class="mb-1">Rating</h6>
						<span class="badge rounded-pill bg-light">
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
						</span>
					</div>
					<div class="d-flex justify-content-evenly mb-2">
						<a href="#" class="btn btn-sm text-white shadow-none custom-bg">Book Now</a>
						<a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
					</div>

				</div>
			</div>
		</div>


		<div class="col-lg-4 col-md-6 my-3">
			<div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
				<img src="<?=base_url('assets/images/rooms/3.jpg')?>" class="card-img-top" alt="...">
				<div class="card-body">
					<h5>Room Name</h5>
					<h6 class="mb-4">₹500 Par Night</h6>
					<!-- Rooms features -->
					<div class="features mb-4">
						<h6 class="mb-1">Features</h6>
						<span class="badge bg-light text-dark text-wrap">
							2 Rooms
						</span>
						<span class="badge bg-light text-dark text-wrap">
							1 Bathroom
						</span>
						<span class="badge bg-light text-dark text-wrap">
							1 Balcony
						</span>
						<span class="badge bg-light text-dark text-wrap">
							2 Sofa
						</span>
					</div>
					<!-- Rooms Facilities -->
					<div class="facilities mb-4">
						<h6 class="mb-1">Facilities</h6>
						<span class="badge bg-light text-dark text-wrap">
							Wifi
						</span>
						<span class="badge bg-light text-dark text-wrap">
							Television
						</span>
						<span class="badge bg-light text-dark text-wrap">
							Ac
						</span>
						<span class="badge bg-light text-dark text-wrap">
							Room Heater
						</span>
					</div>

					<!-- Rooms Gueste -->
					<div class="gueste mb-4">
						<h6 class="mb-1">Gueste</h6>
						<span class="badge bg-light text-dark text-wrap">
							5 Adults
						</span>
						<span class="badge bg-light text-dark text-wrap">
							4 Children
						</span>
					</div>
					
					<!-- Rooms Rating -->
					<div class="rating mb-4">
						<h6 class="mb-1">Rating</h6>
						<span class="badge rounded-pill bg-light">
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
							<i class="bi bi-star-fill text-warning"></i>
						</span>
					</div>
					<div class="d-flex justify-content-evenly mb-2">
						<a href="#" class="btn btn-sm text-white shadow-none custom-bg">Book Now</a>
						<a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
					</div>

				</div>
			</div>
		</div>

		<div class="col-lg-12 text-center mt-5">
			<a href="" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
		</div>
	</div>
</div>

<!-- Our Facilities -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
<div class="container">
	<div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
		<div class="col-lg-2 col-md-2 text-center bg-white shadow py-4 my-3">
			<img src="<?=base_url('assets/images/facilities/wifi.svg')?>" width="80px">
			<h5 class="mt-3">Wifi</h5>
		</div>
		<div class="col-lg-2 col-md-2 text-center bg-white shadow py-4 my-3">
			<img src="<?=base_url('assets/images/facilities/wifi.svg')?>" width="80px">
			<h5 class="mt-3">Wifi</h5>
		</div>
		<div class="col-lg-2 col-md-2 text-center bg-white shadow py-4 my-3">
			<img src="<?=base_url('assets/images/facilities/wifi.svg')?>" width="80px">
			<h5 class="mt-3">Wifi</h5>
		</div>
		<div class="col-lg-2 col-md-2 text-center bg-white shadow py-4 my-3">
			<img src="<?=base_url('assets/images/facilities/wifi.svg')?>" width="80px">
			<h5 class="mt-3">Wifi</h5>
		</div>
		<div class="col-lg-2 col-md-2 text-center bg-white shadow py-4 my-3">
			<img src="<?=base_url('assets/images/facilities/wifi.svg')?>" width="80px">
			<h5 class="mt-3">Wifi</h5>
		</div>

		<div class="col-lg-12 text-center mt-5">
			<a href="" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities >>></a>
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
					<img src="<?=base_url('assets/images/facilities/wifi.svg')?>" width="30px" alt="">
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
					<img src="<?=base_url('assets/images/facilities/wifi.svg')?>" width="30px" alt="">
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
					<img src="<?=base_url('assets/images/facilities/wifi.svg')?>" width="30px" alt="">
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
					<img src="<?=base_url('assets/images/facilities/wifi.svg')?>" width="30px" alt="">
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
		<a href="" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Know More >>></a>
	</div>
</div>

<!-- Reach us -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-8 shadow p-3 mb-lg-0 mb-3 bg-white rounded">
			<iframe class="w-100 rounded"
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58662.08905837483!2d87.02184589501707!3d23.229234556431216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f7a58c5fc2b411%3A0xfdbd0b45c0b4aa70!2sBankura%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1726938786713!5m2!1sen!2sin"
				height="355px" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
		<div class="col-lg-4 col-md-4">
			<div class="bg-white p-4 rounded mb-4 shadow">
				<h5>Call us</h5>
				<a class="text-decoration-none d-inline-block mb-2 text-dark" href="tel:+917778889990"> <i
						class="bi bi-telephone-fill"></i> +917778889990
				</a>
				<br>
				<a class="text-decoration-none d-inline-block text-dark" href="tel:+917778889990"> <i
						class="bi bi-telephone-fill"></i> +917778889990
				</a>
			</div>

			<div class="bg-white p-4 rounded mb-4 shadow">
				<h5>Follow us</h5>
				<a class="d-inline-block mb-3 text-dark" href="">
					<span class="badge bg-light text-dark fs-6 p-2"><i class="bi bi-twitter me-1"></i>Twitter</span>
				</a>
				<br>
				<a class="d-inline-block mb-3 text-dark" href="">
					<span class="badge bg-light text-dark fs-6 p-2"><i class="bi bi-facebook me-1"></i>Facebook</span>
				</a>
				<br>
				<a class="d-inline-block text-dark" href="">
					<span class="badge bg-light text-dark fs-6 p-2"><i class="bi bi-instagram me-1"></i>Instagram</span>
				</a>
			</div>
		</div>


	</div>
</div>