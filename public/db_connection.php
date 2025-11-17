<?php
// db_connection.php
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "formlogin_db";

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (!$conn) {
    // jangan tampilkan detail sensitif di production
    die("Koneksi database gagal: " . mysqli_connect_error());
}
