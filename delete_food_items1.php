<?php
// Gọi session để kiểm tra admin đã đăng nhập chưa
include('session_m.php');

// Nếu chưa đăng nhập thì quay về trang login admin
if(!isset($login_session)){
    header('Location: managerlogin.php'); 
    exit();
}

// Lấy danh sách ID từ checkbox (danh sách ID món ăn được chọn)
$cheks = implode("','", $_POST['checkbox']); 
// Ghép thành chuỗi kiểu: '1','2','3'

// Câu lệnh SQL xóa các món có ID trong danh sách
$sql = "DELETE FROM FOOD WHERE F_ID in ('$cheks')";

// Thực thi câu lệnh xóa, nếu lỗi sẽ dừng ngay
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// Sau khi xóa xong thì quay về trang danh sách món ăn
header('Location: delete_food_items.php');

// Đóng kết nối database
$conn->close();
?>
