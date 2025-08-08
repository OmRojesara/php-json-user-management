<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2 style="text-align:center;">Login</h2>
<?php if (!empty($error)): ?>
<p style="color:red; text-align:center;"><?= $error ?></p>
<?php endif ?>
<form method="post" action="?action=login" style="text-align:center;">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="submit" value="Login">
</form>
<p style="text-align:center;"><a href="?action=register">Create an account</a></p>
</body>
</html>
