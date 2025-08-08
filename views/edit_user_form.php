<!DOCTYPE html>
<html>
<head><title>Edit User</title></head>
<body>
<h2 style="text-align:center;">Edit User</h2>
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
<form method="post" action="?action=update" style="text-align:center;">
    <input type="hidden" name="id" value="<?= $user->id ?>">
    <input type="text" name="name" value="<?= $user->name ?>" required><br><br>
    <input type="email" name="email" value="<?= $user->email ?>" required><br><br>
    <input type="password" name="password" placeholder="New Password (leave blank to keep current)"><br><br>
    <input type="submit" value="Update User">
</form>
</body>
</html>
