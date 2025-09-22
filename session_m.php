<?php
// Kết nối database
require_once 'connection.php';
$conn = Connect();

// Chỉ start session nếu chưa có session active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem user đã login chưa
if (!isset($_SESSION['login_user1'])) {
    header("Location: managerlogin.php");
    exit();
}

// Lấy thông tin manager
$user_check = $_SESSION['login_user1'];
$query = "SELECT username FROM MANAGER WHERE username = '$user_check'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);

$login_session = $row['username'];
?>
