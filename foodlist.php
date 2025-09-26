<?php
session_start();

if(!isset($_SESSION['login_user2'])){
  header("location: customerlogin.php"); //Redirecting to myrestaurant Page
}
?>

<html>
<head>
  <title> Danh Mục Món Ăn | HUYFOOD </title>
  <link rel="stylesheet" type="text/css" href="css/foodlist.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <style>
    /* ✅ Fix hover giỏ hàng không bị nền đen */
    .navbar-inverse .navbar-nav > li > a {
      color: #fff;
    }
    .navbar-inverse .navbar-nav > li > a:hover {
      background-color: transparent !important;
      color: #ddd !important;
    }

    /* ✅ Fix khung món ăn đều nhau */
    .mypanel {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      padding: 10px;
      margin: 15px 0;
      height: 420px; /* cố định chiều cao khung */
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      text-align: center;
    }

    .mypanel img {
      width: 100%;
      height: 180px;   /* cố định chiều cao ảnh */
      object-fit: cover; /* ảnh luôn nằm gọn trong khung */
      border-radius: 6px;
      margin-bottom: 10px;
    }

    .mypanel h5 {
      margin: 5px 0;
      font-size: 14px;
      text-align: center;
    }
    /* ✅ Input số lượng căn giữa */
        .mypanel input[type="number"] {
            width: 60px;
            margin: 0 auto;
            text-align: center;
            display: block;
        }

        .mypanel .btn-success {
            margin-top: 10px;
        }
  </style>
</head>

<body>

<!-- ======== NAVBAR ======== -->
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

<?php
if(isset($_SESSION['login_user1'])){
?>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin Chào <?php echo $_SESSION['login_user1']; ?> </a></li>
        <li><a href="view_food_items.php">Trang Admin</a></li>
        <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Đăng Xuất </a></li>
      </ul>
<?php
}
else if (isset($_SESSION['login_user2'])) {
  ?>
       <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin Chào <?php echo $_SESSION['login_user2']; ?> </a></li>
        <li class="active"><a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span> Danh Mục Món Ăn </a></li>
        <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ Hàng  (<?php
          if(isset($_SESSION["cart"])){
          $count = count($_SESSION["cart"]); 
          echo "$count"; 
        }
          else
            echo "0";
          ?>) </a></li>

        <!-- 🔎 Thanh tìm kiếm -->
        <li style="padding-top:8px;">
          <form method="GET" action="foodlist.php" class="navbar-form" style="display:flex;  margin:0; padding:0; align-items: center; gap: 5px;">
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

<!-- Carousal -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
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
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>

<div class="jumbotron">
  <div class="container text-center">
    <h1>HUYFOOD</h1>      
    <p>Thưởng thức hương vị, tận hưởng niềm vui.</p>
  </div>
</div>

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
searchInput.parentNode.appendChild(suggestionBox);

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
require 'connection.php';
$conn = Connect();

$search = "";
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM FOOD WHERE name LIKE '%$search%' ORDER BY F_ID";
} else {
    $sql = "SELECT * FROM FOOD ORDER BY F_ID";
}

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
  while($row = mysqli_fetch_assoc($result)){
?>
<div class="col-md-4">
  <form method="post" action="cart.php?action=add&id=<?php echo $row["F_ID"]; ?>">
    <div class="mypanel" align="center">
      <img src="<?php echo $row["images_path"]; ?>" class="img-responsive">
      <h5 class="text-info"><?php echo $row["name"]; ?></h5>
      <h5 class="text-info"><?php echo $row["description"]; ?></h5>
      <h5 class="text-danger"><?php echo number_format($row["price"], 0, ',', '.'); ?> VNĐ</h5>
      <h5 class="text-info">Số lượng: 
        <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> 
      </h5>
      <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
      <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
      <input type="hidden" name="hidden_RID" value="<?php echo $row["R_ID"]; ?>">
      <input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Thêm Vào Giỏ Hàng">
    </div>
  </form>
</div>
<?php
  }
}
else {
  echo '<div class="container"><div class="jumbotron"><center><h2 style="color:red;">Không tìm thấy món ăn nào phù hợp.</h2></center></div></div>';
}
?>
</div>

</body>
<footer class="container-fluid bg-4 text-center">
  <br>
  <p>HUYFOOD 2025 | &copy All Rights Reserved</p>
  <br>
</footer>
</html>
