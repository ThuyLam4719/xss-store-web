<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "thucung";

$mysqli = new mysqli($servername, $username, $password, $dbname);
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}
?>
