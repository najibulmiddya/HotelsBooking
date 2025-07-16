<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-success">
            <div class="modal-header custom-bg text-white">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i id="success_icon" class="bi bi-check-circle"></i>
                <p id="success_modal_text"></p>
            </div>
            <div class="modal-footer" id="successButtonAdd">

            </div>
        </div>
    </div>
</div>

<!-- Failed Modal -->
<div class="modal fade" id="failedModal" tabindex="-1" aria-labelledby="failedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="failedModalLabel"><i class="bi bi-exclamation-triangle-fill me-2"></i>Failed</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body  text-center">
                <i id="failed_icon" class="bi bi-x-circle-fill"></i>
                <p id="failed_modal_text"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger shadow-none" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>
<!-- main-content end -->
<?php require(APPPATH . 'views/admin/include/scripts.php') ?>

</body>

</html>