<h3 class="mb-4"> FACILITIES</h3>
<!-- USERS QUERIES Table -->
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">Feature</h5>
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                data-bs-target="#feature-s">
                <i class="bi bi-person-add"></i> Add
            </button>
        </div>

        <table class="table">
            <thead>
                <tr>
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
    <div class="modal-dialog" id="general-model">

        <form id="feature-from">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Feature</h5>
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

<!--Edit Feature Modal -->
<div class="modal fade" id="feature-update" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form id="edit-feature-from">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Feature</h5>
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
<!-- Edit Feature Modal End -->


<script>
    // Get all Feature
    function get_features() {
        $.ajax({
            url: "<?php echo base_url('get-all-feature'); ?>",
            type: "GET",
            dataType: "json",
            success: function(resp) {

                if (resp.status == true) {
                    var rows = '';
                    var sno = 1;
                    $.each(resp.response, function(index, record) {
                        rows += '<tr>';
                        rows += '<th scope="row">' + sno + '</th>';
                        rows += '<td>' + record.feature_name + '</td>';
                        rows += '<td>';

                        rows += '<a href="javascript:void(0);" class="btn btn-success shadow-none btn-ms" onclick="updateFeature(' + record.id + ')"><i class="bi bi-pencil-square"></i> </a>';

                        rows += '<a href="javascript:void(0);"  class="btn btn-danger shadow-none btn-ms" onclick="deleteRecord(' + record.id + ')"><i class="bi bi-archive-fill"></i></a>';
                        rows += '</td>';
                        rows += '</tr>';
                        sno++;
                    });
                    $('#feature-records-show').html(rows); // Append rows to table body
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
                    js_alert(response.status, response.message);
                    $('#feature-from')[0].reset();
                    $('#feature-s').modal('hide');
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

    // Show Modal with Current Data
    function updateFeature(id) {
        // Fetch the current data for the selected feature
        $.ajax({
            url: '<?= base_url("get-singal-feature") ?>?' + id,
            type: 'GET',
            success: function(resp) {
                if (resp.status==true) {
                    $('#feature-name-inp').val(resp.feature_name); // Set current feature name
                    $('#feature-update-modal').modal('show'); // Show the modal
                } else {
                   js_alert(resp.status,resp.message);
                }
            }
        });
    }

    // Update Feature on Form Submit
    $('#edit-feature-form').submit(function(e) {
        e.preventDefault(); // Prevent form from submitting traditionally

        // Send updated data to backend
        $.ajax({
            url: '/yourcontroller/update_feature', // Adjust to your CI3 controller method
            type: 'POST',
            data: $(this).serialize(), // Serialize form data for easy POST
            success: function(response) {
                if (response.status) {
                    alert(response.message || 'Feature updated successfully');
                    $('#feature-update-modal').modal('hide'); // Close modal
                    // Optionally, refresh the table to show updated data
                    loadFeatures(); // Assumes a function to reload data
                } else {
                    $('#feature-name-error').text(response.errors.feature_name).show();
                }
            }
        });
    });
</script>