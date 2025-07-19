<div class="container">
    <div class="row">

        <!-- Page Heading -->
        <div class="col-12 my-5 mb-4 px-4">
            <h2 class="fw-bold">PROFILE</h2>
            <div style="font-size: 14px;">
                <a href="<?= base_url("home") ?>" class="text-secondary text-decoration-none">Home</a>
                <span class="text-secondary"> &gt; </span>
                <span class="text-secondary">Profile</span>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="col-12 px-4 mb-5">
            <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                <div class="row align-items-center">
                    <!-- Profile Image -->
                    <!-- <div class="col-md-3 text-center mb-3 mb-md-0">
                        <img src="<?= USER_PROFILE_SITE_PATH . $user_data->profile ?>"
                            alt="Profile Photo"
                            class="rounded-circle border shadow"
                            style="width: 120px; height: 120px; object-fit: cover;">
                    </div> -->


                    <div class="col-md-3 text-center mb-3 mb-md-0">
                        <div class="position-relative d-inline-block">
                            <img id="profilePreview"
                                src="<?= USER_PROFILE_SITE_PATH . $user_data->profile ?>"
                                alt="Profile Photo"
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
                        <p class="text-muted mb-2"><?= htmlspecialchars($user_data->email) ?></p>
                        <div class="d-flex flex-wrap gap-3">
                            <span><strong>Phone:</strong> <?= htmlspecialchars($user_data->number) ?></span>
                            <span><strong>DOB:</strong> <?= date('d M Y', strtotime($user_data->dob)) ?></span>
                            <span><strong>Pincode:</strong> <?= htmlspecialchars($user_data->pincode) ?></span>
                        </div>
                        <p class="mt-2 mb-0"><strong>Address:</strong> <?= htmlspecialchars($user_data->address) ?></p>
                        <p class="mb-0"><strong>Joined On:</strong> <?= date('d M Y', strtotime($user_data->create_at)) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Info (Optional Form - non-functional for now) -->
        <div class="col-12 px-4">
            <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                <form id="profileUpdateForm">
                    <input type="hidden" name="user_id" value="<?= $user_data->id ?>">

                    <h5 class="mb-3 fw-bold">Edit Basic Information</h5>

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
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" id="usrs_dob" name="dob" class="form-control shadow-none" value="<?= $user_data->dob ?>">
                            <small id="usrS_dob_error" class="text-danger"></small>
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

        $('#profileUpdateForm').on('submit', function(e) {
            e.preventDefault();

            let isValid = true;

            const name = $('#user_name').val();
            const number = $('#user_phone').val();
            const dob = $('#user_dob').val();
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

            // DOB
            if (dob === '') {
                $('#user_dob').addClass('is-invalid');
                $('#user_dob_error').text('Please select your date of birth.');
                isValid = false;
            } else {
                $('#user_dob').removeClass('is-invalid');
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









    });
</script>