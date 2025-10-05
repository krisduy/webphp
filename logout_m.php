<?php
session_start(); // Bắt đầu session để có thể hủy

// Kiểm tra và hủy toàn bộ session hiện tại
if(session_destroy()) { 
    // Nếu hủy session thành công thì điều hướng về trang đăng nhập Admin
    header("Location: managerlogin.php"); 
    exit(); // Thoát luôn để đảm bảo không chạy thêm code nào khác
}
?>
