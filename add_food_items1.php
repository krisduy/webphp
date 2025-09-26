<?php
include('session_m.php');

if(!isset($login_session)){
    header('Location: managerlogin.php'); // Redirecting To Home Page
    exit();
}
$name = $conn->real_escape_string($_POST['name']);
$price = $conn->real_escape_string($_POST['price']);
$description = $conn->real_escape_string($_POST['description']);
$images_path = $conn->real_escape_string($_POST['images_path']);

$R_ID = 1;

$query = "INSERT INTO FOOD(name, price, description, R_ID, images_path) 
          VALUES('$name', '$price', '$description', '$R_ID', '$images_path')";
$success = $conn->query($query);

if (!$success){
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/add_food_items.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </head>
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

            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li><a href="index.php">Trang Chủ</a></li>
                <li><a href="aboutus.php">Về Chúng Tôi</a></li>
                <li><a href="contactus.php">Liên Hệ</a></li>
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
             <h1> Ôi!!! </h1>
             <p>Không thể thêm món ăn . Vui lòng Kiểm Tra Lại Thông Tin Bạn Đã Nhập.</p>
             <p><a href="add_food_items.php"> Nhấn Vào Đây Để Thêm </a></p>
            </div>
        </div>

    </body>
    <footer class="container-fluid bg-4 text-center">
      <br>
    <p>HUYFOOD 2025 | &copy </p>
      <br>
    </footer>
    </html>

    <?php
} else {
    header('Location: add_food_items.php');
    exit();
}

$conn->close();
?>
