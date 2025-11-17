<?php
// index.php - landing
session_start();
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
header("Location: login.php");
exit();
