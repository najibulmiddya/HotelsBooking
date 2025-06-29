<!-- Footer -->
<?php
// pp($_SESSION['data']);
if ($data = $this->session->userdata('data')) {
}
?>
<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4 custom-shadow">
            <h3 class="h-font fw-bold fs-3 mb-2"><?= $data['site_title'] ?></h3>
            <p>
                <?= $data['site_about'] ?>
            </p>
        </div>
        <div class="col-lg-4 p-4 custom-shadow">
            <h5 class="mb-2">Links</h5>
            <a href="home" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
            <a href="" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
            <a href="" class="d-inline-block mb-2 text-dark text-decoration-none">Facilites</a><br>
            <a href="<?= base_url('contact') ?>" class="d-inline-block mb-2 text-dark text-decoration-none">Contact us</a><br>
            <a href="<?= base_url('about') ?>" class="d-inline-block mb-2 text-dark text-decoration-none ">About</a>
        </div>

        <div class="col-lg-4 p-4 custom-shadow">
            <h5 class="mb-3">Follow us</h5>
            <a class="d-inline-block mb-2 text-dark text-decoration-none" href="<?= $data['twitter']; ?>">
                <i class="bi bi-twitter me-1"></i> Twitter</a><br>

            <a class="d-inline-block mb-2 text-dark text-decoration-none" href="<?= $data['facebook']; ?>">
                <i class="bi bi-facebook me-1"></i> Facebook</a><br>

            <a class="d-inline-block text-dark text-decoration-none" href="<?= $data['instagram']; ?>">
                <i class="bi bi-instagram me-1"></i> Instagram</a><br>
        </div>
    </div>
</div>

<h6 class="text-center bg-dark text-white p-3 m-0">Designed and Developed by Najibul Middya ||
    <a href="#" class="text-decoration-none">
        <i class="bi bi-instagram me-1"></i>najibul_middya
    </a>
</h6>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-success">
            <div class="modal-header custom-bg text-white">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i id="success_icon" class="bi bi-check-circle"></i>
                <p id="success_modal_text"></p>
            </div>
            <div class="modal-footer" id="successButtonAdd">

            </div>
        </div>
    </div>
</div>

<!-- Failed Modal -->
<div class="modal fade" id="failedModal" tabindex="-1" aria-labelledby="failedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="failedModalLabel"><i class="bi bi-exclamation-triangle-fill me-2"></i>Failed</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body  text-center">
                <i id="failed_icon" class="bi bi-x-circle-fill"></i>
                <p id="failed_modal_text"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger shadow-none" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="resetPasswordForm">
                <div class="modal-header">
                    <h5 class="modal-title">Set up new Password</h5>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="reset_token" name="reset_token">
                    <input type="hidden" id="reset_email" name="reset_email">

                    <!-- New Password -->
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="password" id="new_password" name="new_password" class="form-control shadow-none" placeholder="New Password">
                            <span class="input-group-text" id="newtogglePassword" style="cursor:pointer;">
                                <i class="bi bi-eye-fill"></i>
                            </span>
                        </div>
                        <span id="newpassword_error" class="error text-danger"></span>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="password" id="newconfirm_password" name="confirm_password" class="form-control shadow-none" placeholder="Confirm Password">
                            <span class="input-group-text" id="newtoggleConfirmPassword" style="cursor:pointer;">
                                <i class="bi bi-eye-fill"></i>
                            </span>
                        </div>
                        <span id="newconfirm_password_error" class="error text-danger"></span>
                    </div>

                    <!-- Password Checklist -->
                    <div class="mb-3">
                        <div id="newpassword-checklist" class="p-3 bg-light rounded shadow-sm border small" style="display: none;">
                            <ul class="mb-0 list-unstyled">
                                <li id="newcheck-length" class="text-danger mb-1">❌ At least 8 characters</li>
                                <li id="newcheck-uppercase" class="text-danger mb-1">❌ At least 1 uppercase letter</li>
                                <li id="newcheck-lowercase" class="text-danger mb-1">❌ At least 1 lowercase letter</li>
                                <li id="newcheck-number" class="text-danger mb-1">❌ At least 1 number</li>
                                <li id="newcheck-special" class="text-danger mb-1">❌ At least 1 special character</li>
                                <li id="newcheck-match" class="text-danger mb-1">❌ Passwords do not match</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Submit -->
                    <div class="text-end">
                        <button id="update_password" class="btn custom-bg shadow-none text-white">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Login check Alert Modal -->
<div class="modal fade" id="loginAlertModal" tabindex="-1" aria-labelledby="loginAlertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="loginAlertModalLabel"><i class="bi bi-exclamation-triangle-fill"></i> Login Required</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                You need to be logged in to book a room.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn custom-bg text-white shadow-none"
                    data-bs-dismiss="modal"
                    data-bs-toggle="modal"
                    data-bs-target="#loginModal">
                    Login New
                </button>

            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // Helper to get URL parameter
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }
        const resetToken = getQueryParam("reset-token");
        const email = getQueryParam("email");

        if (resetToken && email) {
            // Verify token via backend
            $.ajax({
                type: "GET",
                url: "<?= base_url('check-reset-token') ?>",
                data: {
                    token: resetToken,
                    email: email
                },
                dataType: "json",
                success: function(res) {
                    if (res.status === true) {
                        $("#reset_token").val(resetToken);
                        $("#reset_email").val(email);
                        $("#resetPasswordModal").modal("show");

                    } else {
                        $("#failed_modal_text").text(res.message);
                        $("#failedModal").modal('show');
                        setTimeout(function() {
                            const cleanUrl = window.location.origin + window.location.pathname;
                            window.location.href = cleanUrl;
                        }, 5000);
                    }
                },
                error: function() {
                    alert("Something went wrong while checking reset token.");
                }
            });
        }

        // Toggle Password Visibility
        $('#newtogglePassword').on('click', function() {
            const input = $('#new_password');
            const icon = $(this).find('i');
            input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            icon.toggleClass('bi-eye-fill bi-eye-slash-fill');
        });

        $('#newtoggleConfirmPassword').on('click', function() {
            const input = $('#newconfirm_password');
            const icon = $(this).find('i');
            input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            icon.toggleClass('bi-eye-fill bi-eye-slash-fill');
        });

        // Live Password Validation
        function newvalidatePasswordChecklist() {
            const newpassword = $('#new_password').val();
            const newconfirmPassword = $('#newconfirm_password').val();

            if (newpassword || newconfirmPassword) {
                $('#newpassword-checklist').slideDown();
            } else {
                $('#newpassword-checklist').slideUp();
            }

            const rules = {
                '#newcheck-length': [newpassword.length >= 8, 'At least 8 characters'],
                '#newcheck-uppercase': [/[A-Z]/.test(newpassword), 'At least 1 uppercase letter'],
                '#newcheck-lowercase': [/[a-z]/.test(newpassword), 'At least 1 lowercase letter'],
                '#newcheck-number': [/[0-9]/.test(newpassword), 'At least 1 number'],
                '#newcheck-special': [/[\W_]/.test(newpassword), 'At least 1 special character'],
                '#newcheck-match': [newpassword === newconfirmPassword && newconfirmPassword !== '', 'Passwords match']
            };

            $.each(rules, function(id, ruleData) {
                const isValid = ruleData[0];
                const message = ruleData[1];
                const icon = isValid ? '✅' : '❌';
                const textClass = isValid ? 'text-success' : 'text-danger';

                $(id).html(`${icon} ${message}`)
                    .removeClass('text-success text-danger')
                    .addClass(textClass);
            });
        }

        $('#new_password, #newconfirm_password').on('input', newvalidatePasswordChecklist);

        // <<---------------New password Update ------------>>
        $(document).on('click', '#update_password', function(e) {
            e.preventDefault();

            let isValid = true;
            let password = $('#new_password').val().trim();
            let confirmPassword = $('#newconfirm_password').val().trim();
            let email = $('#reset_email').val();
            let token = $('#reset_token').val();

            if (password.length < 8) {
                $('#new_password').addClass('is-invalid');
                $('#newpassword_error').text("Password must be at least 8 characters.");
                isValid = false;
                return false;
            } else {
                $('#new_password').removeClass('is-invalid');
                $('#newpassword_error').text("");
            }

            if (password !== confirmPassword) {
                $('#newconfirm_password').addClass('is-invalid');
                $('#newconfirm_password_error').text("Passwords do not match.");
                isValid = false;
                return false;
            } else {
                $('#newconfirm_password').removeClass('is-invalid');
                $('#newconfirm_password_error').text("");
            }

            if (isValid) {
                let btn = $("#update_password");
                let originalText = btn.html();
                btn.prop("disabled", true).html(`
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...
                    `);

                // Send AJAX request
                $.ajax({
                    url: "<?= base_url('update-password') ?>",
                    method: 'POST',
                    data: {
                        reset_email: email,
                        reset_token: token,
                        new_password: password
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === true) {
                            btn.prop("disabled", false).html(originalText);
                            $('#new_password').val("");
                            $('#newconfirm_password').val("");
                            $('#reset_email').val("");
                            $('#reset_token').val("");
                            $('#resetPasswordModal').modal('hide');
                            $('#resetPasswordForm')[0].reset();
                            $("#success_modal_text").text(res.message);
                            $("#successButtonAdd").html(``);
                            $("#successModal").modal('show');
                            setTimeout(function() {
                                const cleanUrl = window.location.origin + window.location.pathname;
                                window.location.href = cleanUrl;
                            }, 5000);

                        } else {
                            $("#failed_modal_text").text(res.message);
                            $("#failedModal").modal('show');
                        }
                    },
                    error: function() {
                        btn.prop("disabled", false).html(originalText);
                        $('#newpassword_error').text('Server error. Please try again.');
                    }
                });
            }
        });
    });

    // Check Login and Room booking
    function checkLoginToBook(isLoggedIn, roomId) {
        if (isLoggedIn == 1) {
            let base_url ="<?=base_url('');?>"
            window.location.href = base_url + 'booking/room/' + roomId;
        } else {
            $('#loginAlertModal').modal('show');
        }
    }
</script>
<!-- Bootstrap Js -->
<?php require(APPPATH . 'views/users/include/scripts.php'); ?>
<!-- Custom js -->
<script src="<?= base_url('assets/js/swiper/custom.js') ?>"></script>
</body>

</html>