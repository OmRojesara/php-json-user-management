<!DOCTYPE html>
<html>
<head><title>User List</title></head>
<body>
<h2 style="text-align:center;">User List</h2>
<div style="text-align:center;">
    <p>Welcome, <?= $_SESSION['user']->name ?> | <a href="?action=logout">Logout</a></p>
</div>

<div style="text-align:center; margin-bottom: 10px;">
    <form method="get" action="index.php">
        <input type="text" name="search" placeholder="Search by name/email" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <input type="submit" value="Search">
        <a href="index.php" style="margin-left:10px;">Reset</a>
    </form>
</div>

<div style="text-align:center; margin-bottom: 10px;">
    <a href="?action=add">Add New User</a>
</div>

<table border="1" cellpadding="8" cellspacing="0" style="margin:auto;">
    <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Created At</th><th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user->id ?></td>
        <td><?= $user->name ?></td>
        <td><?= $user->email ?></td>
        <td><?= Helper::formatDate($user->created_at) ?></td>
        <td>
            <a href="?action=view&id=<?= $user->id ?>">View</a> |
            <a href="?action=edit&id=<?= $user->id ?>">Edit</a> |
            <a href="?action=delete&id=<?= $user->id ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach ?>
</table>
</body>
</html>
