<?php
// update_profile.php
session_start();
require_once 'db_connection.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : $_SESSION['user_id'];
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username'] ?? '');
    $password = mysqli_real_escape_string($conn, $_POST['password'] ?? '');

    if ($username !== '') {
        if ($password !== '') {
            mysqli_query($conn, "UPDATE users SET username='$username', password='$password' WHERE id=$id");
        } else {
            mysqli_query($conn, "UPDATE users SET username='$username' WHERE id=$id");
        }
        $msg = "Berhasil update.";
    }
}
$res = mysqli_query($conn, "SELECT id, username FROM users WHERE id=$id LIMIT 1");
$user = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Update Profile</title></head>
<body>
<h2>Update Profile</h2>
<?php if($msg) echo "<p style='color:green;'>$msg</p>"; ?>
<form method="post">
  <label>Username</label><br>
  <input name="username" value="<?= htmlspecialchars($user['username']) ?>" required><br><br>
  <label>Password (kosong = tidak diubah)</label><br>
  <input type="password" name="password"><br><br>
  <button type="submit">Simpan</button>
</form>
<p><a href="profile.php?id=<?=$id?>">Back</a></p>
</body>
</html>
