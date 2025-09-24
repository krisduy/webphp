<?php
session_start();
require 'connection.php';
$conn = Connect();
if(!isset($_SESSION['login_user2'])){
header("location: customerlogin.php"); //Redirecting to myrestaurant Page
}

unset($_SESSION["cart"]);
?>

<html>

  <head>
    <title> Giỏ Hàng | HUYFOOD </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/COD.css">
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
            <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="aboutus.php">Về Chúng Tôi</a></li>
            <li><a href="contactus.php">Liên Hệ</a></li>

          </ul>

<?php
if(isset($_SESSION['login_user1'])){

?>


          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin Chào <?php echo $_SESSION['login_user1']; ?> </a></li>
            <li><a href="view_food_items.php">Trang Admin</a></li>
            <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất </a></li>
          </ul>
<?php
}
else if (isset($_SESSION['login_user2'])) {
  ?>
           <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin Chào <?php echo $_SESSION['login_user2']; ?> </a></li>
            <li><a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span> Danh Mục Món Ăn </a></li>
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ Hàng
             (<?php
              if(isset($_SESSION["cart"])){
              $count = count($_SESSION["cart"]); 
              echo "$count"; 
            }
              else
                echo "0";
              ?>)
              </a></li>
            <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất </a></li>
          </ul>
  <?php        
}
else {

  ?>

<ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Đăng Kí <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="customersignup.php"> User Đăng Kí</a></li>
              <li> <a href="managersignup.php"> Admin Đăng Kí</a></li>
              <li> <a href="#"> Admin Đăng Kí</a></li>
            </ul>
            </li>

            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Đăng Nhập <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li> <a href="customerlogin.php"> User Đăng Nhập</a></li>
              <li> <a href="managerlogin.php"> Admin Đăng Nhập</a></li>
              <li> <a href="#"> Admin Đăng Nhập</a></li>
            </ul>
            </li>
          </ul>

<?php
}
?>


        </div>

      </div>
    </nav>



        <div class="container">
          <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Đặt Hàng Thành Công.</h1>
          </div>
        </div>
        <br>

<h2 class="text-center"> Cảm Ơn Bạn Đã Đặt Món Tại HUYFOOD! Quy Trình Đặt Món Của Bạn Đã Hoàn Tất.</h2>

<?php 
  $num1 = rand(100000,999999); 
  $num2 = rand(100000,999999); 
  $num3 = rand(100000,999999);
  $number = $num1.$num2.$num3;
?>

<h3 class="text-center"> <strong>Mã Đơn Hàng Của Bạn:</strong> <span style="color: blue;"><?php echo "$number"; ?></span> </h3>


 <div class="container" >
  <h5 class="text-center">Vui Lòng Đọc Kĩ Các Thông Tin Sau Về Đơn Hàng Của Bạn.</h5>
  <div class="box">
    <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
      <h3 style="color: orange;">Đơn Hàng Của Bạn Đã Được Tiếp Nhận.</h3>
      <br>
      <h4>Hãy Ghi Chú Lại <strong>Mã Đơn Hàng</strong> Này Và Giữ Trong Trường Hợp Bạn Cần Liên Hệ Chúng Tôi Về Đơn Hàng.</h4>
      <br>
      <h3 style="color: orange;">Nhận Hóa Đơn</h3>
      <br>
      <h4>Khi Đơn Hàng Của Bạn Được Hoàn Tất và Giao Đi,Chúng Tôi Sẽ Gửi Thông Báo Qua Email.</h4>
      <br>
      <h3 style="color: orange;">Giỏ Hàng Của Bạn Vừa Được Làm Trống</h3>
      <br>
      <h4>Các Sản Phẩm Bạn Vừa Mua Sẽ Được Xóa Khỏi Giỏ Hàng.</h4>

    </div>
  

      
<br><br>
        </body>

  <footer class="container-fluid bg-4 text-center">
  <br>
  <p> HUYFOOD 2025 | &copy </p>
  <br>
  </footer>
</html>