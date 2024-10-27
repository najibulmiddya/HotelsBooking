<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">CONTACT US</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit.<br>
        Beatae reiciendis repudiandae a dolores nam, porro unde deserunt velit tempore quam.</p>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 mb-5 px-4">
            <div class="bg-white rounded p-4 shadow">
                <iframe class="w-100 rounded mb-4"
                    src="<?= $contact_details->iframe ?>"
                    height="320px" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <h5>Address</h5>
                <a href="https://maps.app.goo.gl/Prb9ntMdsodFWuwk8" target="_blank"
                    class="d-inline-block text-decoration-none text-dark mb-2">
                    <i class="bi bi-geo-alt-fill"></i> <?= $contact_details->address ?>
                </a>

                <h5 class="mt-4">Call us</h5>
                <a class="text-decoration-none d-inline-block mb-2 text-dark" href="tel:<?= $contact_details->ph1 ?>"> <i
                        class="bi bi-telephone-fill"></i> <?= $contact_details->ph1 ?>
                </a>
                <br>
                <a class="text-decoration-none d-inline-block text-dark" href="tel:<?= $contact_details->ph2 ?>"> <i
                        class="bi bi-telephone-fill"></i> <?= $contact_details->ph2 ?>
                </a>

                <h5 class="mt-4">Email</h5>
                <a href="mailto: <?= $contact_details->email ?>" class="text-decoration-none d-inline-block text-dark">
                    <i class="bi bi-envelope-fill"></i> <?= $contact_details->email ?>
                </a>

                <h5 class="mt-4">Follow us</h5>
                <a href="<?= $contact_details->tw ?>" class="d-inline-block text-dark fs-5 me-2">
                    <i class="bi bi-twitter me-1"></i>
                </a>

                <a href="<?= $contact_details->fb ?>" class="d-inline-block text-dark fs-5 me-2">
                    <i class="bi bi-facebook me-1"></i>
                </a>

                <a href="<?= $contact_details->insta ?>" class="d-inline-block text-dark fs-5">
                    <i class="bi bi-instagram me-1"></i>
                </a>
            </div>
        </div>

        <!-- Send Message form -->
        <div class="col-lg-6 col-md-6 px-4">
            <div class="bg-white rounded p-4 shadow">
                <form id="user_contact_us_form">
                    <h5>Send a Message</h5>

                    <div class="mt-3">
                        <label class="form-label" style="font-weight: 500;">Name</label>
                        <input type="text" id="user_name_inp" name="name" class="form-control shadow-none">
                        <span id="user_name_error" class="text-danger"></span>
                    </div>

                    <div class="mt-3">
                        <label class="form-label" style="font-weight: 500;">Email</label>
                        <input type="email" id="user_email_inp" name="email" class="form-control shadow-none">
                        <span id="user_email_error" class="text-danger"></span>
                    </div>

                    <div class="mt-3">
                        <label class="form-label" style="font-weight: 500;">Subject</label>
                        <input type="text" id="user_subject_inp" name="subject" class="form-control shadow-none">
                        <span id="user_subject_error" class="text-danger"></span>
                    </div>

                    <div class="mt-3">
                        <label class="form-label" style="font-weight: 500;">Message</label>
                        <textarea class="form-control shadow-none" id="user_message_inp" name="message" rows="5" style="resize: none;"></textarea>
                        <div id="user_message_error" class="text-danger"></div>
                    </div>

                    <button class="btn text-white custom-bg mt-3" type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('#user_contact_us_form').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: `<?= base_url("contact-from-submit") ?>`,
                type: 'POST',
                data: {
                    name: $('#user_name_inp').val(),
                    email: $('#user_email_inp').val(),
                    subject: $('#user_subject_inp').val(),
                    message: $('#user_message_inp').val()
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == "validation errors") {
                        // Display validation errors
                        $('#user_name_error').text(response.errors.name);
                        $('#user_email_error').text(response.errors.email);
                        $('#user_subject_error').text(response.errors.subject);
                        $('#user_message_error').text(response.errors.message);
                    } else {
                        $('#user_name_error').text('');
                        $('#user_email_error').text('');
                        $('#user_subject_error').text('');
                        $('#user_message_error').text('');
                    }
                    if (response.status == true) {
                        $('#user_contact_us_form')[0].reset();
                        js_alert(response.status, response.message);
                    }

                    if (response.status == false) {
                        js_alert(response.status, response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert("An error occurred: " + error);
                }
            });
        });
    });
</script>