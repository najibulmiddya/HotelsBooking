<h3 class="mb-4">Users</h3>
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <table class="" id="usersTable">
            <thead>
                <tr class="">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Verified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="usersData">
                
            </tbody>
        </table>
    </div>
</div>

<!-- Confirm Status Toggle Modal -->
<div class="modal fade" id="confirmStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header custom-bg text-white">
                <h5 class="modal-title"><i class="bi bi-question-circle-fill"></i> Change Status</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to <span class="fw-bold" id="statusAction"></span> user: <span class="fw-bold" id="statusUserName"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn custom-bg text-white shadow-none" id="confirmStatusBtn">Yes, Proceed</button>
            </div>
        </div>
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
                Are you sure you want to delete <span class="fw-bold" id="deleteUserName"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn custom-bg text-white shadow-none" id="confirmDeleteBtn">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="bi bi-check-circle-fill"></i> Success</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="successModalText"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        fetchUsers();

        function fetchUsers() {
            $.ajax({
                url: '<?= base_url("admin/fetch-users") ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        let rows = '';
                        $.each(response.data, function(index, user) {
                            let statusBtn = user.status == 1 ?
                                `<button class="btn btn-success btn-sm toggle-status" data-id="${user.id}" data-name="${user.name}" data-status="0">
                                <i class="bi bi-check-circle-fill"></i> Active
                           </button>` :
                                `<button class="btn btn-danger btn-sm toggle-status" data-id="${user.id}" data-name="${user.name}" data-status="1">
                                <i class="bi bi-x-circle-fill"></i> Inactive
                           </button>`;

                            let verifiedIcon = user.is_verified == 1 ?
                                `<i class="bi bi-patch-check-fill text-success fs-5"></i>` :
                                `<i class="bi bi-x-circle-fill text-danger fs-5"></i>`;

                            let deleteBtn = '';

                            if (user.is_verified == 0) {
                                deleteBtn = `<button class="btn btn-danger btn-sm delete-user" data-name="${user.name}" data-id="${user.id}">
                                <i class="bi bi-archive-fill"></i>
                                </button>`;
                            } else {
                                deleteBtn = `<button class="btn btn-danger btn-sm" disabled>
                                <i class="bi bi-archive-fill"></i>
                                </button>`;
                            }


                            rows += `
                        <tr>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>${user.number}</td>
                            <td>${statusBtn}</td>
                            <td>${verifiedIcon}</td>
                            <td>${deleteBtn}</td>
                        </tr>`;
                        });

                        // Destroy DataTable before updating table content
                        if ($.fn.DataTable.isDataTable('#usersTable')) {
                            $('#usersTable').DataTable().clear().destroy();
                        }
                        // Inject new rows
                        $('#usersData').html(rows);
                        // Re-initialize DataTable after DOM update
                        $('#usersTable').DataTable({
                            responsive: true,
                            destroy: true,
                            pageLength: 10,
                        });

                    } else {
                        $('#usersData').html(`
                    <tr>
                        <td colspan="6" class="text-center text-danger">${response.message}</td>
                    </tr>`);
                    }
                },
                error: function() {
                    $('#usersData').html(`
                <tr>
                    <td colspan="6" class="text-center text-danger">Failed to fetch data from server.</td>
                </tr>`);
                }
            });
        }

        // User Activate and Deactivate 
        let statusUserId = null;
        let newStatus = null;
        $(document).on('click', '.toggle-status', function() {
            statusUserId = $(this).data('id');
            newStatus = $(this).data('status');
            let name = $(this).data('name');
            $('#statusUserName').text(name);
            $('#statusAction').text(newStatus == 1 ? 'Activate' : 'Deactivate');
            $('#confirmStatusModal').modal('show');
        });
        $('#confirmStatusBtn').on('click', function() {
            if (statusUserId !== null) {
                $.post('<?= base_url("admin/toggle-user-status") ?>', {
                    id: statusUserId,
                    status: newStatus
                }, function(res) {
                    $('#confirmStatusModal').modal('hide');
                    $('#successModalText').text(res.message || 'Status updated successfully.');
                    $('#successModal').modal('show');
                    fetchUsers();
                    statusUserId = null;
                    newStatus = null;
                }, 'json');
            }
        });

    //  <<---------- unverified uses delete -------------->>
        let deleteUserId = null;
        $(document).on('click', '.delete-user', function() {
            deleteUserId = $(this).data('id');
            let userName = $(this).data('name');
            $('#deleteUserName').text(userName);
            $('#confirmDeleteModal').modal('show');
        });

        // Confirm delete button
        $('#confirmDeleteBtn').on('click', function() {
            if (deleteUserId) {
                $.post('<?= base_url("admin/delete-user") ?>', {
                    id: deleteUserId
                }, function(res) {
                    $('#confirmDeleteModal').modal('hide');
                    $('#successModalText').text(res.message || 'User deleted successfully.');
                    $('#successModal').modal('show');
                    fetchUsers(); // reload
                }, 'json');
            }
        });

    });
</script>