<?php
session_start();
require 'connection.php';
$conn = Connect();

// 🔒 Kiểm tra user đã login chưa (nếu chưa thì về trang login)
if(!isset($_SESSION['login_user2'])){
    header("location: customerlogin.php");
    exit();
}

// ✅ Lấy customer_id từ session để lưu vào đơn hàng
if(!isset($_SESSION['login_user2_id'])){
    die("Lỗi: Customer ID chưa được thiết lập. Vui lòng đăng nhập lại.");
}
$customer_id = $_SESSION['login_user2_id'];
?>

<html>
<head>
    <title>Thanh Toán | HUYFOOD</title>
</head>

<link rel="stylesheet" type="text/css" href="css/payment.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<body>

<!-- 🔝 Thanh điều hướng -->
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

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin Chào <?php echo $_SESSION['login_user2']; ?> </a></li>
        <li><a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span> Danh Mục Món Ăn </a></li>
        <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ Hàng
           (<?php echo isset($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0; ?>)
        </a></li>
        <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất </a></li>
      </ul>
    </div>
  </div>
</nav>

<?php
$gtotal = 0; // tổng tiền đơn hàng

// ✅ Kiểm tra giỏ hàng có dữ liệu
if(isset($_SESSION["cart"]) && is_array($_SESSION["cart"]) && count($_SESSION["cart"]) > 0){

    // Duyệt qua từng món trong giỏ
    foreach($_SESSION["cart"] as $keys => $values){
        // Lấy dữ liệu từng món ăn từ session
        $food_id = isset($values["food_id"]) ? $values["food_id"] : 0;
        $quantity = isset($values["food_quantity"]) ? $values["food_quantity"] : 1;
        $price = isset($values["food_price"]) ? $values["food_price"] : 0;
        $manager_id = isset($values["manager_id"]) ? $values["manager_id"] : NULL; // có thể NULL
        $order_date = date('Y-m-d'); // ngày đặt hàng

        // Tính tổng tiền cho món này
        $gtotal += ($quantity * $price);

        // 💾 Chèn đơn hàng vào DB
        $stmt = $conn->prepare("
            INSERT INTO orders (customer_id, food_id, manager_id, quantity, price, order_date)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        if(!$stmt){
            die("Lỗi chuẩn bị câu lệnh: " . $conn->error);
        }

        // Gắn tham số cho câu lệnh (manager_id có thể NULL)
        $stmt->bind_param("iiiids", $customer_id, $food_id, $manager_id, $quantity, $price, $order_date);

        // Thực thi query
        if(!$stmt->execute()){
            die("Lỗi thêm đơn hàng: " . $stmt->error);
        }

        $stmt->close();
    }
?>

<!-- 🎉 Giao diện chọn phương thức thanh toán -->
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

<?php
    // 🧹 Xóa giỏ hàng sau khi tạo đơn hàng thành công
    unset($_SESSION["cart"]);
} else { 
?>
    <!-- Nếu giỏ hàng trống -->
    <div class="container">
      <div class="jumbotron">
        <h1>Giỏ hàng trống!</h1>
        <p>Vui lòng thêm sản phẩm trước khi thanh toán.</p>
      </div>
    </div>
<?php } ?>

<br><br><br><br><br><br>

<!-- 🔻 Footer -->
<footer class="container-fluid bg-4 text-center">
  <br>
  <p>HUYFOOD 2025 | &copy;</p>
  <br>
</footer>

</body>
</html>
