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
        }

        #password-checklist div {
            margin-bottom: 5px;
        }

        .text-success {
            color: green;
        }

        .text-danger {
            color: red;
        }

        .modal-backdrop.blur-backdrop {
            backdrop-filter: blur(6px);
            background-color: rgba(0, 0, 0, 0.3);
            /* optional: darker overlay */
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
    <?php
    //  session_start();
    if (isset($_SESSION['data'])) {
        $data = $this->session->userdata('data');
    } else {
        redirect('home');
    }
    ?>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="<?= base_url('home') ?>"><?= $data['site_title']; ?></a>
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
                    <?php
                    $CI = &get_instance();
                    $loggedUser = $CI->session->userdata('loggedInuser');
                    ?>
                    <?php if ($loggedUser && $loggedUser['USER_LOGGEDIN'] == true): ?>
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-dark shadow-none  dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <img src="<?= USER_PROFILE_SITE_PATH . $loggedUser['PROFILE'] ?>" width="30" height="27px" class="rounded-circle me-1">
                                <?= $loggedUser['NAME'] ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li><a class="dropdown-item" href="<?= base_url(""); ?>">Profile</a></li>
                                <li>
                                    <a class="dropdown-item <?= is_active('bookings', 'index'); ?>" href="<?= base_url("user/bookings"); ?>">
                                        <i class="bi bi-journal-check me-2"></i> My Bookings
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="logoutBtn">Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Button trigger Login -->
                        <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal"
                            data-bs-target="#loginModal">
                            Login
                        </button>
                        <!-- Button trigger Register -->
                        <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal"
                            data-bs-target="#registerModal">
                            Register
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="loginFrom">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center" id="staticBackdropLabel"> <i
                                class="bi bi-person-circle fs-3 me-2 color_Green"></i> User Login</h5>
                        <button type="reset" id="closeLogin" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="login_error_msg" class="text-danger text-center d-none"></p>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" id="loginEmail" name="login_email" class="form-control shadow-none">
                            <span id="login_email_error" class="error"></span>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" id="loginPassword" name="login_password" class="form-control shadow-none">
                            <span id="login_password_error" class="error"></span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button class="btn btn-dark shadow-none custom-bg" type="submit" id="login">Login</button>
                            <button type="button" class="btn text-secondary shadow-none p-0" data-bs-toggle="modal"
                                data-bs-target="#forgotPasswordModal" data-bs-dismiss="modal">
                                FrogotPassword?
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Register Modal step 1 -->
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center" id="staticBackdropLabel"> <i
                            class="bi bi-person-lines-fill fs-3 me-2 color_Green"></i> User Registration</h5>
                    <button type="reset" class="btn-close shadow-none step1Back" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registration_from" enctype="multipart/form-data">
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
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" id="dob" placeholder="Select" class="form-control shadow-none">
                                    <span id="dob_error" class="error"></span>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control shadow-none" id="address"></textarea>
                                    <span id="address_error" class="error"></span>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="pinCode">PIN Code:</label><br>
                                    <input class="form-control shadow-none" type="text" id="pincode" name="pincode">
                                    <span id="pincode_error" class="error"></span>
                                </div>

                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button class="btn btn-dark shadow-none step1Back" id="step1Back" type="reset" data-bs-dismiss="modal"
                            aria-label="Close">Back</button>
                        <button class="btn text-white shadow-none custom-bg" id="step1Next">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal Step 2 -->
    <div class="modal fade" id="registerModalStep2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="registration_from_stap2" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">Create a Password</h5>
                        <button type="reset" class="btn-close shadow-none backStap2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" id="password" class="form-control shadow-none">
                                        <span class="input-group-text" id="togglePassword" style="cursor:pointer;">
                                            <i class="bi bi-eye-fill"></i>
                                        </span>
                                    </div>
                                    <span id="password_error" class="error text-danger"></span>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" id="confirm_password" class="form-control shadow-none">
                                        <span class="input-group-text" id="toggleConfirmPassword" style="cursor:pointer;">
                                            <i class="bi bi-eye-fill"></i>
                                        </span>
                                    </div>
                                    <span id="confirm_password_error" class="error text-danger"></span>
                                </div>

                                <div class="mb-3">
                                    <div id="password-checklist" class="p-3 bg-light rounded shadow-sm border small" style="display: none;">
                                        <ul class="mb-0 list-unstyled">
                                            <li id="check-length" class="text-danger mb-1">
                                                ❌ At least 8 characters
                                            </li>
                                            <li id="check-uppercase" class="text-danger mb-1">
                                                ❌ At least 1 uppercase letter
                                            </li>
                                            <li id="check-lowercase" class="text-danger mb-1">
                                                ❌ At least 1 lowercase letter
                                            </li>
                                            <li id="check-number" class="text-danger mb-1">
                                                ❌ At least 1 number
                                            </li>
                                            <li id="check-special" class="text-danger mb-1">
                                                ❌ At least 1 special character
                                            </li>
                                            <li id="check-match" class="text-danger mb-1">
                                                ❌ Passwords do not match
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" id="backStap2" class="btn btn-secondary shadow-none" data-bs-target="#registerModalStep1"
                        data-bs-toggle="modal" data-bs-dismiss="modal"></i> Back
                    </button>
                    <button type="button" class="btn shadow-none text-white custom-bg" id="step2Next">
                        Create
                    </button>

                    <button id="loadingBtn" class="btn custom-bg shadow-none text-white" type="button" disabled style="display: none;">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Frogot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="frogotPassword">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center" id="staticBackdropLabel">Frogot Password</h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge bg-light text-dark me-3 text-wrap lh-base">
                            Note: A link will be send to your email to reset your password!
                        </span>

                        <div class="mb-4">
                            <label class="form-label">Email Address</label>
                            <input type="email" id="forgot_email" name="forgot_email" class="form-control shadow-none">
                            <span id="forgot_email_error" class="error"></span>
                        </div>

                        <div class="mb-2 text-end">
                            <button type="button" id="cancel_forgot" class="btn text-secondary shadow-none p-0" data-bs-toggle="modal"
                                data-bs-target="#loginModal" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button class="btn shadow-none text-white custom-bg" id="sendFrogotPassword">SEND LINK</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Mobile Number keyup
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
            // Name keypress
            $('#name').on('keypress', function(e) {
                const char = String.fromCharCode(e.which);
                if (!/[a-zA-Z\s]/.test(char)) {
                    e.preventDefault();
                }
            });

            $('#pincode').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);
            });

            const checkinCalendar = flatpickr("#dob", {
                dateFormat: "Y-m-d",
                maxDate: "today",
                clickOpens: true
            });

            // <<<--------- Submit Registration Form ------------->>>
            $('#step1Next').click(function(e) {
                e.preventDefault();
                $('.error').text('');
                let isValid = true;
                let name = $('#name').val();
                let email = $('#email').val();
                let number = $('#number').val();
                let address = $('#address').val();
                let pincode = $('#pincode').val();
                let dob = $('#dob').val();
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
                    $('#name_error').text("");
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
                    $('#email_error').text("");
                }

                // <<------- Check if email already exists ---------------->>
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('check-email-exists') ?>",
                    data: {
                        email: email
                    },
                    dataType: "json",
                    async: false,
                    success: function(response) {
                        if (response.exists) {
                            $('#email').addClass('is-invalid');
                            $('#email_error').text("This email is already registered.");
                            isValid = false;
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('#email_error').text("");
                        }
                    }
                });

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
                    $('#address_error').text("Please Enter your Address.");
                    isValid = false;
                    return false;
                } else {
                    $('#address').removeClass('is-invalid');
                    $('#address_error').text("");
                }

                if (pincode === "") {
                    $('#pincode').addClass('is-invalid');
                    $('#pincode_error').text("Please Enter Pin Number.");
                    isValid = false;
                    return false;
                } else if (!/^\d{6}$/.test(pincode)) {
                    $('#pincode').addClass('is-invalid');
                    $('#pincode_error').text("Pincode must be exactly 6 digits.");
                    isValid = false;
                    return false;
                } else {
                    $('#pincode').removeClass('is-invalid');
                    $('#pincode_error').text("");
                }

                if (dob === "") {
                    $('#dob').addClass('is-invalid');
                    $('#dob_error').text("please Select Date of birth.");
                    isValid = false;
                    return false;
                } else {
                    $('#dob').removeClass('is-invalid');
                    $('#dob_error').text("");
                }

                if (isValid) {
                    $('#registerModal').modal('hide');
                    $('#registerModalStep2').modal('show');
                } else {
                    return false;
                }
            });

            // <<---------- Step1 Back -------------->>
            $(document).on('click', '.step1Back', function() {
                $('#registration_from')[0].reset();
                $('#name').removeClass('is-invalid');
                $('#email').removeClass('is-invalid');
                $('#number').removeClass('is-invalid');
                $('#address').removeClass('is-invalid');
                $('#pincode').removeClass('is-invalid');
                $('#name_error').text("");
                $('#email_error').text("");
                $('#number_error').text("");
                $('#address_error').text("");
                $('#pincode_error').text("");
                $('#dob_error').text("");
                $('#dob').removeClass('is-invalid');
                $("#registration_from_stap2")[0].reset();
                $("#password-checklist").hide();
                $('#registerModalStep2').modal('hide');
                $('#registerModal').modal('show');
            });


            $(document).on('click', '#backStap2', function() {
                $('#registerModal').modal('show');
                $('#registerModalStep2').modal('hide');
            })

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

            function validatePasswordChecklist() {
                const password = $('#password').val();
                const confirmPassword = $('#confirm_password').val();
                if (password || confirmPassword) {
                    $('#password-checklist').slideDown();
                } else {
                    $('#password-checklist').slideUp();
                }
                const rules = {
                    '#check-length': [password.length >= 8, 'At least 8 characters'],
                    '#check-uppercase': [/[A-Z]/.test(password), 'At least 1 uppercase letter'],
                    '#check-lowercase': [/[a-z]/.test(password), 'At least 1 lowercase letter'],
                    '#check-number': [/[0-9]/.test(password), 'At least 1 number'],
                    '#check-special': [/[\W_]/.test(password), 'At least 1 special character'],
                    '#check-match': [password === confirmPassword && confirmPassword !== '', 'Passwords match']
                };
                $.each(rules, function(id, [isValid, message]) {
                    const icon = isValid ? '✅' : '❌';
                    const textClass = isValid ? 'text-success' : 'text-danger';

                    $(id).html(`${icon} ${message}`)
                        .removeClass('text-success text-danger')
                        .addClass(textClass);
                });
            }
            $('#password, #confirm_password').on('input', validatePasswordChecklist);

            $(document).on('click', '#step2Next', function(e) {

                let isValid = true;
                let password = $('#password').val();
                let confirm_password = $('#confirm_password').val();
                if (password.length < 8) {
                    $('#password').addClass('is-invalid');
                    $('#password_error').text("Password must be at least 8 characters.");
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

                if (isValid) {
                    $("#backStap2").hide();
                    $("#step2Next").hide();
                    $("#loadingBtn").show();
                    let formData = new FormData();
                    formData.append('name', $('#name').val());
                    formData.append('email', $('#email').val());
                    formData.append('number', $('#number').val());
                    formData.append('address', $('#address').val());
                    formData.append('pincode', $('#pincode').val());
                    formData.append('dob', $('#dob').val());
                    formData.append('password', $('#password').val());

                    let profileInput = $('#profile')[0];
                    if (profileInput.files.length > 0) {
                        formData.append('profile', profileInput.files[0]);
                    }
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url("user-registration") ?>",
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(response) {
                            if (response.status == true) {
                                $('#registerModalStep2').modal('hide');
                                $('#registration_from')[0].reset();
                                $("#registration_from_stap2")[0].reset();
                                $("#loadingBtn").hide();
                                $("#step2Next").show();
                                $("#success_modal_text").text(response.message);
                                $("#successButtonAdd").html(`<button type="button" class="btn text-white custom-bg shadow-none" id="gotoLogin">Go To Login</button>`);
                                $("#successModal").modal('show');
                            } else {
                                $("#loadingBtn").hide();
                                $("#step2Next").show();
                                $('#registerModalStep2').modal('hide');
                                $('#registration_from')[0].reset();
                                $("#registration_from_stap2")[0].reset();
                                $("#failed_modal_text").text("Something went wrong. Please try again.");
                                $("#failedModal").modal('show');
                            }
                        }
                    });
                }
            })

            // <<----------- Stap2 Back ---------------->>
            $(document).on('click', '.backStap2', function() {
                $('#registration_from')[0].reset();
                $("#registration_from_stap2")[0].reset();
            });

            $(document).on('click', '#gotoLogin', function() {
                $("#successModal").modal('hide');
                $("#loginModal").modal("show");
            });

            //  <<----------- Login ---------------->>
            $(document).on('click', "#login", function(e) {
                e.preventDefault();
                let isValid = true;
                let login_email = $("#loginEmail").val();
                let login_password = $("#loginPassword").val();
                if (login_email === "") {
                    $('#loginEmail').addClass('is-invalid');
                    $('#login_email_error').text("Please enter your Login email.");
                    isValid = false;
                    return false;
                } else if (!/^\S+@\S+\.\S+$/.test(login_email)) {
                    $('#loginEmail').addClass('is-invalid');
                    $('#login_email_error').text("Please enter a valid email Address.");
                    isValid = false;
                    return false;
                } else {
                    $('#loginEmail').removeClass('is-invalid');
                    $('#login_email_error').text("");
                }

                if (login_password == "") {
                    $('#loginPassword').addClass('is-invalid');
                    $('#login_password_error').text("Please enter your Login Password.");
                } else if (login_password.length < 8) {
                    $('#loginPassword').addClass('is-invalid');
                    $('#login_password_error').text("Password must be at least 8 characters.");
                    isValid = false;
                    return false;
                } else {
                    $('#loginPassword').removeClass('is-invalid');
                    $('#login_password_error').text("");
                }
                if (isValid) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url("user-login") ?>",
                        data: {
                            email: login_email,
                            password: login_password
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == true) {
                                $('#loginModal').modal('hide');
                                $('#loginFrom')[0].reset();
                                $("#success_modal_text").text(response.message);
                                $("#successButtonAdd").html(``);
                                $("#successModal").modal('show');
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            } else {
                                if (response.error == 'password') {
                                    $('#login_password_error').text(response.message);
                                } else if (response.error == 'email') {
                                    $('#login_email_error').text(response.message);
                                } else if (response.error == 'status' || response.error == 'is_verified') {
                                    $("#login_error_msg").removeClass('d-none').html(response.message);
                                } else {
                                    $("#failed_modal_text").text("Login failed. Try again.");
                                    $("#failedModal").modal('show');
                                }
                            }
                        }
                    });
                }
            })

            $(document).on("click", "#closeLogin", function() {
                $('#loginFrom')[0].reset();
                $('#login_email_error').text("");
                $('#login_password_error').text("");
                $('#login_error_msg').html("");
                $('#loginEmail').removeClass('is-invalid');
                $('#loginPassword').removeClass('is-invalid');
            })

            $(document).on('click', '#logoutBtn', function() {
                $.get("<?= base_url('user-logout') ?>", function() {
                    location.reload();
                });
            });


            // <<----------- Send Forgot Password Link ---------------->>
            $(document).on('click', "#sendFrogotPassword", function(e) {
                e.preventDefault();
                let isValid = true;
                let forgot_email = $("#forgot_email").val();

                if (forgot_email === "") {
                    $('#forgot_email').addClass('is-invalid');
                    $('#forgot_email_error').text("Please enter your login email.");
                    isValid = false;
                    return;
                } else if (!/^\S+@\S+\.\S+$/.test(forgot_email)) {
                    $('#forgot_email').addClass('is-invalid');
                    $('#forgot_email_error').text("Please enter a valid email address.");
                    isValid = false;
                    return;
                } else {
                    $('#forgot_email').removeClass('is-invalid');
                    $('#forgot_email_error').text("");
                }

                if (isValid) {
                    $("#cancel_forgot").hide();
                    let btn = $("#sendFrogotPassword");
                    let originalText = btn.html();
                    btn.prop("disabled", true).html(`
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...
                    `);

                    let current_page = window.location.href;
                    //  alert(current_page);

                    $.ajax({
                        type: "GET",
                        url: "<?= base_url("forgot-password") ?>",
                        data: {
                            email: forgot_email,
                            page: current_page
                        },
                        dataType: "json",
                        success: function(response) {
                            $("#forgot_email").val('');
                            $("#cancel_forgot").show();
                            btn.prop("disabled", false).html(originalText);
                            if (response.status == true) {
                                $('#forgotPasswordModal').modal('hide');
                                $("#success_modal_text").text(response.message);
                                $("#successButtonAdd").html(`<button type="button" class="btn text-white custom-bg shadow-none" data-bs-dismiss="modal">Close</button>`);
                                $("#successModal").modal('show');
                                setTimeout(function() {
                                    $("#successModal").modal('hide');
                                }, 5000);
                            } else {
                                if (response.error === 'verify_error') {
                                    $('#forgot_email_error').text(response.message).addClass('text-danger');
                                } else if (response.error === 'email') {
                                    $('#forgot_email_error').text(response.message).addClass('text-danger');
                                } else {
                                    $("#failed_modal_text").text("Something went wrong. Try again.");
                                    $("#failedModal").modal('show');
                                }
                            }
                        },
                        error: function() {
                            $("#cancel_forgot").show();
                            btn.prop("disabled", false).html(originalText);
                            $("#failed_modal_text").text("Request failed. Please try again.");
                            $("#failedModal").modal('show');
                        }
                    });
                }
            });
        });
    </script>