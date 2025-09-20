<html>

  <head>
    <title> Đăng nhập Admin | HUYFOOD </title>
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
            <span class="sr-only">thanh quản lí</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">HUYFOOD</a>
        </div>

        <div class="collapse navbar-collapse " id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active" ><a href="index.php">TRANG CHỦ</a></li>
            <li><a href="aboutus.php">VỀ CHÚNG TÔI</a></li>
            <li><a href="contactus.php">LIÊN HỆ</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> ĐĂNG NHẬP </a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> ĐĂNG NHẬP </a></li>
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

$query = "INSERT into MANAGER(fullname,username,email,contact,address,password) VALUES('" . $fullname . "','" . $username . "','" . $email . "','" . $contact . "','" . $address ."','" . $password ."')";
$success = $conn->query($query);

if (!$success){
	die("Couldnt enter data: ".$conn->error);
}

$conn->close();

?>


<div class="container">
	<div class="jumbotron" style="text-align: center;">
		<h2> <?php echo "Xin chào $fullname!" ?> </h2>
		<h1>ĐĂNG KÍ THÀNH CÔNG.</h1>
		<p>ĐĂNG NHẬP NGAY TẠI <a href="managerlogin.php">ĐÂY</a></p>
	</div>
</div>

    </body>

  <footer class="container-fluid bg-4 text-center">
  <br>
  <p> Food Exploria 2017 | &copy  </p>
  <br>
  </footer>
</html>