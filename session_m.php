<?php
//  Kết nối database
require_once 'connection.php';
$conn = Connect();

//  Chỉ start session nếu chưa có session active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//  Kiểm tra xem user đã login chưa
if (!isset($_SESSION['login_user1'])) {
    // Nếu chưa login thì chuyển hướng về trang đăng nhập Admin
    header("Location: managerlogin.php");
    exit();
}

//  Lấy thông tin username của Admin từ session
$user_check = $_SESSION['login_user1'];

//  Truy vấn DB để kiểm tra username có tồn tại trong bảng MANAGER không
$query = "SELECT username FROM MANAGER WHERE username = '$user_check'";
$ses_sql = mysqli_query($conn, $query);

//  Lấy dữ liệu hàng đầu tiên từ kết quả truy vấn
$row = mysqli_fetch_assoc($ses_sql);

//  Gán username vào biến session login_session để sử dụng ở các trang khác
$login_session = $row['username'];
?>
