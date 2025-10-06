<?php
include('session_m.php');

if(!isset($login_session)){
    header('Location: managerlogin.php'); // Redirecting To Home Page
    exit();
}

// Lấy tên file hiện tại để làm menu active
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Thêm Món Ăn | HUYFOOD</title>
    <link rel="stylesheet" type="text/css" href="css/add_food_items.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>

<body>

    <!-- Thanh navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#myNavbar">
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
                    <li><a href="contactus.php">Liên Hệ</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span>
                        Xin Chào <?php echo $login_session; ?> </a></li>
                    <li class="active"><a href="managerlogin.php">Trang Admin</a></li>
                    <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất </a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Nội dung -->
    <div class="container">
        <div class="jumbotron">
            <h1>Xin Chào Admin!</h1>
            <p>Trang Thêm Sản Phẩm Ở Đây !</p>
        </div>
    </div>

    <div class="container">
        <!-- Menu bên trái -->
        <div class="col-xs-3" style="text-align: center;">
           <div class="list-group">
           <a href="view_food_items.php" class="list-group-item ">Xem Các Món Ăn</a>
         <a href="add_food_items.php" class="list-group-item active">Thêm Món Ăn</a>
         <a href="edit_food_items.php" class="list-group-item ">Chỉnh Sửa Món Ăn</a>
        <a href="delete_food_items.php" class="list-group-item ">Xóa Món Ăn</a>
        <a href="view_order_details.php" class="list-group-item ">Xem Chi Tiết Đơn Hàng</a>
      </div>
           <div style="margin-bottom:15px; text-align:left;">
          <a href="statistics.php" class="btn btn-primary">
        <span class="glyphicon glyphicon-arrow-left"></span> Quay lại Trang Chính
    </a>
</div>

        </div>

        <!-- Form thêm món ăn -->
        <div class="col-xs-9">
            <div class="form-area" style="padding: 0px 100px 100px 100px;">
                <form action="add_food_items1.php" method="POST">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;">
                        Thêm Món Ăn Tại Đây !
                    </h3>

                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Tên Món Ăn" required>
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" id="price" name="price"
                               placeholder="Giá (VNĐ)" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="description" name="description"
                               placeholder="Mô Tả" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="images_path" name="images_path"
                               placeholder="Ảnh Món Ăn [images/<filename>.<extention>]" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">
                            Thêm Món Ăn
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

<footer class="container-fluid bg-4 text-center">
    <br>
    <p>HUYFOOD 2025 | &copy;</p>
    <br>
</footer>

</html>
