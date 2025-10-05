<?php
// Gọi file connection.php để kết nối Database
require 'connection.php';
$conn = Connect();

// Bắt đầu session để quản lý trạng thái đăng nhập
session_start();

// Lấy username đã lưu trong session (khi user đăng nhập thành công)
$user_check = $_SESSION['login_user2'];

// Truy vấn SQL để lấy thông tin username từ bảng CUSTOMER
$query = "SELECT username FROM CUSTOMER WHERE username = '$user_check'";
$ses_sql = mysqli_query($conn, $query);

// Lấy kết quả truy vấn (một dòng dữ liệu) dưới dạng mảng
$row = mysqli_fetch_assoc($ses_sql);

// Lưu username lấy được từ CSDL vào biến $login_session
$login_session = $row['username'];
?>
