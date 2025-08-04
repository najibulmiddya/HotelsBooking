<h3 class="mb-3">
    <i class="bi bi-gear-fill me-2 text-primary"></i> SETTINGS
</h3>

<!-- General Settings Card -->
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 text-dark">
                <i class="bi bi-sliders me-1 text-secondary"></i> General Settings
            </h5>
            <button type="button" class="btn btn-outline-primary shadow-none" data-bs-toggle="modal" data-bs-target="#general-s">
                <i class="bi bi-pencil-square me-1"></i> Edit
            </button>
        </div>

        <!-- Site Title -->
        <div class="mb-3">
            <h6 class="fw-semibold text-muted mb-1">Site Title</h6>
            <p class="mb-0 text-dark" id="site_title">...</p>
        </div>

        <!-- About Us -->
        <div>
            <h6 class="fw-semibold text-muted mb-1">About Us</h6>
            <p class="mb-0 text-dark" id="site_about">...</p>
        </div>
    </div>
</div>
<!-- General Settings Card Section End -->

<!-- Shutdown Website Section -->
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0 text-danger">
                <i class="bi bi-power me-2"></i> Shutdown Website
            </h5>
            <div class="form-check form-switch form-switch-lg">
                <input class="form-check-input btn-lg" type="checkbox" id="shutdown-toggle">
            </div>
        </div>
        <p class="mb-0 text-muted small">
            Enabling shutdown mode will prevent customers from booking hotel rooms.
        </p>
    </div>
</div>

<!-- Contact Us Settings Section -->
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">
                <i class="bi bi-geo-alt-fill text-primary me-2"></i> Contact Us Settings
            </h5>
            <button type="button" class="btn  btn-outline-primary shadow-none" data-bs-toggle="modal" data-bs-target="#contacts-s">
                <i class="bi bi-pencil-square me-1"></i> Edit
            </button>
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-6">
                <div class="mb-4">
                    <h6 class="fw-bold mb-1">Address</h6>
                    <p class="text-muted mb-0" id="address"></p>
                </div>
                <div class="mb-4">
                    <h6 class="fw-bold mb-1">Google Map</h6>
                    <p class="text-muted mb-0" id="gmap"></p>
                </div>
                <div class="mb-4">
                    <h6 class="fw-bold mb-1">Phone Numbers</h6>
                    <p class="mb-1 text-muted">
                        <i class="bi bi-telephone-fill me-1"></i><span id="pn1"></span>
                    </p>
                    <p class="text-muted">
                        <i class="bi bi-telephone-fill me-1"></i><span id="pn2"></span>
                    </p>
                </div>
                <div class="mb-4">
                    <h6 class="fw-bold mb-1">Email</h6>
                    <p class="text-muted mb-0" id="email"></p>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-6">
                <div class="mb-4">
                    <h6 class="fw-bold mb-1">Social Links</h6>
                    <p class="mb-1 text-muted">
                        <i class="bi bi-twitter me-1"></i><span id="twitter"></span>
                    </p>
                    <p class="mb-1 text-muted">
                        <i class="bi bi-facebook me-1"></i><span id="facbook"></span>
                    </p>
                    <p class="text-muted">
                        <i class="bi bi-instagram me-1"></i><span id="instagram"></span>
                    </p>
                </div>
                <div class="mb-2">
                    <h6 class="fw-bold mb-2">Embedded Map</h6>
                    <iframe id="iframe" class="border rounded w-100" height="200" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Management Teams Section -->
<section class="card border-0 shadow mb-4">
    <div class="card-body">
        <!-- Section Header -->
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h5 class="mb-0 text-primary d-flex align-items-center">
                <i class="bi bi-people-fill me-2 fs-5"></i>
                <span>Management Teams</span>
            </h5>
            <button type="button" class="btn btn-sm btn-dark shadow-none d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#team-s">
                <i class="bi bi-person-plus me-1"></i> Add Member
            </button>
        </div>

        <!-- Team Data Container -->
        <div id="team-data" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <!-- Team cards will be dynamically inserted here -->
        </div>
    </div>
</section>


<!-- General Settings Modal -->
<div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true" style="backdrop-filter: blur(1px);">
    <div class="modal-dialog" id="general-model">
        <form id="general-from">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-gear-fill me-2"></i> General Settings
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="bi bi-card-heading me-1 text-primary"></i> Site Title
                        </label>
                        <input id="site_title_inp" type="text" name="site_title" value=""
                            class="form-control shadow-none">
                        <div id="site_title_error" class="text-danger d-none">Site title is required</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="bi bi-info-circle-fill me-1 text-primary"></i> About Us
                        </label>
                        <textarea id="site_about_inp" name="site_about" class="form-control shadow-none"
                            rows="6" required></textarea>
                        <div id="site_about_error" class="text-danger d-none">About us is required</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cencel-modal" class="btn btn-outline-secondary shadow-none" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">
                        <i class="bi bi-check-circle-fill me-1"></i> Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- General Settings Modal End -->


<!-- Contacts Settings Modal -->
<div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="contactsModalLabel" aria-hidden="true" style="backdrop-filter: blur(1px);">
    <div class="modal-dialog modal-lg">
        <form id="contacts-from">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="contactsModalLabel">
                        <i class="bi bi-geo-alt-fill me-2"></i> Contacts Settings
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- Address -->
                                <div class="mb-3">
                                    <label for="address_inp" class="form-label fw-bold">
                                        <i class="bi bi-geo-alt me-1"></i> Address
                                    </label>
                                    <input type="text" id="address_inp" name="address" class="form-control shadow-none">
                                    <div id="address_inp_error" class="text-danger d-none"></div>
                                </div>

                                <!-- Google Map -->
                                <div class="mb-3">
                                    <label for="gmap_inp" class="form-label fw-bold">
                                        <i class="bi bi-map me-1"></i> Google Map
                                    </label>
                                    <input type="text" id="gmap_inp" name="gmap" class="form-control shadow-none">
                                    <div id="gmap_inp_error" class="text-danger d-none"></div>
                                </div>

                                <!-- Phone 1 -->
                                <div class="mb-3">
                                    <label for="pn1_inp" class="form-label fw-bold">
                                        <i class="bi bi-telephone-fill me-1"></i> Phone Number 1
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="text" id="pn1_inp" name="pn1" class="form-control shadow-none">
                                    </div>
                                    <div id="pn1_inp_error" class="text-danger d-none"></div>
                                </div>

                                <!-- Phone 2 -->
                                <div class="mb-3">
                                    <label for="pn2_inp" class="form-label fw-bold">
                                        <i class="bi bi-telephone-fill me-1"></i> Phone Number 2
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="text" id="pn2_inp" name="pn2" class="form-control shadow-none">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email_inp" class="form-label fw-bold">
                                        <i class="bi bi-envelope-fill me-1"></i> Email
                                    </label>
                                    <input type="email" id="email_inp" name="email" class="form-control shadow-none">
                                    <div id="email_inp_error" class="text-danger d-none"></div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Social Links -->
                                <div class="mb-3">

                                    <!-- Twitter -->
                                    <label for="twitter_inp" class="form-label fw-semibold">
                                        <i class="bi bi-twitter me-1 text-primary"></i> Twitter
                                    </label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="bi bi-twitter"></i></span>
                                        <input type="url" id="twitter_inp" name="twitter" class="form-control shadow-none" placeholder="Twitter URL">
                                    </div>
                                    <div id="twitter_inp_error" class="text-danger d-none"></div>

                                    <!-- Facebook -->
                                    <label for="facbook_inp" class="form-label fw-semibold">
                                        <i class="bi bi-facebook me-1 text-primary"></i> Facebook
                                    </label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                        <input type="url" id="facbook_inp" name="facebook" class="form-control shadow-none" placeholder="Facebook URL">
                                    </div>
                                    <div id="facbook_inp_error" class="text-danger d-none"></div>

                                    <!-- Instagram -->
                                    <label for="instagram_inp" class="form-label fw-semibold">
                                        <i class="bi bi-instagram me-1 text-danger"></i> Instagram
                                    </label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                        <input type="url" id="instagram_inp" name="instagram" class="form-control shadow-none" placeholder="Instagram URL">
                                    </div>
                                    <div id="instagram_inp_error" class="text-danger d-none"></div>
                                </div>

                                <!-- iFrame -->
                                <div class="mb-3">
                                    <label for="iframe_inp" class="form-label fw-bold">
                                        <i class="bi bi-code-slash me-1"></i> iFrame Source
                                    </label>
                                    <input type="text" id="iframe_inp" name="iframe" class="form-control shadow-none" placeholder="Paste embed iframe src">
                                    <div id="iframe_inp_error" class="text-danger d-none"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" id="cancel-contacts-modal" class="btn btn-outline-secondary shadow-none" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-info text-white shadow-none">
                        <i class="bi bi-check-circle-fill me-1"></i> Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Contacts Settings Modal -->





<!-- Management Teams Modal -->
<div class="modal fade" id="team-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="general-model">

        <form id="team-from" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Team Member</h5>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Member Name</label>
                        <input id="member_name_inp" name="member_name_inp" type="text" class="form-control shadow-none">
                        <div id="member_name_error" class="text-danger" style="display:none;"></div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label fw-bold">Picture</label>
                        <input id="member_picture_inp" name="member_picture_inp" type="file"
                            class="form-control shadow-none">
                        <div id="member_picture_error" class="text-danger" style="display:none;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cencel-team-modal" class="btn text-secondary shadow-none"
                        data-bs-dismiss="modal">CENCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Management Teams Modal End -->

<script>
    $(document).ready(function() {

        let shutdown_toggle = $('#shutdown-toggle');

        function get_general() {
            $.ajax({
                type: "GET",
                url: `<?= base_url("settings-get") ?>`,
                dataType: "JSON",
                success: function(resp) {
                    if (resp.status == true) {
                        $('#site_title').text(resp.response.site_title);
                        $('#site_about').text(resp.response.site_about);
                        $('#site_title_inp').val(resp.response.site_title);
                        $('#site_about_inp').val(resp.response.site_about);
                    }

                    if (resp.response.shutdown == 0) {
                        $('#shutdown-toggle').prop('checked', false);
                        shutdown_toggle.val(0)
                    } else {
                        $('#shutdown-toggle').prop('checked', true);
                        shutdown_toggle.val(1)
                    }
                },
                error: function(status, error) {
                    console.log('Error:', error);
                }
            });
        }
        get_general();

        $('#cencel-modal').on('click', function() {
            get_general();
        });

        //general data update
        $('#general-from').submit(function(event) {
            event.preventDefault();

            site_title = $('#site_title_inp').val().trim();
            site_about = $('#site_about_inp').val().trim();

            // Validate site title
            if (site_title === '') {
                $('#site_title_error').text('Site title is required').show();
                return false;
            }

            // Validate about section
            if (site_about === '') {
                $('#site_about_error').text('About us is required').show();
                return false;
            }

            $.ajax({
                type: "POST",
                url: `<?= base_url("settings-update") ?>`,
                dataType: "JSON",
                data: {
                    site_title: site_title,
                    site_about: site_about
                },
                success: function(resp) {
                    if (resp.status == true) {
                        $('#site_title_error').hide();
                        $('#site_about_error').hide();
                        get_general();
                        $('#general-s').modal('hide');
                        js_alert(resp.status, resp.message)
                    } else {
                        $('#site_title_error').hide();
                        $('#site_about_error').hide();
                        $('#general-s').modal('hide');
                        js_alert(resp.status, resp.message)
                    }
                },
                error: function(status = "error", error) {
                    js_alert(status, error)
                }
            });
        });



        // Shutdown Data Update
        $('#shutdown-toggle').change(function() {
            let val = $(this).val();
            $.ajax({
                type: "POST",
                url: `<?= base_url("settings-update-shutdown") ?>`,
                dataType: "JSON",
                data: {
                    shutdown: val,
                },
                success: function(resp) {
                    if (resp.status == true) {
                        js_alert(resp.status, resp.message)
                    } else {
                        js_alert(resp.status, resp.message)
                    }
                    get_general();
                },
                error: function(status = "error", error) {
                    js_alert(status, error)
                }
            });
        });



        // get_contacts details
        function get_contacts() {
            // element id select
            let contacts_p_id = [
                'address', 'gmap', 'pn1', 'pn2', 'email', 'twitter', 'facbook', 'instagram'
            ]

            let iframe = $('#iframe');

            $.ajax({
                type: "GET",
                url: `<?= base_url("settings-get_contacts") ?>`,
                dataType: "JSON",
                success: function(resp) {
                    if (resp.status == true) {
                        let contact_data = Object.values(resp.response);

                        for (let i = 0; i < contacts_p_id.length; i++) {
                            $('#' + contacts_p_id[i]).text(contact_data[i + 1]);
                        }
                        $(iframe).attr('src', contact_data[9]);
                        contacts_inp(contact_data);
                    }
                },
                error: function(status, error) {
                    console.log('Error:', error);
                }
            });
        }
        get_contacts();

        // contacts model data show
        function contacts_inp(data) {
            let contacts_inp_id = [
                'address_inp', 'gmap_inp', 'pn1_inp', 'pn2_inp', 'email_inp', 'twitter_inp', 'facbook_inp', 'instagram_inp', 'iframe_inp',
            ]
            for (let i = 0; i < contacts_inp_id.length; i++) {
                $('#' + contacts_inp_id[i]).val(data[i + 1]);

            }
        }

        // contacts model Cencel reset data
        $('#cencel-contacts-modal').on('click', function() {
            get_contacts();
        });


        //contacts data update
        $('#contacts-from').submit(function(event) {

            event.preventDefault();
            let address_inp = $('#address_inp').val().trim();
            let gmap_inp = $('#gmap_inp').val().trim();
            let pn1_inp = $('#pn1_inp').val();
            let pn2_inp = $('#pn2_inp').val();
            let email_inp = $('#email_inp').val().trim();
            let tw_inp = $('#twitter_inp').val();
            let fb_inp = $('#facbook_inp').val();
            let insta_inp = $('#instagram_inp').val();
            let iframe_inp = $('#iframe_inp').val();

            let isValid = true;
            if (address_inp === '') {
                $('#address_inp_error').text('Address is required').show();
                isValid = false;
            }

            if (gmap_inp === '') {
                $('#gmap_inp_error').text('Google Map URL is required').show();
                isValid = false;
            }

            if (pn1_inp === '') {
                $('#pn1_inp_error').text('Enter a valid phone number').show();
                isValid = false;
            }

            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email_inp === '' || !emailPattern.test(email_inp)) {
                $('#email_inp_error').text('Enter a valid email address').show();
                isValid = false;
            }

            if (tw_inp === '') {
                $('#twitter_inp_error').text('Twitter URL is required').show();
                isValid = false;
            }
            if (fb_inp === '') {
                $('#facbook_inp_error').text('Facebook URL is required').show();
                isValid = false;
            }
            if (insta_inp === '') {
                $('#instagram_inp_error').text('Instagram URL is required').show();
                isValid = false;
            }

            if (iframe_inp === '') {
                $('#iframe_inp_error').text('iFrame source is required').show();
                isValid = false;
            }

            if (isValid) {
                $.ajax({
                    type: "POST",
                    url: `<?= base_url("settings-contacts-details-update") ?>`,
                    dataType: "JSON",
                    data: {
                        address: address_inp,
                        gmap: gmap_inp,
                        pn1: pn1_inp,
                        pn2: pn2_inp,
                        email: email_inp,
                        tw: tw_inp,
                        fb: fb_inp,
                        insta: insta_inp,
                        iframe: iframe_inp
                    },
                    success: function(resp) {
                        if (resp.status == true) {
                            get_contacts();
                            $('#contacts-s').modal('hide');
                            js_alert(resp.status, resp.message)
                        } else {
                            $('#contacts-s').modal('hide');
                            js_alert(resp.status, resp.message)


                        }
                    },
                    error: function(status = "error", error) {
                        js_alert(status, error)
                    }
                });
            }

        });



        //  add Member function call
        $('#team-from').submit(function(event) {
            event.preventDefault();

            let name = $('#member_name_inp').val();
            let picture = $('#member_picture_inp').val();

            if (name == '') {
                $('#member_name_error').text(' Mebmer name is required').show();
                return false;
            } else {
                $('#member_name_error').text(' Mebmer name is required').hide();
            }
            if (picture == '') {
                $('#member_picture_error').text('Plese Mebmer picture Select').show();
                return false;
            } else {
                $('#member_picture_error').text('Plese Mebmer picture Select').hide();
            }


            data = new FormData(this);

            $.ajax({
                type: "POST",
                url: `<?= base_url("settings-add-member") ?>`,
                dataType: "JSON",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(resp) {
                    if (resp.status == true) {
                        get_member();
                        $('#team-from')[0].reset();
                        $('#team-s').modal('hide');
                        js_alert(resp.status, resp.message)
                    }
                    if (resp.status == 2) {
                        $('#member_picture_inp').val('');
                        $('#team-s').modal('hide');
                        js_alert(resp.status, resp.message)
                    } else {
                        $('#team-s').modal('hide');
                        js_alert(resp.status, resp.message)
                    }
                },
                error: function(status = "error", error) {
                    js_alert(status, error)
                }
            });
        });

        function get_member() {
            $.ajax({
                type: "GET",
                url: `<?= base_url("settings-get-member") ?>`,
                dataType: "JSON",
                success: function(resp) {
                    let teamHtml = '';
                    for (let i = 0; i < resp.response.length; i++) {
                        let name = resp.response[i]['name'];
                        let picture = resp.response[i]['picture'];
                        let id = resp.response[i]['id'];
                        teamHtml += `
                        <div class="col-md-2 mb-3 team-member" data-id="${id}">
                            <div class="card bg-dark text-white">
                                <img class="card-img" src="<?= TEAM_IMAGE_SITE_PATH ?>${picture}">
                                <div class="card-img-overlay text-end">
                                    <button type="button" class="btn btn-danger btn-ms text-end shadow-none delete-btn">
                                        <i class="bi bi-trash"></i> 
                                    </button>
                                </div>
                                <p class="card-text text-center px-3 py-2">${name}</p>
                            </div>
                        </div>`;
                    }
                    $('#team-data').html(teamHtml);
                },
                error: function(status = "error", error) {
                    js_alert(status, error)
                }
            });
        }
        get_member();

        $('#team-data').on('click', '.delete-btn', function() {
            let memberCard = $(this).closest('.team-member');
            let memberId = memberCard.data('id');
            if (confirm('Are you sure you want to delete this member?')) {
                $.ajax({
                    url: `<?= base_url("settings-delete-member") ?>`,
                    type: 'POST',
                    data: {
                        id: memberId
                    },
                    dataType: 'json',
                    success: function(resp) {
                        if (resp.status == true) {
                            memberCard.remove();
                            js_alert(resp.status, resp.message);
                        } else {
                            js_alert(resp.status, resp.message)
                        }
                    },
                    error: function(status = "error", error) {
                        js_alert(status, error)
                    }
                });
            }
        });
    })
</script>