<?php
// Nếu chưa có session thì khởi tạo session
if(!isset($_SESSION)) {
    session_start();
}

// Kết nối database
include 'connection.php';
$conn = Connect();

// Lấy ID món ăn và hành động từ URL (?id=...&action=...)
$F_ID   = $_GET['id'];
$action = $_GET['action'];

// Lấy số lượng tồn kho từ bảng food
$sql = "SELECT quantity FROM food WHERE F_id = ".$F_ID;
$result = mysqli_query($conn, $sql);

if($result){
    if($obj = mysqli_fetch_assoc($result)) {
        switch($action) {
            case "add":
                // Kiểm tra còn hàng trước khi thêm
                if($_SESSION['cart'][$F_ID] + 1 <= $obj["quantity"]) {
                    $_SESSION['cart'][$F_ID]++;
                }
                break;

            case "remove":
                // Giảm số lượng trong giỏ
                $_SESSION['cart'][$F_ID]--;
                // Nếu số lượng = 0 thì xóa khỏi giỏ
                if($_SESSION['cart'][$F_ID] == 0) {
                    unset($_SESSION['cart'][$F_ID]);
                }
                break;
        }
    }
}

// Chuyển hướng về trang giỏ hàng
header("location:cart.php");
exit();
?>
