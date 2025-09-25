<?php
session_start();
require 'connection.php';
$conn = Connect();
if(!isset($_SESSION['login_user2'])){
    header("location: customerlogin.php");
    exit();
}
?>

<html>
<head>
    <title> Thanh Toán | HUYFOOD</title>
</head>

<link rel="stylesheet" type="text/css" href="css/payment.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">HUYFOOD</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Trang Chủ</a></li>
        <li><a href="aboutus.php">Về Chúng Tôi</a></li>
        <li><a href="contactus.php">Liên Hệ</a></li>
      </ul>

      <?php
      if(isset($_SESSION['login_user1'])){
      ?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user1']; ?> </a></li>
          <li><a href="view_food_items.php">Trang Admin</a></li>
          <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất </a></li>
        </ul>
      <?php
      } else if(isset($_SESSION['login_user2'])){
      ?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin Chào <?php echo $_SESSION['login_user2']; ?> </a></li>
          <li><a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span> Danh Mục Món Ăn </a></li>
          <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ Hàng
             (<?php echo isset($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0; ?>)
          </a></li>
          <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất </a></li>
        </ul>
      <?php } ?>
    </div>
  </div>
</nav>

<?php
$gtotal = 0;
if(isset($_SESSION["cart"]) && is_array($_SESSION["cart"]) && count($_SESSION["cart"]) > 0){
    foreach($_SESSION["cart"] as $keys => $values){
        $F_ID = $values["food_id"];
        $foodname = $values["food_name"];
        $quantity = $values["food_quantity"];
        $price = $values["food_price"];
        $total = ($quantity * $price);
        $R_ID = $values["R_ID"];
        $username = $_SESSION["login_user2"];
        $order_date = date('Y-m-d');

        $gtotal += $total;

        // Thêm đơn hàng vào bảng ORDERS
        $query = "INSERT INTO orders (F_ID, foodname, price, quantity, order_date, username, R_ID) 
                  VALUES ('$F_ID','$foodname','$price','$quantity','$order_date','$username','$R_ID')";
        $conn->query($query);
    }
?>
    <div class="container">
      <div class="jumbotron">
        <h1>Chọn Phương Thức Thanh Toán</h1>
      </div>
    </div>

    <h1 class="text-center">Tổng Giá Trị Đơn Hàng: <?php echo number_format($gtotal, 0, '.', '.'); ?> VNĐ</h1>
    <h5 class="text-center">Đã bao gồm tất cả phụ phí dịch vụ. (Không áp dụng phí giao hàng)</h5>
    <br>
    <div class="text-center">
      <a href="cart.php" class="btn btn-warning">
        <span class="glyphicon glyphicon-circle-arrow-left"></span> Quay Lại Giỏ Hàng
      </a>
      <a href="COD.php" class="btn btn-success">
        <span class="glyphicon glyphicon-"></span> Thanh Toán Khi Nhận Hàng
      </a>
    </div>

<?php } else { ?>
    <div class="container">
      <div class="jumbotron">
        <h1>Giỏ hàng trống!</h1>
        <p>Vui lòng thêm sản phẩm trước khi thanh toán.</p>
      </div>
    </div>
<?php } ?>

<br><br><br><br><br><br>

<footer class="container-fluid bg-4 text-center">
  <br>
  <p>HUYFOOD 2025 | &copy;</p>
  <br>
</footer>

</body>
</html>
