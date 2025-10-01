<html>

  <head>
    <title> User Đăng Kí | HUYFOOD </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/manager_registered_success.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">HUYFOOD</a>
        </div>

        <div class="collapse navbar-collapse " id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active" ><a href="index.php">Trang Chủ</a></li>
            <li><a href="aboutus.php">Về Chúng Tôi</a></li>
            <li><a href="contactus.php">Liên Hệ</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Đăng Kí </a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Đăng Nhập </a></li>
          </ul>
        </div>

      </div>
    </nav>

<?php

require 'connection.php';
$conn = Connect();

$fullname = $conn->real_escape_string($_POST['fullname']);
$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$contact = $conn->real_escape_string($_POST['contact']);
$address = $conn->real_escape_string($_POST['address']);
$password = $conn->real_escape_string($_POST['password']);

// Hash mật khẩu
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Kiểm tra username tồn tại chưa
$check_query = "SELECT username FROM CUSTOMER WHERE username='$username'";
$check_result = $conn->query($check_query);

if ($check_result->num_rows > 0) {
    die("Lỗi: Username '$username' đã tồn tại. Vui lòng chọn username khác.");
}

// Dòng 56 đã sửa:
$query = "INSERT INTO CUSTOMER (username, email, password,address,Telephone,fullname) VALUES('$username', '$email', '$hashed_password','$address','$contact','$fullname')";
$success = $conn->query($query);

if (!$success){
	die("Couldnt enter data: ".$conn->error);
}

$conn->close();

?>


<div class="container">
	<div class="jumbotron" style="text-align: center;">
		<h2> <?php echo "Xin Chào $fullname!" ?> </h2>
		<h1>Đăng Kí Thành Công.</h1>
		<p>Đăng Nhập Tại <a href="customerlogin.php">Đây!</a></p>
	</div>
</div>

  </body>

  <footer class="container-fluid bg-4 text-center">
  <br>
  <p> HUYFOOD 2025 | &copy; </p>
  <br>
  </footer>
</html>
