<?php
// connect.php

$servername = "sql110.infinityfree.com";
$username = "if0_37067508"; // MySQL username
$password = "Quocdat123ak"; // Your MySQL password
$dbname = "if0_37067508_skinle"; // Your MySQL database name

// Kết nối cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Thiết lập charset cho kết nối
$conn->set_charset("utf8mb4");
?>
