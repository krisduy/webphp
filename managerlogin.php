<?php
// Gọi file xử lý đăng nhập cho Admin
include('login_m.php'); 

// Nếu Admin đã đăng nhập rồi thì tự động chuyển về trang quản lý món ăn
if(isset($_SESSION['login_user1'])){
  header("location: view_food_items.php");
}
?>

<!DOCTYPE html>
<html>

  <head>
    <title> Đăng nhập Admin | HUYFOOD </title>
  </head>

  <!-- CSS cho giao diện -->
  <link rel="stylesheet" type = "text/css" href ="css/managerlogin.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">

  <!-- JS hỗ trợ Bootstrap -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <body>

    <!-- Thanh menu -->
    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <!-- Nút toggle cho mobile -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Trang Admin</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Logo HUYFOOD -->
          <a class="navbar-brand" href="index.php">HUYFOOD</a>
        </div>

        <!-- Menu chính -->
        <div class="collapse navbar-collapse " id="myNavbar">
          <ul class="nav navbar-nav">
            <li ><a href="index.php">Trang Chủ</a></li>
            <li><a href="aboutus.php">Về Chúng Tôi</a></li>
            <li><a href="contactus.php">Liên Hệ</a></li>
          </ul>

          <!-- Menu phải: Đăng ký / Đăng nhập -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Đăng ký -->
            <li>
              <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-user"></span> Đăng Kí <span class="caret"></span> 
              </a>
              <ul class="dropdown-menu">
                <li><a href="customersignup.php"> User Đăng Kí</a></li>
                <li><a href="managersignup.php"> Admin Đăng Kí</a></li>
              </ul>
            </li>

            <!-- Đăng nhập -->
            <li>
              <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-log-in"></span> Đăng Nhập <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="customerlogin.php"> User Đăng Nhập</a></li>
                <li><a href="managerlogin.php"> Admin Đăng Nhập</a></li>
              </ul>
            </li>
          </ul>
        </div>

      </div>
    </nav>

    <!-- Phần chào mừng -->
    <div class="container">
      <div class="jumbotron">
        <h1>Xin Chào Admin,<br> Chào Mừng Bạn Đến Với <span class="edit"> HUYFOOD </span></h1>
        <br>
        <p>Vui lòng đăng nhập để tiếp tục.</p>
      </div>
    </div>

    <!-- Form đăng nhập -->
    <div class="container" style="margin-top: 4%; margin-bottom: 2%;">
      <div class="col-md-5 col-md-offset-4">
        
        <!-- Hiển thị lỗi đăng nhập nếu có -->
        <label style="margin-left: 5px;color: red;">
          <span> <?php echo $error;  ?> </span>
        </label>

        <div class="panel panel-primary">
          <div class="panel-heading"> Đăng Nhập </div>
          <div class="panel-body">
            
            <!-- Form login -->
            <form action="" method="POST">
              
              <!-- Nhập Username -->
              <div class="row">
                <div class="form-group col-xs-12">
                  <label for="username">
                    <span class="text-danger" style="margin-right: 5px;">*</span> Username: 
                  </label>
                  <div class="input-group">
                    <input class="form-control" id="username" type="text" name="username" placeholder="Username" required="" autofocus="">
                    <span class="input-group-btn">
                      <label class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></label>
                    </span>
                  </div>           
                </div>
              </div>

              <!-- Nhập Password -->
              <div class="row">
                <div class="form-group col-xs-12">
                  <label for="password">
                    <span class="text-danger" style="margin-right: 5px;">*</span> Password: 
                  </label>
                  <div class="input-group">
                    <input class="form-control" id="password" type="password" name="password" placeholder="Password" required="">
                    <span class="input-group-btn">
                      <label class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></label>
                    </span>
                  </div>           
                </div>
              </div>

              <!-- Nút đăng nhập -->
              <div class="row">
                <div class="form-group col-xs-4">
                    <button class="btn btn-primary" name="submit" type="submit" value="Login">Đăng nhập</button>
                </div>
              </div>

              <!-- Link tạo tài khoản mới -->
              <label style="margin-left: 5px;">hoặc</label> <br>
              <label style="margin-left: 5px;"><a href="managersignup.php">Tạo tài khoản mới.</a></label>
            
            </form>

          </div>
        </div>
        
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
