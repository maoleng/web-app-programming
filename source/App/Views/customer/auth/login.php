<?php $old = session()->get('old') ?>

<!doctype html>
<html lang="en">
<?php include section('customer-theme.head_tag') ?>
<body class="login-page">
<?php include section('customer-theme.header') ?>
<div class="page-header header-filter" style="background-image: url('<?= url('public/assets/img/bg7.jpg') ?>'); background-size: cover; background-position: top center;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <div class="card card-signup">
                    <form class="form" method="post" action="<?= url('/process_login') ?>">
                        <div class="header header-primary text-center">
                            <h4 class="card-title">Log in</h4>
                        </div>
                        <p class="text-center"><strong><?= showFirstError() ?></strong></p>
                        <div class="card-content">
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="material-icons">email</i>
                                </span>
                                <input name="email" value="<?= $old['email'] ?? null ?>" type="text" class="form-control" placeholder="Email...">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="material-icons">lock_outline</i>
                                </span>
                                <input name="password" type="password" placeholder="Password..." class="form-control" />
                            </div>
                        </div>
                        <div class="footer text-center">
                            <button class="btn btn-primary btn-simple btn-wd btn-lg">Login</button>
                        </div>
                        <p class="description text-center">Does not have account ? <a href="<?= url('register') ?>">Register</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include section('customer-theme.script') ?>
<script>
    <?= alertError() ?>
    <?= alertSuccess() ?>
</script>
</html>