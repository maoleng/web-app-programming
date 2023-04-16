<h1>Trang chu</h1>


<?php if (authed() === null) { ?>
    <a href="<?= url('login') ?>">Login</a>
<?php } else { ?>
    <p>Hello <?= authed()->name ?></p>
    <a href="<?= url('logout') ?>">Logout</a>
<?php } ?>
