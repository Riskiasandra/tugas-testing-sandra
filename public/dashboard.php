<?php
// dashboard.php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Dashboard</title></head>
<body>
<h2>Dashboard</h2>
<p>Halo, <?=htmlspecialchars($_SESSION['username'])?></p>
<ul>
  <li><a href="manage_users.php">Manage Users</a></li>
  <li><a href="profile.php">Profile</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
</body>
</html>
