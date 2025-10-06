<?php
// Gọi session cho admin
include('session_m.php');
// Kết nối database
require 'connection.php';
$conn = Connect();

// Nếu chưa login thì quay về trang đăng nhập admin
if(!isset($login_session)){
    header("location: managerlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Chi Tiết Đơn Hàng | HUYFOOD</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/view_order_details.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <!-- JS -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>

<!-- Thanh điều hướng -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">HUYFOOD</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Trang Chủ</a></li>
                <li><a href="aboutus.php">Về Chúng Tôi</a></li>
                <li><a href="contactus.php">Liên Hệ </a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <!-- Hiển thị tên admin đang login -->
              <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin Chào <?php echo $login_session; ?></a></li>
              <li class="active"><a href="managerlogin.php">Trang Admin</a></li>
              <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất</a></li>
            </ul>
        </div>
  </div>
</nav>

<!-- Nội dung chính -->
<div class="container" style="margin-top:70px;">
  <div class="jumbotron">
    <h1>Xin Chào Admin</h1>
    <p>Hiển Thị Chi Tiết Tất Cả Đơn Hàng !</p>
  </div>

  <div class="row">
    <!-- Menu bên trái -->
    <div class="col-xs-3" style="text-align: center;">
      <div class="list-group">
        <a href="view_food_items.php" class="list-group-item">Xem Các Món Ăn</a>
        <a href="add_food_items.php" class="list-group-item">Thêm Món Ăn</a>
        <a href="edit_food_items.php" class="list-group-item">Chỉnh Sửa Món Ăn</a>
        <a href="delete_food_items.php" class="list-group-item">Xóa Món Ăn</a>
        <a href="view_order_details.php" class="list-group-item active">Xem Chi Tiết Đơn Hàng</a>
      </div>
      <!-- Nút quay lại -->
      <div style="margin-top:15px; text-align:center;">
        <a href="statistics.php" class="btn btn-primary btn-block">
          <span class="glyphicon glyphicon-arrow-left"></span> Quay lại Trang Chính
        </a>
      </div>
    </div>

    <!-- Danh sách đơn hàng -->
    <div class="col-xs-9">
      <div class="form-area" style="padding: 0px 50px 50px 50px;">
        <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> DANH SÁCH ĐƠN HÀNG </h3>

<?php
// Truy vấn đơn hàng + join với bảng food và customer để lấy thêm thông tin
$sql = "SELECT o.order_id, 
               o.food_id,              -- ID sản phẩm
               f.name AS foodname,     -- tên món ăn
               o.price, 
               o.quantity, 
               c.username AS customer_name, -- tên khách hàng
               o.order_date,
               f.description,          -- mô tả món
               f.images_path           -- ảnh món
        FROM orders o
        LEFT JOIN food f ON o.food_id = f.food_id
        LEFT JOIN customer c ON o.customer_id = c.customer_id
        ORDER BY o.order_date DESC";

$result = mysqli_query($conn, $sql);

// Nếu có đơn hàng thì hiển thị bảng
if(mysqli_num_rows($result) > 0){
?>
  <table class="table table-striped table-bordered">
    <thead class="thead-dark">
      <tr>
        <th>ID Đặt Hàng</th>
        <th>ID Sản Phẩm</th>
        <th>Tên Món</th>
        <th>Giá</th>
        <th>Mô Tả</th>
        <th>Ảnh</th>
        <th>Số Lượng</th>
        <th>Khách Hàng</th>
        <th>Ngày Đặt</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($result)){ ?>
      <tr>
        <td><?php echo $row["order_id"]; ?></td>
        <td><?php echo $row["food_id"]; ?></td>
        <td><?php echo $row["foodname"]; ?></td>
        <td><?php echo number_format($row["price"],0,',','.'); ?> VNĐ</td>
        <td><?php echo !empty($row["description"]) ? $row["description"] : '-'; ?></td>
        <td>
          <?php if(!empty($row["images_path"])): ?>
            <img src="<?php echo $row["images_path"]; ?>" width="80" height="60" style="border-radius:5px;">
          <?php else: ?>
            -
          <?php endif; ?>
        </td>
        <td><?php echo $row["quantity"]; ?></td>
        <td><?php echo $row["customer_name"]; ?></td>
        <td><?php echo $row["order_date"]; ?></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
<?php
} else {
  // Nếu chưa có đơn nào
  echo "<h4><center>Chưa có đơn hàng nào</center></h4>";
}
?>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <br>
  <p>HUYFOOD 2025 | &copy </p>
  <br>
</footer>
</body>
</html>
