<h4 class="mb-4"><i class="bi bi-star-fill"></i> Users Rating & Review [Rooms]</h4>
<!-- Filter Section -->
<div class="row">
    <div class="col-md-3">
        <label for="filter_room_id" class="form-label fw-bold">Rooms</label>
        <select id="filter_room_id" class="form-select shadow-none">

        </select>
    </div>

    <div class="col-md-3">
        <label for="filter_rating" class="form-label fw-bold">Rating</label>
        <select id="filter_rating" class="form-select shadow-none">
            <option value="">Select Rating</option>
            <option class="text-warning fw-bold" value="1">★</option>
            <option class="text-warning fw-bold" value="2">★★</option>
            <option class="text-warning fw-bold" value="3">★★★</option>
            <option class="text-warning fw-bold" value="4">★★★★</option>
            <option class="text-warning fw-bold" value="5">★★★★★</option>
        </select>
    </div>

    <div class="col-md-3 d-flex align-items-end">
        <button class="btn btn-primary me-2 shadow-none" id="applyFilter">
            <i class="bi bi-funnel-fill"></i> Filter
        </button>
        <button class="btn btn-secondary shadow-none" id="resetFilter">
            <i class="bi bi-arrow-clockwise"></i> Reset
        </button>
    </div>

</div>

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <!-- Loader for Bookings -->
        <div id="bookingLoader" class="text-center my-3 d-none">
            <div class="spinner-border text-primary" role="status" aria-label="Loading">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 fw-bold mb-0">Loading Data...</p>
        </div>
        <table class="" id="rate_review_table">
            <thead>
                <tr>
                    <th style="width: 14%;">Name</th>
                    <th style="width: 18%;">Room</th>
                    <th style="width: 12%;">Rating</th>
                    <th style="width: 32%;">Review</th>
                    <th style="width: 14%;">Date</th>
                    <th style="width: 4%;" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody id="rate_review_data">

            </tbody>
        </table>
    </div>
</div>


<!-- Confirm Delete Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle-fill"></i> Confirm Deletion</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this Rate & Review ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn custom-bg text-white shadow-none" id="confirmDeleteBtn">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        fetchReview();

        function fetchReview() {
            const filter_room_id = $('#filter_room_id').val();
            const filter_rating = $('#filter_rating').val();

            $('#bookingLoader').removeClass('d-none');
            $('#rate_review_data').html('');

            $.ajax({
                url: '<?= base_url("admin/fetch-room-reviews") ?>',
                type: 'GET',
                data: {
                    room_id: filter_room_id,
                    rating: filter_rating
                },
                dataType: 'json',
                success: function(response) {
                    $('#bookingLoader').addClass('d-none');

                    if (response.status === true) {
                        let rows = '';

                        $.each(response.data, function(index, review) {
                            const date = new Date(review.created_at);
                            const formattedDate = date.toLocaleString('en-GB', {
                                day: '2-digit',
                                month: 'short',
                                year: 'numeric'
                            });

                            let stars = '';
                            for (let i = 1; i <= 5; i++) {
                                stars += `<i class="bi ${i <= review.rating ? 'bi-star-fill text-warning' : 'bi-star text-muted'}"></i>`;
                            }

                            const deleteBtn = `<button class="btn btn-danger delete-user btn-sm" data-id="${review.id}">
                                            <i class="bi bi-archive-fill"></i>
                                        </button>`;

                            rows += `
                        <tr>
                            <td>${review.name}</td>
                            <td>${review.room_name}</td>
                            <td>${stars}</td>
                            <td>${review.review}</td>
                            <td>${formattedDate}</td>
                            <td class="text-center">${deleteBtn}</td>
                        </tr>`;
                        });

                        if ($.fn.DataTable.isDataTable('#rate_review_table')) {
                            $('#rate_review_table').DataTable().clear().destroy();
                        }

                        $('#rate_review_data').html(rows);

                        $('#rate_review_table').DataTable({
                            responsive: true,
                            pageLength: 10,
                        });

                    } else {
                        $('#rate_review_data').html(`
                    <tr>
                        <td colspan="6" class="text-center text-danger">${response.message}</td>
                    </tr>`);
                    }
                },
                error: function() {
                    $('#bookingLoader').addClass('d-none');
                    $('#rate_review_data').html(`
                <tr>
                    <td colspan="6" class="text-center text-danger">Failed to fetch data from server.</td>
                </tr>`);
                }
            });
        }

        // Run on Filter button
        $('#applyFilter').on('click', function() {
            fetchReview();
        });

        // Reset filter button
        $('#resetFilter').on('click', function() {
            $('#filter_room_id').val('');
            $('#filter_rating').val('');
            fetchReview();
        });


        function loadRoomDropdown() {
            $.ajax({
                url: '<?= base_url("admin/fetch-room-review-list") ?>', // create endpoint to return all rooms
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        let options = '<option value="">All</option>';
                        $.each(response.data, function(index, room) {

                            options += `<option value="${room.room_id}">${room.room_name}</option>`;
                        });
                        $('#filter_room_id').html(options);
                    }
                }
            });
        }

        // Call once on page load
        loadRoomDropdown();



        //  <<---------- Delete Rewview-------------->>
        let review_id = null;
        $(document).on('click', '.delete-user', function() {
            review_id = $(this).data('id');
            $('#confirmDeleteModal').modal('show');
        });

        // Confirm delete button
        $('#confirmDeleteBtn').on('click', function() {
            if (review_id) {
                $.post('<?= base_url("admin/delete-room-review") ?>', {
                    id: review_id
                }, function(res) {
                    if (res.status == true) {
                        $('#confirmDeleteModal').modal('hide');
                        review_id = null; // Reset review_id after successful deletion
                        $('#success_modal_text').text(res.message);
                        $('#successModal').modal('show');
                        fetchReview();
                    } else {
                        $('#confirmDeleteModal').modal('hide');
                        $('#failed_modal_text').text(res.message);
                        $('#failed_modal').modal('show');
                    }
                }, 'json');
            }
        });

    });
</script>