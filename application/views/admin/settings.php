<h3 class="mb-4">SETTINGS</h3>
<!-- General Settings Section -->
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">General Settings</h5>
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                data-bs-target="#general-s">
                <i class="bi bi-pencil-square"></i> Edit
            </button>
        </div>
        <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
        <p class="card-text" id="site_title"></p>
        <h6 class="card-subtitle mb-1 fw-bold">About us</h6>
        <p class="card-text" id="site_about"></p>
    </div>
</div>
<!-- General Settings Section End -->

<!-- General Settings Modal -->
<div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="general-model">
        <form id="general-from">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">General Settings</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Site Titel</label>
                        <input id="site_title_inp" type="text" name="site_title" value=""
                            class="form-control shadow-none">

                        <div id="site_title_error" class="text-danger" style="display:none;">Site title is required
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">About us</label>
                        <textarea id="site_about_inp" required name="site_about" class="form-control shadow-none"
                            rows="6"></textarea>
                        <div id="site_about_error" class="text-danger" style="display:none;">About us is required</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cencel-modal" class="btn text-secondary shadow-none"
                        data-bs-dismiss="modal">CENCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- General Settings Modal End -->

<!-- Shutdown Section -->
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">Shutdown Website</h5>
            <form>
                <div class="form-check form-switch">
                    <input class="form-check-input" id="shutdown-toggle" type="checkbox">
                </div>
            </form>
        </div>
        <p class="card-text">No Customers wile be allowed to book hotel room, when shutdown mode is turned on.</p>
    </div>
</div>
<!-- Shutdown Section End -->

<!--  Contacts us Section  -->
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">Contacts us Settings</h5>
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                data-bs-target="#contacts-s">
                <i class="bi bi-pencil-square"></i> Edit
            </button>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                    <p class="card-text" id="address"></p>
                </div>
                <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                    <p class="card-text" id="gmap"></p>
                </div>
                <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Phone Number</h6>
                    <p class="card-text mb-1">
                        <i class="bi bi-telephone-fill"></i>
                        <span id="pn1"></span>
                    </p>
                    <p class="card-text">
                        <i class="bi bi-telephone-fill"></i>
                        <span id="pn2"></span>
                    </p>
                </div>
                <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">E-mail</h6>
                    <p class="card-text" id="email"></p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Social Links</h6>
                    <p class="card-text mb-1">
                        <i class="bi bi-twitter me-1"></i>
                        <span id="twitter"></span>
                    </p>
                    <p class="card-text mb-1">
                        <i class="bi bi-facebook me-1"></i>
                        <span id="facbook"></span>
                    </p>
                    <p class="card-text">
                        <i class="bi bi-instagram me-1"></i>
                        <span id="instagram"></span>
                    </p>
                </div>
                <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">iFrame</h6>
                    <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Contacts us Section end  -->

<!-- Contacts us Modal -->
<div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="contacts-model">
        <form id="contacts-from">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contacts Settings</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Address</label>
                                    <input id="address_inp" type="text" name="address" class="form-control shadow-none">
                                    <div id="address_inp_error" class="text-danger" style="display:none;">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Google Map</label>
                                    <input id="gmap_inp" type="text" class="form-control shadow-none">
                                    <div id="gmap_inp_error" class="text-danger" style="display:none;">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Phone Numbers (whit country code)</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="bi bi-telephone-fill"></i>
                                        </span>
                                        <input type="text" id="pn1_inp" class="form-control shadow-none">
                                    </div>
                                    <div id="pn1_inp_error" class="text-danger" style="display:none;"></div>


                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="bi bi-telephone-fill"></i>
                                        </span>
                                        <input type="text" id="pn2_inp" class="form-control shadow-none">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input id="email_inp" type="email" class="form-control shadow-none">
                                    <div id="email_inp_error" class="text-danger" style="display:none;"></div>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Social Links</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="bi bi-twitter me-1"></i>
                                        </span>
                                        <input type="text" id="twitter_inp" class="form-control shadow-none">
                                        <div id="twitter_inp_error" class="text-danger" style="display:none;"></div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="bi bi-facebook me-1"></i>
                                        </span>
                                        <input type="text" id="facbook_inp" class="form-control shadow-none">
                                        <div id="facbook_inp_error" class="text-danger" style="display:none;"></div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="bi bi-instagram me-1"></i>
                                        </span>
                                        <input type="text" id="instagram_inp" class="form-control shadow-none">
                                        <div id="instagram_inp_error" class="text-danger" style="display:none;"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">iFrame Scr</label>
                                        <input id="iframe_inp" type="text" class="form-control shadow-none">
                                        <div id="iframe_inp_error" class="text-danger" style="display:none;">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cencel-contacts-modal" class="btn text-secondary shadow-none"
                        data-bs-dismiss="modal">CENCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Contacts us Modal End -->

<!-- Management Teams  Section -->
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">General Settings</h5>
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                data-bs-target="#team-s">
                <i class="bi bi-person-add"></i> Add
            </button>
        </div>
        <div class="row" id="team-data">

        </div>
    </div>
</div>
<!--  Management Teams Section End -->

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
                        <i class="bi bi-trash"></i> Delete
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