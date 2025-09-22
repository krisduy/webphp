<?php
include('session_m.php');
require 'connection.php';
$conn = Connect();

if (!isset($login_session)) {
    header('Location: managerlogin.php'); // Redirecting To Login Page
}

// Lấy F_ID từ URL nếu có
$F_ID = isset($_GET['F_ID']) ? intval($_GET['F_ID']) : 0;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Chi Tiết Đơn Hàng | HUYFOOD</title>
  <link rel="stylesheet" type="text/css" href="css/view_order_details.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">HUYFOOD</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $login_session; ?></a></li>
      <li class="active"><a href="managerlogin.php">TRANG ADMIN</a></li>
      <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất</a></li>
    </ul>
  </div>
</nav>

<div class="container" style="margin-top:70px;">
  <div class="jumbotron">
    <h1>Chi Tiết Đơn Hàng</h1>
    <?php if ($F_ID > 0) {
        echo "<p>Hiển thị đơn hàng cho món ăn ID: $F_ID</p>";
    } else {
        echo "<p>Hiển thị tất cả đơn hàng</p>";
    } ?>
  </div>

  <div class="col-xs-12">
    <div class="form-area" style="padding: 0px 50px 50px 50px;">
      <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> DANH SÁCH ĐƠN HÀNG </h3>

<?php
$sql = "SELECT o.order_ID, o.F_ID, f.name AS foodname, f.price, f.description, f.images_path, o.quantity, o.username, o.order_date
        FROM orders o
        JOIN food f ON o.F_ID = f.F_ID";

if ($F_ID > 0) {
    $sql .= " WHERE o.F_ID = $F_ID";
}

$sql .= " ORDER BY o.order_date DESC";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
?>
  <table class="table table-striped table-bordered">
    <thead class="thead-dark">
      <tr>
        <th>Order ID</th>
        <th>Food ID</th>
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
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $row["order_ID"]; ?></td>
        <td><?php echo $row["F_ID"]; ?></td>
        <td><?php echo $row["foodname"]; ?></td>
        <td><?php echo number_format($row["price"],0,',','.'); ?> VNĐ</td>
        <td><?php echo $row["description"]; ?></td>
        <td><img src="<?php echo $row["images_path"]; ?>" width="80" height="60" style="border-radius:5px;"></td>
        <td><?php echo $row["quantity"]; ?></td>
        <td><?php echo $row["username"]; ?></td>
        <td><?php echo $row["order_date"]; ?></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
<?php
} else {
  echo "<h4><center>Chưa có đơn hàng nào</center></h4>";
}
?>
    </div>
  </div>
</div>

<footer class="container-fluid bg-4 text-center">
  <br>
  <p>HUYFOOD 2025 | &copy All Rights Reserved</p>
  <br>
</footer>
</body>
</html>
