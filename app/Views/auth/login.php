<h1>Login</h1>

<?= showFirstError() ?>

<form action="<?= url('/process_login') ?>" method="post">
    Email
    <input type="text" name="email">
    <br>
    Password
    <input type="password" name="password">
    <br>
    <button>Login</button>
</form>