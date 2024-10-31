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

        <table class="table table-hover border">
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
<div class="modal fade" id="edit-model" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
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
                                            <button type="button" class="btn btn-danger" data-id="${val.id}" id="feature-delete-btn"><i class="bi bi-trash"></i></button>
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

    // Feature delete 
    $('body').on('click', '#feature-delete-btn', function() {
        const id = $(this).data('id');
        const row = $(this).closest('tr'); // Get the closest table row
        // Confirm before deletion
        if (confirm(`Are you sure you want to delete this Recrod`)) {
            $.ajax({
                url: `<?= base_url("delete-feature/") ?>${id}`,
                type: 'GET',
                dataType: 'json',
                success: function(resp) {
                    if (resp.status === true) {
                        row.fadeOut();
                        js_alert(resp.status.resp.message);
                    } else {
                        js_alert(resp.status.resp.message);
                    }
                },
                error: function() {
                    alert('Error occurred while deleting the item.');
                }
            });
        }
    });
</script>