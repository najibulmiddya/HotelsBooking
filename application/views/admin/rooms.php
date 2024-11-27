<h3 class="mb-4">Rooms</h3>
<!-- Room Table -->
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">ROOMS</h5>
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                data-bs-target="#add-room">
                <i class="bi bi-person-add"></i> Add
            </button>
        </div>
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="bg-secondary text-light">
                    <th scope="col">S.NO</th>
                    <th scope="col">Name</th>
                    <th scope="col">Area</th>
                    <th scope="col">Gueste</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="room-data">

            </tbody>
        </table>

    </div>
</div>

<!-- add Room Modal -->
<div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <form id="room-from">
            <!-- autocomplete="off" -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Room</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Room Name</label>
                            <input name="name" type="text" class="form-control shadow-none">
                            <div id="room_error" class="text-danger" style="display:none;"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Area</label>
                            <input name="area" type="number" min="1" class="form-control shadow-none">
                            <div id="area_error" class="text-danger" style="display:none;"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Price</label>
                            <input name="price" type="number" min="1" class="form-control shadow-none">
                            <div id="price_error" class="text-danger" style="display:none;"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Quantity</label>
                            <input name="quantity" type="number" min="1" class="form-control shadow-none">
                            <div id="quantity_error" class="text-danger" style="display:none;"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Adult (Max.)</label>
                            <input name="adult" type="number" min="1" class="form-control shadow-none">
                            <div id="adult_error" class="text-danger" style="display:none;"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Children (Max.)</label>
                            <input name="children" type="number" min="1" class="form-control shadow-none">
                            <div id="children_error" class="text-danger" style="display:none;"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Features</label>
                            <div class="row">
                                <?php if ($features) {
                                    foreach ($features as $key => $val) {
                                        echo "
                                 <div class='col-md-3 mb-1'>
                                 <label>
                                 <input type='checkbox' name='features[]' value='$val[id]' class='form-check-input shadow-none'>
                                 $val[feature_name]
                                 </label>
                                   </div>
                                   ";
                                    }
                                } ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Facilities</label>
                            <div class="row">
                                <?php if ($facilities) {
                                    foreach ($facilities as $key => $val) {
                                        echo "
                                 <div class='col-md-3 mb-1'>
                                 <label>
                                 <input type='checkbox' name='facilities[]' value='$val[id]' class='form-check-input shadow-none'>
                                 $val[facility_name]
                                 </label>
                                   </div>
                                   ";
                                    }
                                } ?>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="from-label fw-bold">Description</label>
                            <textarea name="desc" rows="4" class="form-control shadow-none"></textarea>
                            <div id="desc_error" class="text-danger" style="display:none;"></div>
                        </div>
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
<!-- add Room Modal End -->



<!-- Edit Room Modal -->
<div class="modal fade" id="edit-room-modal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="editRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="edit-room-form" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoomModalLabel">Edit Room</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="roomId" name="roomId"> <!-- Hidden field for Room ID -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Room Name</label>
                            <input id="editRoomName" name="name" type="text" class="form-control shadow-none">
                            <div id="room_name_error" class="text-danger" style="display:none;"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Area</label>
                            <input id="editRoomArea" name="area" type="number" min="1" class="form-control shadow-none">
                            <div id="e_area_error" class="text-danger" style="display:none;"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Price</label>
                            <input id="editRoomPrice" name="price" type="number" min="1" class="form-control shadow-none">
                            <div id="e_price_error" class="text-danger" style="display:none;"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Quantity</label>
                            <input id="editRoomQuantity" name="quantity" type="number" min="1" class="form-control shadow-none">
                            <div id="e_quantity_error" class="text-danger" style="display:none;"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Adult (Max.)</label>
                            <input id="editRoomAdult" name="adult" type="number" min="1" class="form-control shadow-none">
                            <div id="e_adult_error" class="text-danger" style="display:none;"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Children (Max.)</label>
                            <input id="editRoomChildren" name="children" type="number" min="1" class="form-control shadow-none">
                            <div id="e_children_error" class="text-danger" style="display:none;"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Features</label>
                            <div class="row" id="editRoomFeatures">
                                <?php if ($features) {
                                    foreach ($features as $key => $val) {
                                        echo "
                                         <div class='col-md-3 mb-1'>
                                         <label>
                                         <input type='checkbox' name='features[]' value='$val[id]' class='form-check-input shadow-none'>
                                         $val[feature_name]
                                         </label>
                                           </div>
                                           ";
                                    }
                                } ?>
                                <div id="e_features_error" class="text-danger" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Facilities</label>
                            <div class="row" id="editRoomFacilities">
                                <?php if ($facilities) {
                                    foreach ($facilities as $key => $val) {
                                        echo "
                                         <div class='col-md-3 mb-1'>
                                         <label>
                                         <input type='checkbox' name='facilities[]' value='$val[id]' class='form-check-input shadow-none'>
                                         $val[facility_name]
                                         </label>
                                           </div>
                                           ";
                                    }
                                } ?>
                                <div id="e_facilities_error" class="text-danger" style="display:none;"></div>
                            </div>

                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea id="editRoomDesc" name="desc" rows="4" class="form-control shadow-none"></textarea>
                            <div id="e_desc_error" class="text-danger" style="display:none;"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Edit Model end  -->

<!-- Room details view Model -->
<div class="modal fade" id="room-details-modal" tabindex="-1" aria-labelledby="roomDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roomDetailsModalLabel">Room Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Room details will be populated here dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Room details view Model End -->

<!-- Room Image Upload Model  -->
<div class="modal fade" id="room-image-upload-Modal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title room-img-model-room_name" id="uploadModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="room-image-upload-form" enctype="multipart/form-data">
                    <input type="hidden" id="room-id" name="room_id">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Select Image</label>
                        <input id="room-image-input" name="room_image" type="file"
                            class="form-control shadow-none">
                        <div id="room_image_error" class="text-danger" style="display:none;"></div>
                    </div>
                    <button type="submit" class="btn btn-primary shadow-none btn-sm" id="upload-image-btn"> <i class="bi bi-person-add"></i> Add</button>
                </form>
            </div>

            <table class="table table-hover table-bordered" id="room-images-table">
                <thead class="bg-info">
                    <tr>
                        <th>S No</th>
                        <th>Image</th>
                        <th>Thumb</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="overflow-auto">
                    <!-- Rows will be appended here dynamically -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Room Image Upload Model End -->


<script>
    $(document).ready(function() {

        // Room add
        $('#room-from').on('submit', function(e) {
            e.preventDefault(); // Prevents default form submission

            // Reset error messages
            $('.text-danger').hide().text('');
            // Serialize form data
            let formData = new FormData(this);

            $.ajax({
                url: '<?= base_url('room-add') ?>', // Your controller method URL
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        js_alert(response.status, response.message);
                        get_rooms();
                        $('#room-from')[0].reset();
                        $('#add-room').modal('hide');
                    } else {
                        // Display validation errors
                        if (response.errors) {
                            for (let field in response.errors) {
                                $('#' + field + '_error').show().text(response.errors[field]);
                            }
                        }
                        if (response.status === false) {
                            js_alert(response.status, response.message);
                        }
                    }
                },
                error: function() {
                    alert('Error: Could not add room. Please try again.');
                }
            });
        });


        // Get all facilitys
        function get_rooms() {
            $('#room-data').html('');
            $.ajax({
                url: "<?php echo base_url('get-all-rooms'); ?>",
                type: "GET",
                dataType: "json",
                success: function(resp) {
                    if (resp.status == true) {
                        let i = 0
                        $.each(resp.response, function(key, val) {

                            let statusText = val.status == 1 ? "Active" : "Inactive";
                            let statusClass = val.status == 1 ? "btn-success" : "btn-warning";
                            let toggleStatusText = val.status == 1 ? "Deactivate" : "Activate";
                            i++
                            $('#room-data').append(`
                                    <tr id="${val.id}" class="align-middle"> 
                                        <td>${i}</td>
                                        <td>${val.room_name}</td>
                                        <td>${val.area} sq. ft.</td>

                                        <td> 
                                        <span class="badge rounded-pill bg-ligth text-dark">
                                        Adult: ${val.adult}
                                        </span><br>
                                        <span class="badge rounded-pill bg-ligth text-dark">
                                        Children: ${val.children}
                                        </span>
                                        </td>

                                        <td>₹${val.price}</td>
                                        <td>${val.quantity}</td>
                                        <td><span class="badge ${statusClass}">${statusText}</span></td>
                                        <td>
                                            <button type="button" class="btn btn-primary shadow-none"data-id="${val.id}" id="room-update-btn"><i class="bi bi-pencil-square"></i></button>

                                            <button type="button" class="btn btn-info shadow-none"data-id="${val.id}" data-name="${val.room_name}"  id="room-image-upload-btn"><i class="bi bi-images"></i></button>

                                            <button type="button" class="btn btn-success shadow-none"data-id="${val.id}" id="room-details-view-btn"><i class="bi bi-eye-fill"></i></button>

                                            <button type="button" class="btn btn-danger shadow-none"data-id="${val.id}" id="room-delete-btn"><i class="bi bi-archive-fill"></i></button>

                                             <button type="button" class="btn ${statusClass} shadow-none toggle-status-btn" data-id="${val.id}" data-status="${val.status}">
                                            ${toggleStatusText}
                                            </button>
                                        </td>
                                    </tr>`);
                        });
                    } else {
                        $('#room-data').append(` <tr> <td class="text-danger text-center" colspan="8">${resp.message}</td></tr>`);
                    }
                },
                error: function() {
                    alert("Error fetching data");
                }
            });
        }
        get_rooms();

        // Room Activate / Deactivate 
        $(document).on('click', '.toggle-status-btn', function() {
            const roomId = $(this).data('id');
            const currentStatus = $(this).data('status');
            const newStatus = currentStatus == 1 ? 0 : 1; // Toggle status between 1 and 0
            $.ajax({
                url: "<?php echo base_url('update-room-status'); ?>", // Adjust this URL to your route
                type: "POST",
                data: {
                    room_id: roomId,
                    status: newStatus
                },
                dataType: "json",
                success: function(resp) {
                    if (resp.status == true) {
                        get_rooms();
                        js_alert(resp.status, resp.message);
                    } else {
                        alert("Failed to update room status. Please try again.");
                    }
                },
                error: function() {
                    alert("Error while trying to toggle room status.");
                }
            });
        });


        // Delete Room 
        $(document).on('click', '#room-delete-btn', function() {
            const roomId = $(this).data('id');
            const row = $(this).closest('tr'); // Get the closest table row

            // Confirmation prompt
            if (confirm("Are you sure you want to delete this Recrod.")) {
                $.ajax({
                    url: `<?= base_url("delete-room/") ?>${roomId}`, // Adjust this URL to your route
                    type: "get",
                    dataType: "json",
                    success: function(resp) {
                        if (resp.status == true) {
                            row.fadeOut();
                            alert(resp.message);
                            js_alert(resp.status.resp.message);

                        } else {
                            js_alert(resp.status.resp.message);
                        }
                    },
                    error: function() {
                        alert("Error occurred while trying to delete the room.");
                    }
                });
            }
        });

        // Room Details Sohw in Edit Model
        $(document).on('click', '#room-update-btn', function() {
            const roomId = $(this).data('id');

            $.ajax({
                url: "<?php echo base_url('get-room-details'); ?>/" + roomId,
                type: "GET",
                dataType: "json",
                success: function(resp) {
                    if (resp.status === true) {

                        $.each(resp.features, function(index, val) {
                            console.log("Feature ID: " + val);
                        });

                        // Populate the form fields
                        $('#roomId').val(resp.data.id);
                        $('#editRoomName').val(resp.data.room_name);
                        $('#editRoomArea').val(resp.data.area);
                        $('#editRoomPrice').val(resp.data.price);
                        $('#editRoomQuantity').val(resp.data.quantity);
                        $('#editRoomAdult').val(resp.data.adult);
                        $('#editRoomChildren').val(resp.data.children);
                        $('#editRoomDesc').val(resp.data.desc);

                        // Populate checkboxes for features
                        $('#editRoomFeatures input[type="checkbox"]').each(function() {
                            const checkboxValue = $(this).val();
                            if (resp.data.features.includes(checkboxValue)) {
                                $(this).prop('checked', true);
                            } else {
                                $(this).prop('checked', false);
                            }
                        });

                        // Populate checkboxes for facilities
                        $('#editRoomFacilities input[type="checkbox"]').each(function() {
                            const checkboxValue = $(this).val();
                            if (resp.data.facilities.includes(checkboxValue)) {
                                $(this).prop('checked', true);
                            } else {
                                $(this).prop('checked', false);
                            }
                        });

                        // Show the modal
                        $('#edit-room-modal').modal('show');
                    } else {
                        alert("Failed to fetch room details.");
                    }
                },
                error: function() {
                    alert("Error fetching room data.");
                }
            });
        });

        // Edit Room Data Submit 
        $('#edit-room-form').on('submit', function(e) {
            e.preventDefault();
            $('.text-danger').text('');
            $('#success-message').text('');
            $('#error-message').text('');
            $.ajax({
                url: '<?= base_url("room-data-update"); ?>',
                type: 'POST',
                data: $('#edit-room-form').serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        js_alert(response.status, response.message);
                        $('#edit-room-form')[0].reset();
                        $('#edit-room-modal').modal('hide');
                    } else {
                        // Display validation errors
                        if (response.errors) {
                            for (let field in response.errors) {
                                $('#' + field + '_error').show().text(response.errors[field]);
                            }
                        }
                        if (response.status === false) {
                            $('#edit-room-modal').modal('hide');
                            js_alert(response.status, response.message);
                        }
                    }
                },
                error: function() {
                    $('#error-message').text('An error occurred while updating the room.');
                }
            });
        });


        // Room Details View
        $(document).on('click', '#room-details-view-btn', function() {
            const roomId = $(this).data('id');
            $.ajax({
                url: "<?php echo base_url('get-room-details'); ?>/" + roomId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        // Populate room details in a modal or view
                        $('#room-details-modal .modal-body').html(`
                    <p><strong>Room No:</strong> ${response.data.id}</p>
                    <p><strong>Room Name:</strong> ${response.data.room_name}</p>
                    <p><strong>Area:</strong> ${response.data.area} sq ft</p>
                    <p><strong>Price:</strong> $ ${response.data.price}</p>
                    <p><strong>Quantity:</strong> ${response.data.quantity}</p>
                    <p><strong>Max Adults:</strong> ${response.data.adult}</p>
                    <p><strong>Max Children:</strong> ${response.data.children}</p>
                    <p><strong>Description:</strong> ${response.data.desc}</p>
                    <p><strong>Features:</strong> ${response.data.feature_name.join(', ')}</p>
                    <p><strong>Facilities:</strong> ${response.data.facility_name.join(', ')}</p>
                `);
                        $('#room-details-modal').modal('show');
                    } else {
                        alert('Failed to fetch room details. Please try again.');
                    }
                },
                error: function() {
                    alert('An error occurred while fetching room details.');
                }
            });
        });


        // Room Image updode Model Show date 
        // $(document).on('click', '#room-image-upload-btn', function() {
        //     const roomId = $(this).data('id');
        //     const name = $(this).data('name');
        //     // Validate room ID
        //     if (!roomId || isNaN(roomId)) {
        //         alert('Invalid Room ID.');
        //         return;
        //     }
        //     $('#room-id').val(roomId);
        //     $('.room-img-model-room_name').text(name);
        //     $('#room-image-upload-Modal').modal('show');
        // });

        // Handle the image  upload process
        // $('#upload-image-btn').on('click', function() {
        //     let formData = new FormData($('#room-image-upload-form')[0]);
        //     $.ajax({
        //         url: "<?php echo base_url('room-image-add'); ?>",
        //         type: 'POST',
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         success: function(response) {
        //             if (response.status === true) {
        //                 js_alert(response.status, response.message);
        //             } else if (response.error) {
        //                 if (response.errors.room_image) {
        //                     $('#room_image_error').text(response.errors.room_image).show();
        //                 }
        //             }else{
        //                 if (response.status===false) {
        //                     js_alert(response.status,response.message)
        //                 }
        //             }
        //         },
        //         error: function() {
        //             alert('An error occurred during the upload.');
        //         }
        //     });
        // });

        $(document).on('click', '#room-image-upload-btn', function() {
            const roomId = $(this).data('id');
            const name = $(this).data('name');

            if (!roomId || isNaN(roomId)) {
                alert('Invalid Room ID.');
                return;
            }

            $('#room-id').val(roomId); // Set room ID in hidden input
            $('.room-img-model-room_name').text(name); // Set room name
            $('#room-image-upload-Modal').modal('show'); // Show modal
        });

        $('#room-image-upload-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "<?php echo base_url('room-image-add'); ?>",
                type: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from automatically processing the data
                contentType: false, // Ensure the request is sent as multipart/form-data
                success: function(response) {
                    try {
                        response = typeof response === "string" ? JSON.parse(response) : response;
                        if (response.status == true) {
                            js_alert(response.status, response.message); // Show success alert
                        } else {
                            if (response.errors) {
                                if (response.errors && response.errors.room_image) {
                                    $('#room_image_error').text(response.errors.room_image).show();
                                } 
                            }
                            if (response.status==false) {
                                js_alert(response.status, response.message);
                            }

                        }
                    } catch (e) {
                        console.error('Invalid JSON response', e);
                        alert('An unexpected error occurred.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    alert('An error occurred during the upload.');
                }
            });
        });







    });
</script>