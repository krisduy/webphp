<?php
include('session_m.php'); // Gọi session kiểm tra admin đã đăng nhập hay chưa

// Nếu chưa đăng nhập thì chuyển hướng về trang đăng nhập admin
if(!isset($login_session)){
    header('Location: managerlogin.php'); 
    exit();
}

require_once('connection.php'); // Gọi file kết nối DB
$conn = Connect(); // Kết nối Database

// --- Xử lý khi admin bấm nút XÓA ---
if (isset($_POST['delete'])) {
    // Kiểm tra có checkbox nào được chọn không
    if (isset($_POST['checkbox']) && is_array($_POST['checkbox']) && !empty($_POST['checkbox'])) {
        // Ép kiểu int từng ID để chống SQL Injection
        $checkbox = array_map('intval', $_POST['checkbox']); 
        // Ghép thành chuỗi ID cách nhau bằng dấu ,
        $ids = implode(',', $checkbox);

        // Câu lệnh SQL xóa theo danh sách ID đã chọn
        $sql = "DELETE FROM food WHERE food_id IN ($ids)";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Xóa thành công!'); window.location.href='delete_food_items.php';</script>";
            exit();
        } else {
            echo "<script>alert('Xóa thất bại: ".mysqli_error($conn)."'); window.location.href='delete_food_items.php';</script>";
            exit();
        }
    } else {
        // Nếu không chọn món nào thì báo lỗi
        echo "<script>alert('Bạn chưa chọn món ăn nào để xóa!'); window.location.href='delete_food_items.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title> Admin Đăng Nhập | HUYFOOD </title>
    <!-- Gọi file CSS và JS -->
    <link rel="stylesheet" type="text/css" href="css/delete_food_items.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>

<body>

<!-- Thanh menu điều hướng -->
<nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">HUYFOOD</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Trang Chủ </a></li>
        <li><a href="aboutus.php">Về Chúng Tôi</a></li>
        <li><a href="contactus.php">Liên Hệ</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!-- Hiển thị tên admin đã login -->
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin Chào <?php echo $login_session; ?> </a></li>
        <li class="active"> <a href="managerlogin.php">Trang Admin</a></li>
        <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất  </a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Tiêu đề trang -->
<div class="container">
    <div class="jumbotron">
        <h1>Xin Chào Admin! </h1>
        <p>Đây Là Trang Xóa Sản Phẩm !</p>
    </div>
</div>

<div class="container">
    <!-- Menu chức năng bên trái -->
    <div class="col-xs-3" style="text-align: center;">
        <div class="list-group">
           <a href="view_food_items.php" class="list-group-item ">Xem Các Món Ăn</a>
           <a href="add_food_items.php" class="list-group-item ">Thêm Món Ăn</a>
           <a href="edit_food_items.php" class="list-group-item ">Chỉnh Sửa Món Ăn</a>
           <a href="delete_food_items.php" class="list-group-item active ">Xóa Món Ăn</a>
           <a href="view_order_details.php" class="list-group-item ">Xem Chi Tiết Đơn Hàng</a>
        </div>
    </div>

    <!-- Nội dung chính: bảng danh sách món ăn -->
    <div class="col-xs-9">
      <div class="form-area" style="padding: 0px 100px 100px 100px;">
        <form action="delete_food_items.php" method="POST">
        <br style="clear: both">
        <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Xóa Sản Phẩm Ở Đây.</h3>

<?php
// Lấy tất cả món ăn từ bảng food
$sql = "SELECT * FROM food ORDER BY food_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
?>

<!-- Bảng hiển thị danh sách món ăn -->
<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th>#</th>
      <th>ID</th>
      <th>Tên Món Ăn</th>
      <th>Giá</th>
      <th>Mô Tả</th>
      <th>Ảnh</th>
    </tr>
  </thead>

<?php
  // Duyệt từng dòng dữ liệu món ăn
  while($row = mysqli_fetch_assoc($result)){
?>
  <tbody>
    <tr>
      <!-- Checkbox chọn món ăn để xóa -->
      <td> <input name="checkbox[]" type="checkbox" value="<?php echo $row['food_id']; ?>"/> </td>
      <td><?php echo $row["food_id"]; ?></td>
      <td><?php echo $row["name"]; ?></td>
      <td><?php echo $row["price"]; ?></td>
      <td><?php echo $row["description"]; ?></td>
      <!-- Hiển thị ảnh sản phẩm -->
      <td><img src="<?php echo $row["images_path"]; ?>" width="80" height="60"></td>
    </tr>
  </tbody>
<?php } ?>
</table>

<br>
<!-- Nút xóa -->
<div class="form-group">
  <button type="submit" id="submit" name="delete" value="Delete" class="btn btn-danger pull-right"> Xóa </button>    
</div>

<?php } else { ?>
<!-- Nếu không có sản phẩm nào -->
<h4><center>0 RESULTS</center> </h4>
<?php } ?>

        </form>
      </div>
    </div>
</div>

</body>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
<br>
 <p>HUYFOOD 2025 | &copy </p>
<br>
</footer>
</html>
