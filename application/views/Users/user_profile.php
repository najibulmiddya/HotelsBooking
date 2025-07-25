<div class="container">
    <div class="row">
        <!-- Page Heading -->
        <div class="col-12 my-2 mb-4 px-4">
            <h2 class="fw-bold">PROFILE</h2>
            <div style="font-size: 14px;">
                <a href="<?= base_url("home") ?>" class="text-secondary text-decoration-none">Home</a>
                <span class="text-secondary"> &gt; </span>
                <span class="active">Profile</span>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="col-12 px-4 mb-5">
            <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                <div class="row align-items-center">

                    <?php
                    $u_profile = !empty($user_data->profile)
                        ? USER_PROFILE_SITE_PATH . $user_data->profile
                        : 'https://via.placeholder.com/120x120.png?text=No+Image';
                    ?>

                    <div class="col-md-3 text-center mb-3 mb-md-0">
                        <div class="position-relative d-inline-block">
                            <img id="profilePreview"
                                src="<?= $u_profile ?>"
                                class="rounded-circle border shadow"
                                style="width: 120px; height: 120px; object-fit: cover; cursor: pointer;">

                            <button type="button" class="position-absolute bottom-0 end-0 custom-bg text-white px-1 py-0 rounded-circle"
                                style="cursor:pointer;" id="uploadProfilePhotoBtn" title="Change Photo">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </div>

                        <!-- Hidden File Upload Field -->
                        <div id="change_photo_div" class="d-none mt-2">
                            <form id="profilePhotoForm" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?= $user_data->id ?>">
                                <div>
                                    <input type="file" name="user_profilePhoto" id="user_profilePhoto" accept="image/jpeg,image/png" class="form-control form-control-sm shadow-none">
                                    <span class="text-danger" id="user_profilePhoto_error"></span>
                                </div>
                                <!-- Upload Button with Icon -->
                                <button type="submit" id="upload_btn" class="btn btn-sm text-white custom-bg mt-2 shadow-none">
                                    <i class="bi bi-cloud-upload me-1"></i> Upload
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="col-md-9">
                        <h4 class="fw-bold mb-1"><?= htmlspecialchars($user_data->name) ?></h4>
                        <p class="text-muted mb-2 d-flex align-items-center gap-2">
                            <?= htmlspecialchars($user_data->email) ?>
                            <button type="button" class="btn btn-sm custom-bg text-white shadow-none" id="editEmailBtn">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </p>

                        <div class="d-flex flex-wrap gap-3">
                            <span><strong>Phone:</strong> <?= htmlspecialchars($user_data->number) ?></span>
                            <span><strong>DOB:</strong> <?= date('d M Y', strtotime($user_data->dob)) ?></span>
                            <span><strong>Pincode:</strong> <?= htmlspecialchars($user_data->pincode) ?></span>
                        </div>
                        <p class="mt-2 mb-0"><strong>Address:</strong> <?= htmlspecialchars($user_data->address) ?></p>
                        <p class="mb-0"><strong>Joined On:</strong> <?= date('d M Y', strtotime($user_data->create_at)) ?></p>

                        <!-- Change Password Button -->
                        <div class="mt-3">
                            <button type="button" class="btn custom-bg text-white btn-sm shadow-none" id="changePasswordBtn">
                                <i class="bi bi-key"></i> Change Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Info (Optional Form - non-functional for now) -->
        <div class="col-12 px-4">
            <h5 class="fw-bold mb-0 bg-info p-3 text-white rounded d-flex align-items-center gap-2">
                <i class="bi bi-pencil-square me-2"></i> Edit Basic Information
            </h5>
            <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                <form id="profileUpdateForm">
                    <input type="hidden" name="user_id" value="<?= $user_data->id ?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="user_name" name="name" class="form-control shadow-none" value="<?= htmlspecialchars($user_data->name) ?>">
                            <small id="user_name_error" class="text-danger"></small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" id="user_phone" name="number" class="form-control shadow-none" value="<?= htmlspecialchars($user_data->number) ?>">
                            <small id="user_phone_error" class="text-danger"></small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <select name="dob_day" id="dob_day" class="form-control selectpicker shadow-none">
                                        <option value="">Day</option>
                                        <?php for ($i = 1; $i <= 31; $i++): ?>
                                            <option value="<?= $i ?>" <?= ($i == date('j', strtotime($user_data->dob))) ? 'selected' : '' ?>>
                                                <?= $i ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select name="dob_month" id="dob_month" class="form-control selectpicker shadow-none">
                                        <option value="">Month</option>
                                        <?php for ($i = 1; $i <= 12; $i++): ?>
                                            <option value="<?= $i ?>" <?= ($i == date('n', strtotime($user_data->dob))) ? 'selected' : '' ?>>
                                                <?= date('F', mktime(0, 0, 0, $i, 1)) ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="dob_year" id="dob_year" class="form-control selectpicker shadow-none">
                                        <option value="">Year</option>
                                        <?php for ($i = date('Y'); $i >= 1950; $i--): ?>
                                            <option value="<?= $i ?>" <?= ($i == date('Y', strtotime($user_data->dob))) ? 'selected' : '' ?>>
                                                <?= $i ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <small id="user_dob_error" class="text-danger"></small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="pincode" class="form-label">Pincode</label>
                            <input type="text" id="user_pincode" name="pincode" class="form-control shadow-none" value="<?= htmlspecialchars($user_data->pincode) ?>">
                            <small id="user_pincode_error" class="text-danger"></small>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea id="user_address" name="address" class="form-control shadow-none" rows="2"><?= htmlspecialchars($user_data->address) ?></textarea>
                            <small id="user_address_error" class="text-danger"></small>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn text-white shadow-none custom-bg">
                                <i class="bi bi-person-check me-1"></i> Update Profile
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <!-- Edit Email Modal -->
        <div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Header -->
                    <div class="modal-header custom-bg text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-envelope-at"></i> Update Email
                        </h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body">
                        <!-- Current Email Display -->
                        <div id="currentEmailSection">
                            <div class="mb-3">
                                <label class="form-label">Current Email</label>
                                <span class="form-control shadow-none"><?= $user_data->email ?></span>
                            </div>
                            <input type="hidden" id="user_id" value="<?= $user_data->id ?>">
                            <input type="hidden" id="current_email" value="<?= $user_data->email ?>">
                        </div>

                        <!-- Success Message -->
                        <p class="text-success d-none" id="otp_success"></p>

                        <!-- Email Update Form -->
                        <form id="editEmailForm">
                            <!-- OTP Field -->
                            <div class="d-none" id="otpSection">
                                <div class="mb-3">
                                    <label for="otp" class="form-label">OTP</label>
                                    <input type="text" id="otp" name="otp" class="form-control shadow-none">
                                    <small id="otp_error" class="text-danger"></small>
                                </div>
                            </div>

                            <!-- New Email Fields -->
                            <div class="d-none" id="emailEditFields">
                                <div class="mb-3">
                                    <label for="new_email" class="form-label">New Email</label>
                                    <input type="email" id="new_email" name="new_email" class="form-control shadow-none">
                                    <small class="text-danger" id="new_email_error"></small>
                                </div>

                                <div class="mb-3">
                                    <label for="confirm_email" class="form-label">Confirm Email</label>
                                    <input type="email" id="confirm_email" name="confirm_email" class="form-control shadow-none">
                                    <small class="text-danger" id="confirm_email_error"></small>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn custom-bg text-white shadow-none" id="sendEmailButton">
                            <i class="bi bi-send"></i> Send OTP
                        </button>
                        <button type="button" class="btn custom-bg text-white shadow-none d-none" id="resendOtpButton" disabled>
                            <i class="bi bi-arrow-repeat"></i> Resend OTP
                        </button>
                        <button type="submit" form="editEmailForm" class="btn btn-primary shadow-none d-none" id="updateEmailBtn">
                            <i class="bi bi-check2-circle"></i> Update Email
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Verify New Email OTP Modal -->
        <div class="modal fade" id="verifyNewEmailOtpModal" tabindex="-1" aria-labelledby="otpLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header custom-bg text-white">
                        <h5 class="modal-title"><i class="bi bi-shield-lock"></i> Verify New Email</h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <label class="form-label">Enter OTP sent to your new email</label>
                        <input type="text" id="new_email_otp" class="form-control shadow-none" maxlength="6">
                        <small class="text-danger" id="new_email_otp_error"></small>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn custom-bg text-white" id="verifyNewEmailOtpBtn">
                            <i class="bi bi-check2-circle"></i> Verify OTP
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Change Password Modal -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header custom-bg text-white">
                        <h5 class="modal-title"><i class="bi bi-key"></i> Change Password</h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="changePasswordForm">
                        <div class="modal-body">
                            <input type="hidden" name="user_id" value="<?= $user_data->id ?>">

                            <div class="mb-3">
                                <label for="user_current_password" class="form-label">Current Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control shadow-none" id="user_current_password" name="user_current_password">
                                    <span class="input-group-text custom-bg text-white" id="toggle_user_current_password" style="cursor:pointer;">
                                        <i class="bi bi-eye-fill"></i>
                                    </span>
                                </div>
                                <small class="text-danger" id="user_current_password_error"></small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control shadow-none" id="user_new_password" name="user_new_password">
                                    <span class="input-group-text custom-bg text-white" id="toggle_user_new_password" style="cursor:pointer;">
                                        <i class="bi bi-eye-fill"></i>
                                    </span>
                                </div>
                                <small class="text-danger" id="user_new_password_error"></small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control shadow-none" id="user_confirm_password" name="user_confirm_password">
                                    <span class="input-group-text custom-bg text-white " id="toggle_user_confirm_password" style="cursor:pointer;">
                                        <i class="bi bi-eye-fill"></i>
                                    </span>
                                </div>
                                <small class="text-danger" id="user_confirm_password_error"></small>
                            </div>

                            <div id="user_password_checklist" class="p-3 bg-light rounded shadow-sm border small d-none">
                                <ul class="mb-0 list-unstyled">
                                    <li id="pas_check-length">❌ At least 8 characters</li>
                                    <li id="pas_check-uppercase">❌ At least 1 uppercase letter</li>
                                    <li id="pas_check-lowercase">❌ At least 1 lowercase letter</li>
                                    <li id="pas_check-check-number">❌ At least 1 number</li>
                                    <li id="pas_check-special">❌ At least 1 special character</li>
                                    <li id="pas_check-match">❌ Passwords do not match</li>
                                </ul>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn custom-bg text-white shadow-none">
                                <i class="bi bi-check2-circle"></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>

<script>
    $(document).ready(function() {
        // Phone number keyup
        $('#user_phone').on('keyup', function() {
            let number = $(this).val();
            number = number.replace(/\D/g, '');
            if (number.length > 10) {
                number = number.substring(0, 10);
            }
            $(this).val(number);
            if (number.length !== 10) {
                $('#user_phone').addClass('is-invalid');
                $('#user_phone_error').text("Phone number must be exactly 10 digits.");
            } else {
                $('#user_phone').removeClass('is-invalid');
                $('#user_phone_error').text("");
            }
        });

        // Pincode input limit
        $('#user_pincode').on('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 6);
        });

        $('#user_name').on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[a-zA-Z\s]/.test(char)) {
                e.preventDefault();
            }
        });

        //    user Basic Information form 
        $('#profileUpdateForm').on('submit', function(e) {
            e.preventDefault();
            let isValid = true;
            const name = $('#user_name').val();
            const number = $('#user_phone').val();
            const day = $('#dob_day').val();
            const month = $('#dob_month').val();
            const year = $('#dob_year').val();
            const pincode = $('#user_pincode').val();
            const address = $('user_#address').val();
            const nameRegex = /^[A-Za-z\s]+$/;

            // Name validation
            if (name === '' || !nameRegex.test(name)) {
                $('#user_name').addClass('is-invalid');
                $('#user_name_error').text('Enter a valid name.');
                isValid = false;
            } else {
                $('#user_name').removeClass('is-invalid');
                $('#user_name_error').text('');
            }

            // Phone number validation
            if (!/^\d{10}$/.test(number)) {
                $('#user_phone').addClass('is-invalid');
                $('#user_phone_error').text('Enter a valid 10-digit phone number.');
                isValid = false;
            } else {
                $('#user_phone').removeClass('is-invalid');
                $('#user_phone_error').text('');
            }

            // DOB validation
            if (!day || !month || !year) {
                $('#user_dob_error').text('Please select full date of birth.');
                isValid = false;
            } else {
                $('#user_dob_error').text('');  
            }

            // Pincode
            if (!/^\d{6}$/.test(pincode)) {
                $('#user_pincode').addClass('is-invalid');
                $('#user_pincode_error').text('Enter a valid 6-digit pincode.');
                isValid = false;
            } else {
                $('#user_pincode').removeClass('is-invalid');
                $('#user_pincode_error').text('');
            }

            // Address
            if (address === '') {
                $('#user_address').addClass('is-invalid');
                $('#user_address_error').text('Please enter your address.');
                isValid = false;
            } else {
                $('#user_address').removeClass('is-invalid');
                $('#user_address_error').text('');
            }

            // Submit if valid
            if (isValid) {
                $.ajax({
                    url: '<?= base_url("user/update-profile") ?>',
                    method: 'POST',
                    data: $('#profileUpdateForm').serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === true) {
                            $('#success_modal_text').text(response.message);
                            $('#successModal').modal('show');
                            setTimeout(function() {
                                $('#successModal').modal('hide');
                                location.reload();
                            }, 3000);
                        } else {
                            $('#failed_modal_text').text(response.message);
                            $('#failedModal').modal('show');
                        }
                    },
                    error: function() {
                        alert('Server error. Please try again later.');
                    }
                });
            }
        });

        // Show upload form on pencil button click
        $('#uploadProfilePhotoBtn').on('click', function(e) {
            e.preventDefault();
            $('#change_photo_div').removeClass('d-none').hide().slideDown();
        });

        // Handle form submit
        $('#profilePhotoForm').on('submit', function(e) {
            e.preventDefault();

            const fileInput = $('#user_profilePhoto')[0];
            const file = fileInput.files[0];
            const errorSpan = $('#user_profilePhoto_error');
            errorSpan.text('');

            if (!file) {
                errorSpan.text('Please select a profile photo.');
                return;
            }

            const allowedTypes = ['image/jpeg', 'image/png'];
            const maxSize = 2 * 1024 * 1024; // 2MB

            if (!allowedTypes.includes(file.type)) {
                errorSpan.text('Only JPG or PNG files are allowed.');
                return;
            }

            if (file.size > maxSize) {
                errorSpan.text('Image must be under 2MB.');
                return;
            }

            const formData = new FormData(this);

            $.ajax({
                url: '<?= base_url("user/upload-profile-photo") ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#upload_btn').prop('disabled', true).text('Uploading...');
                },
                success: function(res) {
                    $('#upload_btn').prop('disabled', false).text('Upload');
                    if (res.status == true) {
                        errorSpan.html(`<span class="text-success">${res.message}</span>`);
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        errorSpan.text(res.message || 'Upload failed.');
                    }

                },
                error: function() {
                    $('#upload_btn').prop('disabled', false).text('Upload');
                    errorSpan.text('Server error. Please try again.');
                }
            });
        });

        // Show modal and reset UI
        $('#editEmailBtn').on('click', function() {
            $('#editEmailModal').modal('show');
            $('#otpSection, #emailEditFields').addClass('d-none');
            $('#sendEmailButton').removeClass('d-none').attr('disabled', false);
            $('#resendOtpButton').addClass('d-none').attr('disabled', true);
            $('#updateEmailBtn').addClass('d-none');
            $('#otp_success').addClass('d-none').text('');
            $('#otp_error, #new_email_error, #confirm_email_error').text('');
            $('#editEmailForm')[0].reset();
        });

        // Send OTP
        $('#sendEmailButton').on('click', function(e) {
            e.preventDefault();
            const currentEmail = $('#current_email').val();

            $.ajax({
                url: '<?= base_url("user/send-email-otp") ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    current_email: currentEmail
                },
                beforeSend: function() {
                    $('#sendEmailButton').html('<i class="bi bi-hourglass-split"></i> Sending...').attr('disabled', true);
                },
                success: function(res) {
                    if (res.status) {
                        $('#otpSection').removeClass('d-none');
                        $('#resendOtpButton').removeClass('d-none');
                        $('#sendEmailButton').addClass('d-none');
                        $('#otp_success').removeClass('d-none').text(res.message);
                        enableResendOtpAfterDelay();
                    } else {
                        alert(res.message || "Failed to send OTP.");
                    }
                },
                error: function() {
                    alert("Server error. Please try again.");
                },
                complete: function() {
                    $('#sendEmailButton').html('<i class="bi bi-send"></i> Send OTP').attr('disabled', false);
                }
            });
        });

        // Resend OTP
        $('#resendOtpButton').on('click', function() {
            const currentEmail = $('#current_email').val();

            $.ajax({
                url: '<?= base_url("user/send-email-otp") ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    current_email: currentEmail
                },
                beforeSend: function() {
                    $('#resendOtpButton').html('<i class="bi bi-clock-history"></i> Sending...').attr('disabled', true);
                },
                success: function(res) {
                    if (res.status) {
                        $('#otp_success').removeClass('d-none').text(res.message);
                        $('#otp_error').text('');
                        $('#otp').val('');
                        enableResendOtpAfterDelay();
                    } else {
                        $('#otp_success').addClass('d-none');
                        alert(res.message);
                    }
                },
                error: function() {
                    alert('Failed to resend OTP. Please try again.');
                }
            });
        });

        // Verify OTP on input
        $('#otp').on('input', function() {
            const otp = $(this).val().trim();
            const $otpError = $('#otp_error');
            const $emailEditFields = $('#emailEditFields');
            const $updateEmailBtn = $('#updateEmailBtn');

            $otpError.removeClass('text-danger text-success').text('');

            if (/^\d{6}$/.test(otp)) {
                $.ajax({
                    url: '<?= base_url("user/verify-email-otp") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        otp
                    },
                    success: function(res) {
                        if (res.status) {
                            $otpError.addClass('text-success').text(res.message);
                            $emailEditFields.removeClass('d-none');
                            $updateEmailBtn.removeClass('d-none');
                            $('#sendEmailButton, #resendOtpButton').addClass('d-none');
                        } else {
                            $otpError.addClass('text-danger').text(res.message);
                            $emailEditFields.addClass('d-none');
                            $updateEmailBtn.addClass('d-none');
                            $('#resendOtpButton').removeClass('d-none').attr('disabled', false);
                        }
                    },
                    error: function() {
                        $otpError.addClass('text-danger').text('Server error. Please try again.');
                        $emailEditFields.addClass('d-none');
                        $updateEmailBtn.addClass('d-none');
                        $('#resendOtpButton').removeClass('d-none').attr('disabled', false);
                    }
                });
            } else {
                $otpError.addClass('text-danger').text('OTP must be exactly 6 digits.');
                $emailEditFields.addClass('d-none');
                $updateEmailBtn.addClass('d-none');
            }
        });

        // Enable Resend OTP After Delay
        function enableResendOtpAfterDelay() {
            const $btn = $('#resendOtpButton');
            $btn.removeClass('d-none').attr('disabled', true).html('<i class="bi bi-clock"></i> Resend in 60s');
            let countdown = 60;

            const timer = setInterval(() => {
                countdown--;
                $btn.html(`<i class="bi bi-clock"></i> Resend in ${countdown}s`);
                if (countdown <= 0) {
                    clearInterval(timer);
                    $btn.attr('disabled', false).html('<i class="bi bi-arrow-repeat"></i> Resend OTP');
                }
            }, 1000);
        }

        // new email update function 
        $('#updateEmailBtn').on('click', function(e) {
            e.preventDefault();
            const newEmail = $('#new_email').val().trim();
            const confirmEmail = $('#confirm_email').val().trim();

            $('#new_email_error, #confirm_email_error').text('');
            // Simple validation
            let hasError = false;

            if (!newEmail) {
                $('#new_email_error').text('New email is required.');
                hasError = true;
            } else if (!validateEmail(newEmail)) {
                $('#new_email_error').text('Please enter a valid email.');
                hasError = true;
            }
            if (!confirmEmail) {
                $('#confirm_email_error').text('Please confirm your new email.');
                hasError = true;
            } else if (newEmail !== confirmEmail) {
                $('#confirm_email_error').text('Email addresses do not match.');
                hasError = true;
            }

            if (hasError) return;

            // Submit to server
            $.ajax({
                url: '<?= base_url("user/update-email") ?>', // Adjust endpoint if needed
                type: 'POST',
                dataType: 'json',
                data: {
                    new_email: newEmail,
                    confirm_email: confirmEmail,
                },
                beforeSend: function() {
                    $('#updateEmailBtn')
                        .html('<i class="bi bi-arrow-repeat"></i> Updating...')
                        .attr('disabled', true);
                },
                success: function(res) {
                    if (res.status === true) {
                        $('#editEmailModal').modal('hide'); // Hide the edit modal
                        $('#verifyNewEmailOtpModal').modal('show'); // Show OTP verification modal
                        $('#success_modal_text').text(res.message);
                        $('#successModal').modal('show');

                        // Clear OTP field in case it's old
                        $('#new_email_otp').val('');
                        $('#new_email_otp_error').text('');
                    } else {
                        $("#failure_modal_text").text(res.message || 'Failed to update email.');
                        $('#failureModal').modal('show');
                    }
                },
                error: function() {
                    alert('Server error. Please try again later.');
                },
                complete: function() {
                    $('#updateEmailBtn')
                        .html('<i class="bi bi-check2-circle"></i> Update Email')
                        .attr('disabled', false);
                }
            });
        });

        // Utility: Validate email format
        function validateEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        // new email verify function 
        $('#verifyNewEmailOtpBtn').on('click', function(e) {
            e.preventDefault();
            const otp = $('#new_email_otp').val().trim();
            $('#new_email_otp_error').text('');

            if (!otp || otp.length !== 6 || !/^\d+$/.test(otp)) {
                $('#new_email_otp_error').text('Enter a valid 6-digit OTP.');
                return;
            }

            $.ajax({
                url: '<?= base_url("user/verify-new-email-otp") ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    otp: otp
                },
                beforeSend: function() {
                    $('#verifyNewEmailOtpBtn').html('<i class="bi bi-shield-check"></i> Verifying...').attr('disabled', true);
                },
                success: function(res) {
                    if (res.status) {
                        $('#verifyNewEmailOtpModal').modal('hide');
                        $('#success_modal_text').text(res.message);
                        $('#successModal').modal('show');
                        // Optionally reload
                        setTimeout(() => {
                            $('#successModal').modal('hide');
                            location.reload();
                        }, 2000);
                    } else {
                        $('#new_email_otp_error').text(res.message);
                    }
                },
                error: function() {
                    $('#new_email_otp_error').text('Server error. Try again later.');
                },
                complete: function() {
                    $('#verifyNewEmailOtpBtn').html('<i class="bi bi-check2-circle"></i> Verify OTP').attr('disabled', false);
                }
            });
        });

        // Show Change Password modal and reset form fields and checklist
        $('#changePasswordBtn').on('click', function() {
            $('#changePasswordModal').modal('show');
            $('#changePasswordForm')[0].reset();
            $('#user_password_checklist').addClass('d-none');
            $('.text-danger').text('');
        });

        // Toggle current Password Visibility
        $('#toggle_user_current_password').on('click', function() {
            const input = $('#user_current_password');
            const icon = $(this).find('i');
            input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            icon.toggleClass('bi-eye-fill bi-eye-slash-fill');
        });

        // Toggle Password Visibility
        $('#toggle_user_new_password').on('click', function() {
            const input = $('#user_new_password');
            const icon = $(this).find('i');
            input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            icon.toggleClass('bi-eye-fill bi-eye-slash-fill');
        });
        // Toggle Confirm Password Visibility
        $('#toggle_user_confirm_password').on('click', function() {
            const input = $('#user_confirm_password');
            const icon = $(this).find('i');
            input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            icon.toggleClass('bi-eye-fill bi-eye-slash-fill');
        });

        // Password Rules
        function user_validatePasswordChecklist() {
            const newPass = $('#user_new_password').val();
            const confirmPass = $('#user_confirm_password').val();

            $('#user_password_checklist').toggleClass('d-none', !(newPass || confirmPass));

            const rules = {
                '#pas_check-length': [newPass.length >= 8, 'At least 8 characters'],
                '#pas_check-uppercase': [/[A-Z]/.test(newPass), 'At least 1 uppercase letter'],
                '#pas_check-lowercase': [/[a-z]/.test(newPass), 'At least 1 lowercase letter'],
                '#pas_check-check-number': [/\d/.test(newPass), 'At least 1 number'],
                '#pas_check-special': [/[\W_]/.test(newPass), 'At least 1 special character'],
                '#pas_check-match': [newPass === confirmPass && confirmPass !== '', 'Passwords match']
            };

            $.each(rules, function(selector, [valid, msg]) {
                $(selector)
                    .text((valid ? '✅ ' : '❌ ') + msg)
                    .removeClass('text-danger text-success')
                    .addClass(valid ? 'text-success' : 'text-danger');
            });
        }

        $('#user_new_password, #user_confirm_password').on('input', user_validatePasswordChecklist);

        // Change Password Submit Handler
        $('#changePasswordForm').on('submit', function(e) {
            e.preventDefault();

            const currentPassword = $('#user_current_password').val().trim();
            const newPassword = $('#user_new_password').val().trim();
            const confirmPassword = $('#user_confirm_password').val().trim();
            $('.text-danger').text('');

            let valid = true;

            if (!currentPassword) {
                $('#user_current_password_error').text('Current password is required.');
                valid = false;
                return false;
            } else if (currentPassword.length < 8) {
                $('#user_current_password_error').text('Current password must be at least 8 characters.');
                valid = false;
                return false;
            }
            if (!newPassword) {
                $('#user_new_password_error').text('New password is required.');
                valid = false;
                return false;
            } else if (newPassword.length < 8) {
                $('#user_new_password_error').text('Password must be at least 8 characters.');
                valid = false;
                return false;
            }
            if (!confirmPassword) {
                $('#user_confirm_password_error').text('Please confirm your new password.');
                valid = false;
                return false;
            } else if (newPassword !== confirmPassword) {
                $('#user_confirm_password_error').text('Passwords do not match.');
                valid = false;
                return false;
            }

            if (!valid) return;

            $.ajax({
                url: '<?= base_url("user/change-password") ?>',
                type: 'POST',
                dataType: 'json',
                data: $('#changePasswordForm').serialize(),
                beforeSend: function() {
                    $('#changePasswordForm button[type="submit"]').html('<i class="bi bi-arrow-repeat"></i> Updating...').attr('disabled', true);
                },
                success: function(res) {
                    if (res.status) {
                        $('#changePasswordModal').modal('hide');
                        $('#success_modal_text').text(res.message);
                        $('#successModal').modal('show');
                        setTimeout(() => $('#successModal').modal('hide'), 2000);
                    } else {
                        if (res.errors) {
                            $('#user_current_password_error').text(res.errors.user_current_password || '');
                            $('#user_new_password_error').text(res.errors.user_new_password || '');
                            $('#user_confirm_password_error').text(res.errors.user_confirm_password || '');
                        } else {
                            $('#user_current_password_error').text(res.message || 'Failed to change password.');
                        }
                    }
                },
                error: function() {
                    $('#user_current_password_error').text('Server error. Please try again.');
                },
                complete: function() {
                    $('#changePasswordForm button[type="submit"]').html('<i class="bi bi-check2-circle"></i> Update Password').attr('disabled', false);
                }
            });
        });


    });
</script>