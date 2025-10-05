<?php
session_start();  // Bắt đầu session để lưu thông tin đăng nhập
$error='';        // Biến lưu thông báo lỗi

if (isset($_POST['submit'])) { // Kiểm tra nếu form được submit
    if (empty($_POST['username']) || empty($_POST['password'])) {
        // Nếu username hoặc password trống
        $error = "Username hoặc Email không tồn tại.";
    }
    else
    {
        // Lấy dữ liệu từ form
        $username=$_POST['username'];
        $password=$_POST['password'];

        // Kết nối CSDL
        require 'connection.php';
        $conn = Connect();

        // Chuẩn bị truy vấn: lấy username và password trong bảng MANAGER
        $query = "SELECT username, password FROM MANAGER WHERE username=? AND password=? LIMIT 1";

        // Chuẩn bị statement để chống SQL Injection
        $stmt = $conn->prepare($query);

        // Gắn tham số vào câu lệnh SQL
        $stmt -> bind_param("ss", $username, $password);

        // Thực thi câu lệnh
        $stmt -> execute();

        // Gán kết quả trả về cho biến (ở đây sẽ ghi đè $username và $password)
        $stmt -> bind_result($username, $password);

        // Lưu kết quả để kiểm tra
        $stmt -> store_result();

        // Nếu fetch() thành công tức là có bản ghi khớp
        if ($stmt->fetch())  
        {
            // Tạo session đăng nhập
            $_SESSION['login_user1']=$username; 

            // Chuyển hướng sang trang quản lý món ăn
            header("location: view_food_items.php"); 
        } else {
            // Nếu không tìm thấy tài khoản
            $error = "Username hoặc Email không tồn tại.";
        }

        // Đóng kết nối CSDL
        mysqli_close($conn); 
    }
}
?>
