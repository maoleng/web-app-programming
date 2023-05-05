<!doctype html>
<html lang="en">
<?php include section('customer-theme.head_tag') ?>
<body class="section-white">
<?php include section('customer-theme.header') ?>

<div class="section">
</div>

<div class="section main main-raised">
    <div class="contact-content">
        <div class="container">
            <h2 class="title">Profile</h2>
            <div class="row">
                <div class="col-md-6">
                    <form action="<?= url('profile') ?>" role="form" id="contact-form" method="post">
                        <p><?= showFirstError() ?></p>
                        <p><?= showSuccess() ?></p>
                        <div class="form-group label-floating">
                            <label class="control-label">Email address</label>
                            <input value="<?= authed()->email ?>" disabled="" type="email" class="disabled form-control"/>
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">Your name</label>
                            <input value="<?= authed()->name ?>" type="text" name="name" class="form-control">
                        </div>
                        <div id="btn-toggle" class="checkbox form-group label-floating">
                            <label>
                                <input type="checkbox" name="is_change_password">
                                Change Password
                            </label>
                        </div>
                        <div class="hidden" id="div-change_password">
                            <div class="form-group label-floating">
                                <label class="control-label">Current password</label>
                                <input type="text" name="password" class="form-control"/>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">New password</label>
                                <input type="text" name="new_password" class="form-control"/>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Retype new password</label>
                                <input type="text" name="re_password" class="form-control"/>
                            </div>
                        </div>

                        <div class="submit text-center">
                            <input type="submit" class="btn btn-primary btn-raised btn-round" value="Change" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include section('customer-theme.footer') ?>
</body>
<?php include section('customer-theme.script') ?>
<script>
    $('#btn-toggle').on('change', function() {
        const div = $('#div-change_password')
        if (div.hasClass('hidden')) {
            div.removeClass('hidden')
        } else {
            div.addClass('hidden')
        }
    })
</script>
</html>