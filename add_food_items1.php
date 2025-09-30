<?php
// Kết nối database
require_once 'connection.php';
$conn = Connect();

// Start session nếu chưa active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra manager đã login chưa
if (!isset($_SESSION['login_user1'])) {
    header("Location: managerlogin.php");
    exit();
}

// Lấy username manager từ session
$user_check = $_SESSION['login_user1']; // username đã login

// Lấy manager_id từ database
$result = $conn->query("SELECT manager_id FROM manager WHERE username='$user_check'");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $manager_id = $row['manager_id']; // dùng để insert food
} else {
    die("Manager không tồn tại trong database.");
}

// Lấy dữ liệu từ form POST và bảo vệ dữ liệu
$name = $conn->real_escape_string($_POST['name']);
$price = $conn->real_escape_string($_POST['price']);
$description = $conn->real_escape_string($_POST['description']);
$images_path = $conn->real_escape_string($_POST['images_path']);

// Query insert món ăn vào bảng food
$query = "INSERT INTO food(name, price, description, images_path, manager_id) 
          VALUES('$name', '$price', '$description', '$images_path', '$manager_id')";
$success = $conn->query($query);

// Xử lý kết quả
if (!$success){
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Thêm Món Ăn Thất Bại</title>
        <link rel="stylesheet" type="text/css" href="css/add_food_items.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
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
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin Chào <?php echo $user_check; ?> </a></li>
                <li class="active"> <a href="managerlogin.php">Trang Admin</a></li>
                <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất </a></li>
              </ul>
            </div>
          </div>
        </nav>

        <div class="container">
            <div class="jumbotron text-center">
             <h1>Ôi!!!</h1>
             <p>Không thể thêm món ăn. Vui lòng kiểm tra lại thông tin bạn đã nhập.</p>
             <p><a href="add_food_items.php">Nhấn vào đây để thử lại</a></p>
            </div>
        </div>

    </body>
    <footer class="container-fluid bg-4 text-center">
      <br>
      <p>HUYFOOD 2025 | &copy;</p>
      <br>
    </footer>
    </html>

<?php
} else {
    // Thêm thành công → hiển thị thông báo popup
    echo "<script>
            alert('Thêm món ăn thành công!');
            window.location.href='add_food_items.php';
          </script>";
    exit();
}

// Đóng kết nối
$conn->close();
?>
