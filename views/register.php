<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
<h2 style="text-align:center;">Register</h2>
<div style="text-align:center;">
    <a href="index.php?action=login">Already have an account? Login</a>
</div>
<?php if (!empty($errors)): ?>
    <ul style="color:red;text-align:center;">
        <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>
<form method="post" action="?action=do_register" style="text-align:center;">
    <input type="text" name="name" placeholder="Full Name" required><br><br>
    <input type="email" name="email" placeholder="Email Address" required><br><br>
    <input type="password" name="password" placeholder="Password (min 6 chars)" required><br><br>
    <input type="submit" value="Register">
</form>
</body>
</html>
