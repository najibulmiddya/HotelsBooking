<h3 class="mb-4">USERS QUERIES</h3>
<!-- USERS QUERIES Table -->
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="text-end mb-4">
            <a id="all-record-seen" class="btn btn-success rounded-pill shadow-none btn-ms" href="javascript:void(0);">
                <i class='bi bi-eye-fill'></i> Mark all read
            </a>

            <a id="all-record-delete" class="btn btn-danger rounded-pill shadow-none btn-ms"
                href="javascript:void(0);"><i class="bi bi-archive-fill"></i> Delete all
            </a>
        </div>
        <div class="table-responsive-md">
            <table id="users-queries-table" class="table table-striped table-hover border" style="width:100%">
                <thead class="text-center">
                    <tr class="bg-secondary text-light">
                        <th width="8%">Name</th>
                        <th width="8%">Email</th>
                        <th width="25%">Subject</th>
                        <th width="30%">Querie</th>
                        <th width="15%">Date & Time</th>
                        <th width="14%">Acction</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if ($queries) {
                        foreach ($queries as $key => $d) {
                            $seen = '';
                            $id = $d['id'];
                            if ($d['seen'] != 1) {
                                $seen = "<a href='javascript:void(0);' data-id='$id'class='btn btn-ms  btn-success seen_update'> <i class='bi bi-eye-fill'></i></a>";
                            } else {
                                $seen = "<a href='javascript:void(0);' class='btn btn-ms btn-success'> <i class='bi bi-file-earmark-check-fill'></i></a>";
                            }
                    ?>
                            <tr>
                                <td>
                                    <?= $d['user_name'] ?>
                                </td>
                                <td>
                                    <?= $d['user_email'] ?>
                                </td>
                                <td>
                                    <?= $d['subjact'] ?>
                                </td>
                                <td>
                                    <?= $d['message'] ?>
                                </td>
                                <td>
                                    <?= $d['created_at'] ?>
                                </td>
                                <td>
                                    <?= $seen ?>

                                    <a href="javascript:void(0);" class="btn btn-ms btn-danger user_queries_delete"
                                        data-id="<?= $id ?>"><i class="bi bi-archive-fill"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6" class="text-danger" style="text-align: center;">No data found.</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Querie</th>
                        <th>Date & Time</th>
                        <th>Acction</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<!--  USERS QUERIES Table  End -->


<script>
    $(document).ready(function() {
        // new DataTable('#users-queries-table');
        var table = $('#users-queries-table').DataTable();

        // singal data delete

        $('body').on('click', '.user_queries_delete', function() {
            // $('.user_queries_delete').on('click', function(e) {
            //     e.preventDefault();

            var id = $(this).data('id');
            var row = $(this).closest('tr'); // Get the row element
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    url: '<?= base_url("users-querie-delete") ?>',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(resp) {
                        if (resp.status === true) {
                            alert(resp.message);
                            row.fadeOut();
                        } else {
                            alert(resp.message);
                        }
                    },
                    error: function() {
                        alert('Error occurred while deleting the item.');
                    }
                });
            }
        });

        // Singal Data Seen
        $('.seen_update').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: '<?= base_url("users-querie-seen") ?>',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(resp) {
                    if (resp.status == true) {
                        js_alert(resp.status, resp.message);
                        table.ajax.reload(null, false);
                    } else {
                        js_alert(resp.status, resp.message);
                    }
                },
                error: function(status = "error", error) {
                    js_alert(status, error)
                }
            });

        });

        // All Data delete
        $('#all-record-delete').on('click', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete All record?')) {
                $.ajax({
                    url: '<?= base_url("users-querie-delete-all") ?>',
                    type: 'POST',
                    success: function(resp) {
                        if (resp.status == true) {
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

        // all Users Querie Seen
        $('#all-record-seen').on('click', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to seen All querie ?')) {
                $.ajax({
                    url: '<?= base_url("users-querie-seen-all") ?>',
                    type: 'POST',
                    success: function(resp) {
                        if (resp.status == true) {
                            js_alert(resp.status, resp.message);
                            table.ajax.reload(null, false);
                        } else {
                            js_alert(resp.status, resp.message);
                        }
                    },
                    error: function(status = "error", error) {
                        js_alert(status, error)
                    }
                });
            }
        });
    });
</script>