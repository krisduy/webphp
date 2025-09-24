<?php
session_start();
?>

<html>

  <head>
    <title> Trang chủ | HUYFOOD </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">

  <link rel="stylesheet" type = "text/css" href ="css/index.css">
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
              
            </ul>
            </li>

            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Đăng Nhập <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li> <a href="customerlogin.php"> User Đăng Nhập</a></li>
              <li> <a href="managerlogin.php"> Admin Đăng Nhập</a></li>
             
            </ul>
            </li>
          </ul>

<?php
}
?>


        </div>

      </div>
    </nav>

    <div class="wide">
      	<div class="col-xs-5 line"><hr></div>
        <div class="col-xs-2 logo"><img src="images/logothoi.jpg"></div>
        <div class="col-xs-5 line"><hr></div>
        <div class="tagline">Thưởng thức nhanh – Vui trọn vị!</div>
    </div>
    <br>
    <div class="orderblock">
    <h2>Bạn Đang Cảm Thấy Đói?</h2>
    <center><a class="btn btn-success btn-lg" href="customerlogin.php" role="button" > Đặt Hàng Ngay! </a></center>
    </div>

    <div class="col-xs-12 line"><hr></div>

    <div class="wide2">
        <div class="col-xs-4 box">
          <img src="images/minimumx.png" height="200px">
        </div>
        <div class="col-xs-4 box">
          <img src="images/locationx.png">
        </div>
        <div class="col-xs-4 box">
          <img src="images/deliveryx.png">
        </div>

        <div class="col-xs-4 box">
          <h2><strong>Không Giới Hạn<br> Số Lượng Đặt Hàng <br> </strong><hr> </h2>
          <h4>Bạn Muốn Đặt Bao Nhiêu<br> Tùy Ý.<br></h4>
        </div>
        <div class="col-xs-4 box">
          <h2><strong>Theo Dõi Đơn Hàng<br> Trực Tiếp <br> </strong><hr> </h2>
          <h4>Biết Ngay Đơn Hàng Của Bạn Ở Đâu,<br> Bất Cứ Lúc Nào!</h4>
        </div>
        <div class="col-xs-4 box">
          <h2><strong>Giao Hàng<br> Nhanh Chóng <br> </strong><hr> </h2>
          <h4>Đồ Ăn Nóng Hổi<br> Giao Tận Tay!</h4>
        </div>
    </div>

     <div class="col-xs-12 line"><hr></div>

     <div class="paragraph1" style="background-color: #f0f8ff; padding: 20px; border-radius: 10px;">
  <h1>
    <span style="color: #ff6600; font-weight: bold;">Chào Mừng Bạn Đến Với</span> 
    <span style="color: #007acc; font-weight: bold;">HUYFOOD</span>
  </h1>

  <h4 style="color: #333;">
    <span style="color: #007acc; font-weight: bold;">HUYFOOD</span> luôn sẵn sàng mang đến những trải nghiệm ẩm thực tuyệt vời cho bạn và khách ghé thăm.  
    Mỗi bữa ăn được chuẩn bị với tâm huyết và sự tận tâm, tạo nên những khoảnh khắc đáng nhớ.  
    Khách đến, bạn có dịp chia sẻ niềm vui và sự ấm áp qua những hương vị hấp dẫn, khiến mọi người đều cảm thấy hài lòng và vui vẻ.  
    Chúng tôi muốn mỗi lần thưởng thức tại <span style="color: #007acc; font-weight: bold;">HUYFOOD</span> đều là một trải nghiệm dễ chịu, thân thiện và đầy hứng khởi.
  </h4>

  <p style="color: #555;">
    Chúng tôi tin rằng "Khách đến nhà như trời đến nhà" – và với <span style="color: #007acc; font-weight: bold;">HUYFOOD</span>, mỗi bữa ăn đều mang đến niềm vui và sự thoải mái trọn vẹn.
  </p>
</div>




  <footer class="container-fluid bg-4 text-center">
  <br>
  <p> HUYFOOD 2025 | &copy  </p>
  <br>
  </footer>
</html>