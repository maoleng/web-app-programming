<h1>Register</h1>

<?= showFirstError() ?>

<form action="<?= url('/process_register') ?>" method="post">
    Name
    <input type="text" name="name">
    <br>
    Email
    <input type="text" name="email">
    <br>
    Password
    <input type="password" name="password">
    <br>
    Retype Password
    <input type="password" name="re_password">
    <br>
    <button>Register</button>
</form>