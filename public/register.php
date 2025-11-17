<?php
// register.php
require_once 'db_connection.php';
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username'] ?? '');
    $password = mysqli_real_escape_string($conn, $_POST['password'] ?? '');

    if ($username === "" || $password === "") {
        $msg = "Isi semua field.";
    } else {
        // pastikan unik username
        $chk = mysqli_query($conn, "SELECT id FROM users WHERE username='$username' LIMIT 1");
        if ($chk && mysqli_num_rows($chk) > 0) {
            $msg = "Username sudah terpakai.";
        } else {
            // NOTE: bila ingin aman, gunakan password_hash
            $ins = mysqli_query($conn, "INSERT INTO users (username,password) VALUES ('$username','$password')");
            if ($ins) {
                header("Location: login.php");
                exit();
            } else {
                $msg = "Gagal registrasi.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Register</title></head>
<body>
<h2>Register</h2>
<?php if($msg) echo "<p style='color:red;'>$msg</p>"; ?>
<form method="post" action="">
  <input name="username" placeholder="Username" required><br><br>
  <input name="password" type="password" placeholder="Password" required><br><br>
  <button type="submit">Daftar</button>
</form>
<p>Sudah punya akun? <a href="login.php">Login</a></p>
</body>
</html>
