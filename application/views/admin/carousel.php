<!-- Carousel Images Section -->
<div class="card border-0  mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">
                <i class="bi bi-images me-2 text-info"></i> Carousel Images
            </h5>
            <button type="button" class="btn btn-primary btn-sm shadow" data-bs-toggle="modal"
                data-bs-target="#carousel-s">
                <i class="bi bi-plus-circle me-1"></i> Add Image
            </button>
        </div>

        <!-- Loader -->
        <div id="carousel-loader" class="text-center d-none mb-3">
            <div class="spinner-border text-info" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="row" id="carousel-data">

            <!-- Images load here dynamically -->
        </div>
    </div>
</div>

<!-- Carousel Images Modal -->
<div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true" style="backdrop-filter: blur(1px);">
    <div class="modal-dialog" id="carousel-model">

        <form id="carousel-from" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Add Image</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Picture</label>
                        <input id="carousel_image_inp" name="carousel_image_inp" type="file" class="form-control shadow-none">
                        <div id="carousel_image_error" class="text-danger d-none mt-1"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cencel-carousel-modal" class="btn text-secondary shadow-none"
                        data-bs-dismiss="modal">CENCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Carousel Images Modal End -->

<!-- JavaScript (jQuery + Bootstrap 5) -->
<script>
    $(document).ready(function() {

        $('#carousel-from').submit(function(event) {
            event.preventDefault();

            let fileInput = $('#carousel_image_inp')[0];
            let file = fileInput.files[0];

            // Validate if file is selected
            if (!file) {
                $('#carousel_image_inp').addClass('is-invalid');
                $('#carousel_image_error').text('Please select an image.').removeClass('d-none');
                return false;
            }

            // Validate file type
            let allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                $('#carousel_image_inp').addClass('is-invalid');
                $('#carousel_image_error').text('Only JPG, PNG, and GIF files are allowed.').removeClass('d-none');
                return false;
            }

            // Validate file size (max 1MB)
            if (file.size > 1 * 1024 * 1024) {
                $('#carousel_image_inp').addClass('is-invalid');
                $('#carousel_image_error').text('File size must be less than 1MB.').removeClass('d-none');
                return false;
            }

            $('#carousel_image_inp').removeClass('is-invalid');
            $('#carousel_image_error').addClass('d-none');

            let formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?= base_url('carousel-add-image') ?>",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(resp) {
                    console.log(resp);
                    if (resp.status === true) {
                        get_image();
                        $('#carousel-from')[0].reset();
                        $('#carousel-s').modal('hide');
                        js_alert(resp.status, resp.message);
                    } else {
                        js_alert(resp.status, resp.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    console.log(xhr.responseText);
                    js_alert('error', 'Server error occurred.');
                }
            });
        });


        // Fetch images
        function get_image() {
            $('#carousel-loader').removeClass('d-none'); // Show loader
            $('#carousel-data').empty();
            $.ajax({
                type: "GET",
                url: `<?= base_url("carousel-get-image") ?>`,
                dataType: "JSON",
                success: function(resp) {
                    $('#carousel-loader').addClass('d-none');
                    if (resp.status === true) {
                        let teamHtml = '';
                        let sno = 1;

                        for (let i = 0; i < resp.response.length; i++) {
                            let image = resp.response[i]['image'];
                            let id = resp.response[i]['id'];

                            let isActive = resp.response[i]['status'] == 1;
                            let toggleIcon = isActive ? 'bi-eye-slash' : 'bi-eye';
                            let toggleText = isActive ? 'Disable' : 'Enable';
                            let toggleBtnClass = isActive ? 'btn-warning text-white' : 'btn-success'; // Yellow for active, green for inactive


                            teamHtml += `
                            <div class="col-md-4 mb-3 img_id" data-id="${id}">
                                <div class="card border shadow h-100">
                                    <img src="<?= CAROUSE_IMAGE_SITE_PATH ?>${image}" class="card-img-top" alt="Carousel Image">
                                    <div class="card-body p-2 text-center">
                                        <p class="card-text mb-2">Carousel Image ${sno++}</p>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-danger delete-btn shadow-none me-1">
                                                <i class="bi bi-archive-fill"></i> Delete
                                            </button>

                                           <button type="button" class="btn btn-sm ${toggleBtnClass} toggle-status-btn shadow-none">
                                            <i class="bi ${toggleIcon} me-1"></i> ${toggleText}
                                        </button>

                                        </div>
                                    </div>
                                </div>
                            </div>`;

                        }

                        $('#carousel-data').html(teamHtml);
                    }
                },
                error: function(status = "error", error) {
                    $('#carousel-loader').addClass('d-none');
                    js_alert(status, error);
                }
            });
        }

        // Initial load
        get_image();

        // Delete image
        $('#carousel-data').on('click', '.delete-btn', function() {
            const imageCard = $(this).closest('.img_id');
            const imageId = imageCard.data('id');

            if (confirm('Are you sure you want to delete this image?')) {
                $.ajax({
                    url: `<?= base_url("carousel-delete-image") ?>`,
                    type: 'POST',
                    data: {
                        id: imageId
                    },
                    dataType: 'json',
                    success: function(resp) {
                        if (resp.status === true) {
                            imageCard.remove();
                            js_alert(resp.status, resp.message);
                        } else {
                            js_alert(resp.status, resp.message);
                        }
                    },
                    error: function(status = "error", error) {
                        js_alert(status, error);
                    }
                });
            }
        });

        // Toggle active/inactive status
        $('#carousel-data').on('click', '.toggle-status-btn', function() {
            const imageCard = $(this).closest('.img_id');
            const imageId = imageCard.data('id');
            const button = $(this);

            $.ajax({
                url: `<?= base_url("carousel-toggle-status") ?>`,
                type: 'POST',
                data: {
                    id: imageId
                },
                dataType: 'json',
                success: function(resp) {
                    if (resp.status === true) {
                        js_alert(resp.status, resp.message);
                        get_image();
                    } else {
                        js_alert(resp.status, resp.message);
                    }
                },
                error: function() {
                    js_alert('error', 'Something went wrong!');
                }
            });
        });


    });
</script>