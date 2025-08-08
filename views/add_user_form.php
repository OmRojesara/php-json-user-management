<!DOCTYPE html>
<html>
<head><title>Add User</title></head>
<body>
<h2 style="text-align:center;">Add User</h2>
<div style="text-align:center;">
    <a href="index.php">Back to List</a>
</div>
<?php if (!empty($errors)): ?>
    <ul style="color:red;text-align:center;">
        <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>
<form method="post" action="?action=store" style="text-align:center;">
    <input type="text" name="name" placeholder="Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="submit" value="Add User">
</form>
</body>
</html>
