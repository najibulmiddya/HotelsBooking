<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>

	<!-- Bootstrap Css -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- google Fonts -->
	<link
		href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:wght@400;500;600&display=swap"
		rel="stylesheet">

	<!-- bootstrap icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

	<!-- Link Carousel's CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/css/custom.css')?>" />
</head>

<body class="bg-light">

	<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow sticky-top">
		<div class="container-fluid">
			<a class="navbar-brand me-5 fw-bold fs-3 h-font" href="#">Hotels</a>
			<button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
				data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active me-2" aria-current="page" href="#">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link me-2" href="#">Rooms</a>
					</li>

					<li class="nav-item">
						<a class="nav-link me-2" href="#">Facilites</a>
					</li>
					<li class="nav-item">
						<a class="nav-link me-2" href="#">Contact us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">About</a>
					</li>

				</ul>
				<div class="d-flex">
					<!-- Button trigger Login -->
					<button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal"
						data-bs-target="#loginModal">
						Login
					</button>
					<!-- Button trigger register -->
					<button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal"
						data-bs-target="#registerModal">
						Register
					</button>
				</div>
			</div>
		</div>
	</nav>

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
		</div>
	</div>
	</div>
	<br /><br /><br /><br /><br /><br /><br /><br />

	<!-- Login Modal -->
	<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="login-from">
					<div class="modal-header">
						<h5 class="modal-title d-flex align-items-center" id="staticBackdropLabel"> <i
								class="bi bi-person-circle fs-3 me-2"></i> User Login</h5>
						<button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
							aria-label="Close"></button>
					</div>
					<div class="modal-body">

						<div class="mb-3">
							<label class="form-label">Email address</label>
							<input type="email" class="form-control shadow-none">
						</div>
						<div class="mb-4">
							<label class="form-label">Password</label>
							<input type="email" class="form-control shadow-none">
						</div>

						<div class="d-flex align-items-center justify-content-between mb-2">
							<button class="btn btn-dark shadow-none" type="submit">Login</button>
							<a href="javascript: void(0)" class="text-secondary text-decoration-none">Frogot
								Password</a>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Register Modal -->
	<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form id="login-from">
					<div class="modal-header">
						<h5 class="modal-title d-flex align-items-center" id="staticBackdropLabel"> <i
								class="bi bi-person-lines-fill fs-3 me-2"></i> User Registration</h5>
						<button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
							aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<span class="badge bg-light text-dark me-3 text-wrap lh-base">
							Note: Your Details must match with your ID (Aadhaar card, Passport, driving license, etc.)
							that will be
							required during check-in.
						</span>
						<div class="contaniner-fluid">
							<div class="row">

								<div class="col-md-6 mb-3">
									<label class="form-label">Name</label>
									<input type="text" class="form-control shadow-none">
								</div>
								<div class="col-md-6 mb-3">
									<label class="form-label">Email</label>
									<input type="text" class="form-control shadow-none">
								</div>

								<div class="col-md-6 mb-3">
									<label class="form-label">Phone Number</label>
									<input type="number" class="form-control shadow-none">
								</div>
								<div class="col-md-6 mb-3">
									<label class="form-label">Picture</label>
									<input type="file" class="form-control shadow-none">
								</div>

								<div class="col-md-12 mb-3">
									<label class="form-label">Address</label>
									<textarea class="form-control shadow-none"></textarea>
								</div>

								<div class="col-md-6 mb-3">
									<label class="form-label">Pincode</label>
									<input type="number" class="form-control shadow-none">
								</div>

								<div class="col-md-6 mb-3">
									<label class="form-label">Date of Birth</label>
									<input type="date" class="form-control shadow-none">
								</div>

								<div class="col-md-6 mb-3">
									<label class="form-label">Password</label>
									<input type="password" class="form-control shadow-none">
								</div>

								<div class="col-md-6 mb-3">
									<label class="form-label">Confirm Password</label>
									<input type="Password" class="form-control shadow-none">
								</div>
							</div>
						</div>

						<div class="d-flex align-items-center justify-content-between mb-2">
							<button class="btn btn-dark shadow-none" type="submit">Submit</button>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>



	<!-- Bootstrap Js -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
		crossorigin="anonymous"></script>
	<!-- Carousel JS -->
	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

	<!-- Initialize Carousel -->
	<script>
		var swiper = new Swiper(".mySwiper", {
			spaceBetween: 30,
			effect: "fade",
			loop: true,
			autoplay: {
				delay: 2500, disableOnInteraction: false,
			}

		});
	</script>


</body>

</html>