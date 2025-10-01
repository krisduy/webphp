<?php
session_start();

// Kết nối Database
$conn = mysqli_connect("localhost", "root", "", "huyfood");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// --- Thêm các cột cần thiết nếu chưa tồn tại ---
$alter_sql = "ALTER TABLE contact_messages 
    ADD COLUMN IF NOT EXISTS name VARCHAR(100) AFTER customer_id,
    ADD COLUMN IF NOT EXISTS email VARCHAR(100) AFTER name,
    ADD COLUMN IF NOT EXISTS mobile VARCHAR(20) AFTER email";
mysqli_query($conn, $alter_sql);

// Nếu người dùng ấn nút gửi
if (isset($_POST['submit'])) {

    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile  = mysqli_real_escape_string($conn, $_POST['mobile']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Nếu user đăng nhập là customer thì lấy customer_id
    $customer_id = isset($_SESSION['login_user2_id']) ? $_SESSION['login_user2_id'] : NULL;

    $sql = "INSERT INTO contact_messages (customer_id, name, email, mobile, subject, message) 
            VALUES ('$customer_id', '$name', '$email', '$mobile', '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm.'); </script>";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

?>

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
        <form role="form" method="POST" action="contactus.php">
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
           <textarea class="form-control" type="textarea" id="message" name="message" placeholder="Mô Tả" maxlength="140" rows="7"></textarea>
           <span class="help-block"><p id="characterLeft" class="help-block">Tối đa : 140 từ </p></span>
          </div> 
          <button type="submit" name="submit" class="btn btn-primary pull-right">Gửi</button>    
        </form>
      </div>
    </div>
    </div>

<div class="paragraph1">
    <p><h3>Chúng tôi luôn sẵn sàng giải đáp mọi thắc mắc mà bạn có về những trải nghiệm cùng <font color="green"><strong>HUYFOOD</strong></font>. Hãy liên hệ với chúng tôi và bạn sẽ nhận được phản hồi trong thời gian sớm nhất.</h3></p>
    <p><h3>Ngay cả khi có điều gì bạn luôn mong muốn được trải nghiệm nhưng chưa tìm thấy trên <font color="green"><strong>HUYFOOD</strong></font>, xin vui lòng cho chúng tôi biết.<font color="green"><strong>HUYFOOD cam kết sẽ nỗ lực hết sức để tìm ra cho bạn và gợi ý những điều tuyệt vời nhất.</strong></font> </h3></p>
    <p><b><h3>Thông tin liên hệ của đội ngũ HUYFOOD được cung cấp bên dưới.</h3></b></p>
    <p class="edit2">
        <strong>Email:</strong>  <a href="huyfood345@gmail.com">huyfood@gmail.com</a>
        |
        <strong> Số Điện Thoại  :</strong>  +84 876858550
    </p>
    <p class="edit2"><strong>Liên hệ với chúng tôi qua mạng xã hội :</strong></p>
    <img src="images/facebook.jpg" width="50px" height="50px">
    <img src="images/gg.png" width="50px" height="50px">
    <img src="images/twiterrrrr.jpeg" width="50px" height="50px">
    <img src="images/inta.jpeg" width="50px" height="50px">

    <p class="edit2">Chúng tôi thậm chí còn cung cấp cho bạn một nền tảng để chia sẻ những trải nghiệm ẩm thực và đánh giá của mình bằng cách gửi email cho chúng tôi tại địa chỉ <a href="huyfood345@gmail.com">huyfood123@gmail.com</a> </p>
</div>

  </body>
  <footer class="container-fluid bg-4 text-center">
  <br>
      <p>HUYFOOD 2025 | &copy </p>
  <br>
  </footer>
</html>
