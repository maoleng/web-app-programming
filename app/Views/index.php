<h1>Trang chu</h1>

<?= showSuccess() ?>
<br>

<?php if (authed() === null) { ?>
    <a href="<?= url('login') ?>">Login</a>
    <br>
    <a href="<?= url('register') ?>">Register</a>
<?php } else { ?>
    <p>Hello <?= authed()->name ?></p>
    <a href="<?= url('logout') ?>">Logout</a>
<?php } ?>
