<?php
// delete_user.php
session_start();
require_once 'db_connection.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
}
header("Location: manage_users.php");
exit();
