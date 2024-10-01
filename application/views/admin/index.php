
<?php if (isset($_SESSION['loggedInAdmin'])==true) {
   redirect('dashboard');
}?>
<div class="login-from text-center rounded bg-white shadow overflow-hidden">
    <?= bs_alert() ?>
    <h4 class="bg-dark text-white py-3">ADMIN LOGIN PNAEL</h4>
    <form action="<?= base_url('admin/login') ?>" method="post">
        <div class="p-4">
            <div class="mb-3">
                <input type="text" name="username" value="<?= set_value('username'); ?>"
                    class="form-control shadow-none text-center" placeholder="User Name">
                <div style="color: red;">
                    <?= form_error('username'); ?>
                </div>
            </div>
            <div class="mb-4">
                <input type="password" name="password" class="form-control shadow-none text-center"
                    placeholder="Password">
                <div style="color: red;">
                    <?= form_error('password'); ?>
                </div>
            </div>
            <button type="submit" name="login" class="btn text-white custom-bg shadow-none">LOGIN</button>
        </div>
    </form>
</div>