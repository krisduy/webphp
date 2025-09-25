<?php
include('session_m.php');
require_once('connection.php'); // đảm bảo chỉ include 1 lần
$conn = Connect();

if (!isset($login_session)) {
    header('Location: managerlogin.php'); // Redirecting To Home Page
}
?>
<!DOCTYPE html>
<html>
<head><title>Đăng Nhập Admin | HUYFOOD</title>
  <link rel="stylesheet" type="text/css" href="css/view_food_items.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">HUYFOOD</a></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Trang Chủ</a></li>
                <li><a href="aboutus.php">Về Chúng Tôi</a></li>
                <li><a href="contactus.php">Liên hệ </a></li>
            </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin Chào <?php echo $login_session; ?></a></li>
      <li class="active"><a href="managerlogin.php">Trang Admin</a></li>
      <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất</a></li>
    </ul>
    </div>
  </div>
</nav>

<div class="container" style="margin-top:70px;">
  <div class="jumbotron">
    <h1>Xin Chào Admin!</h1>
    <p>Quản Lý Cửa Hàng Tại Đây !</p>
  </div>

  <div class="row">
    <div class="col-xs-3" style="text-align: center;">
      <div class="list-group">
        <a href="view_food_items.php" class="list-group-item ">Xem Các Món Ăn</a>
    		<a href="add_food_items.php" class="list-group-item active">Thêm Món Ăn</a>
    		<a href="edit_food_items.php" class="list-group-item ">Chỉnh Sửa Món Ăn</a>
    		<a href="delete_food_items.php" class="list-group-item ">Xóa Món Ăn</a>
        <a href="view_order_details.php" class="list-group-item ">Xem Chi Tiết Đơn Hàng</a>
      </div>
    </div>

    <div class="col-xs-9">
      <h3 style="text-align:center;">Danh Sách Món Ăn</h3>
      <?php
      $sql = "SELECT * FROM food ORDER BY F_ID DESC";
      $result = mysqli_query($conn, $sql);

      if(mysqli_num_rows($result) > 0) {
      ?>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tên món</th>
              <th>Giá</th>
              <th>Mô tả</th>
              <th>Ảnh</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?php echo $row["F_ID"]; ?></td>
              <td><?php echo $row["name"]; ?></td>
              <td><?php echo number_format($row["price"],0,',','.'); ?> VNĐ</td>
              <td><?php echo $row["description"]; ?></td>
              <td><img src="<?php echo $row["images_path"]; ?>" width="80" height="60"></td>
              <td>
                <a href="edit_food_items.php?F_ID=<?php echo $row['F_ID']; ?>" class="btn btn-warning btn-xs">Chỉnh sửa</a>
                <a href="delete_food_items.php?F_ID=<?php echo $row['F_ID']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc chắn muốn xóa món này?');">Xóa</a>
                <a href="view_order_details.php?F_ID=<?php echo $row['F_ID']; ?>" class="btn btn-info btn-xs">Xem Chi Tiết</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php
      } else {
        echo "<h4><center>Chưa có món ăn nào</center></h4>";
      }
      ?>
    </div>
  </div>
</div>

<footer class="container-fluid text-center" style="margin-top:20px;">
  <p>HUYFOOD 2025 | &copy </p>
</footer>

</body>
</html>
