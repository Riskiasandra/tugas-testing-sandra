<?php
// profile.php
session_start();
require_once 'db_connection.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : $_SESSION['user_id'];

$res = mysqli_query($conn, "SELECT id, username FROM users WHERE id=$id LIMIT 1");
$user = mysqli_fetch_assoc($res);
if (!$user) {
    echo "User tidak ditemukan.";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Profile</title></head>
<body>
<h2>Profile: <?= htmlspecialchars($user['username']) ?></h2>
<p>ID: <?= $user['id'] ?></p>
<p>Username: <?= htmlspecialchars($user['username']) ?></p>
<p><a href="update_profile.php?id=<?= $user['id'] ?>">Edit</a></p>
<p><a href="dashboard.php">Back</a></p>
</body>
</html>
