<?php
include('session_m.php');

if(!isset($login_session)){
    header('Location: managerlogin.php'); // Redirecting To Home Page
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title> Admin Đăng Nhập | HUYFOOD </title>
    <link rel="stylesheet" type="text/css" href="css/edit_food_items.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function display_alert() {
            alert("Cập Nhật Thành Công...!!!");
        }
    </script>
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">HUYFOOD</a></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Trang Chủ</a></li>
                <li><a href="aboutus.php">Về Chúng Tôi</a></li>
                <li><a href="contactus.php">Liên Hệ </a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin Chào <?php echo $login_session; ?> </a></li>
                <li class="active"> <a href="managerlogin.php">Trang Admin</a></li>
                <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất </a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="jumbotron">
        <h1> Xin Chào Admin!</h1>
        <p>Chỉnh Sửa Sản Phẩm Ở Đây !</p>
    </div>
</div>

<div class="container">
    <div class="col-xs-3" style="text-align: center;">
        <div class="list-group">
         <a href="view_food_items.php" class="list-group-item ">Xem Các Món Ăn</a>
    		<a href="add_food_items.php" class="list-group-item ">Thêm Món Ăn</a>
    		<a href="edit_food_items.php" class="list-group-item active ">Chỉnh Sửa Món Ăn</a>
    		<a href="delete_food_items.php" class="list-group-item ">Xóa Món Ăn</a>
        <a href="view_order_details.php" class="list-group-item ">Xem Chi Tiết Đơn Hàng</a>
        </div>
    </div>

    <div class="col-xs-3">
        <div class="form-area" style="padding: 10px 10px 110px 10px;">
            <div style="text-align: center;">
                <h3>Chọn Sản Phẩm Muốn Chỉnh Sửa.<br><br></h3>
            </div>
            <?php
            require_once('connection.php');
            $conn = Connect();

            if (isset($_POST['submit'])) {
                $F_ID = $_POST['dfid'];
                $name = $_POST['dname'];
                $price = $_POST['dprice'];
                $description = $_POST['ddescription'];

                // Xử lý upload ảnh
                if(isset($_FILES['dimage']) && $_FILES['dimage']['error'] == 0){
                    $target_dir = "images/";
                    $target_file = $target_dir . basename($_FILES["dimage"]["name"]);
                    move_uploaded_file($_FILES["dimage"]["tmp_name"], $target_file);
                    $query = mysqli_query($conn, "UPDATE food SET name='$name', price='$price', description='$description', images_path='$target_file' WHERE F_ID='$F_ID'");
                } else {
                    $query = mysqli_query($conn, "UPDATE food SET name='$name', price='$price', description='$description' WHERE F_ID='$F_ID'");
                }
            }

            // Lấy danh sách tất cả món ăn
            $query = mysqli_query($conn, "SELECT * FROM food ORDER BY F_ID");
            while ($row = mysqli_fetch_array($query)) {
                echo "<div class='list-group' style='text-align:center;'><b><a href='edit_food_items.php?update={$row['F_ID']}'>{$row['name']}</a></b></div>";
            }
            ?>

            <?php
            if (isset($_GET['update'])) {
                $update = $_GET['update'];
                $query1 = mysqli_query($conn, "SELECT * FROM food WHERE F_ID=$update");
                while ($row1 = mysqli_fetch_array($query1)) {
            ?>
        </div>
    </div>

    <div class="container">
        <div class="col-md-6">
            <div class="form-area" style="padding: 0px 100px 100px 100px;">
                <form action="edit_food_items.php" method="POST" enctype="multipart/form-data">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Chỉnh Sửa Sản Phẩm Ở Đây !</h3>

                    <input type="hidden" name="dfid" value="<?php echo $row1['F_ID']; ?>" />

                    <div class="form-group">
                        <label> Tên Món Ăn: </label>
                        <input type="text" class="form-control" id="dname" name="dname" value="<?php echo htmlspecialchars($row1['name']); ?>" placeholder="Your Food name" required>
                    </div>

                    <div class="form-group">
                        <label> Giá : </label>
                        <input type="text" class="form-control" id="dprice" name="dprice" value="<?php echo $row1['price']; ?>" placeholder="Your Food Price (INR)" required>
                    </div>

                    <div class="form-group">
                        <label> Mô Tả: </label>
                        <input type="text" class="form-control" id="ddescription" name="ddescription" value="<?php echo htmlspecialchars($row1['description']); ?>" placeholder="Your Food Description" required>
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
                        <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right" onclick="display_alert()"> Cập Nhật </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
                }
            }
            mysqli_close($conn);
?>
</div>

<footer class="container-fluid bg-4 text-center">
    <br>
    <p>HUYFOOD 2025 | &copy </p>
    <br>
</footer>
</body>
</html>

