<?php
session_start();

// Nếu user chưa đăng nhập thì chuyển hướng về trang login user
if(!isset($_SESSION['login_user2'])){
  header("location: customerlogin.php"); 
}
?>

<html>
<head>
  <title> Danh Mục Món Ăn | HUYFOOD </title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/foodlist.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

  <!-- JS -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <style>
    /* CSS custom cho giao diện */
    .navbar-inverse .navbar-nav > li > a {
      color: #fff;
    }
    .navbar-inverse .navbar-nav > li > a:hover {
      background-color: transparent !important;
      color: #ddd !important;
    }

   /* === CARD MÓN ĂN === */
.mypanel {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  padding: 15px;
  margin: 20px 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  transition: all 0.3s ease-in-out;
  min-height: 450px; /* đồng bộ chiều cao */
}

/* Hiệu ứng hover: nổi lên, đổ bóng */
.mypanel:hover {
  transform: translateY(-6px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

/* Ảnh món ăn */
.mypanel img {
  width: 100%;
  height: 200px;
  object-fit: cover; /* ảnh tự co để vừa khung */
  border-radius: 10px;
  margin-bottom: 12px;
}

/* Tên món */
.mypanel h5.text-info:first-of-type {
  font-size: 18px;
  font-weight: 600;
  color: #333;
  margin-bottom: 8px;
  min-height: 45px; /* giữ card đều nhau */
}

/* Mô tả */
.mypanel h5.text-info:nth-of-type(2) {
  font-size: 14px;
  font-weight: normal;
  color: #666;
  margin-bottom: 12px;
  height: 60px;
  overflow: hidden;
}

/* Giá */
.mypanel h5.text-danger {
  font-size: 16px;
  font-weight: bold;
  color: #e74c3c;
  margin: 10px 0;
}

/* Input số lượng */
.mypanel input[type="number"] {
  width: 70px;
  margin: 0 auto;
  text-align: center;
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 4px;
  transition: border 0.2s ease;
}

.mypanel input[type="number"]:focus {
  border: 1px solid #27ae60;
  outline: none;
}

/* Nút thêm giỏ hàng */
.mypanel .btn-success {
  background: #27ae60;
  border: none;
  border-radius: 8px;
  padding: 10px 18px;
  font-weight: 500;
  font-size: 14px;
  transition: all 0.3s ease;
}

.mypanel .btn-success:hover {
  background: #219150;
  transform: scale(1.05);
}

  </style>
</head>

<body>

<!-- ======== NAVBAR ======== -->
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

<?php
// Nếu là admin đang login
if(isset($_SESSION['login_user1'])){
?>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin Chào <?php echo $_SESSION['login_user1']; ?> </a></li>
        <li><a href="statistics.php">Trang Admin</a></li>
        <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất </a></li>
      </ul>
<?php
}
// Nếu là user đang login
else if (isset($_SESSION['login_user2'])) {
  ?>
       <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin Chào <?php echo $_SESSION['login_user2']; ?> </a></li>
        <li class="active"><a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span> Danh Mục Món Ăn </a></li>
        <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ Hàng (<?php
          // Đếm số lượng sản phẩm trong giỏ
          if(isset($_SESSION["cart"])){
            $count = count($_SESSION["cart"]); 
            echo "$count"; 
          } else {
            echo "0";
          }
        ?>) </a></li>

        <!-- Thanh tìm kiếm -->
        <li style="padding-top:8px;">
          <form method="GET" action="foodlist.php" class="navbar-form" style="display:flex; margin:0; padding:0; align-items: center; gap: 5px;">
            <input type="text" name="search" id="search" 
                   placeholder="Tìm món ăn..."
                   value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" 
                   autocomplete="off"
                   class="form-control" style="width:150px;">
            <button type="submit" class="btn btn-primary">Tìm</button>
          </form>
        </li>
        <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất </a></li>
      </ul>
  <?php    
}
// Nếu chưa login
else {
  ?>
  <ul class="nav navbar-nav navbar-right">
    <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Đăng Kí <span class="caret"></span> </a>
        <ul class="dropdown-menu">
          <li> <a href="customersignup.php"> User Đăng Kí</a></li>
          <li> <a href="managersignup.php"> Admin Đăng Kí</a></li>
        </ul>
    </li>

    <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Đăng Nhập <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li> <a href="customerlogin.php"> User Đăng Nhập</a></li>
        <li> <a href="managerlogin.php"> Admin Đăng Nhập</a></li>
      </ul>
    </li>
  </ul>
<?php
}
?>
    </div>
  </div>
</nav>

<!-- SLIDE -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Nút tròn -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Ảnh -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="images/slide001.jpg" style="width:100%;">
    </div>
    <div class="item">
      <img src="images/slide002.jpg" style="width:100%;">
    </div>
    <div class="item">
      <img src="images/slide003.jpg" style="width:100%;">
    </div>
  </div>

  <!-- Nút qua lại -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>

<!-- Banner giới thiệu -->
<div class="jumbotron">
  <div class="container text-center">
    <h1>HUYFOOD</h1>      
    <p>Thưởng thức hương vị, tận hưởng niềm vui.</p>
  </div>
</div>

<!-- Container hiển thị món ăn -->
<div class="container" style="width:95%;">

<script>
// JS gợi ý tìm kiếm
const searchInput = document.getElementById("search");
const suggestionBox = document.createElement("div");
suggestionBox.id = "suggestion-box";
suggestionBox.style.position = "absolute";
suggestionBox.style.background = "#fff";
suggestionBox.style.border = "1px solid #ccc";
suggestionBox.style.width = "150px";
suggestionBox.style.display = "none";
suggestionBox.style.boxShadow = "0 2px 6px rgba(0,0,0,0.2)";
suggestionBox.style.marginTop = "5px";
suggestionBox.style.zIndex = "9999";

// Thêm suggestionBox ngay sau input search
searchInput.parentNode.appendChild(suggestionBox);

// Bắt sự kiện khi user nhập vào ô search
searchInput.addEventListener("keyup", function() {
  const query = this.value.toLowerCase().trim();

  if (query.length === 0) {
    suggestionBox.style.display = "none";
    suggestionBox.innerHTML = "";
    return;
  }

  // Gợi ý cứng (có thể thay bằng AJAX lấy từ DB FOOD)
  const suggestions = [
    "Phở Ngon Hà Thành",
    "Cơm Tấm Sườn",
    "Mì Cay Hải Sản",
    "Trà Đào",
    "Bún Trộn",
    "Chả Giò",
    "Tokbokki"
  ];

  const matches = suggestions.filter(item => item.toLowerCase().includes(query));

  if (matches.length > 0) {
    suggestionBox.innerHTML = matches.map(item => 
      `<div style="padding:8px; cursor:pointer;" 
            onclick="document.getElementById('search').value='${item}'; 
                     document.querySelector('form').submit();">
         ${item}
       </div>`).join("");
    suggestionBox.style.display = "block";
  } else {
    suggestionBox.style.display = "none";
  }
});
</script>

<?php
// Kết nối DB
require 'connection.php';
$conn = Connect();

// Nếu có tìm kiếm
$search = "";
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM FOOD WHERE name LIKE '%$search%' ORDER BY food_id";
} else {
    $sql = "SELECT * FROM food ORDER BY food_id";
}

$result = mysqli_query($conn, $sql);

// Nếu có món ăn -> hiển thị
if (mysqli_num_rows($result) > 0)
{
  while($row = mysqli_fetch_assoc($result)){
?>
<div class="col-md-4">
  <form method="post" action="cart.php?action=add&id=<?php echo $row["food_id"]; ?>">
    <div class="mypanel" align="center">
      <img src="<?php echo $row["images_path"]; ?>" class="img-responsive">
      <h5 class="text-info"><?php echo $row["name"]; ?></h5>
      <h5 class="text-info"><?php echo $row["description"]; ?></h5>
      <h5 class="text-danger"><?php echo number_format($row["price"], 0, ',', '.'); ?> VNĐ</h5>
      <h5 class="text-info">Số lượng:
        <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> 
      </h5>
      <!-- Truyền dữ liệu ẩn -->
      <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
      <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
      <input type="hidden" name="hidden_RID" value="<?php echo $row["manager_id"]; ?>">
      <input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Thêm Vào Giỏ Hàng">
    </div>
  </form>
</div>
<?php
  }
}
// Nếu không có kết quả
else {
  echo '<div class="container"><div class="jumbotron"><center><h2 style="color:red;">Không tìm thấy món ăn nào phù hợp.</h2></center></div></div>';
}
?>
</div>

</body>
<footer class="container-fluid bg-4 text-center">
  <br>
  <p>HUYFOOD 2025 | &copy </p>
  <br>
</footer>
</html>
