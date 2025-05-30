<h3 class="mb-4">FACILITIES & FEATURE</h3>

<!-- FACILITIES Table -->
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">FACILITIES</h5>
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                data-bs-target="#facilities-s">
                <i class="bi bi-person-add"></i> Add
            </button>
        </div>

        <table class="table table-hover table-bordered">
            <thead>
                <tr class="bg-secondary text-light">
                    <th scope="col">S.NO</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Facility Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="facilities-records-show">

            </tbody>
        </table>
    </div>
</div>
<!-- add FACILITIES Modal -->
<div class="modal fade" id="facilities-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="general-model">

        <form id="facilitie-from" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Facility Name</label>
                        <input name="facility_name_inp" type="text" class="form-control shadow-none">
                        <div id="facility_name_error" class="text-danger" style="display:none;"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Icon</label>
                        <input id="facility_icon_inp" name="facility_icon" accept=".svg" type="file"
                            class="form-control shadow-none">
                        <div id="facility_icon_error" class="text-danger" style="display:none;"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="facility_desc" class="form-control shadow-none"></textarea>
                        <div id="facility_desc_error" class="text-danger" style="display:none;"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none"
                        data-bs-dismiss="modal">CENCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- add FACILITIES Modal End -->

<!-- Edit FACILITIES Modal -->
<div class="modal fade" id="updateFacilitieModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="facilitie-edit-from" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="facility_id" />

                    <div class="mb-3">
                        <label for="facilityName" class="form-label">Facility Name</label>
                        <input type="text" class="form-control" name="facility_name" id="facilityName" />
                        <small id="facilityNameError" class="text-danger"></small>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Current Icon</label>
                        <img id="facility-icon-preview" src="" alt="Facility Icon" style="width: 50px; height: 50px; display: none;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Icon</label>
                        <input id="facility_icon" name="facility_icon" accept=".svg" type="file"
                            class="form-control shadow-none">
                        <div id="facilityIconError" class="text-danger" style="display:none;"></div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea id="facility_desc" name="facility_desc" rows="4" class="form-control shadow-none"></textarea>
                        <div id="facilityDescError" class="text-danger" style="display:none;"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none"
                        data-bs-dismiss="modal">CENCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Edit FACILITIES Modal End -->

<!-- Feature Table -->
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">FEATURE</h5>
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                data-bs-target="#feature-s">
                <i class="bi bi-person-add"></i> Add
            </button>
        </div>

        <table class="table table-hover table-bordered">
            <thead>
                <tr class="bg-secondary text-light">
                    <th scope="col">S.NO</th>
                    <th scope="col">Feature Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="feature-records-show">

            </tbody>
        </table>

    </div>
</div>

<!-- add Feature Modal -->
<div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="general-model">

        <form id="feature-from">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Feature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Feature Name</label>
                        <input name="feature_name_inp" type="text" class="form-control shadow-none">
                        <div id="feature_name_error" class="text-danger" style="display:none;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none"
                        data-bs-dismiss="modal">CENCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- add Feature Modal End -->

<!-- Feature Edit Model -->
<div class="modal fade" id="updateFeatureModal" tabindex="-1" aria-labelledby="updateFeatureLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="updateFeatureForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateFeatureLabel">Update Feature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="feature_id" />
                    <div class="mb-3">
                        <label for="featureName" class="form-label">Feature Name</label>
                        <input type="text" class="form-control" name="feature_name" id="featureName" />
                        <small id="featureNameError" class="text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Feature</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Get all Feature
    function get_features() {
        $('#feature-records-show').html('');
        $.ajax({
            url: "<?php echo base_url('get-all-feature'); ?>",
            type: "GET",
            dataType: "json",
            success: function(resp) {
                if (resp.status == true) {
                    let i = 0
                    $.each(resp.response, function(key, val) {
                        i++
                        $('#feature-records-show').append(`
                                    <tr  id="${val.id}"> 
                                        <td>${i}</td>
                                        <td>${val.feature_name}</td>
                                        <td>

                                        <button type="button" class="btn btn-primary shadow-none"data-id="${val.id}" id="feature-update-btn"><i class="bi bi-pencil-square"></i></button>
                                        
                                            <button type="button" class="btn btn-danger shadow-none" data-id="${val.id}" id="feature-delete-btn"><i class="bi bi-archive-fill"></i></button>
                                            </td>
                                     </tr>`);
                    });
                } else {
                    $('#feature-records-show').append(` <tr> <td class="text-danger text-center" colspan="3">${resp.message}</td></tr>`);
                }
            },
            error: function() {
                alert("Error fetching data");
            }
        });
    }

    $(document).ready(function() {
        get_features();
    });

    // add Fecture
    $('#feature-from').on('submit', function(e) {
        e.preventDefault();

        $('#feature_name_error').hide().text('');
        var featureName = $('input[name="feature_name_inp"]').val().trim();
        var formData = $(this).serialize();
        $.ajax({
            url: '<?= base_url("add-feature") ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status == true) {
                    get_features();
                    $('#feature-from')[0].reset();
                    $('#feature-s').modal('hide');
                    js_alert(response.status, response.message);
                } else {
                    if (response.errors.feature_name) {
                        $('#feature_name_error').text(response.errors.feature_name).show();
                    }
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred. Please try again.');
            }
        });
    });


    // Feature Edit Model Show
    $('body').on('click', '#feature-update-btn', function() {
        const id = $(this).data('id');
        $.ajax({
            url: `<?= base_url('get-feature/') ?>${id}`, // API endpoint to get feature details
            type: 'GET',
            dataType: 'json',
            success: function(resp) {
                if (resp.status === true) {
                    $('#updateFeatureModal input[name="feature_name"]').val(resp.data.feature_name);
                    $('#updateFeatureModal input[name="feature_id"]').val(resp.data.id);
                    $('#updateFeatureModal').modal('show');
                } else {
                    alert(resp.message || 'Failed to fetch feature details.');
                }
            },
            error: function() {
                alert('Error occurred while fetching the feature details.');
            }
        });
    });

    // Submit Feature Edit Model
    $('#updateFeatureForm').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        $.ajax({
            url: '<?= base_url('update-feature') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(resp) {

                if (resp.status === true) {
                    js_alert(resp.status, resp.message);
                    get_features();
                    $('#updateFeatureModal').modal('hide');

                } else if (resp.errors) {

                    // Display field-specific error messages
                    if (resp.errors.feature_name) {
                        $('#featureNameError').text(resp.errors.feature_name);
                    } else {
                        $('#featureNameError').text(''); // Clear error if resolved
                    }

                } else {
                    js_alert(resp.status, resp.message);
                }


            },
            error: function() {
                alert('Error occurred while updating the feature.');
            }
        });
    });


    // Feature delete 
    $('body').on('click', '#feature-delete-btn', function() {
        const id = $(this).data('id');
        const row = $(this).closest('tr'); // Get the closest table row
        // Confirm before deletion
        if (confirm(`Are you sure you want to Delete this Feature?`)) {
            $.ajax({
                url: `<?= base_url("delete-feature/") ?>${id}`,
                type: 'GET',
                dataType: 'json',
                success: function(resp) {
                    console.log(resp);
                    if (resp.status === true) {
                        js_alert(resp.status, resp.message);
                        row.fadeOut();
                    } else {
                        js_alert(resp.status, resp.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert(`Error: ${xhr.status} - ${error}`);
                }
            });
        }
    });

    // Get all facilitys
    function get_facilitys() {
        $('#facilities-records-show').html('');
        $.ajax({
            url: "<?php echo base_url('get-all-facilitys'); ?>",
            type: "GET",
            dataType: "json",
            success: function(resp) {
                if (resp.status == true) {
                    let i = 0
                    $.each(resp.response, function(key, val) {
                        i++
                        $('#facilities-records-show').append(`
                                    <tr id="${val.id}" class="align-middle"> 
                                        <td>${i}</td>
                                        <td><img style="width: 50px; height:50px;"  src="<?= FACILIITIES_IMAGE_SITE_PATH ?>${val.icon}"></td>
                                        <td>${val.facility_name}</td>
                                        <td width="40%">${val.description}</td>
                                        <td>
                                         <button type="button" class="btn btn-primary shadow-none"data-id="${val.id}" id="facilitys-update-btn"><i class="bi bi-pencil-square"></i></button>

                                            <button type="button" class="btn btn-danger shadow-none" data-id="${val.id}" id="facilitys-delete-btn"><i class="bi bi-archive-fill"></i></button>

                                        </td>
                                    </tr>`);
                    });
                } else {
                    $('#facilities-records-show').append(` <tr> <td class="text-danger text-center" colspan="5">${resp.message}</td></tr>`);
                }
            },
            error: function() {
                alert("Error fetching data");
            }
        });

    }
    get_facilitys();

    //  add facilitie
    $('#facilitie-from').on('submit', function(e) {
        e.preventDefault();
        $('#facility_name_error').hide();
        $('#facility_icon_error').hide();
        $('#facility_desc_error').hide();
        var formData = new FormData(this);
        $.ajax({
            url: '<?= base_url("add-facility") ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if (response.status === true) {
                    $('#facilities-s').modal('hide');
                    $('#facilitie-from')[0].reset();
                    get_facilitys();
                    js_alert(response.status, response.message);
                } else if (response.success == false) {
                    if (response.errors.facility_name_inp) {
                        $('#facility_name_error').text(response.errors.facility_name_inp).show();
                    }
                    if (response.errors.facility_icon) {
                        $('#facility_icon_error').text(response.errors.facility_icon).show();
                    }
                    if (response.errors.facility_desc) {
                        $('#facility_desc_error').text(response.errors.facility_desc).show();
                    }
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    });

    // facilitie Edit Model Show
    $('body').on('click', '#facilitys-update-btn', function() {
        const id = $(this).data('id');
        $.ajax({
            url: `<?= base_url('get-facility/') ?>${id}`, // API endpoint to get feature details
            type: 'GET',
            dataType: 'json',
            success: function(resp) {
                if (resp.status === true) {
                    console.log(resp.data.description);
                    $('#updateFacilitieModal input[name="facility_id"]').val(resp.data.id);
                    $('#updateFacilitieModal input[name="facility_name"]').val(resp.data.facility_name);
                    $('#facility_desc').val(resp.data.description);
                    if (resp.data.icon) {
                        $('#updateFacilitieModal img#facility-icon-preview').attr('src', `<?= FACILIITIES_IMAGE_SITE_PATH ?>${resp.data.icon}`).show();
                    }

                    $('#updateFacilitieModal').modal('show');
                } else {
                    alert(resp.message || 'Failed to fetch Facilitie details.');
                }
            },
            error: function() {
                alert('Error occurred while fetching the feature details.');
            }
        });
    });

    // Update Facilitie submit
    $('#facilitie-edit-from').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "<?= base_url('update-facility'); ?>",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function() {
                $('#facilityNameError').text('');
                $('#facilityIconError').text('').hide();
                $('#facilityDescError').text('').hide();
            },
            success: function(response) {
                if (response.status == true) {
                    js_alert(response.status, response.message);
                    $('#facilitie-edit-from')[0].reset();
                    get_facilitys();
                    $('#updateFacilitieModal').modal('hide');
                } else {
                    if (response.status == false) {
                        js_alert(response.status, response.message);
                        $('#updateFacilitieModal').modal('hide');
                    }
                    if (response.errors) {
                        if (response.errors.facility_name) {
                            $('#facilityNameError').text(response.errors.facility_name);
                        }
                        if (response.errors.facility_icon) {
                            $('#facilityIconError').text(response.errors.facility_icon).show();
                        }
                        if (response.errors.facility_desc) {
                            $('#facilityDescError').text(response.errors.facility_desc).show();
                        }
                    }
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    });

    // facilitys delete 
    $('body').on('click', '#facilitys-delete-btn', function() {
        const id = $(this).data('id');
        const row = $(this).closest('tr'); // Get the closest table row
        // Confirm before deletion
        if (confirm(`Are you sure you want to delete this Facility?`)) {
            $.ajax({
                url: `<?= base_url("delete-facility/") ?>${id}`,
                type: 'GET',
                dataType: 'json',
                success: function(resp) {
                    if (resp.status === true) {
                        js_alert(resp.status, resp.message);
                        row.fadeOut();
                    } else {
                        js_alert(resp.status, resp.message);
                    }
                },
                error: function() {
                    alert('Error occurred while deleting the item.');
                }
            });
        }
    });
</script>