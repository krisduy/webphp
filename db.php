<?php
$server   = "sql103.infinityfree.com"; // MySQL Host
$username = "if0_40080644";            // MySQL Username (không có khoảng trắng)
$password = "huyfood123";              // Mật khẩu DB
$dbname   = "if0_40080644_huyfood";    // Tên Database

$conn = mysqli_connect($server, $username, $password, $dbname);

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
?>
