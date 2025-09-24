<?php
session_start();
?>

<html>

  <head>
    <title> Liên Hệ | HUYFOOD </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/contactus.css">
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
            <li class="active"><a href="contactus.php">Liên Hệ</a></li>
          </ul>

          <?php


if(isset($_SESSION['login_user1'])){

?>


          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin Chào<?php echo $_SESSION['login_user1']; ?> </a></li>
            <li><a href="view_food_items.php">Trang Quản Lí</a></li>
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
    <br>

    <div class="heading">
     <strong>Bạn Muốn Liên Hệ <span class="edit"> HUYFOOD </span>?</strong>
     <br>
    Dưới Đây là Vài Cách Để Liên Hệ Chúng Tôi.
    </div>

    <div class="col-xs-12 line"><hr></div>

    <div class="container" >
    <div class="col-md-5" style="float: none; margin: 0 auto;">
      <div class="form-area">
        <form role="form">
        <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Form Liên Hệ</h3>

          <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên Của Bạn" required autofocus="">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="email" name="email" placeholder="Nhập Email" required>
          </div>     

          <div class="form-group">
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Nhập Số Điện Thoại" required>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Vấn Đề Liên Hệ" required>
          </div>

          <div class="form-group">
           <textarea class="form-control" type="textarea" id="message" placeholder="Mô Tả" maxlength="140" rows="7"></textarea>
           <span class="help-block"><p id="characterLeft" class="help-block">Tối đa : 140 từ </p></span>
          </div> 
          <button type="button" id="submit" name="submit" class="btn btn-primary pull-right">Gửi/button>    
        </form>

        
      </div>
    </div>
      
    </div>

<div class="paragraph1">

    <p><h3>We are here to answer any queries you may have about our <font color="green"><strong>HUYFOOD</strong></font> experiences. Reach out to us and we will respond as soon as we can.</h3></p>
        <p><h3>Even if there is something you always wanted to experience and couldn't find it on <font color="green"><strong>HUYFOOD</strong></font>, please do let us know and we here at <font color="green"><strong>HUYFOOD ?cart?promise to do our best to find it for you and suggest you the best of best.</strong></font> </h3></p>
        <p><b><h3>Contact Details of Team HUYFOOD are given below.</h3></b></p>
        <p class="edit2">
        
        <strong>Email:</strong>  <a href="huyfood345@gmail.com">huyfood@gmail.com</a>
        |
        <strong> Số Điện Thoại  :</strong>  +84 876858550
        
        </p>
        <p class="edit2"><strong>Get in touch with us on Social Media.</strong></p>
        <pre><a href="https://www.facebook.com/HUYFOOD/" target="_blank"><img src="images/facebook.jpg" width="50px" height="50px"></a>  <a href="https://twitter.com/login" target="_blank"><img src="images/googleplus.png" width="50px" height="50px"></a>  <a href="https://www.instagram.com/accounts/login/" target="_blank"><img src="images/twitter.jpg" width="50px" height="50px"></a>  <a href="https://www.facebook.com/huyfood/" target="_blank"><img src="images/insta.jpg" width="50px" height="50px"></a></pre>
        <p class="edit2">We even provide you a platform to share your food experiences and reviews by mailing it to us at <a href="huyfood345@gmail.com">huyfood345@gmail.com</a> </p>
      

</div>
     </body>

  <footer class="container-fluid bg-4 text-center">
  <br>
      <p>HUYFOOD 2025 | &copy All Rights Reserved</p>
  <br>
  </footer>
</html>