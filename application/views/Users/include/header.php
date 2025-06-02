<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <?php require(APPPATH . 'views/users/include/link.php'); ?>
    <style>
        .error {
            color: red;
            font-size: 0.875rem;
            /* optional: slightly smaller text */
        }
    </style>

    <script>
        // ja alert function
        function js_alert(status, message) {
            if (status == true) {
                status = "success";
                mes_type = "Successfully ! "
            } else {
                status = "warning";
                mes_type = "Warning ! ";
            }
            if (status == 'error') {
                status == 'danger'
                mes_type = "Failed ! "
            }

            let mes = ` <div class="alert alert-${status} alert-dismissible fade show custom-alert" role="alert">
                            <strong>${mes_type}</strong>${message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
            $(document.body).append(mes);
        }
    </script>
</head>

<body class="bg-light">
    <!-- Navbar -->
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
                        <a class="nav-link <?= is_active('home'); ?> me-2" aria-current="page" href="<?= base_url('home') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2  <?= is_active('rooms'); ?>" href="<?= base_url('hotels-rooms') ?>">Rooms</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link me-2  <?= is_active('facilities'); ?>" href="<?= base_url('facilities') ?>">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 <?= is_active('contact'); ?>" href="<?= base_url('contact') ?>">Contact us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= is_active('about'); ?>" href="<?= base_url('hotels-about') ?>">About</a>
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
                <form id="login-from" enctype="multipart/form-data">
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
                                    <input type="text" id="name" class="form-control shadow-none">
                                    <span id="name_error" class="error"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" id="email" class="form-control shadow-none">
                                    <span id="email_error" class="error"></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" id="number" class="form-control shadow-none">
                                    <span id="number_error" class="error"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Picture</label>
                                    <input type="file" id="profile" class="form-control shadow-none">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control shadow-none" id=""></textarea>
                                    <span id="address_error" class="error"></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pincode</label>
                                    <input type="number" id="pincode" class="form-control shadow-none">
                                    <span id="pincode_error" class="error"></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" id="dob" class="form-control shadow-none">
                                    <span id="dob_error" class="error"></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" id="password" class="form-control shadow-none">
                                        <span class="input-group-text" id="togglePassword" style="cursor:pointer;">
                                            <i class="bi bi-eye-fill"></i>
                                        </span>
                                    </div>
                                    <span id="password_error" class="error text-danger"></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" id="confirm_password" class="form-control shadow-none">
                                        <span class="input-group-text" id="toggleConfirmPassword" style="cursor:pointer;">
                                            <i class="bi bi-eye-fill"></i>
                                        </span>
                                    </div>
                                    <span id="confirm_password_error" class="error text-danger"></span>
                                </div>

                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button class="btn btn-dark shadow-none" id="register_btn">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('#number').on('keyup', function() {
                let number = $(this).val();
                number = number.replace(/\D/g, '');
                if (number.length > 10) {
                    number = number.substring(0, 10);
                }
                $(this).val(number);
                if (number.length !== 10) {
                    $('#number').addClass('is-invalid');
                    $('#number_error').text("Phone number must be exactly 10 digits.");
                } else {
                    $('#number').removeClass('is-invalid');
                    $('#number_error').text("");
                }
            });

            $('#name').on('keypress', function(e) {
                const char = String.fromCharCode(e.which);
                if (!/[a-zA-Z\s]/.test(char)) {
                    e.preventDefault();
                }
            });

            // Password show/hide
            $('#togglePassword').on('click', function() {
                const input = $('#password');
                const icon = $(this).find('i');
                input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
                icon.toggleClass('bi-eye-fill bi-eye-slash-fill');
            });

            // Confirm password show/hide
            $('#toggleConfirmPassword').on('click', function() {
                const input = $('#confirm_password');
                const icon = $(this).find('i');
                input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
                icon.toggleClass('bi-eye-fill bi-eye-slash-fill');
            });


            $('#register_btn').click(function(e) {
                e.preventDefault();
                $('.error').text('');
                let isValid = true;

                let name = $('#name').val();
                let email = $('#email').val();
                let number = $('#number').val();
                let address = $('#address').val();
                let pincode = $('#pincode').val();
                let dob = $('#dob').val();
                let password = $('#password').val();
                let confirm_password = $('#confirm_password').val();
                let profile = $('#profile')[0].files[0];

                const nameRegex = /^[A-Za-z\s]+$/;
                if (name === "") {
                    $('#name').addClass('is-invalid');
                    $('#name_error').text("Please Enter Your Name.");
                    isValid = false;
                    return false;
                } else if (!nameRegex.test(name)) {
                    $('#name').addClass('is-invalid');
                    $('#name_error').text("Only alphabets and spaces are allowed.");
                    isValid = false;
                    return false;
                } else {
                    $('#name').removeClass('is-invalid');
                }

                if (email === "") {
                    $('#email').addClass('is-invalid');
                    $('#email_error').text("Please enter your email.");
                    isValid = false;
                    return false;
                } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                    $('#email').addClass('is-invalid');
                    $('#email_error').text("Please enter a valid email address.");
                    isValid = false;
                    return false;
                } else {
                    $('#email').removeClass('is-invalid');
                }

                if (number === "") {
                    $('#number').addClass('is-invalid');
                    $('#number_error').text("Please enter your Phone number.");
                    isValid = false;
                    return false;
                } else if (!/^\d{10}$/.test(number)) {
                    $('#number').addClass('is-invalid');
                    $('#number_error').text("Please enter a valid 10 digits Phone number.");
                    isValid = false;
                    return false;
                } else {
                    $('#number').removeClass('is-invalid');
                    $('#number_error').text("");
                }

                if (address === "") {
                    $('#address').addClass('is-invalid');
                    $('#address_error').text("Address is required.");
                    isValid = false;
                    return false;
                } else {
                    $('#address').removeClass('is-invalid');
                    $('#address_error').text("");
                }

                if (pincode === "") {
                    $('#pincode').addClass('is-invalid');
                    $('#pincode_error').text("Pincode is required.");
                    isValid = false;
                    return false;
                } else {
                    $('#pincode').removeClass('is-invalid');
                    $('#pincode_error').text("");
                }

                if (dob === "") {
                    $('#dob').addClass('is-invalid');
                    $('#dob_error').text("Date of birth is required.");
                    isValid = false;
                    return false;
                } else {
                    $('#dob').removeClass('is-invalid');
                    $('#dob_error').text("");
                }

                if (password.length < 6) {
                    $('#password').addClass('is-invalid');
                    $('#password_error').text("Password must be at least 6 characters.");
                    isValid = false;
                    return false;
                } else {
                    $('#password').removeClass('is-invalid');
                    $('#password_error').text("");
                }

                if (password !== confirm_password) {
                    $('#confirm_password').addClass('is-invalid');
                    $('#confirm_password_error').text("Passwords do not match.");
                    isValid = false;
                    return false;
                } else {
                    $('#confirm_password').removeClass('is-invalid');
                    $('#confirm_password_error').text("");
                }


                if (!isValid) return;

                let formData = new FormData();
                formData.append("name", name);
                formData.append("email", email);
                formData.append("number", number);
                formData.append("address", address);
                formData.append("pincode", pincode);
                formData.append("dob", dob);
                formData.append("password", password);
                if (profile) {
                    formData.append("profile", profile);
                }

                $.ajax({
                    url: "<?= base_url('user/register') ?>",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function() {
                        $('#register_btn').prop('disabled', true).text("Submitting...");
                    },
                    success: function(res) {
                        if (res.status) {
                            alert(res.message);
                            $('#register-form')[0].reset();
                            $('#registerModal').modal('hide');
                        } else {
                            alert(res.message || "Registration failed.");
                        }
                    },
                    error: function() {
                        alert("Server error. Please try again later.");
                    },
                    complete: function() {
                        $('#register_btn').prop('disabled', false).text("Submit");
                    }
                });
            });
        });
    </script>