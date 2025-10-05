<?php
// Kiểm tra nếu hàm Connect chưa được định nghĩa thì mới khai báo
if (!function_exists('Connect')) {
    
    // Hàm Connect dùng để kết nối tới database MySQL
    function Connect() {
        // Thông tin kết nối CSDL
        $dbhost = "localhost";  // Máy chủ CSDL (localhost nghĩa là chạy trên máy cục bộ)
        $dbuser = "root";       // Tên tài khoản MySQL
        $dbpass = "";           // Mật khẩu MySQL (mặc định XAMPP thường để trống)
        $dbname = "huyfood";    // Tên database bạn đã tạo (ở đây là huyfood)

        // Tạo kết nối đến MySQL bằng đối tượng mysqli
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

        // Kiểm tra nếu kết nối thất bại thì dừng chương trình và báo lỗi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Nếu kết nối thành công thì trả về đối tượng kết nối $conn
        return $conn;
    }
}
?>
