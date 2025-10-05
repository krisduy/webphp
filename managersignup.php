<html>

  <head>
    <title> Đăng Kí Admin | HUYFOOD </title>
  </head>

  <!-- CSS -->
  <link rel="stylesheet" type = "text/css" href ="css/managersignup.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">

  <!-- JS -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <body>

    <!-- Thanh menu -->
    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <!-- Nút menu toggle cho mobile -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Trang Admin</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Logo -->
          <a class="navbar-brand" href="index.php">HUYFOOD</a>
        </div>

        <div class="collapse navbar-collapse " id="myNavbar">
          <!-- Menu trái -->
          <ul class="nav navbar-nav">
            <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="aboutus.php">Về Chúng Tôi</a></li>
            <li><a href="contactus.php">Liên Hệ</a></li>
          </ul>

          <!-- Menu phải -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Dropdown Đăng ký -->
            <li>
              <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-user"></span> Đăng Kí <span class="caret"></span> 
              </a>
              <ul class="dropdown-menu">
                <li><a href="customersignup.php"> User Đăng Kí</a></li>
                <li><a href="managersignup.php"> Admin Đăng Kí</a></li>
              </ul>
            </li>

            <!-- Dropdown Đăng nhập -->
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
        <h1>Xin Chào, <br> Chào Mừng Bạn Đến Với <span class="edit"> HUYFOOD </span></h1>
        <br>
        <p>Vui lòng đăng kí để tiếp tục.</p>
      </div>
    </div>

    <!-- Form đăng ký -->
    <div class="container" style="margin-top: 4%; margin-bottom: 2%;">
      <div class="col-md-5 col-md-offset-4">
        <div class="panel panel-primary">
          <div class="panel-heading"> Tạo tài khoản mới</div>
          <div class="panel-body">
          
            <!-- Gửi dữ liệu sang manager_registered_success.php để xử lý -->
            <form role="form" action="manager_registered_success.php" method="POST">

              <!-- Họ và tên -->
              <div class="row">
                <div class="form-group col-xs-12">
                  <label for="fullname"><span class="text-danger">*</span> Họ và tên: </label>
                  <div class="input-group">
                    <input class="form-control" id="fullname" type="text" name="fullname" placeholder="Nhập họ và tên bạn" required autofocus>
                    <span class="input-group-btn">
                      <label class="btn btn-primary"><span class="glyphicon glyphicon-user"></span></label>
                    </span>
                  </div>           
                </div>
              </div>

              <!-- Username -->
              <div class="row">
                <div class="form-group col-xs-12">
                  <label for="username"><span class="text-danger">*</span> Username: </label>
                  <div class="input-group">
                    <input class="form-control" id="username" type="text" name="username" placeholder="Nhập Username" required>
                    <span class="input-group-btn">
                      <label class="btn btn-primary"><span class="glyphicon glyphicon-user"></span></label>
                    </span>
                  </div>           
                </div>
              </div>

              <!-- Email -->
              <div class="row">
                <div class="form-group col-xs-12">
                  <label for="email"><span class="text-danger">*</span> Email: </label>
                  <div class="input-group">
                    <input class="form-control" id="email" type="email" name="email" placeholder="Nhập Email" required>
                    <span class="input-group-btn">
                      <label class="btn btn-primary"><span class="glyphicon glyphicon-envelope"></span></label>
                    </span>
                  </div>           
                </div>
              </div>

              <!-- Số điện thoại -->
              <div class="row">
                <div class="form-group col-xs-12">
                  <label for="contact"><span class="text-danger">*</span> Số điện thoại: </label>
                  <div class="input-group">
                    <input class="form-control" id="contact" type="text" name="contact" placeholder="Nhập số điện thoại" required>
                    <span class="input-group-btn">
                      <label class="btn btn-primary"><span class="glyphicon glyphicon-phone"></span></label>
                    </span>
                  </div>           
                </div>
              </div>

              <!-- Địa chỉ -->
              <div class="row">
                <div class="form-group col-xs-12">
                  <label for="address"><span class="text-danger">*</span> Địa chỉ: </label>
                  <div class="input-group">
                    <input class="form-control" id="address" type="text" name="address" placeholder="Địa chỉ" required>
                    <span class="input-group-btn">
                      <label class="btn btn-primary"><span class="glyphicon glyphicon-home"></span></label>
                    </span>
                  </div>           
                </div>
              </div>

              <!-- Password -->
              <div class="row">
                <div class="form-group col-xs-12">
                  <label for="password"><span class="text-danger">*</span> Password: </label>
                  <div class="input-group">
                    <input class="form-control" id="password" type="password" name="password" placeholder="Nhập Password" required>
                    <span class="input-group-btn">
                      <label class="btn btn-primary"><span class="glyphicon glyphicon-lock"></span></label>
                    </span>
                  </div>           
                </div>
              </div>

              <!-- Nút đăng ký -->
              <div class="row">
                <div class="form-group col-xs-4">
                  <button class="btn btn-primary" type="submit">Đăng Kí</button>
                </div>
              </div>

              <!-- Link đăng nhập nếu đã có tài khoản -->
              <label style="margin-left: 5px;">hoặc</label> <br>
              <label style="margin-left: 5px;"><a href="managerlogin.php">Đã có tài khoản? Đăng Nhập.</a></label>

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
