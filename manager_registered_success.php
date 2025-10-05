<html>
  <head>
    <title> Đăng nhập Admin | HUYFOOD </title>
  </head>

  <!-- CSS & Bootstrap -->
  <link rel="stylesheet" type="text/css" href="css/manager_registered_success.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <body>

    <!-- Thanh điều hướng -->
    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <!-- Menu thu gọn trên mobile -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Trang Admin</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">HUYFOOD</a>
        </div>

        <div class="collapse navbar-collapse " id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Trang Chủ</a></li>
            <li><a href="aboutus.php">Về Chúng Tôi</a></li>
            <li><a href="contactus.php">Liên Hệ</a></li>
          </ul>

          <!-- Menu bên phải -->
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> ĐĂNG NHẬP </a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> ĐĂNG NHẬP </a></li>
          </ul>
        </div>
      </div>
    </nav>

<?php
// Kết nối database
require 'connection.php';
$conn = Connect();

// Lấy dữ liệu từ form đăng ký và escape để tránh SQL Injection
$fullname = $conn->real_escape_string($_POST['fullname']);
$username = $conn->real_escape_string($_POST['username']);
$email    = $conn->real_escape_string($_POST['email']);
$contact  = $conn->real_escape_string($_POST['contact']);
$address  = $conn->real_escape_string($_POST['address']);
$password = $conn->real_escape_string($_POST['password']); // ⚠️ Hiện đang lưu password thường, nên dùng password_hash

// Câu lệnh thêm Admin mới vào bảng MANAGER
$query = "INSERT INTO MANAGER(fullname,username,email,contact,address,password) 
          VALUES('$fullname', '$username', '$email', '$contact', '$address', '$password')";

try {
    // Thực thi query
    $success = $conn->query($query);
} catch (mysqli_sql_exception $e) {
    // Nếu trùng username thì báo lỗi
    if (strpos($e->getMessage(), "Duplicate entry") !== false) {
        die("Lỗi: Username '$username' đã tồn tại. Vui lòng chọn tên khác.");
    } else {
        // Các lỗi khác
        die("Lỗi cơ sở dữ liệu: " . $e->getMessage());
    }
}

// Đóng kết nối
$conn->close();
?>

<!-- Giao diện thông báo đăng ký thành công -->
<div class="container">
	<div class="jumbotron" style="text-align: center;">
		<h2> <?php echo "Xin chào $fullname!" ?> </h2>
		<h1>ĐĂNG KÍ THÀNH CÔNG.</h1>
		<p>ĐĂNG NHẬP NGAY TẠI <a href="managerlogin.php">ĐÂY</a></p>
	</div>
</div>

  </body>

  <!-- Footer -->
  <footer class="container-fluid bg-4 text-center">
    <br>
    <p> HUYFOOD 2025 | &copy </p>
    <br>
  </footer>
</html>
