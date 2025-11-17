<?php
// manage_users.php
session_start();
require_once 'db_connection.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT id, username FROM users ORDER BY id ASC");
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Manage Users</title></head>
<body>
<h2>Manage Users</h2>
<p><a href="register.php">Tambah User</a></p>
<table border="1" cellpadding="6">
  <tr><th>ID</th><th>Username</th><th>Aksi</th></tr>
  <?php while($r = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><?= $r['id'] ?></td>
      <td><?= htmlspecialchars($r['username']) ?></td>
      <td>
        <a href="profile.php?id=<?= $r['id'] ?>">View</a> |
        <a href="update_profile.php?id=<?= $r['id'] ?>">Edit</a> |
        <a href="delete_user.php?id=<?= $r['id'] ?>" onclick="return confirm('Hapus?')">Delete</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>
<p><a href="dashboard.php">Back</a></p>
</body>
</html>
