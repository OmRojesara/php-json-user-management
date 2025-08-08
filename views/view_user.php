<!DOCTYPE html>
<html>
<head><title>View User</title></head>
<body>
<h2 style="text-align:center;">User Details</h2>
<div style="text-align:center;">
    <a href="index.php">Back to List</a>
</div>
<table border="1" cellpadding="8" cellspacing="0" style="margin:auto;">
    <tr><th>ID</th><td><?= $user->id ?></td></tr>
    <tr><th>Name</th><td><?= $user->name ?></td></tr>
    <tr><th>Email</th><td><?= $user->email ?></td></tr>
    <tr><th>Created At</th><td><?= Helper::formatDate($user->created_at) ?></td></tr>

</table>
</body>
</html>
