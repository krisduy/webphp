<?php
session_start();
?>

<html>

  <head>
    <title> VỀ CHÚNG TÔI | HUYFOOD </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/aboutus.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <body>

  <!--Back to top button..................................................................................-->
    <button onclick="topFunction()" id="myBtn" title="Go to top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
  <!--Javacript for back to top button....................................................................-->
    <script type="text/javascript">
      window.onscroll = function()
      {
        scrollFunction()
      };

      function scrollFunction(){
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("myBtn").style.display = "block";
        } else {
          document.getElementById("myBtn").style.display = "none";
        }
      }

      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>

    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Food Exploria</a>
        </div>

        <div class="collapse navbar-collapse " id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="aboutus.php">About</a></li>
            <li><a href="contactus.php">Contact Us</a></li>
          </ul>

<?php
if(isset($_SESSION['login_user1'])){

?>


          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user1']; ?> </a></li>
            <li><a href="myrestaurant.php">MANAGER CONTROL PANEL</a></li>
            <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> ĐĂNG XUẤT </a></li>
          </ul>
<?php
}
else if (isset($_SESSION['login_user2'])) {
  ?>
           <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> CHÀO MỪNG <?php echo $_SESSION['login_user2']; ?> </a></li>
            <li><a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span> DANH MỤC MÓN ĂN </a></li>
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> GIỎ HÀNG 
            (<?php
              if(isset($_SESSION["cart"])){
              $count = count($_SESSION["cart"]); 
              echo "$count"; 
            }
              else
                echo "0";
              ?>)
            </a></li>
            <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> ĐĂNG XUẤT </a></li>
          </ul>
  <?php        
}
else {

  ?>

<ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Sign Up <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="customersignup.php"> KHÁCH HÀNG ĐĂNG KÍ</a></li>
              <li> <a href="managersignup.php"> ADMIN ĐĂNG KÍ</a></li>
          
            </ul>
            </li>

            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li> <a href="customerlogin.php"> KHÁCH HÀNG ĐĂNG NHẬP</a></li>
              <li> <a href="managerlogin.php"> ADMIN ĐĂNG NHẬP</a></li>

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
        
        <div class="tagline">NHANH <font color="red"><strong>-NGON</strong></font>,-RẺ <font color="green"><strong><em>-TIỆN</em>.</strong></font></div>
    </div>

    <div class="paragraph1">
      <h1>ĐỘI NGŨ CHÚNG TÔI</h1>
      <h3><p>HuyFood ra đời năm 2025, mang đến những món ăn chất lượng, được chế biến tinh tế và đầy sáng tạo.</p><p>Chúng tôi không ngừng đổi mới để đem lại trải nghiệm ẩm thực ngon miệng và đáng nhớ cho bạn. </p></h3>
    </div>

    <div class="col-xs-12 line"><hr></div>

    <div class="col-md-10" style="float: none; margin: 0 auto;">
        <div class="paragraph2">
          <h1><center>Một vài điều HuyFood tin tưởng</center></h1>
          <p><br>
          <div class="goldcolor">
          <h2>1. Chọn nguyên liệu đúng.</h2>
          </div>
          <h3>Mọi món ngon bắt đầu từ nguyên liệu chuẩn. Chúng tôi luôn đảm bảo chọn lọc những gì tươi ngon và chất lượng nhất.</h3> 
          </p>
          <p><br>
          <div class="goldcolor">
          <h2>2. Tìm hương vị mới.</h2>
          </div>
          <h3>Ẩm thực là hành trình sáng tạo. Chúng tôi không ngừng thử nghiệm để mang đến cho bạn những trải nghiệm vị giác <strong>“À ha!”</strong> đầy bất ngờ.</h3> 
          </p>
          <p><br>
          <div class="goldcolor">
            <h2>3. Khách hàng là bạn đồng hành.</h2>
            </div>
            <h3>Bạn đến với HuyFood, và chúng ta cùng nhau thưởng thức, cùng nhau chia sẻ. Chúng tôi lắng nghe để phục vụ tốt hơn.</h3>
          </p>
          <p><br>
          <div class="goldcolor">
            <h2>4. Linh hoạt trong chế biến.</h2>
            </div>
            <h3>Không gò bó trong một công thức, HuyFood chọn cách chế biến phù hợp nhất để tôn lên hương vị tự nhiên của món ăn.</h3>
          </p>
          <p><br>
          <div class="goldcolor">
            <h2>5. Ẩm thực cho cuộc sống.</h2>
            </div>
            <h3>Mỗi món ăn không chỉ ngon miệng mà còn mang lại giá trị thật sự: sự no đủ, niềm vui và những khoảnh khắc gắn kết.</h3>
          </p>
        </div>
    </div>

    <div class="col-xs-12 line"><hr></div>

    <div class="paragraph1">
    <h1><strong> VỀ CHÚNG TÔI </strong></h1>
    <h3>
      <p>
        Mục đích của <font color="green"><strong>HUYFOOD</strong></font> là mang đến một hệ thống phục vụ món ăn nhanh chóng, tiện lợi và chất lượng. Chúng tôi lưu trữ và quản lý thực đơn, đơn hàng rõ ràng để khách hàng dễ dàng lựa chọn và thưởng thức.
      </p>
      <p>
        <font color="green"><strong>HUYFOOD</strong></font>hướng đến sự chính xác, an toàn và tin cậy, giúp khách hàng yên tâm trải nghiệm mà không lo rắc rối hay chờ đợi. Nhờ đó, chúng tôi có thể tập trung vào việc nâng cao hương vị và chất lượng món ăn.
      </p>
      <p>
        <font color="green"><strong>iều quan trọng nhất, HuyFood muốn mỗi bữa ăn không chỉ ngon miệng mà còn mang lại niềm vui và sự gắn kết cho khách hàng.</strong></font> 
      </p>
    </h3>  
    </div>

    <div class="col-xs-12 line"><hr></div>
  <div class="paragraph3">
    <div class="missionbox">
      <div class="missionfont">
      <strong>HUYFOOD – Chất lượng trong từng món ăn.</strong>
      
    </div>
     
    </div>
    
  </div>    
  

  <footer class="container-fluid bg-4 text-center">
  <br>
  <p> HUYFOOD 2025 | &copy </p>
  <br>
  </footer>
</html>