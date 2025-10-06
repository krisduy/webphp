<?php
// Gọi file session kiểm tra admin
include('session_m.php');

// Nếu chưa đăng nhập admin -> quay lại trang login
if(!isset($login_session)){
    header('Location: managerlogin.php'); 
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> Admin Đăng Nhập | HUYFOOD </title>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/edit_food_items.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <!-- JS -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <script type="text/javascript">
        // Hàm thông báo khi cập nhật thành công
        function display_alert() {
            alert("Cập Nhật Thành Công...!!!");
        }
    </script>
</head>

<body>
<!-- Thanh điều hướng -->
<nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
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
                <!-- Hiển thị tên admin đã đăng nhập -->
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin Chào <?php echo $login_session; ?> </a></li>
                <li class="active"> <a href="managerlogin.php">Trang Admin</a></li>
                <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất </a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Banner chào admin -->
<div class="container">
    <div class="jumbotron">
        <h1> Xin Chào Admin!</h1>
        <p>Chỉnh Sửa Sản Phẩm Ở Đây !</p>
    </div>
</div>

<div class="container">
    <!-- Menu trái -->
    <div class="col-xs-3" style="text-align: center;">
        <div class="list-group">
            <a href="view_food_items.php" class="list-group-item ">Xem Các Món Ăn</a>
            <a href="add_food_items.php" class="list-group-item ">Thêm Món Ăn</a>
            <a href="edit_food_items.php" class="list-group-item active ">Chỉnh Sửa Món Ăn</a>
            <a href="delete_food_items.php" class="list-group-item ">Xóa Món Ăn</a>
            <a href="view_order_details.php" class="list-group-item ">Xem Chi Tiết Đơn Hàng</a>
        </div>
         <div style="margin-bottom:15px; text-align:left;">
    <a href="statistics.php" class="btn btn-primary">
        <span class="glyphicon glyphicon-arrow-left"></span> Quay lại Trang Chính
    </a>
</div>
    </div>

    <!-- Danh sách món ăn để chọn chỉnh sửa -->
    <div class="col-xs-3">
        <div class="form-area" style="padding: 10px 10px 110px 10px;">
            <div style="text-align: center;">
                <h3>Chọn Sản Phẩm Muốn Chỉnh Sửa.<br><br></h3>
            </div>
            <?php
            // Kết nối CSDL
            require_once('connection.php');
            $conn = Connect();

            // Nếu admin gửi form cập nhật
            if (isset($_POST['submit']) && isset($_POST['dfid'])) {
                $food_id = $_POST['dfid'];
                $name = $_POST['dname'];
                $price = $_POST['dprice'];
                $description = $_POST['ddescription'];

                // Nếu có upload ảnh mới
                if(isset($_FILES['dimage']) && $_FILES['dimage']['error'] == 0){
                    $target_dir = "images/";
                    $target_file = $target_dir . basename($_FILES["dimage"]["name"]);

                    // Lưu file ảnh vào thư mục images/
                    move_uploaded_file($_FILES["dimage"]["tmp_name"], $target_file);

                    // Update cả ảnh
                    $query_update = mysqli_query($conn, 
                        "UPDATE food 
                         SET name='$name', price='$price', description='$description', images_path='$target_file' 
                         WHERE food_id='$food_id'");
                } else {
                    // Update không thay ảnh
                    $query_update = mysqli_query($conn, 
                        "UPDATE food 
                         SET name='$name', price='$price', description='$description' 
                         WHERE food_id='$food_id'");
                }
            }

            // Lấy danh sách tất cả món ăn
            $query = mysqli_query($conn, "SELECT * FROM food ORDER BY food_id");
            while ($row = mysqli_fetch_array($query)) {
                echo "<div class='list-group' style='text-align:center;'>
                        <b><a href='edit_food_items.php?update={$row['food_id']}'>{$row['name']}</a></b>
                      </div>";
            }
            ?>

            <?php
            // Nếu admin chọn chỉnh sửa 1 món
            if (isset($_GET['update'])) {
                $update_id = $_GET['update'];
                $query1 = mysqli_query($conn, "SELECT * FROM food WHERE food_id=$update_id");

                // Lấy dữ liệu món ăn
                if ($row1 = mysqli_fetch_array($query1)) {
            ?>
        </div>
    </div>

    <!-- Form chỉnh sửa món ăn -->
    <div class="container">
        <div class="col-md-6">
            <div class="form-area" style="padding: 0px 100px 100px 100px;">
                <form action="edit_food_items.php" method="POST" enctype="multipart/form-data">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Chỉnh Sửa Sản Phẩm Ở Đây !</h3>

                    <!-- Ẩn ID món ăn -->
                    <input type="hidden" name="dfid" value="<?php echo $row1['food_id']; ?>" />

                    <div class="form-group">
                        <label> Tên Món Ăn: </label>
                        <input type="text" class="form-control" id="dname" name="dname" 
                               value="<?php echo htmlspecialchars($row1['name']); ?>" 
                               placeholder="Your Food name" required>
                    </div>

                    <div class="form-group">
                        <label> Giá : </label>
                        <input type="text" class="form-control" id="dprice" name="dprice" 
                               value="<?php echo $row1['price']; ?>" 
                               placeholder="Your Food Price (INR)" required>
                    </div>

                    <div class="form-group">
                        <label> Mô Tả: </label>
                        <input type="text" class="form-control" id="ddescription" name="ddescription" 
                               value="<?php echo htmlspecialchars($row1['description']); ?>" 
                               placeholder="Your Food Description" required>
                    </div>

                    <div class="form-group">
                        <label>Ảnh hiện tại:</label><br>
                        <img src="<?php echo $row1['images_path']; ?>" width="100">
                    </div>

                    <div class="form-group">
                        <label>Thay đổi ảnh:</label>
                        <input type="file" name="dimage" accept="image/*">
                    </div>

                    <div class="form-group">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right" onclick="display_alert()"> 
                            Cập Nhật 
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
                }
            }
            // Đóng kết nối
            mysqli_close($conn);
?>
</div>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
    <br>
    <p>HUYFOOD 2025 | &copy </p>
    <br>
</footer>
</body>
</html>
