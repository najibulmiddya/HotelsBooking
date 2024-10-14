<h3 class="mb-4">SETTINGS</h3>
<!-- Carousel Images Section -->
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">Carousel Images</h5>
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                data-bs-target="#carousel-s">
                <i class="bi bi-person-add"></i> Add
            </button>
        </div>
        <div class="row" id="carousel-data">

        </div>
    </div>
</div>
<!--  Carousel Images Section  End -->

<!-- Carousel Images Modal -->
<div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="carousel-model">

        <form id="carousel-from" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Image</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Picture</label>
                        <input id="carousel_image_inp" name="carousel_image_inp" type="file"
                            class="form-control shadow-none">
                        <div id="carousel_image_error" class="text-danger" style="display:none;"></div>
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

<script>
    $(document).ready(function() {
        //  add Carousel Images function call
        $('#carousel-from').submit(function(event) {
            event.preventDefault();
            let picture = $('#carousel_image_inp').val();
            if (picture == '') {
                $('#carousel_image_error').text('Plese Image Select').show();
                return false;
            } else {
                $('#carousel_image_error').text('').hide();
            }

            data = new FormData(this);

            $.ajax({
                type: "POST",
                url: `<?= base_url("carousel-add-image") ?>`,
                dataType: "JSON",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(resp) {
                    if (resp.status == true) {
                        get_image();
                        $('#carousel-from')[0].reset();
                        $('#carousel-s').modal('hide');
                        js_alert(resp.status, resp.message)
                    }
                    if (resp.status == 'upload failed') {
                        $('#carousel_image_inp').val('');
                        $('#carousel-s').modal('hide');
                        js_alert(resp.status, resp.message)
                    } else {
                        $('#carousel-s').modal('hide');
                        js_alert(resp.status, resp.message)
                    }
                },
                error: function(status = "error", error) {
                    js_alert(status, error)
                }
            });
        });

        function get_image() {
            $.ajax({
                type: "GET",
                url: `<?= base_url("carousel-get-image") ?>`,
                dataType: "JSON",
                success: function(resp) {
                    if (resp.status == true) {
                        let teamHtml = '';
                        let sno = 1;
                        for (let i = 0; i < resp.response.length; i++) {
                            let image = resp.response[i]['image'];
                            let id = resp.response[i]['id'];
                            teamHtml += `
                            <div class="col-md-4 mb-3 img_id" data-id="${id}">
                            <div class="card bg-dark text-white">
                            <img class="card-img" src="<?= CAROUSE_IMAGE_SITE_PATH ?>${image}">
                            <div class="card-img-overlay text-end">
                            <button type="button" class="btn btn-danger btn-ms text-end shadow-none delete-btn">
                           <i class="bi bi-trash"></i> Delete
                           </button>
                           </div>
                           <p class="card-text text-center px-3 py-2">Image ${sno++}</p>
                           </div>
                          </div>`;
                        }

                        $('#carousel-data').html(teamHtml);
                    }
                },
                error: function(status = "error", error) {
                    js_alert(status, error)
                }
            });
        }
        get_image();

        $('#carousel-data').on('click', '.delete-btn', function() {
            let imageCard = $(this).closest('.img_id');
            let imageId = imageCard.data('id');
            if (confirm('Are you sure you want to delete this member?')) {
                $.ajax({
                    url: `<?= base_url("carousel-delete-image") ?>`,
                    type: 'POST',
                    data: {
                        id: imageId
                    },
                    dataType: 'json',
                    success: function(resp) {
                        if (resp.status == true) {
                            imageCard.remove();
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