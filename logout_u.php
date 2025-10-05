<?php
session_start(); // Bắt đầu session

// Hủy toàn bộ session hiện tại (logout user)
if (session_destroy()) {
    // Sau khi logout thành công, điều hướng về trang đăng nhập user
    header("Location: customerlogin.php"); 
    exit(); // Thoát chương trình để tránh chạy thêm code thừa
}
?>
